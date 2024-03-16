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

 