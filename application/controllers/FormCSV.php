<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FormCSV extends CI_Controller{
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
		//$data['tampil_datalatih'] = $this->M_datalatih->tampil_datalatih();
        $data['title'] = "Halaman Form CSV";
        $data['isi'] = 'admin/import_form';
		$this->load->view('layout/all', $data);

		// $this->load->view('v_tampil',$data);
    }

    public function process() {
        if(isset($_POST['import'])) {
            $file = $_FILES['file']['tmp_name'];
            $handle = fopen($file, "r");
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                // Lakukan sesuatu dengan data yang dibaca
                $this->M_datalatih->input_datalatih($data); // Gantilah your_model dengan model yang sesuai
            }
            fclose($handle);
            redirect('DataLatih'); // Ganti data dengan halaman tujuan Anda
        }
    }

	
}