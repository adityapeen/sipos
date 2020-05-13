<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Puskesmas
extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!isset($this->session->userdata['username']) || $this->session->userdata['username'] == "") {
            redirect('auth');
        }
        if ($this->session->userdata['role_id'] > 2) {
            redirect('forbidden');
        }
        $this->load->model('puskesmas_model');
        $this->load->model('kegiatan_model');
        $this->load->model('pengukuran_model');
        $this->load->model('penduduk_model');
    }
    public function index()
    {
        $head['title'] = "Overview - SIPOSYANDU";
        $data['user'] = $this->session->userdata();
        $idp = $this->session->userdata['idposyandu'];
        $data['puskesmas'] = $this->puskesmas_model->getDataPuskesmas($idp);
        $data['rasio'] = $this->puskesmas_model->getRasioBalita($idp);
        $th = date('Y');
        $bl = date('m');
        $data['overview'] = $this->puskesmas_model->getOverview($idp, $th, $bl);

        $this->load->view('template/header', $head);
        $this->load->view('template/sidebar', $data);
        $this->load->view('puskesmas/overview', $data);
        $this->load->view('template/footer');
        //var_dump($data);
        // redirect('puskesmas/posyandu');
    }
    public function list($ket)
    {
        $head['title'] = "Detail Overview - SIPOSYANDU";
        $data['user'] = $this->session->userdata();
        $idp = $this->session->userdata['idposyandu'];
        $data['puskesmas'] = $this->puskesmas_model->getDataPuskesmas($idp);
        $th = date('Y');
        $bl = date('m');
        $data['list'] = $this->puskesmas_model->getTimbanganRinci($idp, $ket, $th, $bl);
        $data['tipe'] = $ket;

        $this->load->view('template/header', $head);
        $this->load->view('template/sidebar', $data);
        $this->load->view('puskesmas/detailoverview', $data);
        $this->load->view('template/footer');
    }
    public function userlist()
    {
        $head['title'] = "Userlist - SIPOSYANDU";
        $data['user'] = $this->session->userdata();
        $idposyandu = $this->session->userdata['idposyandu'];
        $data['userlist'] = $this->puskesmas_model->getUserlistLokal($idposyandu);
        $data['role'] = $this->db->query("SELECT * FROM user_role LIMIT 3 OFFSET 1")->result();

        $this->load->view('template/header', $head);
        $this->load->view('template/sidebar', $data);
        $this->load->view('puskesmas/userlist', $data);
        $this->load->view('template/footer');
    }
    public function adduser()
    {
        $idp = $this->session->userdata['idposyandu'];
        $head['title'] = "Daftar Penduduk Daerah - SIPOSYANDU";
        $data['user'] = $this->session->userdata();
        $data['role'] = $this->db->query("SELECT * FROM user_role LIMIT 3 OFFSET 1")->result();
        $data['desa'] = $this->puskesmas_model->getDesaPuskesmas($idp);

        $this->load->view('template/header', $head);
        $this->load->view('template/sidebar', $data);
        $this->load->view('puskesmas/adduser', $data);
        $this->load->view('template/footer');
    }
    public function adduserpos($idp)
    {
        $head['title'] = "Tambah User - SIPOSYANDU";
        $data['user'] = $this->session->userdata();
        $data['posyandu'] = $this->db->where('idposyandu', $idp)->get('tbposyandu')->row_array();
        $data['penduduk'] = $this->penduduk_model->getPendudukLokal($idp);
        $data['role'] = $this->db->query("SELECT * FROM user_role LIMIT 3 OFFSET 1")->result();
        //var_dump($data['penduduk']);


        $this->load->view('template/header', $head);
        $this->load->view('template/sidebar', $data);
        $this->load->view('puskesmas/adduser', $data);
        $this->load->view('template/footer');
    }
    public function posyandu()
    {
        $head['title'] = "Posyandu - SIPOSYANDU";
        $data['user'] = $this->session->userdata();
        $idp = $this->session->userdata['idposyandu'];
        $data['posyandu'] = $this->puskesmas_model->getPosyanduLokal($idp);

        $this->load->view('template/header', $head);
        $this->load->view('template/sidebar', $data);
        $this->load->view('puskesmas/posyandu', $data);
        $this->load->view('template/footer');
    }
    public function bgm()
    {
        $head['title'] = "BGM - SIPOSYANDU";
        $data['user'] = $this->session->userdata();
        $idp = $this->session->userdata['idposyandu'];
        $data['bgm'] = $this->puskesmas_model->getBGM();

        $this->load->view('template/header', $head);
        $this->load->view('template/sidebar', $data);
        $this->load->view('puskesmas/bgm', $data);
        $this->load->view('template/footer');
    }
    public function updatebgm()
    {
        if ($this->puskesmas_model->updateBGM())
            $this->session->set_flashdata("sukses", "Data BGM berhasil diubah");
        redirect('puskesmas/bgm');
    }
    public function detailposyandu($idp)
    {

        $head['title'] = "Detail Posyandu - SIPOSYANDU";
        $data['user'] = $this->session->userdata();

        $data['acara'] = $this->kegiatan_model->getAll($idp);
        $data['posyandu'] = $this->puskesmas_model->getDataPosyandu($idp);
        $data['kader'] = $this->puskesmas_model->getKaderPosyandu($idp);

        $this->load->view('template/header', $head);
        $this->load->view('template/sidebar', $data);
        $this->load->view('puskesmas/detailposyandu', $data);
        $this->load->view('template/footer');
    }
    public function peserta($idp, $ida)
    {
        echo "IDPosyandu = " . $idp;
        echo "\nIDAcara = " . $ida;
    }
    public function rekap($idacara)
    {
        $head['title'] = "Rekap Pengukuran - SIPOSYANDU";
        $data['user'] = $this->session->userdata();
        $data['tahun'] = $this->db->query("SELECT DISTINCT Year(a.tglacara) as tahun FROM `pengukuran` JOIN beritaacara as a")->result();
        $data['bulan'] =  $this->db->query("SELECT DISTINCT Month(a.tglacara) as bulan, Monthname(a.tglacara) as nama FROM `pengukuran` JOIN beritaacara as a ORDER BY bulan ASC")->result();

        $idp = $this->session->userdata['idposyandu'];
        $data['beritaacara'] = $this->kegiatan_model->getById($idacara);
        $data['posyandu'] = $this->db->where('idposyandu', $idp)->get('tbposyandu')->row_array();

        $data['rekap'] = $this->pengukuran_model->getRekap($idacara);


        $this->load->view('template/header', $head);
        $this->load->view('template/sidebar', $data);
        $this->load->view('puskesmas/rekap', $data);
        $this->load->view('template/footer');
    }
    public function penduduk($idp)
    {
        $data['user'] = $this->session->userdata();
        $head['title'] = "Daftar Penduduk - SIPOSYANDU";
        $data['posyandu'] = $this->db->where('idposyandu', $idp)->get('tbposyandu')->row_array();
        $data['penduduk'] = $this->penduduk_model->getPendudukLokal($idp);


        $this->load->view('template/header', $head);
        $this->load->view('template/sidebar', $data);
        $this->load->view('user/penduduk', $data);
        $this->load->view('template/footer');
    }
    public function tes()
    {
        $idpus = 1;
        $ket = 'BGM';
        $data = $this->puskesmas_model->getTimbangan($idpus, $ket, 2020, 5);
        var_dump($data);
    }
}
