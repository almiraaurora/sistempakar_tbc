<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataLatih extends CI_Controller{
	function __construct(){
		parent::__construct();		
		$this->load->model('admin_model/M_datalatih');
    	$this->load->helper('url');
	}
    public function index(){
		//$data['tabel_datalatih'] = $this->M_datalatih->tampil_datalatih();
        // $data=[
		// 	'tabel_datalatih'=>$this->M_datalatih->tampil_datalatih(),
		// 	'title'=> "Halaman Data latih",
		// 	'isi'=> 'admin/tampil_datalatih'
		// ];
		$data['tampil_datalatih'] = $this->M_datalatih->tampil_datalatih();
        $data['title'] = "Halaman Data latih";
        $data['isi'] = 'admin/tampil_datalatih';
		$this->load->view('layout/all', $data);

		// $this->load->view('v_tampil',$data);
    }

	
}