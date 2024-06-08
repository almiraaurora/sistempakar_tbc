<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Analisis extends CI_Controller{
	function __construct(){
		parent::__construct();		
        $this->load->model('admin_model/M_analisis');
        $this->load->model('admin_model/M_datalatih');
		$this->load->helper('url');
 
		//$this->load->model('admin_model/M_analisis');
	}


    public function index() {

        $cf_values = $this->getCFValues();
        $symptoms = array('Bobot_batuk', 'Bobot_batukberdarah', 'Bobot_sesaknafas', 'Bobot_demam', 'Bobot_keringat', 'Bobot_nafsumakan', 'Bobot_beratbadan');
        $masses = $this->evaluateCF($symptoms, $cf_values);
        $combined_mass = $this->combineMass($masses);
        $insertdata = $this-> pindahData();
        
        $data = array();
        $data['cf_values'] = $cf_values;
        $data['masses'] = $masses;
        $data['combined_mass'] = $combined_mass;
        $data['insertdata'] = $insertdata;

        // Hitung hasil perhitungan
        $total_mass = $combined_mass; // Simulasikan perhitungan dengan menjumlahkan semua massa
        $hasil_perhitungan = $total_mass;

        $this->saveAnalisisData($masses, $total_mass, $insertdata);

        
        $data['tampil_analisislatih'] = $this->M_analisis->tampil_analisislatih();
        $data['title'] = "Halaman Analisis";
        $data['isi'] = 'admin/analisis_hasil';
        $this->load->view('layout/all', $data);
    }


    public function id_lanjutananalisis() {
         // Lakukan sesuatu dengan nilai maksimum yang didapatkan (misalnya, tampilkan di view)
         $id_analisislatih = $this->M_analisis->get_max_id_analisis();
         $data['max_id'] = $max_id;
         $this->M_analisis->input_analisislatih($data, 'tabel_analisislatih');
         //$this->load->view('admin/analisis_hasil', $data); // Ganti 'view_name' dengan nama view Anda
    }

    public function getCFValues() {
        $cf = $this->M_analisis->getCFdata();

        $cf_values2 = array();
        foreach ($cf as $row) {
            $cf_values2['Bobot_batuk'] = $row->Bobot_batuk;
            $cf_values2['Bobot_batukberdarah'] = $row->Bobot_batukberdarah;
            $cf_values2['Bobot_sesaknafas'] = $row->Bobot_sesaknafas;
            $cf_values2['Bobot_demam'] = $row->Bobot_demam;
            $cf_values2['Bobot_keringat'] = $row->Bobot_keringat;
            $cf_values2['Bobot_nafsumakan'] = $row->Bobot_nafsumakan;
            $cf_values2['Bobot_beratbadan'] = $row->Bobot_beratbadan;
        }

        return $cf_values2;
    }

    public function getCFValuesForRow($id_datalatih) {
        $cf = $this->M_analisis->getCFdataById($id_datalatih);
    
        $cf_values = array();
        if (!empty($cf) && isset($cf[0])) {
            $row = $cf[0];
            $cf_values['Bobot_batuk'] = $row->Bobot_batuk;
            $cf_values['Bobot_batukberdarah'] = $row->Bobot_batukberdarah;
            $cf_values['Bobot_sesaknafas'] = $row->Bobot_sesaknafas;
            $cf_values['Bobot_demam'] = $row->Bobot_demam;
            $cf_values['Bobot_keringat'] = $row->Bobot_keringat;
            $cf_values['Bobot_nafsumakan'] = $row->Bobot_nafsumakan;
            $cf_values['Bobot_beratbadan'] = $row->Bobot_beratbadan;
        }
    
        return $cf_values;
    }
    

    public function evaluateCF($symptoms, $cf_values) {
        $bobotpakar = array(
            "Bobot_batuk" => 1.0,
            "Bobot_batukberdarah" => 1.0,
            "Bobot_sesaknafas" => 0.8,
            "Bobot_demam" => 0.6,
            "Bobot_keringat" => 0.6,
            "Bobot_nafsumakan" => 0.4,
            "Bobot_beratbadan" => 0.4
        );

        $masses = array();
        foreach ($symptoms as $symptom) {
            if (array_key_exists($symptom, $cf_values) && array_key_exists($symptom, $bobotpakar)) {
                $masses[$symptom] = $cf_values[$symptom] * $bobotpakar[$symptom];
            }
        }

        return $masses;
    }

    public function combineMass($masses) {
        $num_masses = count($masses);
        $product = 1;
        $denominator = 0;

        foreach ($masses as $mass) {
            $product *= $mass;
        }

        $getCombinations = function ($arr, $len) use ($masses, &$getCombinations, &$product, &$denominator) {
            $count = count($arr);

            if ($count === 0) {
                return array(); // Mengembalikan array kosong jika tidak ada elemen yang tersisa
            }

            for ($i = 0; $i < $count; $i++) {
                $x = [$arr[$i]];
                if ($len === 1) {
                    $intersection = $masses[$arr[$i]];
                    $product *= $intersection;
                    $denominator += $intersection;
                } else {
                    $next = array_slice($arr, $i + 1);
                    $subComb = $getCombinations($next, $len - 1);

                    // Periksa apakah $subComb adalah array
                    if (!is_array($subComb)) {
                        $subComb = array();
                    }
                    foreach ($subComb as $sub) {
                        $intersection = 1;

                        foreach ($sub as $symptom) {
                            $intersection *= $masses[$symptom];
                        }

                        $intersection *= $masses[$arr[$i]];
                        $product *= $intersection;
                        $denominator += $intersection;
                    }
                }
            }
        };

        for ($i = 1; $i <= $num_masses; $i++) {
            $getCombinations(array_keys($masses), $i);
        }

        if ($denominator == 0) {
            return 0;
        }
        
        $hasil_perhitungan = $product / $denominator;
        return $hasil_perhitungan;
    }
    
    public function hitungAkurasi($data) {
        $TP = 0;
        $TN = 0;
        $FP = 0;
        $FN = 0;
    
        foreach ($data as $item) {
            $actual_label = $item['label_latih'];  // Label sebenarnya
            $predicted_label = $this->predictLabel($item['Hasil_perhitungan']);  // Pastikan mengirim hasil_perhitungan
    
            if ($actual_label == 1 && $predicted_label == 1) {
                $TP++;
            } elseif ($actual_label == 0 && $predicted_label == 0) {
                $TN++;
            } elseif ($actual_label == 0 && $predicted_label == 1) {
                $FP++;
            } elseif ($actual_label == 1 && $predicted_label == 0) {
                $FN++;
            }
        }
    
        // Hitung akurasi
        $accuracy = ($TP + $TN) / ($TP + $TN + $FP + $FN);
        return $accuracy;
    }
    
    private function predictLabel($hasil_perhitungan) {
        $threshold = 0.5; 
        return $hasil_perhitungan > $threshold ? 1 : 0;
    }
    

    public function pindahData() {
        // Ambil data dari tabel datalatih
        $dataTabelDatalatih = $this->M_datalatih->getDataforAnalisis();

        // Iterasi melalui setiap data dan masukkan ke tabel analisislatih
        foreach ($dataTabelDatalatih as $data) {
           
            // Siapkan data yang akan dimasukkan ke tabel analisislatih
            $insertData = array(
            'id_analisislatih'=> $data['id_datalatih'],
            'Bobotlatih_batuk' => $data['Bobot_batuk'],
            'Bobotlatih_batukberdarah' => $data['Bobot_batukberdarah'],
            'Bobotlatih_sesaknafas' => $data['Bobot_sesaknafas'],
            'Bobotlatih_demam' => $data['Bobot_demam'],
            'Bobotlatih_keringat' => $data['Bobot_keringat'],
            'Bobotlatih_nafsumakan' => $data['Bobot_nafsumakan'],
            'Bobotlatih_beratbadan' => $data['Bobot_beratbadan'],
            'label_latih' => $data['label'], // Sesuaikan dengan nama kolom di tabel datalatih
            // 'label_setelah' => $predicted_label,
            // 'Hasil_perhitungan' => $combined_mass
            );
        
                // Debugging: Tampilkan data yang akan dimasukkan
        // echo "Insert Data: " . var_export($insertData, true) . "\n";

             // Cek apakah data dengan id_analisislatih sudah ada
             $existingData = $this->M_analisis->getAnalisisById($data['id_datalatih']);
             if ($existingData) {
                 // Jika sudah ada, perbarui data tersebut
                 $this->M_analisis->updateData_datalatih($data['id_datalatih'], $insertData);
             } else {
                 // Jika belum ada, masukkan data baru
                 $this->M_analisis->insertData_datalatih($insertData);
             }

            // Panggil metode model untuk menyimpan data ke tabel analisislatih
            //$this->M_analisis->insertData_datalatih($insertData);
        }


        echo "Data berhasil dipindahkan dari tabel datalatih ke tabel analisislatih.";
    }



    public function saveAnalisisData($masses, $hasil_perhitungan) {
        
        if (!is_array($masses)) {
            $masses = array($masses);
        }
    
        // // Hitung total massa
        // $total_mass = array_sum($combined_mass);
        $max_id = $this->M_datalatih->get_max_id();
        $all_ids = $this->M_datalatih->getDataforAnalisis();
        // Persiapkan data yang akan disimpan ke dalam tabel database
        foreach ($all_ids as $id) {
             // Cek apakah data memiliki nilai id_datalatih yang valid

        // if (!isset($data['id_datalatih']) || $data['id_datalatih'] == 0) {
        //     echo "Invalid id_datalatih: " . var_export($data, true);
        //     continue; // Lewati data ini jika id_datalatih tidak valid
        
   
          // Ambil nilai CF untuk baris data ini
        $cf_values = $this->getCFValuesForRow($id['id_datalatih']);
        
        // Definisikan gejala
        $symptoms = array('Bobot_batuk', 'Bobot_batukberdarah', 'Bobot_sesaknafas', 'Bobot_demam', 'Bobot_keringat', 'Bobot_nafsumakan', 'Bobot_beratbadan');
        
        // Hitung massa untuk gejala tersebut
        $masses = $this->evaluateCF($symptoms, $cf_values);

        $predicted_label = $this->predictLabel($hasil_perhitungan);
        
        // Gabungkan massa
        $combined_mass = $this->combineMass($masses);
        $predicted_label = $this->predictLabel($hasil_perhitungan);
        $data = array(
            //'id_analisislatih' => $max_id + 1,
            'id_analisislatih' => $id['id_datalatih'],
            'Bobotlatih_batuk' => isset($masses['Bobot_batuk']) ? $masses['Bobot_batuk'] : 0,
            'Bobotlatih_batukberdarah' => isset($masses['Bobot_batukberdarah']) ? $masses['Bobot_batukberdarah'] : 0,
            'Bobotlatih_sesaknafas' => isset($masses['Bobot_sesaknafas']) ? $masses['Bobot_sesaknafas'] : 0,
            'Bobotlatih_demam' => isset($masses['Bobot_demam']) ? $masses['Bobot_demam'] : 0,
            'Bobotlatih_keringat' => isset($masses['Bobot_keringat']) ? $masses['Bobot_keringat'] : 0,
            'Bobotlatih_nafsumakan' => isset($masses['Bobot_nafsumakan']) ? $masses['Bobot_nafsumakan'] : 0,
            'Bobotlatih_beratbadan' => isset($masses['Bobot_beratbadan']) ? $masses['Bobot_beratbadan'] : 0,
            'label_latih' => isset($id['label']) ? $id['label'] : 0,
            'label_setelah' => $predicted_label,
            'Hasil_perhitungan' => $hasil_perhitungan
        );
        //}

        
        // Debugging: Tampilkan data yang akan disimpan
        //echo "Save Data: " . var_export($data, true) . "\n";
        
         // Cek apakah data dengan id_analisislatih sudah ada
         $existingData = $this->M_analisis->getAnalisisById($id['id_datalatih']);
         if ($existingData) {
             // Jika sudah ada, perbarui data tersebut
             $this->M_analisis->updateData_datalatih($id['id_datalatih'], $data);
         } else {
             // Jika belum ada, masukkan data baru
             $this->M_analisis->input_analisislatih($data);
         }
        // Panggil metode model untuk menyimpan data ke dalam tabel database
        //$this->M_analisis->input_analisislatih($data);
    }
}
}