<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pengukuran_model extends CI_Model
{
    private $_table = "pengukuran";

    public $idpengukuran;
    public $idacara;
    public $idpetugas;
    public $nik;
    public $berat;
    public $tinggi;
    public $kepala;
    public $keterangan;
    public $asi;
    public $vitamina;
    public $beratumur;
    public $tinggiumur;
    public $berattinggi;
    public $statusbantuan;

    public function rules()
    {
        return [
            [
                'field' => 'idacara',
                'label' => 'ID Acara',
                'rules' => 'required'
            ],

            [
                'field' => 'idpetugas',
                'label' => 'ID Petugas',
                'rules' => 'required'
            ],

            [
                'field' => 'nik',
                'label' => 'NIK',
                'rules' => 'required'
            ],

            [
                'field' => 'berat',
                'label' => 'Berat',
                'rules' => 'required'
            ]

        ];
    }
    public function save()
    {
        $post = $this->input->post();

        $this->idpengukuran =  NULL;
        $this->idacara = $post['idacara'];
        $this->idpetugas = $post['idpetugas'];
        $this->nik = $post['nik'];
        $this->berat = $post['berat'];
        $this->tinggi = ($post['tinggi'] == '' ? NULL : $post['tinggi']);
        $this->kepala = ($post['kepala'] == '' ? NULL : $post['kepala']);
        $this->keterangan = $post['keterangan'];
        $this->asi = $post['asie'];
        $this->vitamina = $post['vitamina'];
        $this->beratumur = (!isset($post['beratumur']) || $post['beratumur'] == NULL ? NULL : $post['beratumur']);
        $this->tinggiumur = (!isset($post['tinggiumur']) || $post['tinggiumur'] == NULL ? NULL : $post['tinggiumur']);
        $this->berattinggi = (!isset($post['berattinggi']) || $post['berattinggi'] == NULL ? NULL : $post['berattinggi']);
        $this->statusbantuan = (!isset($post['statusbantuan']) ? NULL : strtoupper($post['statusbantuan']));


        return $this->db->insert($this->_table, $this);
    }
    public function update()
    {
        $post = $this->input->post();
        $this->idpengukuran = $this->input->post('idpengukuran');
        $this->idacara = $post['idacara'];
        $this->idpetugas = $post['idpetugas'];
        $this->nik = $post['nik'];
        $this->berat = $post['berat'];
        $this->tinggi = $post['tinggi'];
        $this->kepala = $post['kepala'];
        $this->keterangan = $post['keterangan'];
        $this->asi = $post['asie'];
        $this->vitamina = $post['vitamina'];
        $this->beratumur = (!isset($post['beratumur']) ? NULL : $post['beratumur']);
        $this->tinggiumur = (!isset($post['tinggiumur']) ? NULL : $post['tinggiumur']);
        $this->berattinggi = (!isset($post['berattinggi']) ? NULL : $post['berattinggi']);
        $this->statusbantuan = (!isset($post['statusbantuan']) ? NULL : strtoupper($post['statusbantuan']));

        return $this->db->update($this->_table, $this, array('idpengukuran' => $post['idpengukuran']));
    }
    public function delete($id)
    {
        return $this->db->delete($this->_table, array("idpengukuran" => $id));
    }

    //Mengambil data pengukuran bulan
    public function getBeritaAcara($th, $bl, $idp)
    {
        $this->db->select('*');
        $this->db->from($this->_table . ' as a');
        $this->db->join('beritaacara b', 'a.idacara = b.idacara', 'left');
        $this->db->where('YEAR(b.tglacara)', $th);
        $this->db->where('MONTH(b.tglacara)', $bl);
        $this->db->where('b.idposyandu', $idp);
        $query = $this->db->get()->result();
        return $query;
    }
    public function getUkuran($id)
    {
        $this->db->from($this->_table);
        $this->db->where('idpengukuran', $id);
        return $this->db->get()->result();
    }

    //Mengambil data ukuran lengkap + ortu
    public function getUkuranLengkap($id)
    {
        $this->db->select('p.idpengukuran, p.nik, anak.nama as namabalita, anak.tgllahir, ibu.nama as ibu, ayah.nama as ayah, p.keterangan, p.statusbantuan');
        $this->db->select('acara.tglacara, (DATEDIFF(acara.tglacara, anak.tgllahir)/30.40) as umur, p.berat, p.tinggi, p.kepala, p.asi, p.vitamina');
        $this->db->from($this->_table . ' as p');
        $this->db->join('beritaacara as acara', 'p.idacara = acara.idacara', 'left');
        $this->db->join('penduduk as anak', 'p.nik = anak.nik', 'left');
        $this->db->join('penduduk as ibu', 'anak.ibu = ibu.nik', 'left');
        $this->db->join('penduduk as ayah', 'anak.ayah = ayah.nik', 'left');
        $this->db->where('idpengukuran', $id);
        return $this->db->get()->result();
    }


    function getIdUkuran($nik, $idacara)
    {
        $this->db->select('idpengukuran');
        $this->db->where('nik', $nik);
        $this->db->where('idacara', $idacara);
        $this->db->from($this->_table);
        $this->db->limit(1);
        return $this->db->get()->result();
    }

    public function getRekap($idacara)
    {
        $this->db->select('p.idpengukuran, p.nik, anak.nama as namabalita, anak.kelamin, anak.tgllahir, ibu.nama as ibu, ayah.nama as ayah, p.keterangan, p.statusbantuan');
        $this->db->select('acara.tglacara, (DATEDIFF(acara.tglacara, anak.tgllahir)/30.40) as umur, p.berat, p.tinggi, p.kepala, p.asi, p.vitamina');
        $this->db->from($this->_table . ' as p');
        $this->db->join('beritaacara as acara', 'p.idacara = acara.idacara', 'left');
        $this->db->join('penduduk as anak', 'p.nik = anak.nik', 'left');
        $this->db->join('penduduk as ibu', 'anak.ibu = ibu.nik', 'left');
        $this->db->join('penduduk as ayah', 'anak.ayah = ayah.nik', 'left');
        $this->db->where('acara.idacara', $idacara);
        $this->db->order_by('anak.tgllahir', 'asc');
        return $this->db->get()->result();
    }
    public function getRekapNew($idacara)
    {
        $this->db->select('p.idpengukuran, p.nik, anak.nama as namabalita, anak.kelamin, anak.tgllahir, ibu.nama as ibu, ayah.nama as ayah, p.keterangan, p.statusbantuan');
        $this->db->select('acara.tglacara, (DATEDIFF(acara.tglacara, anak.tgllahir)/30.40) as umur, p.berat, p.tinggi, p.kepala, REPLACE(REPLACE(p.asi,0,"Tidak"),1,"Ya") as asi, REPLACE(REPLACE(p.vitamina,0,"Tidak"),1,"Ya") as vitamina');
        $this->db->from($this->_table . ' as p');
        $this->db->join('beritaacara as acara', 'p.idacara = acara.idacara', 'left');
        $this->db->join('penduduk as anak', 'p.nik = anak.nik', 'left');
        $this->db->join('penduduk as ibu', 'anak.ibu = ibu.nik', 'left');
        $this->db->join('penduduk as ayah', 'anak.ayah = ayah.nik', 'left');
        $this->db->where('acara.idacara', $idacara);
        $this->db->order_by('anak.tgllahir', 'asc');
        return $this->db->get()->result();
    }

    public function getSkdn($idacara)
    {
        $result = [
            'uraian' => '',
            'data' => ''
        ];
        $result['uraian'] = [
            'Jumlah balita yang ada di Posyandu (S)' => '',
            'Jumlah balita yang mempunyai kartu KMS/ Buku KIA (K)' => '',
            'Jumlah Balita yang naik timbangannya (N)' => '',
            'Balita yang tidak naik berat badannya bulan ini (T)'  => '',
            'Jumlah balita yang bulan ini ditimbang tapi bulan lalu tidak ditimbang (O)' => '',
            'Jumlah balita yang dua kali tidak naik berat badannya bulan ini (2T)' => '',
            'Jumlah balita yang baru ditimbang bulan ini (B)' => '',
            'Jumlah balita yang ditimbang bulan ini (D)' => '',
            'Jumlah balita Garis Merah (BGM)' => '',
            'Jumlah balita mendapat kapsul vitamin A' => '',
            'Jumlah bayi yang diberikan ASI Ekslusif' => ''
        ];
        $result['data'] = [
            'laki-laki' => '',
            'perempuan' => ''
        ];
        // for ($i = 0; $i < 11; $i++) {
        //     $result['no'] = $i;
        //     $result['uraian'] = $uraian[$i];
        // }
        //array_push($result, $uraian);

        //$this->db->query("SELECT COUNT(p.idpengukuran) as bayi FROM pengukuran as p JOIN beritaacara as acara ON p.idacara = acara.idacara JOIN penduduk as anak ON p.nik = anak.nik WHERE CEIL(DATEDIFF(acara.tglacara, anak.tgllahir)/30.40) <= 5 AND p.idacara = $idacara AND anak.kelamin ='L'");
        return $result;
    }

    public function getStat($nik)
    {
        $this->db->select('acara.tglacara, p.berat, p.tinggi, p.kepala');
        $this->db->select('(DATEDIFF(acara.tglacara, anak.tgllahir)/30.40) as umur');
        $this->db->from($this->_table . ' as p');
        $this->db->join('beritaacara as acara', 'p.idacara = acara.idacara', 'left');
        $this->db->join('penduduk as anak', 'p.nik = anak.nik', 'left');
        $this->db->where('p.nik', $nik);
        $this->db->order_by('acara.tglacara', 'asc');
        return $this->db->get()->result();
    }

    public function getKet($nik)
    {
        $this->db->select('berat, keterangan');
        $this->db->from($this->_table . ' as p');
        $this->db->join('beritaacara as a', 'p.idacara = a.idacara');
        $this->db->where('nik', $nik);
        $this->db->where('YEAR(a.tglacara) = YEAR(CURDATE() - INTERVAL 1 MONTH)');
        $this->db->where('MONTH(a.tglacara) = MONTH(CURDATE() - INTERVAL 1 MONTH)');
        $this->db->order_by('idpengukuran', 'desc');
        $this->db->limit(1);
        return $this->db->get()->row_array();
    }
    public function checkBeritaAcara($id)
    {
        return $this->db->get_where($this->_table, ['idacara' => $id])->result();
    }
    public function getBalitaBGM($id)
    {
        $this->db->select('anak.nama as nama, ibu.nama as ibu, ayah.nama as ayah, anak.tgllahir, anak.kelamin, p.berat, p.tinggi, (DATEDIFF(acara.tglacara, anak.tgllahir)/30.40) as umur ')
            ->from($this->_table . ' p')
            ->join('beritaacara as acara', 'p.idacara = acara.idacara', 'left')
            ->join('penduduk as anak', 'p.nik = anak.nik', 'left')
            ->join('penduduk as ibu', 'anak.ibu = ibu.nik', 'left')
            ->join('penduduk as ayah', 'anak.ayah = ayah.nik', 'left')
            ->where('p.idacara', $id)
            ->where('p.keterangan', 'BGM');
        return $this->db->get()->result();
    }
    public function getBalitaASI($id)
    {
        $this->db->select('anak.nama as nama, ibu.nama as ibu, ayah.nama as ayah, anak.tgllahir, anak.kelamin, p.berat, p.tinggi, (DATEDIFF(acara.tglacara, anak.tgllahir)/30.40) as umur ')
            ->from($this->_table . ' p')
            ->join('beritaacara as acara', 'p.idacara = acara.idacara', 'left')
            ->join('penduduk as anak', 'p.nik = anak.nik', 'left')
            ->join('penduduk as ibu', 'anak.ibu = ibu.nik', 'left')
            ->join('penduduk as ayah', 'anak.ayah = ayah.nik', 'left')
            ->where('p.idacara', $id)
            ->where('p.asi', '1');
        return $this->db->get()->result();
    }
}

// mysql> SELECT name, birth, CURDATE( ) AS today,
//     -> (YEAR(CURDATE( )) - YEAR(birth)) * 12
//     -> + (MONTH(CURDATE( )) - MONTH(birth))
//     -> - IF(DAYOFMONTH(CURDATE( )) < DAYOFMONTH(birth),1,0)
//     -> AS 'age in months'
//     -> FROM sibling;
