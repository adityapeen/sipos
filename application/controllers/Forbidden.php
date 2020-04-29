<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Forbidden
extends CI_Controller
{
    public function index()
    {

        $user = [
            'username' => 'hayo nakal',
            'nama' => 'hayo nakal',
            'image' => 'default',
            'role_id' => 4
        ];
        $data['user'] = $user;
        $data['title'] = "Akses Ditolak - Jangan Nakal - SIPOSYANDU";
        $this->load->view('template/header', $data);
        $this->load->view('restricted');
        $this->load->view('template/footer', $data);
    }
    public function err404()
    {
        $user = [
            'username' => 'hayo nakal',
            'nama' => 'hayo nakal',
            'image' => 'default',
            'role_id' => 4
        ];
        $data['user'] = $user;
        $data['title'] = "Halaman tidak Ditemukan - SIPOSYANDU";
        $this->load->view('template/header', $data);
        $this->load->view('404');
        $this->load->view('template/footer', $data);
    }
}
