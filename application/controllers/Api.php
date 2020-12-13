<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api
extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('penduduk_model');
        $this->load->model('pengukuran_model');
        $this->load->model('kegiatan_model');
        $this->load->model('admin_model');
        $this->load->model('puskesmas_model');
    }
    function searchAyah()
    {
        if (isset($_GET['term']) && isset($_GET['idp'])) {
            $result = $this->penduduk_model->getAyah($_GET['term'], $_GET['idp']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'label'  => $row->nama,
                        'nik'   => $row->nik,
                    );
                echo json_encode($arr_result);
            }
        }
    }
    function searchIbu()
    {
        if (isset($_GET['term']) && isset($_GET['idp'])) {
            $result = $this->penduduk_model->getIbu($_GET['term'], $_GET['idp']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'label'  => $row->nama,
                        'nik'   => $row->nik,
                    );
                echo json_encode($arr_result);
            }
        }
    }
    function searchKader()
    {
        if (isset($_GET['term']) && isset($_GET['idp'])) {
            $result = $this->admin_model->getKader($_GET['term'], $_GET['idp']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'label'  => $row->nama,
                        'nik'   => $row->nik,
                    );
                echo json_encode($arr_result);
            }
        }
    }
    function searchKab()
    {
        if (isset($_GET['term'])) {
            $result = $this->penduduk_model->getKabupaten($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'label'  => $row->nama,
                        'idkab'   => $row->idkab,
                    );
                echo json_encode($arr_result);
            }
        }
    }
    function getDetailAcara()
    {
        if (isset($_GET['idacara'])) {
            $result = $this->kegiatan_model->getById($_GET['idacara']);
            if (count($result) > 0) {
                echo json_encode($result);
            }
        }
    }
    function getIdUkuran()
    {
        if (isset($_GET['nik']) && isset($_GET['idacara'])) {
            $result = $this->pengukuran_model->getIdUkuran($_GET['nik'], $_GET['idacara']);
            if (count($result) > 0) {
                echo json_encode($result);
            }
        }
    }
    function getDataPeserta()
    {
        if (isset($_GET['nik'])) {
            $result = $this->penduduk_model->getDataPeserta($_GET['nik']);
            if (count($result) > 0) {
                echo json_encode($result);
            } else echo "Data tidak ditemukan";
        }
    }
    function getDataPenduduk()
    {
        if (isset($_GET['nik'])) {
            $result = $this->penduduk_model->getDataPenduduk($_GET['nik']);
            if (count($result) > 0) {
                echo json_encode($result);
            } else echo "Data tidak ditemukan";
        }
    }
    function getNIK()
    {
        if (isset($_GET['nik'])) {
            $res = array('terpakai' => '');
            $result = $this->db->get_where('penduduk', ['nik' => $_GET['nik']])->row_array();
            if ($result) {
                $res['terpakai'] = true;
            } else $res['terpakai'] = false;

            echo json_encode($res);
        }
    }
    function getUsername()
    {
        if (isset($_GET['username'])) {
            $username = strtolower($_GET['username']);
            $res = array('terpakai' => '');
            $result = $this->db->get_where('user', ['username' => $username])->row_array();
            if ($result) {
                $res['terpakai'] = true;
            } else $res['terpakai'] = false;

            echo json_encode($res);
        }
    }
    function getDataUser()
    {
        if (isset($_GET['username'])) {
            $username = strtolower($_GET['username']);
            $result = $this->admin_model->getDataUser($username);
            if ($result) {
                echo json_encode($result);
            } else echo json_encode(['hasil' => 'tidak ditemukan']);
        }
    }

    function getUkuranLengkap()
    {
        if (isset($_GET['idpengukuran'])) {
            $result = $this->pengukuran_model->getUkuranLengkap($_GET['idpengukuran']);
            if (count($result) > 0) {
                echo json_encode($result);
            } else echo "Data tidak ditemukan";
        }
    }

    function getRekap()
    {
        if (isset($_GET['th']) && isset($_GET['bl'])) {
            $tahun = $_GET['th'];
            $bulan = $_GET['bl'];
            $idp = $_GET['idp'];
            $res = $this->kegiatan_model->getBeritaAcara($tahun, $bulan, $idp);
            if ($res > 0) {
                $rek = $this->pengukuran_model->getRekapNew($res['idacara']);
                echo json_encode($rek);
            }
        }
    }

    function getSkdn()
    {
        if (isset($_GET['idacara'])) {
            $result = $this->pengukuran_model->getSkdn($_GET['idacara']);
            if (count($result) > 0) {
                echo json_encode($result);
            } else echo "Data tidak ditemukan";
        }
    }

    function getBGM()
    {
        if (isset($_GET['umur'])) {
            $result = $this->db->get_where('berat', ['umur' => $_GET['umur']])->result();
            if ($result) echo json_encode($result);
        }
    }

    function getKet()
    {
        if (isset($_GET['nik']) && isset($_GET['berat']) && isset($_GET['umur']) && isset($_GET['kelamin'])) {
            $beratskr = $_GET['berat'];
            $umur = round($_GET['umur']);
            $kelamin = $_GET['kelamin'];
            $res = array('ket' => '', 'umur' => $umur, 'beratlalu' => '', 'angka' => '');
            $v = 'T';
            $result = $this->pengukuran_model->getKet($_GET['nik']);
            //CEK BGM
            $berat = $this->db->get_where('berat', ['umur' => $umur])->row_array();
            if ($kelamin == 'L') {
                $bgm = $berat['garis_merah_l'];
                $kenaikan = $berat['kenaikan_l'];
            } else {
                $bgm = $berat['garis_merah_p'];
                $kenaikan = $berat['kenaikan_p'];
            }
            if ($beratskr < $bgm) $v = 'BGM';
            else {
                if (!$this->db->get_where('pengukuran', ['nik' => $_GET['nik']])->result())
                    $v = "B"; //jika belum pernah menimbang
                else if ($result) { //jika timbangan bulan lalu ditemukan
                    $beratlalu = $result['berat'];
                    $ketlalu = $result['keterangan'];
                    $res['beratlalu'] = $beratlalu; //Bisa dihapus
                    $res['ketlalu'] = $ketlalu; //Bisa dihapus

                    if ($beratskr > $beratlalu) {
                        $interval = round($beratskr - $beratlalu, 2);
                        $res['interval'] = $interval; //Bisa Dihapus
                        if ($interval >= $kenaikan) $v = "N";
                        else $v = "T";
                    }
                    if ($v == 'T') {
                        if (strlen($ketlalu) == 2) {
                            $angka = substr($ketlalu, 0, 1);
                            $res['angka'] = $angka;
                            $v = $angka + 1 . "T";
                        } else if ($ketlalu == 'T') $v = '2T';
                    }
                } else $v = "O"; //jika tidak ada timbangan bulan lalu
            }
            //$res['ket'] = $beratskr-$_GET['berat'];
            $res['ket'] = $v;
            echo json_encode($res);
        }
    }

    // function getKeterangan()
    // {
    //     if (isset($_GET['nik']) && isset($_GET['berat']) && isset($_GET['umur'])) {
    //         $beratskr = $_GET['berat'];
    //         $umur = $_GET['umur'];
    //         $res = array('ket' => '', 'umur' => '', 'beratlalu' => '', 'angka' => '');
    //         $res['umur'] = $_GET['umur']; //Bisa dihapus
    //         $v = 'T';
    //         $result = $this->pengukuran_model->getKet($_GET['nik'], $_GET['berat']);
    //         if (!$this->db->get_where('pengukuran', ['nik' => $_GET['nik']])->result())
    //             $v = "B"; //jika belum pernah menimbang
    //         else if ($result) { //jika timbangan bulan lalu ditemukan
    //             $beratlalu = $result['berat'];
    //             $ketlalu = $result['keterangan'];
    //             $res['beratlalu'] = $beratlalu; //Bisa dihapus
    //             $res['ketlalu'] = $ketlalu; //Bisa dihapus

    //             if ($beratskr > $beratlalu) {
    //                 $interval = round($beratskr - $beratlalu, 2);
    //                 $res['interval'] = $interval; //Bisa Dihapus
    //                 if ($umur < 2 && $interval > 0.8) $v = "N";
    //                 else if ($umur < 3 && $interval >= 0.9) $v = "N";
    //                 else if ($umur < 4 && $interval >= 0.8) $v = "N";
    //                 else if ($umur < 5 && $interval >= 0.6) $v = "N";
    //                 else if ($umur < 6 && $interval >= 0.5) $v = "N";
    //                 else if ($umur < 8 && $interval >= 0.4) $v = "N";
    //                 else if ($umur < 12 && $interval >= 0.3) $v = "N";
    //                 else if ($umur < 61 && $interval >= 0.2) $v = "N";
    //                 else $v = "T";
    //             }
    //             if ($v == 'T') {
    //                 if (strlen($ketlalu) == 2) {
    //                     $angka = substr($ketlalu, 0, 1);
    //                     $res['angka'] = $angka;
    //                     $v = $angka + 1 . "T";
    //                 } else if ($ketlalu == 'T') $v = '2T';
    //             }
    //         } else $v = "O"; //jika tidak ada timbangan bulan lalu

    //         //$res['ket'] = $beratskr-$_GET['berat'];
    //         $res['ket'] = $v;
    //         echo json_encode($res);
    //     }
    // }

    function getallprov()
    {
        $res = $this->db->get('tbprovinsi')->result();
        if ($res) {
            echo json_encode($res);
        }
    }

    function getkab()
    {
        if (isset($_GET['kodeprov'])) {
            $res = $this->db->get_where('tbkabupaten', 'idprov = ' . $_GET['kodeprov'])->result();
            if ($res > 0) {
                echo json_encode($res);
            }
        }
    }
    function getkec()
    {
        if (isset($_GET['kodekab'])) {
            $res = $this->db->get_where('tbkecamatan', 'idkab = ' . $_GET['kodekab'])->result();
            if ($res > 0) {
                echo json_encode($res);
            }
        }
    }
    function getdes()
    {
        if (isset($_GET['kodekec'])) {
            $res = $this->db->get_where('tbdesa', 'idkec = ' . $_GET['kodekec'])->result();
            if ($res > 0) {
                echo json_encode($res);
            }
        }
    }
    function getdesa()
    {
        if (isset($_GET['id'])) {
            $res = $this->db->get_where('tbdesa', 'iddesa = ' . $_GET['id'])->result();
            if ($res > 0) {
                echo json_encode($res);
            }
        }
    }
    function getkeca()
    {
        if (isset($_GET['id'])) {
            $res = $this->db->get_where('tbkecamatan', 'idkec = ' . $_GET['id'])->result();
            if ($res > 0) {
                echo json_encode($res);
            }
        }
    }
    function getkabu()
    {
        if (isset($_GET['id'])) {
            $res = $this->db->get_where('tbkabupaten', 'idkab = ' . $_GET['id'])->result();
            if ($res > 0) {
                echo json_encode($res);
            }
        }
    }
    function getprovi()
    {
        if (isset($_GET['id'])) {
            $res = $this->db->get_where('tbprovinsi', 'idprov = ' . $_GET['id'])->result();
            if ($res > 0) {
                echo json_encode($res);
            }
        }
    }
    function getpos()
    {
        if (isset($_GET['id'])) {
            $res = $this->admin_model->getpos($_GET['id']);
            if ($res > 0) {
                echo json_encode($res);
            }
        }
    }
    function getpus()
    {
        if (isset($_GET['id'])) {
            $res = $this->admin_model->getpus($_GET['id']);
            if ($res > 0) {
                echo json_encode($res);
            }
        }
    }
    function getMenu()
    {
        $res = $this->db->get('user_menu')->result();
        echo json_encode($res);
    }
    function getMenuid()
    {
        $res = $this->db->get_where('user_menu', ['id' => $_GET['id']])->result();
        echo json_encode($res);
    }
    function getRole()
    {
        $res = $this->db->get('user_role')->result();
        echo json_encode($res);
    }
    function getRoleid()
    {
        $res = $this->db->get_where('user_role', ['id' => $_GET['id']])->result();
        echo json_encode($res);
    }
    function getSubMenuid()
    {
        $res = $this->db->get_where('user_sub_menu', ['id' => $_GET['id']])->result();
        echo json_encode($res);
    }
    function getPendudukDaerah()
    {
        $res = $this->penduduk_model->getPendudukDaerah($_GET['kodedesa']);
        if ($res) {
            echo json_encode($res);
        }
    }
    function getPosyanduDaerah()
    {
        if (isset($_GET['id'])) {
            $res = $this->admin_model->getPosyanduDaerah($_GET['id']);
            if ($res > 0) {
                echo json_encode($res);
            }
        }
    }
    function getListOverview()
    {
        if (isset($_GET['idp']) && isset($_GET['ket']) && isset($_GET['th']) && isset($_GET['bl'])) {
            $res = $this->puskesmas_model->getListRinci($_GET['idp'], $_GET['ket'], $_GET['th'], $_GET['bl']);
            if ($res) {
                echo json_encode($res);
            }
        }
    }
}
