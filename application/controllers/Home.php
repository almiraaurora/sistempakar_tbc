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
		$nama = $this->input->post('nama');
		$usia = $this->input->post('usia');
		$jeniskelamin = $this->input->post('jeniskelamin');
 
		$data = array(
			'nama' => $nama,
			'usia' => $usia,
			'jeniskelamin' => $jeniskelamin
			);
		$this->M_user->input_data($data,'tabel_user');
		redirect('V_Gejala');
	}
}