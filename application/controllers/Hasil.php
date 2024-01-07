<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hasil extends CI_Controller{
    function __construct(){
		parent::__construct();		
		$this->load->model('M_hasil');
		$this->load->helper('url');
 
	}
    public function index() {
        // Mendapatkan data Certainty Factor (CF) dari model
        $cf_data = $this->M_hasil->getCFData();

        // Mendapatkan data Dempster-Shafer (DS) dari model
        $ds_data = $this->M_hasil->getDSData();

        // Mengirim data ke view
        $data['cf_data'] = $cf_data;
        $data['ds_data'] = $ds_data;
        $this->load->view('V_Hasil', $data);
    }
    // public function index() {
    //     $this->load->model('M_hasil'); // Memuat model

    //     // Mendapatkan data Certainty Factor (CF) dari model
    //     $cf_data = $this->M_hasil->getCFData();

    //     // Mendapatkan data Dempster-Shafer (DS) dari model
    //     $ds_data = $this->M_hasil->getDSData();

    //     // Mengirim data ke view
    //     $data['cf_data'] = $cf_data;
    //     $data['ds_data'] = $ds_data;

    //     // Menampilkan view dengan data yang telah diperoleh
    //     $this->load->view('hasil_view', $data);
    // }

    public function tambah_userakhir(){
        $id_user = $this->M_kombinasi->get_max_id_userakhir();
        $hasil_perhitungan = $this->input->post('hasil_perhitungan');
        $data = array(
            'id_userakhir' => $id_user,
            'hasil_perhitungan'=> $hasil_perhitungan
        );
        $this->M_kombinasi->input_dataakhir($data,'tabel_hasil2');
    }

    // public function showData() {
        
    //     $data['hasil_perhitungan'] = $this->M_kombinasi->getAllData(); // Mengambil data dari model
        
    //     // Memuat view dan meneruskan data
    //     $this->load->view('V_Hasil', $data);
    // }

    

   
    
    // public function menghitungDS($hasilcf){
    //    // $ds = 
    //     if ($cf >= 0 && $cf <= 1 && $bobot_gejala >= 0 && $bobot_gejala <= 1) {
    //         // Menghitung certainty factor
    //         $hasilcf = $this->hitungCertaintyFactor($cf, $bobot_gejala);
    //         echo "Certainty Factor hasil perhitungan: " . $hasilcf;
    //     } else {
    //         echo "Mohon masukkan Certainty Factor antara 0 dan 1.";
    //     }
    // }
}