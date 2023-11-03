<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller{
    function __construct(){
		parent::__construct();		
		$this->load->model('M_user');
		$this->load->helper('url');
 
	}
    public function index(){
        $this->load->view('V_Dashboard');
    }

    public function tambah_user(){
		$Nama_pasien = $this->input->post('Nama_pasien');
		$Usia_pasien = $this->input->post('Usia_pasien');
		$Jenis_kelamin = $this->input->post('Jenis_kelamin');
 
		$data = array(
			'Nama_pasien' => $Nama_pasien,
			'Usia_pasien' => $Usia_pasien,
			'Jenis_kelamin' => $Jenis_kelamin
			);
print($data);
		$this->M_user->input_data($data,'tabel_user');
		redirect('V_Gejala');
	}
}