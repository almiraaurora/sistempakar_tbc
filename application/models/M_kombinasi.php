<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kombinasi extends CI_Model {

    public $rules=[
        [
            "gejala"=>["batuk"],
            "diagnosis"=> "TBC Paru",
            "cf"=> 1.0
        ],
        [
            "gejala"=>["batukberdarah"],
            "diagnosis"=> "TBC Paru",
            "cf"=> 0.8
        ],
        [
            "gejala"=>["sesaknafas","keringat"],
            "diagnosis"=> "TBC Paru",
            "cf"=> 0.6
        ],
        [
            "gejala"=>["demam","nafsumakan","beratbadan"],
            "diagnosis"=> "TBC Paru",
            "cf"=> 0.4
        ],
    ];

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
            // if (array_key_exists($symptom, $cf_values) && array_key_exists($symptom, $expertWeights)) {
            //     // Kalikan nilai CF dengan bobot pakar
            //     return $cf_values[$symptom] * $expertWeights[$symptom];
            // } else {
            //     return null;
            // }

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

            // public function combineMass($masses) {
            //     $num_masses = count($masses);
            //     $product = 1;
            
            //     foreach ($masses as $symptom => $mass) {
            //         $product *= $mass;
            //     }
            
            //     $denominator = 1;
            //     for ($i = 1; $i < $num_masses; $i++) {
            //         $denominator += $this->getCombination($product, $i);
            //     }
            
            //     if ($denominator == 0) {
            //         return 0; // Hindari pembagian dengan nol
            //     }
            
            //     return $product / $denominator;
            // }
            
            // private function getCombination($n, $r) {
            //     $numerator = 1;
            //     for ($i = $n; $i > $n - $r; $i--) {
            //         $numerator *= $i;
            //     }
            
            //     $denominator = 1;
            //     for ($i = $r; $i > 0; $i--) {
            //         $denominator *= $i;
            //     }
            
            //     return $numerator / $denominator;
                
            // }

            public function getAllData() {
                $query = $this->db->get('tabel_hasil'); // Ganti 'nama_tabel' dengan nama tabel yang sesuai
                return $query->result(); // Mengembalikan hasil query
            }

            function input_dataakhir($data,$table){
                $this->db->insert($table,$data);
            }

            public function get_max_id_userakhir() {
                $query = $this->db->query('SELECT MAX(id_user) as max_id_user FROM tabel_user');
                $row = $query->row();
                return $row->max_id_user;
            }

            
            
            
        }

 