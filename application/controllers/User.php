<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User
extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!isset($this->session->userdata['username']) || $this->session->userdata['username'] == "") {
            redirect('auth');
        }
        $this->load->model('penduduk_model');
        $this->load->library('form_validation');
    }
    public function index()
    {
        $username = $this->session->userdata['username'];
        $user = $this->db->select('user.username, user.nama, user_role.role, tbposyandu.namaposyandu as posyandu')
            ->select('user.date_created, user.image')
            ->join('user_role', 'user.role_id = user_role.id')
            ->join('tbposyandu', 'user.unitkerja = tbposyandu.idposyandu')
            ->get_where('user', ['username' => $username])->row_array();
        $data['user'] = $user;
        $data['title'] = "User Info - SIPOSYANDU";

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('template/footer');
    }
    public function penduduk()
    {
        $data['user'] = $this->session->userdata();
        $head['title'] = "Daftar Penduduk - SIPOSYANDU";
        $idposyandu = $data['user']['idposyandu'];
        $data['posyandu'] = $this->db->where('idposyandu', $idposyandu)->get('tbposyandu')->row_array();
        $data['penduduk'] = $this->penduduk_model->getPendudukLokal($idposyandu);

        $this->load->view('template/header', $head);
        $this->load->view('template/sidebar', $data);
        $this->load->view('user/penduduk', $data);
        $this->load->view('template/footer');
    }
    public function tambahpenduduk($idp)
    {
        $penduduk = $this->penduduk_model;
        $validation = $this->form_validation;
        $validation->set_rules($penduduk->rules());

        if ($validation->run()) {
            $penduduk->save();
            $this->session->set_flashdata("sukses", "Data penduduk berhasil disimpan");
            if (isset($_POST['ukur'])) redirect('posyandu/pengukuran');
            else if (isset($_POST['daftar'])) redirect('posyandu/peserta');
            else {
                if ($this->session->userdata('role_id') < 3)
                    $url = "puskesmas/penduduk/" . $_POST['idposyandu'];
                else $url = "user/penduduk";
                redirect($url);
            }
        } else {
            $this->session->set_flashdata("form_error", form_error('nik'));
            if (isset($_POST['ukur'])) redirect('posyandu/pengukuran');
            else if (isset($_POST['daftar'])) redirect('posyandu/peserta');

            $data['user'] = $this->session->userdata();
            $head['title'] = "Tambah Penduduk - SIPOSYANDU";
            $data['posyandu'] = $this->db->where('idposyandu', $idp)->get('tbposyandu')->row_array();

            $this->load->view('template/header', $head);
            $this->load->view('template/sidebar', $data);
            $this->load->view('user/tambahpenduduk', $data);
            $this->load->view('template/footer');
        }
    }
    public function editpenduduk($nik)
    {
        $head['title'] = "Edit Data Penduduk - SIPOSYANDU";
        $data['user'] = $this->session->userdata();
        $data['penduduk'] = $this->penduduk_model->getPenduduk($nik);

        $this->load->view('template/header', $head);
        $this->load->view('template/sidebar', $data);
        $this->load->view('user/editpenduduk', $data);
        $this->load->view('template/footer');
    }
    public function updatependuduk()
    {
        $penduduk = $this->penduduk_model;
        $validation = $this->form_validation;
        $validation->set_rules($penduduk->rules());

        if ($validation->run()) {
            $penduduk->update();
            $this->session->set_flashdata("sukses", "Data penduduk berhasil diubah");
            redirect('user/penduduk');
        } else {
            $this->session->set_flashdata("gagal", "Data penduduk gagal diubah");
            redirect('user/penduduk');
        }
    }
    public function deletePenduduk()
    {
        $id = $this->input->post('idhapus');
        if (!$this->penduduk_model->checkTimbanganPenduduk($id)) {
            if ($this->penduduk_model->delete($id)) $this->session->set_flashdata("sukses", "Data Penduduk berhasil dihapus");
            else $this->session->set_flashdata("gagal", "Data Penduduk gagal dihapus");
        } else $this->session->set_flashdata("gagal", "Data Penduduk gagal dihapus, sudah ada data pengukuran pada penduduk ini");
        // if ($this->penduduk_model->delete($id)) $this->session->set_flashdata("sukses", "Data Penduduk berhasil dihapus");
        // else $this->session->set_flashdata("gagal", "Data Penduduk gagal dihapus");
        if ($this->session->userdata('role_id') < 3)
            $url = "puskesmas/penduduk/" . $_POST['idposyandu'];
        else $url = "user/penduduk";
        redirect($url);
    }
    public function addUser()
    {
        $head['title'] = "Tambah User - SIPOSYANDU";
        $data['user'] = $this->session->userdata();
        $idposyandu = $data['user']['idposyandu'];
        $data['posyandu'] = $this->db->where('idposyandu', $idposyandu)->get('tbposyandu')->row_array();
        $data['penduduk'] = $this->penduduk_model->getUserLokal($idposyandu);
        $data['role'] = $this->db->query("SELECT * FROM user_role ORDER BY id DESC LIMIT 3")->result();
        //var_dump($data);

        $this->load->view('template/header', $head);
        $this->load->view('template/sidebar', $data);
        $this->load->view('user/tambahuser', $data);
        $this->load->view('template/footer');
    }

    public function uploadpicture()
    {
        $direktori = './assets/img/profile/';
        $uname = $this->input->post('uname');
        $config['upload_path'] = realpath($direktori);
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = '1000';
        $config['encrypt_name'] = false;
        $config['file_name'] = $uname . '.jpg';
        // var_dump($config);

        if (realpath($direktori . $uname . '.jpg')) { //Check and Delete existing image
            rename('./assets/img/profile/' . $uname . '.jpg', './assets/img/profile/buff.jpg');
            //unlink(realpath($direktori . $uname . '.jpg'));
            echo 'Existing picture deleted<br>';
        }
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload()) { //upload gagal
            $this->session->set_flashdata('gagal', 'Gambar Gagal diupload' . $this->upload->display_errors());
            rename('./assets/img/profile/buff.jpg', './assets/img/profile/' . $uname . '.jpg');
            echo $this->upload->display_errors();
        } else {
            $this->session->set_flashdata('sukses', 'Foto Akun berhasil diperbarui');
            $this->db->update('user', ['image' => $this->upload->data('file_name')], ['username' => $uname]);
            $this->session->set_userdata('image', $this->upload->data('file_name'));
            unlink(realpath($direktori . 'buff.jpg'));

            echo "Sukses upload & Update DB";
        }
        redirect('user');
    }
    public function resetpicture()
    {
        if ($this->session->image != 'default.jpg') {
            $oldPic = './assets/img/profile/' . $this->session->username . 'jpg';
            unlink(realpath($oldPic));
        }
        $this->db->update('user', ['image' => 'default.jpg'], ['username' => $this->input->post('id')]);

        $this->session->set_flashdata('sukses', 'Foto Akun berhasil direset');
        //redirect('user');
    }
}
