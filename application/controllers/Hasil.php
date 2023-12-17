<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hasil extends CI_Controller{
    function __construct(){
		parent::__construct();		
		$this->load->model('M_hasil');
		$this->load->helper('url');
 
	}
    public function index() {
        $this->load->view('V_Hasil');
    }

    

   
    
    public function menghitungDS($hasilcf){
       // $ds = 
        if ($cf >= 0 && $cf <= 1 && $bobot_gejala >= 0 && $bobot_gejala <= 1) {
            // Menghitung certainty factor
            $hasilcf = $this->hitungCertaintyFactor($cf, $bobot_gejala);
            echo "Certainty Factor hasil perhitungan: " . $hasilcf;
        } else {
            echo "Mohon masukkan Certainty Factor antara 0 dan 1.";
        }
    }
}