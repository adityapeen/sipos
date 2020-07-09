<?php
class Cetak extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('Pdf');
    }
    function index()
    {
        $this->load->model('kegiatan_model');
        $post = $this->input->post();

        $th = $post['th'];
        $bl = $post['bl'];
        $idp = $post['idp'];
        $res = $this->kegiatan_model->getBeritaAcara($th, $bl, $idp);
        $res['idp'] = $idp;
        echo json_encode($res);
    }

    function rekap()
    {
        $this->load->model('pengukuran_model');

        $idacara = $this->input->post('idacara');
        $header = strtoupper($this->input->post('header'));
        $tahun = $this->input->post('tahun');
        $bulan = strtoupper($this->input->post('bulan'));
        $doc = 'Rekap ' . $this->input->post('header') . ' Bulan ' . $bulan . ' ' . $tahun;



        $header = 'FORMULIR PENILAIAN GIZI BAYI DAN BALITA ' . $header;

        $subheader = 'BULAN ' . $bulan . '        TAHUN ' . $tahun;
        $pdf = new FPDF('P', 'mm', 'A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial', 'B', 12);
        // mencetak string 
        $pdf->Cell(190, 7, $header, 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(190, 7, $subheader, 0, 1, 'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10, 2, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(6, 6, 'NO', 1, 0);
        $pdf->Cell(40, 6, 'NAMA ANAK', 1, 0);
        $pdf->Cell(6, 6, 'L/P', 1, 0);
        $pdf->Cell(20, 6, 'TTL', 1, 0);
        $pdf->Cell(35, 6, 'NAMA ORANGTUA', 1, 0);
        $pdf->Cell(10, 6, 'UMUR', 1, 0);
        $pdf->Cell(10, 6, 'BB', 1, 0);
        $pdf->Cell(10, 6, 'TB', 1, 0);
        $pdf->Cell(10, 6, 'LK', 1, 0);
        $pdf->Cell(7, 6, 'N/T', 1, 0);
        $pdf->Cell(13, 6, 'ASI EKS', 1, 0);
        $pdf->Cell(10, 6, 'VIT A', 1, 0);
        $pdf->Cell(13, 6, 'STATUS', 1, 1);
        $pdf->SetFont('Arial', '', 8);
        $rekap = $this->pengukuran_model->getRekap($idacara);
        $no = 1;
        foreach ($rekap as $r) {
            $pdf->Cell(6, 6, $no, 1, 0, 'C');
            $pdf->Cell(40, 6, $r->namabalita, 1, 0);
            $pdf->Cell(6, 6, $r->kelamin, 1, 0, 'C');
            $pdf->Cell(20, 6, date('j-M-Y', strtotime($r->tgllahir)), 1, 0);
            $pdf->Cell(35, 6, $r->ibu . " / " . $r->ayah, 1, 0);
            $pdf->Cell(10, 6, round($r->umur), 1, 0, 'C');
            $pdf->Cell(10, 6, $r->berat, 1, 0, 'C');
            $pdf->Cell(10, 6, $r->tinggi, 1, 0, 'C');
            $pdf->Cell(10, 6, $r->kepala, 1, 0, 'C');
            $pdf->Cell(7, 6, $r->keterangan, 1, 0, 'C');
            $pdf->Cell(13, 6, ($r->asi == 1 ? "Ya" : "Tidak"), 1, 0, 'C');
            $pdf->Cell(10, 6, ($r->vitamina == 1 ? "Ya" : "Tidak"), 1, 0, 'C');
            $pdf->Cell(13, 6, $r->statusbantuan, 1, 1, 'C');
            $no++;
        }
        $pdf->Output('I', $doc . '.pdf');
    }
}
