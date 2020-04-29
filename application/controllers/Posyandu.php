<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Posyandu
extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata['username'] == "") {
            redirect('auth');
        }
        if ($this->session->userdata['role_id'] == 4) {
            redirect('error/forbidden');
        }
        $this->load->model('Kegiatan_model');
        $this->load->model('Pengukuran_model');
        $this->load->library('form_validation');
    }
    public function index()
    {
        redirect('posyandu/acara');
    }
    public function acara()
    {
        $user = $this->session->userdata();
        $head['user'] = $user;
        $head['title'] = "Berita Acara - SIPOSYANDU";
        $th = date('Y');
        $bl = date('m');
        $idp = $this->session->idposyandu;
        $data['beritaacara'] = $this->Kegiatan_model->getBulanIni($th, $bl, $idp);
        $data['acara'] = $this->Kegiatan_model->getAll($idp);

        $this->load->view('template/header', $head);
        $this->load->view('template/sidebar', $head);
        $this->load->view('posyandu/kegiatan', $data);
        $this->load->view('template/footer');
    }
    public function buatkegiatan()
    {
        $kegiatan = $this->Kegiatan_model;
        $validation = $this->form_validation;
        $validation->set_rules($kegiatan->rules());

        if ($validation->run()) {
            $kegiatan->save();
            $this->session->set_flashdata("sukses", "Berita Acara berhasil disimpan");
        } else {
            $this->session->set_flashdata("gagal", "Berita Acara gagal disimpan");
        }
        redirect('posyandu/pengukuran');
    }
    public function editkegiatan($id)
    {
        $user = $this->session->userdata();
        $head['user'] = $user;
        $head['title'] = "Edit Berita Acara - SIPOSYANDU";

        $data['acara'] = $this->Kegiatan_model->getById($id);

        $this->load->view('template/header', $head);
        $this->load->view('template/sidebar', $head);
        $this->load->view('posyandu/editkegiatan', $data);
        $this->load->view('template/footer', $data);
    }
    public function updateKegiatan()
    {
        $kegiatan = $this->Kegiatan_model;
        $validation = $this->form_validation;
        $validation->set_rules($kegiatan->rules());

        if ($validation->run()) {
            $kegiatan->update();
            $this->session->set_flashdata("sukses", "Berita Acara berhasil diubah");
        } else {
            $this->session->set_flashdata("gagal", "Berita Acara gagal diubah");
        }
        redirect('posyandu/acara');
    }
    public function deleteKegiatan()
    {
        $id = $this->input->post('idhapus');
        if ($this->Kegiatan_model->delete($id)) $this->session->set_flashdata("sukses", "Berita Acara berhasil dihapus");
        else $this->session->set_flashdata("gagal", "Berita Acara gagal dihapus");
        redirect('posyandu/acara');
    }
    public function peserta()
    {
        $this->load->model('Penduduk_model');
        $data['user'] = $this->session->userdata();
        $head['title'] = "Daftar Peserta - SIPOSYANDU";
        $data['peserta'] = $this->Penduduk_model->getDaftarPeserta($this->session->userdata['idposyandu']);

        $this->load->view('template/header', $head);
        $this->load->view('template/sidebar', $data);
        $this->load->view('posyandu/daftarpeserta', $data);
        $this->load->view('template/footer');
    }
    public function pengukuran()
    {
        $this->load->model('Penduduk_model');
        $data['user'] = $this->session->userdata();
        $head['title'] = "Pengukuran Balita - SIPOSYANDU";
        //Parameter ngambil berita acara
        $th = date('Y');
        $bl = date('m');
        // var_dump(date('r'));
        $idp = $this->session->userdata['idposyandu'];
        //$data['idukur'] = $this->Pengukuran_model->getIdUkuran($nik, 10);

        $data['beritaacara'] = $this->Kegiatan_model->getBulanIni($th, $bl, $idp);
        if ($data['beritaacara'] == NULL) {
            $this->session->set_flashdata("gagal", "Berita Acara Posyandu Bulan ini belum dibuat!");
            redirect('posyandu/acara');
        }
        $idacara = $data['beritaacara'][0]->idacara;
        $data['totalPeserta'] = $this->Kegiatan_model->getTotalPeserta($idp);
        // $data['ukuran'] = $this->Pengukuran_model->getBeritaAcara($th, $bl, $idp);
        $data['peserta'] = $this->Penduduk_model->getPesertaPosyandu($idp, $idacara);
        // var_dump($data);

        $this->load->view('template/header', $head);
        $this->load->view('template/sidebar', $data);
        $this->load->view('posyandu/pengukuran', $data);
        $this->load->view('template/footer');
    }
    public function saveTimbangan()
    {
        //var_dump($this->input->post());
        $pengukuran = $this->Pengukuran_model;
        $validation = $this->form_validation;
        $validation->set_rules($pengukuran->rules());

        if ($validation->run()) {
            //$this->_keterangan($this->input->post['berat']);
            $this->input->post('keterangan', 'O');
            $pengukuran->save();
            $this->session->set_flashdata("sukses", "Data Timbangan berhasil disimpan");
        } else {
            $this->session->set_flashdata("gagal", "Data Timbangan gagal disimpan");
        }
        redirect('posyandu/pengukuran');
    }
    private function _keterangan($berat)
    {
    }
    public function edittimbangan($id)
    {
        $head['title'] = "Edit Timbangan Balita - SIPOSYANDU";
        $data['user'] = $this->session->userdata();
        $data['ukuran'] = $this->Pengukuran_model->getUkuranLengkap($id);
        //var_dump($data);

        $this->load->view('template/header', $head);
        $this->load->view('template/sidebar', $data);
        $this->load->view('posyandu/edittimbangan', $data);
        $this->load->view('template/footer');
    }
    public function updateTimbangan()
    {
        $timbangan = $this->Pengukuran_model;
        $validation = $this->form_validation;
        $validation->set_rules($timbangan->rules());

        if ($validation->run()) {
            $timbangan->update();
            $this->session->set_flashdata("sukses", "Timbangan berhasil diubah");
        } else {
            $this->session->set_flashdata("gagal", "Timbangan gagal diubah");
        }
        redirect('posyandu/pengukuran');
    }

    public function deleteTimbangan()
    {
        $id = $this->input->post('idhapus');
        if ($this->Pengukuran_model->delete($id)) $this->session->set_flashdata("sukses", "Data Timbangan berhasil dihapus");
        else $this->session->set_flashdata("gagal", "Data Timbangan gagal dihapus");
        redirect('posyandu/pengukuran');
    }

    public function rekap()
    {
        $head['title'] = "Rekap Pengukuran - SIPOSYANDU";
        $data['user'] = $this->session->userdata();
        $data['tahun'] = $this->db->query("SELECT DISTINCT Year(a.tglacara) as tahun FROM `pengukuran` JOIN beritaacara as a")->result();
        $data['bulan'] =  $this->db->query("SELECT DISTINCT Month(a.tglacara) as bulan, Monthname(a.tglacara) as nama FROM `pengukuran` JOIN beritaacara as a ORDER BY bulan ASC")->result();
        $th = date('Y');
        $bl = date('m');
        // $th = 2020;
        // $bl = 1;
        $idp = $this->session->userdata['idposyandu'];
        $data['posyandu'] = $this->db->where('idposyandu', $idp)->get('tbposyandu')->row_array();
        $data['beritaacara'] = $this->Kegiatan_model->getBulanIni($th, $bl, $idp);
        if ($data['beritaacara'] == NULL) {
            $this->session->set_flashdata("gagal", "Berita Acara Posyandu Bulan ini belum dibuat!");
            redirect('posyandu/acara');
        }
        $idacara = $data['beritaacara'][0]->idacara;

        $data['rekap'] = $this->Pengukuran_model->getRekap($idacara);


        $this->load->view('template/header', $head);
        $this->load->view('template/sidebar', $data);
        $this->load->view('posyandu/rekap', $data);
        $this->load->view('template/footer');
    }

    public function stat($nik)
    {
        $this->load->model('Penduduk_model');
        $head['title'] = "Statistik Balita - SIPOSYANDU";
        $data['user'] = $this->session->userdata();
        $data['balita'] = $this->Penduduk_model->getByNik($nik);
        $data['stat'] = $this->Pengukuran_model->getStat($nik);

        $this->load->view('template/header', $head);
        $this->load->view('template/sidebar', $data);
        $this->load->view('posyandu/stat', $data);
        $this->load->view('template/footer');
    }

    public function skdn()
    {
        $head['title'] = "Rekap Pengukuran - SIPOSYANDU";
        $data['user'] = $this->session->userdata();

        $this->load->view('template/header', $head);
        $this->load->view('template/sidebar', $data);
        $this->load->view('posyandu/skdn', $data);
        $this->load->view('template/footer');
    }
}
