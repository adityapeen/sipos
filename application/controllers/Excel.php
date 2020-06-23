<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Load library phpspreadsheet
require('./vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Excel extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!isset($this->session->userdata['username']) || $this->session->userdata['username'] == "") {
            redirect('auth');
        }
        if ($this->session->userdata['role_id'] == 4) {
            redirect('error/forbidden');
        }
        $this->load->model('puskesmas_model');
    }

    public function index()
    {
        $head['title'] = "Import Data - SIPOSYANDU";
        $data['user'] = $this->session->userdata();
        $idp = $this->session->userdata['idposyandu'];
        $data['posyandu'] = $this->puskesmas_model->getPosyanduLokal($idp);
        $data['kabupaten'] = $this->db->select('tbkabupaten.idkab, tbkabupaten.nama, tbprovinsi.nama as prov')
            ->join('tbprovinsi', 'tbkabupaten.idprov = tbprovinsi.idprov')
            ->get('tbkabupaten')
            ->result();

        $this->load->view('template/header', $head);
        $this->load->view('template/sidebar', $data);
        $this->load->view('puskesmas/import', $data);
        $this->load->view('template/footer');
    }

    public function download()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

        $filename = 'name-of-the-generated-file';
        // Set document properties
        $spreadsheet->getProperties()->setCreator('SIPOS - Sistem Informasi Posyandu')
            ->setLastModifiedBy('User')
            ->setTitle('Office 2007 XLSX Test Document')
            ->setSubject('Office 2007 XLSX Test Document')
            ->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.');

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output'); // download file 

    }
    public function upload() //Import Data Penduduk & Balita
    {
        $direktori = './assets/uploads/';
        $config['upload_path'] = realpath($direktori);
        $config['allowed_types'] = 'xlsx|xls|csv';
        $config['max_size'] = '10000';
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) { //upload gagal
            $this->session->set_flashdata('gagal', 'Data Gagal diupload' . $this->upload->display_errors());
            redirect('puskesmas/import');
            //redirect halaman
        } else {
            $inputFileName = $direktori . $this->upload->data('file_name');
            $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName); //Identify File Type            
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType); //Create reader based on type
            //$reader->setReadDataOnly(true);
            $spreadsheet = $reader->load($inputFileName)->getActiveSheet()->toArray(null, true, true, true); //Load File into Array

            echo "data berhasil diupload - " . $inputFileName . '<br>';
            $data = array(); //Temporary data for batch insert

            $numrow = 1; //start row index
            foreach ($spreadsheet as $row) {
                if ($numrow > 1) {
                    array_push($data, array(
                        'nik' => $row['A'],
                        'nama' => $row['B'],
                        'kelamin' => strtoupper($row['C']),
                        'tempatlahir' => $row['D'],
                        'tgllahir' => date('Y-m-d', strtotime($row['E'])),
                        'alamat' => $row['F'],
                        'pekerjaan' => $row['G'],
                        'agama' => $row['H'],
                        'ibu' => $row['I'],
                        'ayah' => $row['J'],
                        'idposyandu' => $this->input->post('idposyandu'),
                        'kms' => $row['L'],
                        'statusbantuan' => strtoupper($row['M']),
                    ));
                }
                $numrow++;
            }
            $this->db->insert_batch('penduduk', $data);
            $this->session->set_flashdata('sukses', count($spreadsheet) - 1 . ' Data Berhasil diimport');
            unlink(realpath($inputFileName)); //delete file from server
            redirect('puskesmas/penduduk/' . $this->input->post('idposyandu'));
        }
        //redirect('excel');
    }
}
