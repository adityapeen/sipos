<?php defined('BASEPATH') or exit('No direct script access allowed');

class Kegiatan_model extends CI_Model
{
    private $_table = "beritaacara";

    public $tglacara;
    public $idposyandu;
    public $judul;
    public $pemateri;
    public $notulen;
    public $catatan;

    public function rules()
    {
        return [
            [
                'field' => 'tglacara',
                'label' => 'Tanggal Acara',
                'rules' => 'required'
            ],

            [
                'field' => 'idposyandu',
                'label' => 'ID Posyandu',
                'rules' => 'required'
            ],

            [
                'field' => 'notulen',
                'label' => 'Notulen',
                'rules' => 'required'
            ]
        ];
    }

    public function getAll($idp)
    {
        $sub = "(SELECT COUNT(idpengukuran) FROM pengukuran as p WHERE p.idacara = k.idacara) as balita";
        $this->db->select('k.idacara, k.idposyandu, k.tglacara, k.judul, k.pemateri, n.nama as notulen, p.nama as pemateri, ' . $sub);
        $this->db->from($this->_table . ' as k');
        $this->db->join('penduduk n', 'k.notulen = n.nik', 'left');
        $this->db->join('penduduk p', 'k.pemateri = p.nik', 'left');
        $this->db->order_by('k.tglacara', 'DESC');
        $this->db->where('k.idposyandu', $idp);
        $query = $this->db->get()->result();
        return $query;
    }

    public function getById($id)
    {
        $this->db->select('k.idacara, k.idposyandu, a.namaposyandu, k.tglacara, k.judul, k.pemateri, k.notulen as niknot, k.catatan, k.pemateri as nikpem, n.nama as notulen, p.nama as pemateri');
        $this->db->from($this->_table . ' as k');
        $this->db->join('penduduk n', 'k.notulen = n.nik', 'left');
        $this->db->join('penduduk p', 'k.pemateri = p.nik', 'left');
        $this->db->join('tbposyandu a', 'k.idposyandu = a.idposyandu');
        $this->db->where('idacara', $id);
        $query = $this->db->get()->result();
        return $query;
    }

    public function save()
    {
        $post = $this->input->post();
        $this->idacara = NULL;
        $this->idposyandu = $post["idposyandu"];
        $this->tglacara = $post["tglacara"];
        $this->judul  = ($post["judul"] == NULL ? NULL : $post['judul']);
        $this->pemateri = ($post["pemateri"] == NULL ? NULL : $post['pemateri']);
        $this->notulen = ($post["notulen"] == NULL ? NULL : $post['notulen']);
        return $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->idposyandu = $post["idposyandu"];
        $this->tglacara = $post["tglacara"];
        $this->judul  = ($post["judul"] == NULL ? NULL : $post['judul']);
        $this->pemateri = ($post["pemateri"] == NULL ? NULL : $post['pemateri']);
        $this->catatan = ($post["catatan"] == NULL ? NULL : $post['catatan']);
        $this->notulen = ($post["notulen"] == NULL ? NULL : $post['notulen']);


        return $this->db->update($this->_table, $this, array('idacara' => $post['idacara']));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("idacara" => $id));
    }

    //Mengambil Berita acara bulan ini
    public function getBulanIni($th, $bl, $idp)
    {
        $sub = "(SELECT count(idpengukuran) from pengukuran WHERE idacara = beritaacara.idacara) as tertimbang";
        $this->db->select('idacara, tglacara, ' . $sub);
        $this->db->from($this->_table);
        $this->db->where('YEAR(tglacara)', $th);
        $this->db->where('MONTH(tglacara)', $bl);
        $this->db->where('idposyandu', $idp);
        $this->db->limit(1);
        $query = $this->db->get()->result();
        return $query;
    }

    public function getBeritaAcara($th, $bl, $idp)
    {
        $this->db->select('a.idacara, p.namaposyandu as nmpos, p.dusun as alamat');
        $this->db->from($this->_table . ' as a');
        $this->db->where('YEAR(tglacara)', $th);
        $this->db->where('MONTH(tglacara)', $bl);
        $this->db->where('a.idposyandu', $idp);
        $this->db->join('tbposyandu as p', 'a.idposyandu = p.idposyandu');
        $this->db->limit(1);
        return $this->db->get()->row_array();
    }

    public function getPesertaPosyandu($idp, $idacara)
    {
        $sub = "(SELECT idpengukuran from pengukuran where nik = p.nik AND idacara = $idacara) as idpengukuran";
        $this->db->select('p.nik, p.nama, p.tgllahir, (DATEDIFF(CURDATE(), tgllahir)/30.40) as umur, ' . $sub);
        $this->db->where('idposyandu', $idp);
        // $this->db->where('umur <', 30);
        $this->db->where('CEIL(DATEDIFF(CURDATE(), tgllahir)/30.40) <', 60); //Filter umur
        $this->db->order_by('tgllahir', 'ASC');
        $this->db->from('penduduk' . " as p");
        return $this->db->get()->result();
    }

    public function getTotalPeserta($idp) //Total Peserta suatu posyandu berdasarkan umur
    {
        $this->db->select('count(p.nik) as jml ');
        $this->db->where('idposyandu', $idp);
        $this->db->where('CEIL(DATEDIFF(CURDATE(), tgllahir)/30.40) <', 61); //Filter umur
        $this->db->order_by('tgllahir', 'ASC');
        $this->db->from('penduduk' . " as p");
        return $this->db->get()->result();
    }
}
