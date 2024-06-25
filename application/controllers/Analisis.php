<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Analisis extends CI_Controller{
	function __construct(){
		parent::__construct();		
        $this->load->model('admin_model/M_analisis');
       // $this->load->model('admin_model/M_analisisuji');
        $this->load->model('admin_model/M_datauji');
        $this->load->model('admin_model/M_datalatih');
		$this->load->helper('url');
 
		//$this->load->model('admin_model/M_analisis');
	}


    public function index() {

        // Assuming you want to get CF values for a specific row
        $id_datalatih = 1; // Replace this with the actual ID you want to use
        $cf_values_row = $this->getCFValuesForRow($id_datalatih);

        $id_datauji = 1; // Replace this with the actual ID you want to use
        $cf_values_row_uji= $this->getCFValuesForRowUji($id_datauji);
    
        $symptoms = array('Bobot_batuk', 'Bobot_batukberdarah', 'Bobot_sesaknafas', 'Bobot_demam', 'Bobot_keringat', 'Bobot_nafsumakan', 'Bobot_beratbadan');
        $masses = $this->evaluateCF($symptoms, $cf_values_row);
        $result = $this->combineMass($masses);
        
        $masses_uji = $this->evaluateCFuji($symptoms, $cf_values_row_uji);
        $result_uji = $this->combineMass_uji($masses_uji);
       
       // Hitung hasil perhitungan
        $total_mass = $result; // Simulasikan perhitungan dengan menjumlahkan semua massa
        $hasil_perhitungan = $total_mass;
        

       $confusion_matrix = $this->hitungConfusionMatrix();
       $akurasi = $this->hitungAkurasi($confusion_matrix);

       $confusion_matrixuji = $this->hitungConfusionMatrixUji();
       $akurasiuji = $this->hitungAkurasiUji($confusion_matrixuji);
        $this->saveAnalisisData($result, $masses, $hasil_perhitungan);
        $this->saveAnalisisDataUji($result_uji, $masses_uji, $hasil_perhitungan);
        
        $data = array();
       // $data['cf_values'] = $cf_values;
        $data['cf_values_row'] = $cf_values_row; // Store specific row CF values
        $data['masses'] = $masses;
        $data['result'] = $result;
        //$data['confusion_matrix'] = $this->M_analisis->tampil_confusionmatrix()();
        
        
        $data['getLatestConfusionMatrix'] = $this->M_analisis->getLatestConfusionMatrix();
        $data['tampil_analisislatih'] = $this->M_analisis->tampil_analisislatih();
        $data['title'] = "Halaman Analisis";
        $data['isi'] = 'admin/analisis_hasil';
        $this->load->view('layout/all', $data);
    }

    public function tampil_datauji(){
        $data['getLatestConfusionMatrixUji'] = $this->M_analisis->getLatestConfusionMatrixUji();
        $data['tampil_analisisuji'] = $this->M_analisis->tampil_analisisuji();
        $data['title'] = "Halaman Analisis Uji";
        $data['isi'] = 'admin/analisis_uji';
        $this->load->view('layout/all', $data);
    }


    public function getCFValuesForRow($id_datalatih) {
        $cf = $this->M_analisis->getCFdataById($id_datalatih);
    
        $cf_values_row = array();
        if (!empty($cf) && isset($cf[0])) {
            $row = $cf[0];
            $cf_values_row['Bobot_batuk'] = $row->Bobot_batuk;
            $cf_values_row['Bobot_batukberdarah'] = $row->Bobot_batukberdarah;
            $cf_values_row['Bobot_sesaknafas'] = $row->Bobot_sesaknafas;
            $cf_values_row['Bobot_demam'] = $row->Bobot_demam;
            $cf_values_row['Bobot_keringat'] = $row->Bobot_keringat;
            $cf_values_row['Bobot_nafsumakan'] = $row->Bobot_nafsumakan;
            $cf_values_row['Bobot_beratbadan'] = $row->Bobot_beratbadan;
        }
    
        return $cf_values_row;
    }
    
    public function getCFValuesForRowUji($id_datauji) {
        $cf = $this->M_analisis->getCFdataByIdUji($id_datauji);
    
        $cf_values_row_uji = array();
        if (!empty($cf) && isset($cf[0])) {
            $row = $cf[0];
            $cf_values_row_uji['Bobot_batuk'] = $row->Bobot_batuk;
            $cf_values_row_uji['Bobot_batukberdarah'] = $row->Bobot_batukberdarah;
            $cf_values_row_uji['Bobot_sesaknafas'] = $row->Bobot_sesaknafas;
            $cf_values_row_uji['Bobot_demam'] = $row->Bobot_demam;
            $cf_values_row_uji['Bobot_keringat'] = $row->Bobot_keringat;
            $cf_values_row_uji['Bobot_nafsumakan'] = $row->Bobot_nafsumakan;
            $cf_values_row_uji['Bobot_beratbadan'] = $row->Bobot_beratbadan;
        }
    
        return $cf_values_row_uji;
    }

    public function evaluateCF($symptoms, $cf_values_row) {
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
            if (array_key_exists($symptom, $cf_values_row) && array_key_exists($symptom, $bobotpakar)) {
                //$masses[$symptom] = $cf_values_row[$symptom] * $bobotpakar[$symptom];
                $belief = $cf_values_row[$symptom] * $bobotpakar[$symptom];
                $theta = 1 - $belief;
                $masses[$symptom] = array('belief' => $belief, 'theta' => $theta);
                }
            }
        

    // Debugging: Tampilkan hasil evaluateCF
    //echo "Masses: " . var_export($masses, true) . "\n";
        return $masses;
    }

    public function evaluateCFuji($symptoms, $cf_values_row_uji) {
        $bobotpakar = array(
            "Bobot_batuk" => 1.0,
            "Bobot_batukberdarah" => 1.0,
            "Bobot_sesaknafas" => 0.8,
            "Bobot_demam" => 0.6,
            "Bobot_keringat" => 0.6,
            "Bobot_nafsumakan" => 0.4,
            "Bobot_beratbadan" => 0.4
        );

        $masses_uji = array();
        foreach ($symptoms as $symptom) {
            if (array_key_exists($symptom, $cf_values_row_uji) && array_key_exists($symptom, $bobotpakar)) {
                //$masses[$symptom] = $cf_values_row[$symptom] * $bobotpakar[$symptom];
                $belief = $cf_values_row_uji[$symptom] * $bobotpakar[$symptom];
                $theta = 1 - $belief;
                $masses_uji[$symptom] = array('belief' => $belief, 'theta' => $theta);
                }
            }
        

    // Debugging: Tampilkan hasil evaluateCF
    //echo "Masses: " . var_export($masses, true) . "\n";
        return $masses_uji;
    }

    public function combineMass($masses) {
        $num_masses = count($masses);
            $combined_belief = 0;
            $combined_theta = 1;
    
            if (!is_array($masses) || $num_masses == 0) {
                return array('belief' => 0, 'theta' => 0);
            }
        
            foreach ($masses as $mass) {
                // Pastikan setiap mass adalah array yang memiliki key 'belief' dan 'theta'
                if (!is_array($mass) || !isset($mass['belief']) || !isset($mass['theta'])) {
                    continue; // Lewati elemen yang tidak valid
                }
                $belief = $mass['belief'];
                $theta = $mass['theta'];
                  // Kombinasikan belief dan theta menggunakan rumus Dempster-Shafer
                $new_combined_belief = ($combined_belief * $belief) + ($combined_belief * $theta) + ($combined_theta * $belief);
                $new_combined_theta = $combined_theta * $theta;
    
                // Normalisasi
                $k = $new_combined_belief + $new_combined_theta;
                if ($k != 0) {
                    $new_combined_belief /= $k;
                    $new_combined_theta /= $k;
                    $combined_belief = $new_combined_belief;
                    $combined_theta = $new_combined_theta;
                }
            }
            //Debugging
            //echo "Combined Masses: " . var_export(array('belief' => $combined_belief, 'theta' => $combined_theta, 'k'=> $k),  true) . "\n";
            return array('belief' => $combined_belief, 'theta' => $combined_theta);
        }

        public function combineMass_uji($masses_uji) {
        $num_masses = count($masses_uji);
        $combined_beliefuji = 0;
        $combined_thetauji = 1;

        if (!is_array($masses_uji) || $num_masses == 0) {
            return array('belief' => 0, 'theta' => 0);
        }
    
        foreach ($masses_uji as $mass) {
            // Pastikan setiap mass adalah array yang memiliki key 'belief' dan 'theta'
            if (!is_array($mass) || !isset($mass['belief']) || !isset($mass['theta'])) {
                continue; // Lewati elemen yang tidak valid
            }
            $belief = $mass['belief'];
            $theta = $mass['theta'];
              // Kombinasikan belief dan theta menggunakan rumus Dempster-Shafer
            $new_combined_belief_uji = ($combined_beliefuji * $belief) + ($combined_beliefuji * $theta) + ($combined_thetauji * $belief);
            $new_combined_theta_uji = $combined_thetauji * $theta;

            // Normalisasi
            $k = $new_combined_belief_uji + $new_combined_theta_uji;
            if ($k != 0) {
                $new_combined_belief_uji /= $k;
                $new_combined_theta_uji /= $k;
                $combined_beliefuji = $new_combined_belief_uji;
                $combined_thetauji = $new_combined_theta_uji;
            }
        }
        //Debugging
        //echo "Combined Masses: " . var_export(array('belief' => $combined_belief, 'theta' => $combined_theta, 'k'=> $k),  true) . "\n";
        return array('belief' => $combined_beliefuji, 'theta' => $combined_thetauji);
            }
    


    public function predictLabel($combined_belief){
        $threshold = 0.8; 
        
        $prediksi = $combined_belief > $threshold ? 1 : 0;
        return $prediksi;
    }

    public function predictLabelUji($combined_beliefuji){
        $threshold = 0.8; 
        
        $prediksiuji = $combined_beliefuji > $threshold ? 1 : 0;
        return $prediksiuji;
    }
    
    public function hitungConfusionMatrix() {
        $all_ids = $this->M_datalatih->getDataforAnalisis();
    
    $confusion_matrix = array(
        'TP' => 0,
        'TN' => 0,
        'FP' => 0,
        'FN' => 0
    );
    
    foreach ($all_ids as $id) {
        $actual_label = $id['label'];  // Label sebenarnya dari data latih
        $cf_values_row = $this->getCFValuesForRow($id['id_datalatih']);
        $symptoms = array('Bobot_batuk', 'Bobot_batukberdarah', 'Bobot_sesaknafas', 'Bobot_demam', 'Bobot_keringat', 'Bobot_nafsumakan', 'Bobot_beratbadan');
        $masses = $this->evaluateCF($symptoms, $cf_values_row);
        $combined = $this->combineMass($masses);
        $result = $combined['belief'];
        
        // Prediksi label
        $combined_belief = $combined['belief'];
        $prediksi = $this->predictLabel($combined_belief);
        
        // Hitung confusion matrix
        if ($actual_label == 1 && $prediksi == 1) {
            $confusion_matrix['TP']++;
        } elseif ($actual_label == 0 && $prediksi == 0) {
            $confusion_matrix['TN']++;
        } elseif ($actual_label == 0 && $prediksi == 1) {
            $confusion_matrix['FP']++;
        } elseif ($actual_label == 1 && $prediksi == 0) {
            $confusion_matrix['FN']++;
        }
    }
    
    // Simpan confusion matrix ke database
    $this->saveConfusionMatrix($confusion_matrix);
    
    return $confusion_matrix;
    }

    public function hitungConfusionMatrixUji() {
        $all_ids = $this->M_datauji->getDataforAnalisisUji();
    
    $confusion_matrixuji = array(
        'TP' => 0,
        'TN' => 0,
        'FP' => 0,
        'FN' => 0
    );
    
    foreach ($all_ids as $id) {
        $actual_label = $id['label'];  // Label sebenarnya dari data latih
        $cf_values_row_uji = $this->getCFValuesForRowUji($id['id_datauji']);
        $symptoms = array('Bobot_batuk', 'Bobot_batukberdarah', 'Bobot_sesaknafas', 'Bobot_demam', 'Bobot_keringat', 'Bobot_nafsumakan', 'Bobot_beratbadan');
        $masses_uji = $this->evaluateCFuji($symptoms, $cf_values_row_uji);
        $combined_uji = $this->combineMass_uji($masses_uji);
        $result_uji = $combined_uji['belief'];
        
        // Prediksi label
        $combined_belief_uji = $combined_uji['belief'];
        $prediksiuji = $this->predictLabel($combined_belief_uji);
        
        // Hitung confusion matrix
        if ($actual_label == 1 && $prediksiuji == 1) {
            $confusion_matrixuji['TP']++;
        } elseif ($actual_label == 0 && $prediksiuji == 0) {
            $confusion_matrixuji['TN']++;
        } elseif ($actual_label == 0 && $prediksiuji == 1) {
            $confusion_matrixuji['FP']++;
        } elseif ($actual_label == 1 && $prediksiuji == 0) {
            $confusion_matrixuji['FN']++;
        }
    }
    
    // Simpan confusion matrix ke database
    $this->saveConfusionMatrixUji($confusion_matrixuji);
    
    return $confusion_matrixuji;
    }

    public function saveConfusionMatrix($confusion_matrix) {
        $accuracy= $this->hitungAkurasi($confusion_matrix);
        // Misalnya, simpan ke dalam tabel atau lakukan operasi penyimpanan yang sesuai
        $data = array(
            'TP' => $confusion_matrix['TP'],
            'TN' => $confusion_matrix['TN'],
            'FP' => $confusion_matrix['FP'],
            'FN' => $confusion_matrix['FN'],
            'Accuracy' => $accuracy['accuracy'],
            'Precission'=> $accuracy['precision'],
            'Recall'=> $accuracy['recall'],
            'F1_Score'=> $accuracy['f1_score']
            //'timestamp' => date('Y-m-d H:i:s') // Contoh, bisa saja memiliki timestamp atau informasi tambahan lainnya
        );
        
        // Simpan ke database dengan memanggil model yang sesuai
        $this->M_analisis->insertData_ConfusionMatrix($data); // Sesuaikan dengan model Anda
    }

    public function saveConfusionMatrixUji($confusion_matrixuji) {
        $accuracyuji= $this->hitungAkurasiUji($confusion_matrixuji);
        // Misalnya, simpan ke dalam tabel atau lakukan operasi penyimpanan yang sesuai
        $data = array(
            'TP' => $confusion_matrixuji['TP'],
            'TN' => $confusion_matrixuji['TN'],
            'FP' => $confusion_matrixuji['FP'],
            'FN' => $confusion_matrixuji['FN'],
            'Accuracy' => $accuracyuji['accuracy'],
            'Precission'=> $accuracyuji['precision'],
            'Recall'=> $accuracyuji['recall'],
            'F1_Score'=> $accuracyuji['f1_score']
            //'timestamp' => date('Y-m-d H:i:s') // Contoh, bisa saja memiliki timestamp atau informasi tambahan lainnya
        );
        
        // Simpan ke database dengan memanggil model yang sesuai
        $this->M_analisis->insertData_ConfusionMatrixUji($data); // Sesuaikan dengan model Anda
    }


    public function hitungAkurasi($confusion_matrix) {
        $TP = $confusion_matrix['TP'];
        $TN = $confusion_matrix['TN'];
        $FP = $confusion_matrix['FP'];
        $FN = $confusion_matrix['FN'];
    
        $accuracy = ($TP + $TN) / ($TP + $TN + $FP + $FN);
        $precision = $TP / ($TP + $FP);
        $recall = $TP / ($TP + $FN);
        $f1_score = 2 * ($precision * $recall) / ($precision + $recall);
        return array(
            'accuracy' => $accuracy,
            'precision' => $precision,
            'recall' => $recall,
            'f1_score' => $f1_score
        );
    }
    
    public function hitungAkurasiUji($confusion_matrixuji) {
        $TP_uji = $confusion_matrixuji['TP'];
        $TN_uji = $confusion_matrixuji['TN'];
        $FP_uji = $confusion_matrixuji['FP'];
        $FN_uji = $confusion_matrixuji['FN'];
    
        $accuracyuji = ($TP_uji + $TN_uji) / ($TP_uji + $TN_uji + $FP_uji + $FN_uji);
        $precisionuji = $TP_uji / ($TP_uji + $FP_uji);
        $recalluji = $TP_uji / ($TP_uji + $FN_uji);
        $f1_scoreuji = 2 * ($precisionuji * $recalluji) / ($precisionuji + $recalluji);
        return array(
            'accuracy' => $accuracyuji,
            'precision' => $precisionuji,
            'recall' => $recalluji,
            'f1_score' => $f1_scoreuji
        );
    }
    
    public function saveAnalisisData( $masses, $hasil_perhitungan, $result) {
        if (!is_array($masses)) {
            $masses = array($masses);
        }
        
        $all_ids = $this->M_datalatih->getDataforAnalisis();
        
        foreach ($all_ids as $id) {
            // Debugging: Tambahkan output untuk memeriksa nilai $id['id_datalatih']
           // echo "ID Datalatih: " . var_export($id['id_datalatih'], true) . "\n";
           
            $cf_values_row = $this->getCFValuesForRow($id['id_datalatih']);
            $symptoms = array('Bobot_batuk', 'Bobot_batukberdarah', 'Bobot_sesaknafas', 'Bobot_demam', 'Bobot_keringat', 'Bobot_nafsumakan', 'Bobot_beratbadan');
            $masses = $this->evaluateCF($symptoms, $cf_values_row);
            $combined = $this->combineMass($masses);
            $result = $combined['belief']; 
           
            // Prediksi label hanya sekali
            $combined_belief = $combined['belief'];
            $prediksi = $this->predictLabel($combined_belief);
    
            $data = array(
                'id_analisislatih' => $id['id_datalatih'],
                'Bobotlatih_batuk' => isset($cf_values_row['Bobot_batuk']) ? $cf_values_row['Bobot_batuk'] : 0,
                'Bobotlatih_batukberdarah' => isset($cf_values_row['Bobot_batukberdarah']) ? $cf_values_row['Bobot_batukberdarah'] : 0,
                'Bobotlatih_sesaknafas' => isset($cf_values_row['Bobot_sesaknafas']) ? $cf_values_row['Bobot_sesaknafas'] : 0,
                'Bobotlatih_demam' => isset($cf_values_row['Bobot_demam']) ? $cf_values_row['Bobot_demam'] : 0,
                'Bobotlatih_keringat' => isset($cf_values_row['Bobot_keringat']) ? $cf_values_row['Bobot_keringat'] : 0,
                'Bobotlatih_nafsumakan' => isset($cf_values_row['Bobot_nafsumakan']) ? $cf_values_row['Bobot_nafsumakan'] : 0,
                'Bobotlatih_beratbadan' => isset($cf_values_row['Bobot_beratbadan']) ? $cf_values_row['Bobot_beratbadan'] : 0,
                'Hasil_perhitungan' => $result,
                'label_latih' => isset($id['label']) ? $id['label'] : 0,
                'label_setelah' => $prediksi
            );
    
            // Cek apakah data dengan id_datalatih_fk sudah ada
            $existingData = $this->M_analisis->getAnalisisById($id['id_datalatih']); // Pastikan ID yang benar digunakan di sini
            if ($existingData) {
                // Jika sudah ada, perbarui data tersebut
                $this->M_analisis->updateData_datalatih($id['id_datalatih'], $data);
            } else {
                // Jika belum ada, masukkan data baru
                $this->M_analisis->input_analisislatih($data);
            }
            // Debugging: Tampilkan data yang akan disimpan
            //echo "Save Data: " . var_export($data, true) . "\n";

        }
        
    }

    public function saveAnalisisDataUji( $masses_uji, $hasil_perhitungan, $result_uji) {
        if (!is_array($masses_uji)) {
            $masses_uji = array($masses_uji);
        }
        
        $all_ids = $this->M_datauji->getDataforAnalisisUji();
        
        foreach ($all_ids as $id) {
            // Debugging: Tambahkan output untuk memeriksa nilai $id['id_datalatih']
           // echo "ID Datalatih: " . var_export($id['id_datalatih'], true) . "\n";
           
            $cf_values_row_uji = $this->getCFValuesForRowUji($id['id_datauji']);
            $symptoms = array('Bobot_batuk', 'Bobot_batukberdarah', 'Bobot_sesaknafas', 'Bobot_demam', 'Bobot_keringat', 'Bobot_nafsumakan', 'Bobot_beratbadan');
            $masses_uji = $this->evaluateCFuji($symptoms, $cf_values_row_uji);
            $combined_uji = $this->combineMass_uji($masses_uji);
            $result_uji = $combined_uji['belief']; 
           
            // Prediksi label hanya sekali
            $combined_beliefuji = $combined_uji['belief'];
            $prediksiuji = $this->predictLabel($combined_beliefuji);

              // Debugging
              log_message('debug', 'Saving analysis data for id_datauji: ' . $id['id_datauji'] . ' with result: ' . $result_uji);
    
            $data_uji = array(
                'id_analisisuji' => $id['id_datauji'],
                'Bobotuji_batuk' => isset($cf_values_row_uji['Bobot_batuk']) ? $cf_values_row_uji['Bobot_batuk'] : 0,
                'Bobotuji_batukberdarah' => isset($cf_values_row_uji['Bobot_batukberdarah']) ? $cf_values_row_uji['Bobot_batukberdarah'] : 0,
                'Bobotuji_sesaknafas' => isset($cf_values_row_uji['Bobot_sesaknafas']) ? $cf_values_row_uji['Bobot_sesaknafas'] : 0,
                'Bobotuji_demam' => isset($cf_values_row_uji['Bobot_demam']) ? $cf_values_row_uji['Bobot_demam'] : 0,
                'Bobotuji_keringat' => isset($cf_values_row_uji['Bobot_keringat']) ? $cf_values_row_uji['Bobot_keringat'] : 0,
                'Bobotuji_nafsumakan' => isset($cf_values_row_uji['Bobot_nafsumakan']) ? $cf_values_row_uji['Bobot_nafsumakan'] : 0,
                'Bobotuji_beratbadan' => isset($cf_values_row_uji['Bobot_beratbadan']) ? $cf_values_row_uji['Bobot_beratbadan'] : 0,
                'Hasil_perhitunganuji' => $result_uji,
                'label_uji' => isset($id['label']) ? $id['label'] : 0,
                'labeluji_setelah' => $prediksiuji
            );
    
            // Cek apakah data dengan id_datalatih_fk sudah ada
            $existingData = $this->M_analisis->getAnalisisByIdUji($id['id_datauji']); // Pastikan ID yang benar digunakan di sini
            if ($existingData) {
                // Jika sudah ada, perbarui data tersebut
                $this->M_analisis->updateData_datauji($id['id_datauji'], $data_uji);
            } else {
                // Jika belum ada, masukkan data baru
                $this->M_analisis->input_analisisuji($data_uji);
            }
            // Debugging: Tampilkan data yang akan disimpan
            echo "Save Data: " . var_export($data_uji, true) . "\n";

        }
        
    }

    
}