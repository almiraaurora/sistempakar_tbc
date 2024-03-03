<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_hasil extends CI_Model {

    public function getCFData() {
        
        $this->db->select('Bobot_batuk, Bobot_batukberdarah, Bobot_sesaknafas, Bobot_demam, Bobot_keringat, Bobot_nafsumakan, Bobot_beratbadan');
        $this->db->from('tabel_bobot');
        $query = $this->db->get();
        $results = $query->result();

        $data = array(); // Inisialisasi array untuk menyimpan data

        foreach ($results as $row) {
            $data['Bobot_batuk'] = ($row->Bobot_batuk <= 1.0 && $row->Bobot_batuk > 0) ? $row->Bobot_batuk * 1.0 : null;
            $data['Bobot_batukberdarah'] = ($row->Bobot_batukberdarah <= 1.0 && $row->Bobot_batukberdarah > 0) ? $row->Bobot_batukberdarah * 1.0 : null;
            $data['Bobot_sesaknafas'] = ($row->Bobot_sesaknafas <= 1.0 && $row->Bobot_sesaknafas > 0) ? $row->Bobot_sesaknafas * 0.8 : null;
            $data['Bobot_demam'] = ($row->Bobot_demam <= 1.0 && $row->Bobot_demam > 0) ? $row->Bobot_demam * 0.6 : null;
            $data['Bobot_keringat'] = ($row->Bobot_keringat <= 1.0 && $row->Bobot_keringat > 0) ? $row->Bobot_keringat * 0.6 : null;
            $data['Bobot_nafsumakan'] = ($row->Bobot_nafsumakan <= 1.0 && $row->Bobot_nafsumakan > 0) ? $row->Bobot_nafsumakan * 0.4 : null;
            $data['Bobot_beratbadan'] = ($row->Bobot_beratbadan <= 1.0 && $row->Bobot_beratbadan > 0) ? $row->Bobot_beratbadan * 0.4 : null;
            // Penugasan serupa untuk nilai lainnya...
        }
        return $data;
    }

    public function combineMass($data) {
        $num_masses = count($data);
        $product = 1;
    
        // Mengalikan semua massa menjadi satu nilai produk
        foreach ($data as $symptom => $mass) {
            $product *= $mass;
        }
    
        $denominator = 0;
    
        // Perulangan untuk menghitung penyebut (denominator)
        for ($i = 1; $i <= $num_masses; $i++) {
            // Mendapatkan semua kombinasi gejala dengan panjang $i
            $combinations = $this->getCombinations(array_keys($data), $i);
    
            foreach ($combinations as $combination) {
                $intersection = 1;
    
                // Menghitung nilai intersecting mass
                foreach ($combination as $symptom) {
                    $intersection *= $data[$symptom];
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

    function input_datacf($cf,$table){
		$this->db->insert($table,$cf);
	}

    public function getDSData() {
        // Fungsi untuk mengambil massa Dempster-Shafer (DS) dari database
        // Misalnya, mengambil data massa DS dari tabel DS
        $this->db->select('cf');
        $this->db->from('tabel_hasil2');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_max_id_userakhir() {
		$query = $this->db->query('SELECT MAX(id_user) as max_id_user FROM tabel_user');
		$row = $query->row();
		return $row->max_id_user;
	}

   
    
}
