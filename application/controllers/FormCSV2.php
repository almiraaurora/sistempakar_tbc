<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FormCSV2 extends CI_Controller{
	function __construct(){
		parent::__construct();	
        $this->load->model('admin_model/M_datauji');
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
        $data['isi'] = 'admin/import_formuji';
		$this->load->view('layout/all', $data);

		// $this->load->view('v_tampil',$data);
    }

    public function process() {
        if(isset($_POST['import'])) {
            $file = $_FILES['file']['tmp_name'];
            $handle = fopen($file, "r");
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                // Lakukan sesuatu dengan data yang dibaca
                // $Bobot_batuk = $this->input->post('Bobot_batuk');
                // $Bobot_batukberdarah = $this->input->post('Bobot_batukberdarah');
                // $Bobot_sesaknafas = $this->input->post('Bobot_sesaknafas');
                // $Bobot_demam = $this->input->post('Bobot_demam');
                // $Bobot_keringat = $this->input->post('Bobot_keringat');
                // $Bobot_nafsumakan = $this->input->post('Bobot_nafsumakan');
                // $Bobot_beratbadan = $this->input->post('Bobot_beratbadan');
                // $label = $this->input->post('label');
                $data = array(
                    'Bobot_batuk' => $data[0],
                    'Bobot_batukberdarah' => $data[1],
                    'Bobot_sesaknafas' => $data[2],
                    'Bobot_demam' => $data[3],
                    'Bobot_keringat' => $data[4],
                    'Bobot_nafsumakan' => $data[5],
                    'Bobot_beratbadan' => $data[6],
                    'label' => $data[7]
                    );
                $this->M_datauji->input_datauji($data, 'tabel_datauji'); // Gantilah your_model dengan model yang sesuai
            }
            fclose($handle);
            redirect('DataUji'); // Ganti data dengan halaman tujuan Anda
        }
        else {
            echo 'Format file tidak valid!';
        }
    }

}