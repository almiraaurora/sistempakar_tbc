<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Combination extends CI_Controller {
    function __construct(){
		parent::__construct();		
		$this->load->model('M_gejala');
		$this->load->helper('url');
 
	}
    public function index() {
        $this->load->view('V_Gejala');
    }
    public function tambah_bobot(){
		$id_user = $this->M_gejala->get_max_id_user();
		$Bobot_batuk = $this->input->post('Bobot_batuk');
		$Bobot_batukberdarah = $this->input->post('Bobot_batukberdarah');
		$Bobot_sesaknafas = $this->input->post('Bobot_sesaknafas');
		$Bobot_demam = $this->input->post('Bobot_demam');
		$Bobot_keringat = $this->input->post('Bobot_keringat');
		$Bobot_nafsumakan = $this->input->post('Bobot_nafsumakan');
		$Bobot_beratbadan = $this->input->post('Bobot_beratbadan');
		
		$data = array(
			'id_user' => $id_user,
			'Bobot_batuk' => $Bobot_batuk,
			'Bobot_batukberdarah' => $Bobot_batukberdarah,
			'Bobot_sesaknafas' => $Bobot_sesaknafas,
			'Bobot_demam' => $Bobot_demam,
			'Bobot_keringat' => $Bobot_keringat,
			'Bobot_nafsumakan' => $Bobot_nafsumakan,
			'Bobot_beratbadan' => $Bobot_beratbadan
			);
			print_r($data);
		$this->M_gejala->input_data($data,'tabel_bobot');
		redirect('Hasil/index');
	}

	

	// public function menghitungCF(){
    //     // $cf = $this->input->post('cf');
    //     // $cf_kesimpulan = $this->input->post('cf_kesimpulan');

    //     // Validasi input
    //     if ($cf >= 0 && $cf <= 1 && $bobot_gejala >= 0 && $bobot_gejala <= 1) {
    //         // Menghitung certainty factor
    //         $hasilcf = $this->hitungCertaintyFactor($cf, $bobot_gejala);
    //         // echo "Certainty Factor hasil perhitungan: " . $hasilcf;
    //          $this->M_gejala->input_datacf($cf,'tabel_hasil');
    //     } else {
    //         echo "Mohon masukkan Certainty Factor antara 0 dan 1.";
    //     }
    // }
	// private function hitungCertaintyFactor($cf, $bobot_gejala) {
    //     return ($cf * $bobot_gejala);
    // }
	
}