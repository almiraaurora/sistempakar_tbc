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

	public function tambah_bobotdatalatih(){
		$Bobot_batuk = $this->input->post('Bobot_batuk');
		$Bobot_batukberdarah = $this->input->post('Bobot_batukberdarah');
		$Bobot_sesaknafas = $this->input->post('Bobot_sesaknafas');
		$Bobot_demam = $this->input->post('Bobot_demam');
		$Bobot_keringat = $this->input->post('Bobot_keringat');
		$Bobot_nafsumakan = $this->input->post('Bobot_nafsumakan');
		$Bobot_beratbadan = $this->input->post('Bobot_beratbadan');
		
		$data = array(
			'Bobot_batuk' => $Bobot_batuk,
			'Bobot_batukberdarah' => $Bobot_batukberdarah,
			'Bobot_sesaknafas' => $Bobot_sesaknafas,
			'Bobot_demam' => $Bobot_demam,
			'Bobot_keringat' => $Bobot_keringat,
			'Bobot_nafsumakan' => $Bobot_nafsumakan,
			'Bobot_beratbadan' => $Bobot_beratbadan
			);
			print_r($data);
		$this->M_datalatih->input_datalatih($data,'tabel_datalatih');
		redirect('admin/tampil_datalatih');
	}
}