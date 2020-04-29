<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin
extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata['username'] == "") {
            redirect('auth');
        }
        if ($this->session->userdata['role_id'] != 1) {
            redirect('forbidden');
        }
        $this->load->model('admin_model');
    }
    public function index()
    {
        redirect('admin/daerah');
    }

    public function daerah()
    {
        $head['title'] = "Data Daerah - SIPOSYANDU";
        $data['user'] = $this->session->userdata();
        $data['desa'] = $this->admin_model->getDesa();
        $data['kecamatan'] = $this->admin_model->getKecamatan();
        $data['kabupaten'] = $this->admin_model->getKabupaten();
        $data['provinsi'] = $this->admin_model->getProvinsi();
        //var_dump($data['desa']);

        $this->load->view('template/header', $head);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/daerah', $data);
        $this->load->view('template/footer');
    }

    public function tambahdaerah()
    {
        $post = $this->input->post();
        if ($post['tipe'] == 'prov') {
            $this->admin_model->addProvinsi();
            $this->session->set_flashdata("sukses", "Provinsi baru berhasil ditambahkan");
        } else if ($post['tipe'] == 'kab') {
            $this->admin_model->addKabupaten();
            $this->session->set_flashdata("sukses", "Kabupaten baru berhasil ditambahkan");
        } else if ($post['tipe'] == 'kec') {
            $this->admin_model->addKecamatan();
            $this->session->set_flashdata("sukses", "Kecamatan baru berhasil ditambahkan");
        } else if ($post['tipe'] == 'des') {
            $this->admin_model->addDesa();
            $this->session->set_flashdata("sukses", "Desa baru berhasil ditambahkan");
        }
        redirect('admin/daerah');
    }
    public function updatedaerah()
    {
        $post = $this->input->post();
        if ($post['tipe'] == 'prov') {
            $this->admin_model->updateProvinsi();
            $this->session->set_flashdata("sukses", "Data Provinsi berhasil diubah");
        } else if ($post['tipe'] == 'kab') {
            $this->admin_model->updateKabupaten();
            $this->session->set_flashdata("sukses", "Data Kabupaten berhasil diubah");
        } else if ($post['tipe'] == 'kec') {
            $this->admin_model->updateKecamatan();
            $this->session->set_flashdata("sukses", "Data Kecamatan berhasil diubah");
        } else if ($post['tipe'] == 'des') {
            $this->admin_model->updateDesa();
            $this->session->set_flashdata("sukses", "Data Desa berhasil diubah");
        }
        redirect('admin/daerah');
    }

    public function deletedaerah()
    {
        $post = $this->input->post();
        if ($post['tipe'] == 'prov') {
            $this->admin_model->deleteProvinsi();
            $this->session->set_flashdata("sukses", "Provinsi berhasil dihapus");
        } else if ($post['tipe'] == 'kab') {
            $this->admin_model->deleteKabupaten();
            $this->session->set_flashdata("sukses", "Kabupaten berhasil dihapus");
        } else if ($post['tipe'] == 'kec') {
            $this->admin_model->deleteKecamatan();
            $this->session->set_flashdata("sukses", "Kecamatan berhasil dihapus");
        } else if ($post['tipe'] == 'des') {
            $this->admin_model->deleteDesa();
            $this->session->set_flashdata("sukses", "Desa berhasil dihapus");
        }
        redirect('admin/daerah');
    }

    public function posyandu()
    {
        $head['title'] = "Data Posyandu - SIPOSYANDU";
        $data['user'] = $this->session->userdata();
        $data['posyandu'] = $this->admin_model->getPosyandu();
        $data['puskesmas'] = $this->admin_model->getPuskesmas();

        $this->load->view('template/header', $head);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/posyandu', $data);
        $this->load->view('template/footer');
    }
    public function tambahposyandu()
    {
        if ($this->admin_model->addPosyandu()) {
            $this->session->set_flashdata("sukses", "Posyandu baru berhasil ditambahkan");
        } else $this->session->set_flashdata("gagal", "Puskesmas gagal ditambahkan");
        redirect('admin/posyandu');
    }
    public function tambahpuskesmas()
    {
        if ($this->admin_model->addPuskesmas()) {
            $this->session->set_flashdata("sukses", "Puskesmas baru berhasil ditambahkan");
        } else $this->session->set_flashdata("gagal", "Puskesmas gagal ditambahkan");
        redirect('admin/posyandu');
    }

    public function updatepos()
    {
        $post = $this->input->post();
        if ($post['tipe'] == 'pos') {
            $this->admin_model->updatePosyandu();
            $this->session->set_flashdata("sukses", "Data Posyandu berhasil diubah");
        } else if ($post['tipe'] == 'pus') {
            $this->admin_model->updatePuskesmas();
            $this->session->set_flashdata("sukses", "Data Puskesmas berhasil diubah");
        }
        redirect('admin/posyandu');
    }

    public function deletepos()
    {
        $post = $this->input->post();
        if ($post['tipe'] == 'pos') {
            $this->admin_model->deletePosyandu();
            $this->session->set_flashdata("sukses", "Posyandu berhasil dihapus");
        } else if ($post['tipe'] == 'pus') {
            $this->admin_model->deletePuskesmas();
            $this->session->set_flashdata("sukses", "Puskesmas berhasil dihapus");
        }
        redirect('admin/posyandu');
    }

    public function role()
    {
        $head['title'] = "Role Management - SIPOSYANDU";
        $data['user'] = $this->session->userdata();
        $data['role'] = $this->admin_model->getRole();
        $data['menu'] = $this->admin_model->getUserMenu();
        $data['submenu'] = $this->admin_model->getUserSubMenu();
        $data['accessmenu'] = $this->admin_model->getUserAccessMenu();

        $this->load->view('template/header', $head);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('template/footer');
    }
    public function menu()
    {
        $post = $this->input->post();
        if ($post['tipe'] == 'add') {
            if ($this->admin_model->addMenu())
                $this->session->set_flashdata("sukses", "Menu baru berhasil ditambahkan");
        } else if ($post['tipe'] == 'addrole') {
            if ($this->admin_model->addRole())
                $this->session->set_flashdata("sukses", "Role baru berhasil ditambahkan");
        } else if ($post['tipe'] == 'edit') {
            if ($this->admin_model->editMenu())
                $this->session->set_flashdata("sukses", "Nama Menu berhasil diubah");
        } else if ($post['tipe'] == 'editrole') {
            if ($this->admin_model->editRole())
                $this->session->set_flashdata("sukses", "Nama Role berhasil diubah");
        }
        redirect('admin/role');
    }
    public function submenu()
    {
        $post = $this->input->post();
        if ($post['tipe'] == 'add') {
            if ($this->admin_model->addSubMenu())
                $this->session->set_flashdata("sukses", "Sub Menu baru berhasil ditambahkan");
        } else if ($post['tipe'] == 'edit') {
            if ($this->admin_model->editSubMenu())
                $this->session->set_flashdata("sukses", "Sub Menu berhasil diubah");
            else $this->session->set_flashdata("gagal", "Sub Menu gagal diubah");
        }
        redirect('admin/role');
    }
    public function accessmenu()
    {
        if ($this->admin_model->addAccess())
            $this->session->set_flashdata("sukses", "User Akses baru berhasil ditambahkan");
        redirect('admin/role');
    }
    public function deleterole()
    {
        $post = $this->input->post();
        if ($post['tipe'] == 'menu') {
            $this->admin_model->deleteMenu();
            $this->session->set_flashdata("sukses", "Menu berhasil dihapus");
        } else if ($post['tipe'] == 'role') {
            $this->admin_model->deleteRole();
            $this->session->set_flashdata("sukses", "Role berhasil dihapus");
        } else if ($post['tipe'] == 'submenu') {
            $this->admin_model->deleteSubMenu();
            $this->session->set_flashdata("sukses", "Sub Menu berhasil dihapus");
        } else if ($post['tipe'] == 'accessmenu') {
            $this->admin_model->deleteAccessMenu();
            $this->session->set_flashdata("sukses", "Akses Menu berhasil dihapus");
        }
        redirect('admin/role');
    }
    public function userlist()
    {
        $head['title'] = "Userlist - SIPOSYANDU";
        $data['user'] = $this->session->userdata();
        $data['userlist'] = $this->admin_model->getUserlist();
        $data['role'] = $this->db->query("SELECT * FROM user_role ORDER BY id")->result();

        $this->load->view('template/header', $head);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/userlist', $data);
        $this->load->view('template/footer');
    }
    public function adduser()
    {
        $head['title'] = "Daftar Penduduk Daerah - SIPOSYANDU";
        $data['user'] = $this->session->userdata();
        $data['role'] = $this->db->query("SELECT * FROM user_role ORDER BY id")->result();

        $this->load->view('template/header', $head);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/adduser', $data);
        $this->load->view('template/footer');
    }

    public function auto()
    {
        $head['title'] = "Daftar Penduduk Daerah - SIPOSYANDU";
        $data['user'] = $this->session->userdata();

        $this->load->view('template/header', $head);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/auto');
        $this->load->view('template/footer');
    }
}
