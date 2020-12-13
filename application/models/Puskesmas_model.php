<?php defined('BASEPATH') or exit('No direct script access allowed');

class Puskesmas_model extends CI_Model
{
    public function getDataPuskesmas($idp)
    {
        $idpus = $this->_getIDpuskesmas($idp)['id'];
        return $this->db->get_where('tbpuskesmas', ['idpuskesmas' => $idpus])->row_array();
    }
    public function getUserlistLokal($idp)
    {
        $idpus = $this->_getIDpuskesmas($idp);
        $this->db->select('u.id, u.nama, u.username, u.aktif, ur.role, p.namaposyandu as unitkerja, d.nama as desa');
        $this->db->join('user_role as ur', 'u.role_id = ur.id');
        $this->db->join('tbposyandu as p', 'u.unitkerja = p.idposyandu', 'left');
        $this->db->join('tbdesa as d', 'p.iddesa = d.iddesa', 'left');
        $this->db->join('tbkecamatan as k', 'd.idkec = k.idkec', 'left');
        $this->db->join('tbpuskesmas as pus', 'k.idkec = pus.idkec', 'left');
        $this->db->where('pus.idpuskesmas', $idpus['id']);
        return $this->db->get('user as u')->result();
    }
    public function getDesaPuskesmas($idp)
    {
        $idpus = $this->_getIDpuskesmas($idp);
        $this->db->select('des.iddesa as id, des.nama');
        $this->db->from('tbdesa as des');
        $this->db->join('tbkecamatan as kec', 'des.idkec = kec.idkec');
        $this->db->join('tbpuskesmas as pus', 'kec.idkec = pus.idkec');
        $this->db->where('pus.idpuskesmas', $idpus['id']);
        return $this->db->get()->result();
    }
    public function getPosyanduLokal($idp)
    {
        $idpus = $this->_getIDpuskesmas($idp);
        $sub = "(SELECT COUNT(pen.nik) from penduduk as pen WHERE (DATEDIFF(CURDATE(), pen.tgllahir)/30.40) < 61 AND idposyandu = id) as balita";
        $this->db->select('pos.idposyandu as id, pos.namaposyandu as nama, pos.dusun as dusun, des.nama as desa, ' . $sub);
        $this->db->join('tbdesa as des', 'pos.iddesa = des.iddesa');
        $this->db->join('tbpuskesmas as pus', 'des.idkec = pus.idkec');
        $this->db->where('pus.idpuskesmas', $idpus['id']);
        return $this->db->get('tbposyandu as pos')->result();
    }
    public function getDesaLokal($idp)
    {
        $idpus = $this->_getIDpuskesmas($idp)['id'];
        $this->db->select('tbdesa.iddesa, tbdesa.nama')
            ->from('tbdesa')
            ->join('tbpuskesmas', 'tbdesa.idkec = tbpuskesmas.idkec')
            ->where('tbpuskesmas.idpuskesmas', $idpus);
        return $this->db->get()->result();
    }
    public function getDataPosyandu($idp)
    {
        $this->db->select('pos.idposyandu as id, pos.namaposyandu as nama, pos.dusun, des.nama as desa');
        $this->db->where('idposyandu', $idp);
        $this->db->join('tbdesa as des', 'pos.iddesa = des.iddesa');
        return $this->db->get('tbposyandu as pos')->row_array();
    }
    public function getKaderPosyandu($idp)
    {
        $this->db->where('unitkerja', $idp);
        $this->db->where('role_id', 3);
        return $this->db->get('user')->result();
    }
    public function getBGM()
    {
        return $this->db->get('berat')->result();
    }
    public function updateBGM()
    {
        $post = $this->input->post();
        $data = [
            'kenaikan_l' => $post['kenaikan_l'],
            'kenaikan_p' => $post['kenaikan_p'],
            'garis_merah_l' => $post['garis_merah_l'],
            'garis_merah_p' => $post['garis_merah_p']
        ];
        return $this->db->update('berat', $data, ['umur' => $post['idedit']]);
    }
    public function getRasioBalita($idp)
    {
        $idpus = $this->_getIDpuskesmas($idp)['id'];
        $this->db->select('REPLACE(REPLACE(kelamin,"L","Laki-laki"),"P","Perempuan") as kelamin, count(nik) as total')
            ->from('penduduk')
            ->join('tbposyandu', 'penduduk.idposyandu = tbposyandu.idposyandu')
            ->join('tbdesa as des', 'tbposyandu.iddesa = des.iddesa')
            ->join('tbpuskesmas as pus', 'des.idkec = pus.idkec')
            ->where('idpuskesmas', $idpus)
            ->where('CEIL(DATEDIFF(CURDATE(), tgllahir)/30.40) <', 61) //Tanggal Sekarang
            ->group_by('penduduk.kelamin');
        return $this->db->get()->result();
    }
    public function getOverview($idp, $th, $bl)
    {
        $idpus = $this->_getIDpuskesmas($idp)['id'];

        $result = [
            'posyandu' => $this->_getTotalPosyanduLokal($idpus)->total,
            'kader' => $this->_getTotalKader($idpus)->total,
            'balita' => $this->_getTotalBalita($idpus)->total,
            'N' => $this->_getKetTimbangan($idpus, 'N', $th, $bl)->total,
            'T' => $this->_getKetTimbangan($idpus, 'T', $th, $bl)->total,
            '2T' => $this->_getKetTimbangan($idpus, '2T', $th, $bl)->total,
            'O' => $this->_getKetTimbangan($idpus, 'O', $th, $bl)->total,
            'B' => $this->_getKetTimbangan($idpus, 'B', $th, $bl)->total,
            'BGM' => $this->_getKetTimbangan($idpus, 'BGM', $th, $bl)->total
        ];
        return $result;
    }
    private function _getTotalPosyanduLokal($idpus)
    {
        $this->db->select('count(idposyandu) as total')
            ->from('tbposyandu')
            ->join('tbdesa as des', 'tbposyandu.iddesa = des.iddesa')
            ->join('tbpuskesmas as pus', 'des.idkec = pus.idkec')
            ->where('idpuskesmas', $idpus);
        return $this->db->get()->first_row();
    }
    private function _getTotalKader($idpus)
    {
        $this->db->select('count(id) as total')
            ->from('user')
            ->join('tbposyandu', 'user.unitkerja = tbposyandu.idposyandu')
            ->join('tbdesa as des', 'tbposyandu.iddesa = des.iddesa')
            ->join('tbpuskesmas as pus', 'des.idkec = pus.idkec')
            ->where('idpuskesmas', $idpus)
            ->where('role_id', 3);
        return $this->db->get()->first_row();
    }
    private function _getTotalBalita($idpus)
    {
        $this->db->select('count(nik) as total')
            ->from('penduduk')
            ->join('tbposyandu', 'penduduk.idposyandu = tbposyandu.idposyandu')
            ->join('tbdesa as des', 'tbposyandu.iddesa = des.iddesa')
            ->join('tbpuskesmas as pus', 'des.idkec = pus.idkec')
            ->where('idpuskesmas', $idpus)
            ->where('CEIL(DATEDIFF(CURDATE(), tgllahir)/30.40) <', 61) //Tanggal Sekarang
            ->where('CEIL(DATEDIFF(CURDATE(), tgllahir)/30.40) >', 0); //Tanggal Sekarang
        return $this->db->get()->first_row();
    }
    private function _getKetTimbangan($idpus, $ket, $th, $bl)
    {
        $this->db->select('count(idpengukuran) as total')
            ->from('pengukuran')
            ->join('beritaacara', 'pengukuran.idacara = beritaacara.idacara')
            ->join('tbposyandu', 'beritaacara.idposyandu = tbposyandu.idposyandu')
            ->join('tbdesa as des', 'tbposyandu.iddesa = des.iddesa')
            ->join('tbpuskesmas as pus', 'des.idkec = pus.idkec')
            ->where('month(beritaacara.tglacara)', $bl)
            ->where('year(beritaacara.tglacara)', $th)
            ->where('idpuskesmas', $idpus)
            ->where('pengukuran.keterangan', $ket);
        return $this->db->get()->first_row();
    }
    private function _getIDpuskesmas($idp)
    {
        $this->db->select('pus.idpuskesmas as id');
        $this->db->from('tbposyandu as pos');
        $this->db->join('tbdesa as des', 'pos.iddesa = des.iddesa');
        $this->db->join('tbpuskesmas as pus', 'des.idkec = pus.idkec');
        $this->db->where('pos.idposyandu', $idp);
        $this->db->limit(1);
        return $this->db->get()->row_array();
    }
    public function getTimbanganRinci($idp, $ket, $th, $bl)
    {
        $idpus = $this->_getIDpuskesmas($idp)['id'];
        $this->db->select('count(idpengukuran) as total, tbposyandu.idposyandu as id, tbposyandu.namaposyandu as posyandu')
            ->select('concat(tbposyandu.dusun, concat(", ", des.nama)) as alamat')
            ->from('pengukuran')
            ->join('beritaacara', 'pengukuran.idacara = beritaacara.idacara')
            ->join('tbposyandu', 'beritaacara.idposyandu = tbposyandu.idposyandu')
            ->join('tbdesa as des', 'tbposyandu.iddesa = des.iddesa')
            ->join('tbpuskesmas as pus', 'des.idkec = pus.idkec')
            ->where('MONTH(beritaacara.tglacara)', $bl)
            ->where('YEAR(beritaacara.tglacara)', $th)
            ->where('idpuskesmas', $idpus)
            ->where('pengukuran.keterangan', $ket)
            ->group_by('tbposyandu.namaposyandu')
            ->order_by('total', 'DESC');
        return $this->db->get()->result();
    }
    public function getListRinci($idp, $ket, $th, $bl)
    {
        $this->db->select('penduduk.nama, CEIL(DATEDIFF(CURDATE(), tgllahir)/30.40) as umur, pengukuran.berat')
            ->from('pengukuran')
            ->join('beritaacara', 'pengukuran.idacara = beritaacara.idacara')
            ->join('penduduk', 'pengukuran.nik = penduduk.nik')
            ->where('MONTH(beritaacara.tglacara)', $bl)
            ->where('YEAR(beritaacara.tglacara)', $th)
            ->where('beritaacara.idposyandu', $idp)
            ->where('pengukuran.keterangan', $ket)
            ->order_by('umur', 'desc');
        return $this->db->get()->result();
    }

    // SELECT count(pengukuran.idpengukuran) as balita, tbposyandu.namaposyandu as posyandu
    // FROM pengukuran
    // JOIN beritaacara ON pengukuran.idacara = beritaacara.idacara
    // JOIN tbposyandu ON beritaacara.idposyandu = tbposyandu.idposyandu
    // JOIN tbdesa ON tbposyandu.iddesa = tbdesa.iddesa
    // JOIN tbpuskesmas ON tbdesa.idkec = tbpuskesmas.idkec
    // WHERE MONTH(beritaacara.tglacara) = 5
    // AND YEAR(beritaacara.tglacara) = 2020
    // AND pengukuran.keterangan = 'BGM'
    // GROUP BY tbposyandu.namaposyandu
}
