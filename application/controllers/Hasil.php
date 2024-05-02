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
        //$cf_data = $this->M_hasil->tampil_hasil();

        // Mendapatkan data Dempster-Shafer (DS) dari model
        // $ds_data = $this->Combination->getCombination();

        // Mengirim data ke view
        // $data['cf_data'] = $cf_data;
        // $data['ds_data'] = $ds_data;
        $this->load->view('V_Hasil');
    }
  
    public function tambah_userakhir(){
        $id_user = $this->M_kombinasi->get_max_id_userakhir();
        $hasil_perhitungan = $this->input->post('hasil_perhitungan');
        $data = array(
            'id_userakhir' => $id_user,
            'hasil_perhitungan'=> $hasil_perhitungan
        );
        $this->M_kombinasi->input_dataakhir($data,'tabel_hasil3');
    }

    public function getCFValues() {
        //pengambilan nilai CF dari database
        $cf = $this->nama_model->getBobotBatuk();

        
        $cf_values = array();
        foreach ($query->result() as $row) {
            // Menyimpan nilai bobot ke dalam array sesuai dengan gejala yang sesuai
            $cf_values['batuk'] = $row->Bobot_batuk;
            $cf_values['batukberdarah'] = $row->Bobot_batukberdarah;
            $cf_values['sesaknafas'] = $row->Bobot_sesaknafas;
            $cf_values['demam'] = $row->Bobot_demam;
            $cf_values['keringat'] = $row->Bobot_keringat;
            $cf_values['nafsumakan'] = $row->Bobot_nafsumakan;
            $cf_values['beratbadan'] = $row->Bobot_beratbadan;
        }
        
        return $cf_values;
    }

    public function evaluateCF($symptom) {
        $cf_values = $this->getCFValues(); // Ambil nilai CF dari database
    
        $bobotpakar = array(
            "batuk" => 1.0, // Bobot pakar untuk demam tinggi
            "batukberdarah" => 0.8, // Bobot pakar untuk batuk
            "sesaknafas" => 0.6,
            "demam" => 0.4,
            "keringat" => 0.6,
            "nafsumakan" => 0.4,
            "beratbadan" => 0.4
            // Tambahkan bobot pakar untuk gejala lainnya di sini
        );
    
            $masses = array();
            foreach ($symptoms as $symptom) {
                if (array_key_exists($symptom, $cf_values) && array_key_exists($symptom, $bobotpakar)) {
                    // Evaluasi CF untuk setiap gejala dan kalikan dengan bobot pakar
                    $masses[$symptom] = $cf_values[$symptom] * $bobotpakar[$symptom];
                }
            }
            // echo "Fungsi berjalan!";
            // var_dump($masses);
            return $this->M_hasil->input_datacf($masses);
        }

        public function combineMass($masses) {
            $num_masses = count($masses);
            $product = 1;
        
            // Mengalikan semua massa menjadi satu nilai produk
            foreach ($masses as $symptom => $mass) {
                $product *= $mass;
            }
        
            $denominator = 0;
        
            // Perulangan untuk menghitung penyebut (denominator)
            for ($i = 1; $i <= $num_masses; $i++) {
                // Mendapatkan semua kombinasi gejala dengan panjang $i
                $combinations = $this->getCombinations(array_keys($masses), $i);
        
                foreach ($combinations as $combination) {
                    $intersection = 1;
        
                    // Menghitung nilai intersecting mass
                    foreach ($combination as $symptom) {
                        $intersection *= $masses[$symptom];
                    }
        
                    // Menambahkan nilai intersecting mass ke penyebut
                    $denominator += $intersection;
                }
            }
        
            if ($denominator == 0) {
                return 0; // Menghindari pembagian dengan nol
            }
        
            // Mengembalikan hasil perhitungan Dempster-Shafer
            return $product / $denominator;
        }

        // Fungsi rekursif untuk mendapatkan semua kombinasi dari array dengan panjang tertentu
        private function getCombinations($arr, $len) {
            $comb = [];
            $count = count($arr);

            for ($i = 0; $i < $count; $i++) {
                $x = [$arr[$i]];
                if ($len === 1) {
                    $comb[] = $x;
                } else {
                    $next = array_slice($arr, $i + 1);
                    $subComb = $this->getCombinations($next, $len - 1);
                    foreach ($subComb as $sub) {
                        $comb[] = array_merge($x, $sub);
                    }
                }
            }

            return $comb;
        }

    }