<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Combination extends CI_Controller {
    function __construct(){
		parent::__construct();		
		$this->load->model('M_gejala');
		$this->load->model('M_kombinasi');
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

	public function getCFValues() {
        // Di sini Anda perlu mengambil nilai-nilai Certainty Factor dari database
        // Misalnya, dengan menggunakan query ke tabel database yang menyimpan nilai CF
    
        // Contoh pengambilan nilai CF dari database
            $this->db->select('Bobot_batuk, Bobot_batukberdarah, Bobot_sesaknafas, Bobot_demam, Bobot_keringat, Bobot_nafsumakan, Bobot_beratbadan');
            $query = $this->db->get('tabel_bobot');
            
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
                // Pastikan ada kaitan antara nama kolom dan nama gejala yang diambil dari tabel
                // Jika nama kolom dan gejala tidak sesuai, disesuaikan di sini
            }
            
            return $cf_values;
        }

        public function evaluateCF($symptom) {
            $cf_values = $this->getCFValues(); // Ambil nilai CF dari database
        
            $expertWeights = array(
                "batuk" => 1.0, // Bobot pakar untuk demam tinggi
                "batukberdarah" => 0.8, // Bobot pakar untuk batuk
                "sesaknafas" => 0.6,
                "demam" => 0.4,
                "keringat" => 0.6,
                "nafsumakan" => 0.4,
                "beratbadan" => 0.4
                // Tambahkan bobot pakar untuk gejala lainnya di sini
            );
                return $symtomps;
        
                $masses = array();
                foreach ($symptoms as $symptom) {
                    if (array_key_exists($symptom, $cf_values) && array_key_exists($symptom, $expertWeights)) {
                        // Evaluasi CF untuk setiap gejala dan kalikan dengan bobot pakar
                        $masses[$symptom] = $cf_values[$symptom] * $expertWeights[$symptom];
                    }
                }
                // echo "Fungsi berjalan!";
                // var_dump($masses);
                return $masses;
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