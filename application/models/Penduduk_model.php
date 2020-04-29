<?php defined('BASEPATH') or exit('No direct script access allowed');

class Penduduk_model extends CI_Model
{
    private $_table = "penduduk";

    public $nik;
    public $nama;
    public $kelamin;
    public $tempatlahir;
    public $tgllahir;
    public $alamat;
    public $pekerjaan;
    public $ibu;
    public $ayah;
    public $idposyandu;
    public $kms;
    public $statusbantuan;

    public function rules()
    {
        return [
            [
                'field' => 'nik',
                'label' => 'NIK',
                'rules' => 'required'
            ],

            [
                'field' => 'nama',
                'label' => 'Nama',
                'rules' => 'required'
            ],

            [
                'field' => 'tanggallahir',
                'label' => 'Tanggal Lahir',
                'rules' => 'required'
            ],

            [
                'field' => 'idposyandu',
                'label' => 'ID Posyandu',
                'rules' => 'required'
            ]
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getByNik($id)
    {
        $this->db->select('anak.nik, anak.nama, anak.kelamin, anak.tgllahir, (DATEDIFF(CURDATE(), anak.tgllahir)/30.40) as umur, ibu.nama as ibu, ayah.nama as ayah');
        $this->db->select('anak.pekerjaan');
        $this->db->join('penduduk as ibu', 'anak.ibu = ibu.nik', 'left');
        $this->db->join('penduduk as ayah', 'anak.ayah = ayah.nik', 'left');
        return $this->db->get_where($this->_table . ' as anak', ["anak.nik" => $id])->row();
    }

    public function getPenduduk($id)
    {
        $this->db->select('anak.nik, anak.nama, anak.kelamin, anak.tgllahir, (DATEDIFF(CURDATE(), anak.tgllahir)/30.40) as umur, ibu.nama as ibu, ayah.nama as ayah');
        $this->db->select('anak.pekerjaan, anak.agama, anak.alamat, anak.kms, anak.statusbantuan, kab.nama as tempatlahir, anak.ibu as idibu, anak.ayah as idayah');
        $this->db->select('anak.tempatlahir as idkab');
        $this->db->join('penduduk as ibu', 'anak.ibu = ibu.nik', 'left');
        $this->db->join('penduduk as ayah', 'anak.ayah = ayah.nik', 'left');
        $this->db->join('tbkabupaten as kab', 'anak.tempatlahir = kab.idkab', 'left');
        return $this->db->get_where($this->_table . ' as anak', ["anak.nik" => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->nik = $post["nik"];
        $this->nama = $post["nama"];
        $this->kelamin = $post["jk"];
        $this->tempatlahir  = !isset($post["tempatlahir"]) || $post['tempatlahir'] == '' ? NULL : $post["tempatlahir"];
        $this->tgllahir = $post["tanggallahir"];
        $this->alamat = !isset($post["alamat"]) ? NULL : $post["alamat"];
        $this->pekerjaan = !isset($post["pekerjaan"]) ? NULL : $post["pekerjaan"];
        $this->ibu = !isset($post["ibu"]) || $post['ibu'] == '' ? NULL : $post["ibu"];
        $this->ayah = !isset($post["ayah"]) || $post['ayah'] == '' ? NULL : $post["ayah"];
        $this->idposyandu = $post["idposyandu"];
        $this->kms = isset($post["kms"]) ? $post["kms"] : NULL;
        $this->statusbantuan = isset($post["statusbantuan"]) ? $post["statusbantuan"] : NULL;

        return $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->nik = $post["nik"];
        $this->nama = $post["nama"];
        $this->kelamin = $post["jk"];
        $this->tempatlahir  = !isset($post["tempatlahir"]) || $post['tempatlahir'] == '' ? NULL : $post["tempatlahir"];
        $this->tgllahir = $post["tanggallahir"];
        $this->alamat = !isset($post["alamat"]) ? NULL : $post["alamat"];
        $this->pekerjaan = !isset($post["pekerjaan"]) ? NULL : $post["pekerjaan"];
        $this->ibu = !isset($post["ibu"]) || $post['ibu'] == '' ? NULL : $post["ibu"];
        $this->ayah = !isset($post["ayah"]) || $post['ayah'] == '' ? NULL : $post["ayah"];
        $this->idposyandu = $post["idposyandu"];
        $this->kms = isset($post["kms"]) ? $post["kms"] : NULL;
        $this->statusbantuan = isset($post["statusbantuan"]) ? $post["statusbantuan"] : NULL;
        return $this->db->update($this->_table, $this, array('nik' => $post['nik']));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("nik" => $id));
    }

    function getAyah($title)
    {
        $this->db->like('nama', $title, 'both');
        $this->db->where('kelamin', 'L');
        $this->db->order_by('nama', 'ASC');
        $this->db->limit(10);
        return $this->db->get('penduduk')->result();
    }
    function getIbu($title)
    {
        $this->db->like('nama', $title, 'both');
        $this->db->where('kelamin', 'P');
        $this->db->order_by('nama', 'ASC');
        $this->db->limit(10);
        return $this->db->get('penduduk')->result();
    }
    function getKabupaten($title)
    {
        $this->db->like('nama', $title, 'both');
        $this->db->order_by('nama', 'ASC');
        $this->db->limit(10);
        return $this->db->get('tbkabupaten')->result();
    }

    public function getPesertaPosyandu($idp, $idacara)
    {
        $sub = "(SELECT idpengukuran from pengukuran where nik = p.nik AND idacara = $idacara) as idpengukuran";
        $this->db->select('p.nik, p.nama, p.tgllahir, (DATEDIFF(CURDATE(), tgllahir)/30.40) as umur, ' . $sub);
        $this->db->where('idposyandu', $idp);
        // $this->db->where('umur <', 30);
        $this->db->where('CEIL(DATEDIFF(CURDATE(), tgllahir)/30) <', 62);
        $this->db->order_by('tgllahir', 'ASC');
        $this->db->from($this->_table . " as p");
        return $this->db->get()->result();
    }

    public function getDaftarPeserta($idp)
    {
        $this->db->select('p.nik, p.nama, p.tgllahir, (DATEDIFF(CURDATE(), tgllahir)/30.40) as umur, ');
        $this->db->where('idposyandu', $idp);
        $this->db->where('CEIL(DATEDIFF(CURDATE(), tgllahir)/30.40) <', 61);
        $this->db->order_by('tgllahir', 'ASC');
        $this->db->from($this->_table . " as p");
        return $this->db->get()->result();
    }

    public function getDataPeserta($nik)
    {
        $this->db->select('p.nik, p.nama, (DATEDIFF(CURDATE(), tgllahir)/30.40) as umur, p.statusbantuan');
        $this->db->from($this->_table . " as p");
        $this->db->where('nik', $nik);
        return $this->db->get()->result();
    }
    public function getDataPenduduk($nik)
    {
        $this->db->select('p.nik, p.nama');
        $this->db->from($this->_table . " as p");
        $this->db->where('nik', $nik);
        return $this->db->get()->result();
    }

    public function getPendudukLokal($idp)
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where('idposyandu', $idp);
        return $this->db->get()->result();
    }
    public function getPendudukDaerah($id)
    {
        $this->db->select('p.nik as id, p.nama, p.kelamin, p.tgllahir, pos.dusun as dusun');
        $this->db->from($this->_table . ' as p');
        $this->db->join('tbposyandu as pos', 'p.idposyandu = pos.idposyandu');
        $this->db->join('tbdesa as des', 'pos.iddesa = des.iddesa');
        $this->db->where('des.iddesa', $id);
        return $this->db->get()->result();
    }

    public function getUserLokal($idp)
    {
        $sub = "(SELECT id from user where user.nik = p.nik limit 1) as iduser";
        $this->db->select('p.nik, p.nama, p.kelamin, p.tgllahir, ' . $sub);
        $this->db->from($this->_table . ' as p');
        $this->db->where('idposyandu', $idp);
        return $this->db->get()->result();
    }
}
