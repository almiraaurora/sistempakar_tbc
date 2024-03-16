<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TambahDataUji extends CI_Controller{
  function __construct(){
		parent::__construct();		
		$this->load->model('admin_model/M_datauji');
    	$this->load->helper('url');
	}
    public function index(){
		//$data['tampil_datalatih'] = $this->M_datalatih->tampil_datalatih();
        $data['title'] = "Halaman Tambah Data uji";
        $data['isi'] = 'admin/data_uji';
		$this->load->view('layout/all', $data);

		// $this->load->view('v_tampil',$data);
    }

    public function tambah_bobotdatauji(){
      $Bobot_batuk = $this->input->post('Bobot_batuk');
      $Bobot_batukberdarah = $this->input->post('Bobot_batukberdarah');
      $Bobot_sesaknafas = $this->input->post('Bobot_sesaknafas');
      $Bobot_demam = $this->input->post('Bobot_demam');
      $Bobot_keringat = $this->input->post('Bobot_keringat');
      $Bobot_nafsumakan = $this->input->post('Bobot_nafsumakan');
      $Bobot_beratbadan = $this->input->post('Bobot_beratbadan');
      $label = $this->input->post('label');
      
      $data = array(
        'Bobot_batuk' => $Bobot_batuk,
        'Bobot_batukberdarah' => $Bobot_batukberdarah,
        'Bobot_sesaknafas' => $Bobot_sesaknafas,
        'Bobot_demam' => $Bobot_demam,
        'Bobot_keringat' => $Bobot_keringat,
        'Bobot_nafsumakan' => $Bobot_nafsumakan,
        'Bobot_beratbadan' => $Bobot_beratbadan,
        'label' => $label
        );
        print_r($data);
      $this->M_datauji->input_datauji($data,'tabel_datauji');
      redirect('DataUji');
    }
}