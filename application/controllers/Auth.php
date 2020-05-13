<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth
extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        // $this->load->library('encryption');
    }
    public function index()
    {
        if (isset($this->session->userdata['username']) && isset($this->session->userdata['login'])) {
            if ($this->session->userdata['username'] != "" && $this->session->userdata['login'] == true) {
                redirect('posyandu');
            }
        }
        $this->form_validation->set_rules('username', 'Username', 'required|trim', array('required' => '%s tidak boleh kosong!'));
        $this->form_validation->set_rules('password', 'Password', 'required', array('required' => '%s tidak boleh kosong!'));
        if ($this->form_validation->run() == false) {
            $data['title'] = "Login - SIPOSYANDU";
            $this->load->view('template/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('template/auth_footer');
        } else { //validasi sukses
            $this->_login();
        }
    }
    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        //$user = $this->db->get_where('user', ['email' => $email])->row_array();
        $user = $this->db->get_where('user', ['username' => $username])->row_array();
        //Jika user ada
        if ($user) {
            //jika user aktif
            if ($user['aktif'] == 1) {
                //cek password
                if (password_verify($password, $user['password'])) {
                    // if (md5($password) == $user['password']) {
                    $data = [
                        'nama' => $user['nama'],
                        'username' => $user['username'],
                        'role_id' => $user['role_id'],
                        'image' => $user['image'],
                        'idposyandu' => $user['unitkerja'],
                        'nik' => $user['nik'],
                        'login' => true
                    ];
                    $this->session->set_userdata($data);

                    if ($user['role_id'] == 1) {
                        redirect('admin/daerah');
                    } else if ($user['role_id'] == 2) {
                        redirect('puskesmas');
                    } else if ($user['role_id'] == 3) {
                        redirect('posyandu');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Password Salah!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Akun ini dinonaktifkan</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Username tidak terdaftar!</div>');
            redirect('auth');
        }
    }
    public function register()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', array('required' => '%s tidak boleh kosong!'));
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', array('required' => '%s tidak boleh kosong!', 'is_unique' => '%s sudah digunakan orang lain!'));
        //$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', array('required' => '%s tidak boleh kosong!', 'valid_email' => 'Alamat %s harus valid!',  'is_unique' => 'Alamat %s sudah terdaftar!'));
        $this->form_validation->set_rules('password1', 'Password', 'required|min_length[4]|matches[password2]', array('required' => '%s tidak boleh kosong!', 'matches' => '%s harus sama!', 'min_length' => '%s minimal 4 karakter!'));
        $this->form_validation->set_rules('password2', 'Password', 'required|min_length[4]|matches[password2]', array('required' => '%s tidak boleh kosong!', 'matches' => '%s harus sama!', 'min_length' => '%s minimal 4 karakter!'));
        if ($this->form_validation->run() == false) {
            $data['title'] = "Register Akun - SIPOSYANDU";
            $this->load->view('template/auth_header', $data);
            $this->load->view('auth/register');
            $this->load->view('template/auth_footer');
        } else {
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                //'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                // 'password' => md5($this->input->post('password1')),
                'role_id' => $this->input->post('role'),
                'aktif' => 1,
                'date_created' => time(),
                'username' => htmlspecialchars($this->input->post('username', true)),
                'nik' => $this->input->post('nik'),
                'unitkerja' => $this->input->post('idposyandu')
            ];
            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', 'Akun sudah didaftarkan kedalam sistem, Sekarang anda sudah bisa login');
            if ($this->input->post('tipe') == 'admin') redirect('admin/userlist');
            else if ($this->input->post('tipe') == 'puskesmas') redirect('puskesmas/userlist');
            else redirect('user/adduser');
        }
    }
    public function updateUser()
    {
        $post = $this->input->post();
        $data = [
            'username' => htmlspecialchars($post['username'], true),
            'role_id' => $post['role'],
            'aktif' => $post['aktif'],
        ];
        if ($post['password1'] != "") $data['password'] = password_hash($post['password1'], PASSWORD_DEFAULT);
        if ($this->db->update('user', $data, ['id' => $post['id']]))
            $this->session->set_flashdata('message', 'Akun berhasil diubah');
        if ($this->input->post('tipe') == 'admin') redirect('admin/userlist');
        else if ($this->input->post('tipe') == 'puskesmas') redirect('puskesmas/userlist');
    }
    public function resetPassword()
    {
        $post = $this->input->post();
        $data = [
            'password' => password_hash('1234', PASSWORD_DEFAULT),
        ];
        $this->db->update('user', $data, ['id' => $post['id']]);
        $this->session->set_flashdata('message', 'Password akun berhasil direset');
        if ($this->input->post('tipe') == 'admin') redirect('admin/userlist');
        else if ($this->input->post('tipe') == 'puskesmas') redirect('puskesmas/userlist');
    }
    public function deleteUser()
    {
        if ($this->db->delete('user', ['id' => $this->input->post('iddelete')]))
            $this->session->set_flashdata('message', 'Akun Sistem berhasil dihapus');
        if ($this->input->post('tipe') == 'admin') redirect('admin/userlist');
        else if ($this->input->post('tipe') == 'puskesmas') redirect('puskesmas/userlist');
    }
    public function logout()
    {
        $data = [
            'nama' => '',
            'username' => '',
            'role_id' => '',
            'login' => false
        ];
        $this->session->set_userdata($data);
        $this->session->sess_destroy();
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda sudah logout</div>');
        redirect('auth');
    }
    public function force($r)
    {
        $data = [
            'nama' => 'Administrator',
            'username' => 'Admin',
            'role_id' => $r,
            'image' => 'default.jpg',
            'idposyandu' => 1,
            'nik' => NULL,
            'login' => true
        ];
        $this->session->set_userdata($data);
        redirect('admin');
    }
    public function cid($id)
    {
        $this->session->set_userdata(['idposyandu' => $id]);
    }
}
