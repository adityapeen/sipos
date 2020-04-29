<?php defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function getDesa()
    {
        $this->db->select('d.iddesa, d.nama, k.nama as kec');
        $this->db->join('tbkecamatan as k', 'd.idkec = k.idkec');
        return $this->db->get('tbdesa as d')->result();
    }
    public function getKecamatan()
    {
        $this->db->select('k.idkec, k.nama, kb.nama as kab');
        $this->db->join('tbkabupaten as kb', 'k.idkab = kb.idkab');
        return $this->db->get('tbkecamatan as k')->result();
    }
    public function getKabupaten()
    {
        $this->db->select('kb.idkab, kb.nama, p.nama as prov');
        $this->db->join('tbprovinsi as p', 'kb.idprov = p.idprov');
        return $this->db->get('tbkabupaten as kb')->result();
    }
    public function getProvinsi()
    {
        return $this->db->get('tbprovinsi')->result();
    }
    public function addProvinsi()
    {
        $post = $this->input->post();
        $data = array(
            'idprov' => NULL,
            'nama' => $post['nmdaerah']
        );
        return $this->db->insert('tbprovinsi', $data);
    }
    public function addKabupaten()
    {
        $post = $this->input->post();
        $data = array(
            'idkab' => NULL,
            'nama' => $post['nmdaerah'],
            'idprov' => $post['provinsi'],
        );
        return $this->db->insert('tbkabupaten', $data);
    }
    public function addKecamatan()
    {
        $post = $this->input->post();
        $data = array(
            'idkec' => NULL,
            'nama' => $post['nmdaerah'],
            'idkab' => $post['kabupaten'],
        );
        return $this->db->insert('tbkecamatan', $data);
    }
    public function addDesa()
    {
        $post = $this->input->post();
        $data = array(
            'iddesa' => NULL,
            'nama' => $post['nmdaerah'],
            'idkec' => $post['kecamatan'],
        );
        return $this->db->insert('tbdesa', $data);
    }
    public function updateProvinsi()
    {
        $post = $this->input->post();
        $data = array(
            'nama' => $post['namadaerah'],
        );
        return $this->db->update('tbprovinsi', $data, array('idprov' => $post['idedit']));
    }
    public function updateKabupaten()
    {
        $post = $this->input->post();
        $data = array(
            'nama' => $post['namadaerah'],
        );
        return $this->db->update('tbkabupaten', $data, array('idkab' => $post['idedit']));
    }
    public function updateKecamatan()
    {
        $post = $this->input->post();
        $data = array(
            'nama' => $post['namadaerah'],
        );
        return $this->db->update('tbkecamatan', $data, array('idkec' => $post['idedit']));
    }
    public function updateDesa()
    {
        $post = $this->input->post();
        $data = array(
            'nama' => $post['namadaerah'],
        );
        return $this->db->update('tbdesa', $data, array('iddesa' => $post['idedit']));
    }

    public function deleteProvinsi()
    {
        $post = $this->input->post();
        return $this->db->delete('tbprovinsi', array("idprov" => $post['iddelete']));
    }
    public function deleteKabupaten()
    {
        $post = $this->input->post();
        return $this->db->delete('tbkabupaten', array("idkab" => $post['iddelete']));
    }
    public function deleteKecamatan()
    {
        $post = $this->input->post();
        return $this->db->delete('tbkecamatan', array("idkec" => $post['iddelete']));
    }
    public function deleteDesa()
    {
        $post = $this->input->post();
        return $this->db->delete('tbdesa', array("iddesa" => $post['iddelete']));
    }


    public function getPosyandu()
    {
        $this->db->select('pos.idposyandu as id, pos.namaposyandu as nama, pos.dusun, pus.namapuskesmas as puskesmas');
        $this->db->from('tbposyandu as pos');
        $this->db->join('tbdesa as des', 'pos.iddesa = des.iddesa');
        $this->db->join('tbkecamatan as kec', 'des.idkec = kec.idkec');
        $this->db->join('tbpuskesmas as pus', 'kec.idkec = pus.idkec');
        return $this->db->get()->result();
    }

    public function getPuskesmas()
    {
        $this->db->select('pus.idpuskesmas as id, pus.namapuskesmas as nama, kab.nama as kabupaten');
        $this->db->from('tbpuskesmas as pus');
        $this->db->join('tbkecamatan as kec', 'pus.idkec = kec.idkec');
        $this->db->join('tbkabupaten as kab', 'kec.idkab = kab.idkab');
        return $this->db->get()->result();
    }

    public function getPos($id)
    {
        $this->db->select('pos.namaposyandu as nama');
        $this->db->from('tbposyandu as pos');
        $this->db->where('idposyandu', $id);
        return $this->db->get()->result();
    }

    public function getPus($id)
    {
        $this->db->select('pus.namapuskesmas as nama');
        $this->db->from('tbpuskesmas as pus');
        $this->db->where('idpuskesmas', $id);
        return $this->db->get()->result();
    }
    public function addPosyandu()
    {
        $post = $this->input->post();
        $data = array(
            'idposyandu' => NULL,
            'namaposyandu' => $post['nama'],
            'dusun' => $post['dusun'],
            'iddesa' => $post['desa'],
        );
        return $this->db->insert('tbposyandu', $data);
    }
    public function addPuskesmas()
    {
        $post = $this->input->post();
        $data = array(
            'idpuskesmas' => NULL,
            'namapuskesmas' => $post['nama'],
            'idkec' => $post['kecamatan'],
        );
        return $this->db->insert('tbpuskesmas', $data);
    }
    public function updatePosyandu()
    {
        $post = $this->input->post();
        return $this->db->update('tbposyandu', array('namaposyandu' => $post['namapos']), array('idposyandu' => $post['idedit']));
    }
    public function updatePuskesmas()
    {
        $post = $this->input->post();
        return $this->db->update('tbpuskesmas', array('namapuskesmas' => $post['namapos']), array('idpuskesmas' => $post['idedit']));
    }
    public function deletePosyandu()
    {
        $post = $this->input->post();
        return $this->db->delete('tbposyandu', array("idposyandu" => $post['iddelete']));
    }
    public function deletePuskesmas()
    {
        $post = $this->input->post();
        return $this->db->delete('tbpuskesmas', array("idpuskesmas" => $post['iddelete']));
    }

    public function getRole()
    {
        return $this->db->get('user_role')->result();
    }
    public function getRoleId($id)
    {
        return $this->db->get_where('user_role', ['id' => $id])->result();
    }
    public function getUserMenu()
    {
        return $this->db->get('user_menu')->result();
    }
    public function getUserMenuId($id)
    {
        return $this->db->get_where('user_menu', ['id' => $id])->result();
    }
    public function getUserAccessMenu()
    {
        $this->db->select('am.id as id, r.role as role, m.menu as menu');
        $this->db->join('user_menu as m', 'am.menu_id = m.id');
        $this->db->join('user_role as r', 'am.role_id = r.id');
        return $this->db->get('user_access_menu as am')->result();
    }
    public function getUserAccessMenuId($id)
    {
        return $this->db->get_where('user_access_menu', ['id' => $id])->result();
    }
    public function getUserSubMenu()
    {
        $this->db->select('sm.id as id, m.menu as menu, sm.title, sm.url, sm.icon, sm.is_active');
        $this->db->join('user_menu as m', 'sm.menu_id = m.id');
        return $this->db->get('user_sub_menu as sm')->result();
    }
    public function getUserSubMenuId($id)
    {
        return $this->db->get_where('user_sub_menu', ['id' => $id])->result();
    }
    public function addMenu()
    {
        $post = $this->input->post();
        return $this->db->insert('user_menu', ['id' => NULL, 'menu' => $post['nmmenu']]);
    }
    public function addRole()
    {
        $post = $this->input->post();
        return $this->db->insert('user_role', ['id' => NULL, 'role' => $post['nmmenu']]);
    }
    public function addSubMenu()
    {
        $post = $this->input->post();
        $data = array(
            'id' => NULL,
            'menu_id' => $post['menu'],
            'title' => $post['judul'],
            'url' => $post['url'],
            'icon' => $post['icon'],
            'is_active' => $post['is_active'],
        );
        return $this->db->insert('user_sub_menu', $data);
    }
    public function addAccess()
    {
        $post = $this->input->post();
        $data = array(
            'id' => NULL,
            'role_id' => $post['role'],
            'menu_id' => $post['menu'],
        );
        return $this->db->insert('user_access_menu', $data);
    }
    public function editMenu()
    {
        $post = $this->input->post();
        return $this->db->update('user_menu', ['menu' => $post['nmmenu']], ['id' => $post['id']]);
    }
    public function editRole()
    {
        $post = $this->input->post();
        return $this->db->update('user_role', ['role' => $post['nmmenu']], ['id' => $post['id']]);
    }
    public function editSubMenu()
    {
        $post = $this->input->post();
        $data = array(
            'menu_id' => $post['menu'],
            'title' => $post['judul'],
            'url' => $post['url'],
            'icon' => $post['icon'],
            'is_active' => $post['is_active'],
        );
        return $this->db->update('user_sub_menu', $data, ['id' => $post['id']]);
    }
    public function deleteMenu()
    {
        $post = $this->input->post();
        return $this->db->delete('user_menu', ["id" => $post['iddelete']]);
    }
    public function deleteSubMenu()
    {
        $post = $this->input->post();
        return $this->db->delete('user_sub_menu', ["id" => $post['iddelete']]);
    }
    public function deleteRole()
    {
        $post = $this->input->post();
        return $this->db->delete('user_role', ["id" => $post['iddelete']]);
    }
    public function deleteAccessMenu()
    {
        $post = $this->input->post();
        return $this->db->delete('user_access_menu', ["id" => $post['iddelete']]);
    }
    public function getUserlist()
    {
        $this->db->select('u.id, u.nama, u.username, u.aktif, ur.role, p.namaposyandu as unitkerja, pus.namapuskesmas as puskesmas');
        $this->db->join('user_role as ur', 'u.role_id = ur.id');
        $this->db->join('tbposyandu as p', 'u.unitkerja = p.idposyandu', 'left');
        $this->db->join('tbdesa as d', 'p.iddesa = d.iddesa', 'left');
        $this->db->join('tbkecamatan as k', 'd.idkec = k.idkec', 'left');
        $this->db->join('tbpuskesmas as pus', 'k.idkec = pus.idkec', 'left');
        return $this->db->get('user as u')->result();
    }
    public function getPosyanduDaerah($id)
    {
        $this->db->select('pos.idposyandu as id, pos.namaposyandu as nama, pos.dusun as dusun');
        $this->db->from('tbposyandu as pos');
        $this->db->where('pos.iddesa', $id);
        return $this->db->get()->result();
    }
    public function getDataUser($username)
    {
        $this->db->select('id, nama, username, role_id, aktif, tbposyandu.namaposyandu as unitkerja');
        $this->db->from('user');
        $this->db->join('tbposyandu', 'user.unitkerja = tbposyandu.idposyandu');
        $this->db->where('username', $username);
        return $this->db->get()->result();
    }
}
