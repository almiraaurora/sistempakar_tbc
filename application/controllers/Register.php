<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller{
    function __construct(){
		parent::__construct();
		$this->load->model('admin_model/M_register');
		
       
	}
    public function index(){
        $this->load->view('admin/Registrasi');
    }
    function simpan_user(){
		$nama=$this->input->post('nama',TRUE);
		$email=$this->input->post('email');
		$username=$this->input->post('username');
		$password=$this->input->post('password');
		$this->M_register->simpan_user($username,$nama,$email,$password);
		echo $this->session->set_flashdata('msg',"<div class='alert alert-info'>Anda Berhasil Terdaftar</div>");
		redirect('Auth');
	}
}