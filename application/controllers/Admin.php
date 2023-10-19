<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{
    public function index()
	{
		$data=[
			'title'=> "Halaman Home",
			'isi'=> 'admin/HomeAdmin'
		];
		$this->load->view('layout/all', $data);
	}
}