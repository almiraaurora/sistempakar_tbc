<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gejala extends CI_Controller{
    public function index(){
        $data=[
			'title'=> "Halaman daftar gejala",
			'isi'=> 'admin/daftar_gejala'
		];
		$this->load->view('layout/all', $data);
    }
}