<?php defined('BASEPATH') or exit('No direct script access allowed');

class Puskesmas_model extends CI_Model
{
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
}
