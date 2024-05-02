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
        // $cf_values = $this->cache->get('cf_values');
        // if (!$cf_values) {
        //     $cf_values = $this->getCFValues();
        //     $this->cache->save('cf_values', $cf_values, 60); // Cache for 60 seconds
        // }

        $cf_values = $this->getCFValues();

        $symptoms = array('Bobot_batuk', 'Bobot_batukberdarah', 'Bobot_sesaknafas', 'Bobot_demam', 'Bobot_keringat', 'Bobot_nafsumakan', 'Bobot_beratbadan');
        $masses = $this->evaluateCF($symptoms, $cf_values);
        $combined_mass = $this->combineMass($masses);

        $data['cf_values'] = $cf_values;
        $data['masses'] = $masses;
        $data['combined_mass'] = $combined_mass;
        $data['tampil_analisislatih'] = $this->M_analisis->tampil_analisislatih();
        $data['title'] = "Halaman Analisis";
        $data['isi'] = 'admin/analisis_hasil';
        $this->load->view('layout/all', $data);
    }

    public function pindahData() {
        // Ambil data dari tabel A
        $dataTabeldatalatih = $this->M_datalatih->tampil_datalatih();

        // Masukkan data ke dalam tabel B
        foreach ($dataTabeldatalatih as $data) {
            $this->M_analisis->insertData_datalatih($data);
        }

        echo "Data berhasil dipindahkan dari tabel A ke tabel B.";
    }

    public function id_lanjutananalisis() {
        $id_analisislatih = $this->M_analisis->get_max_id_analisis();
        $hasil_perhitungan = $this->input->post('hasil_perhitungan');
        $data = array(
            'id_analisislatih' => $id_analisislatih,
            'label' => $label
        );
        $this->M_analisis->input_analisislatih($data, 'tabel_analisislatih');
    }

    public function getCFValues() {
        $cf = $this->M_analisis->getCFdata();

        $cf_values = array();
        foreach ($cf as $row) {
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
            "batuk" => 1.0,
            "batukberdarah" => 0.8,
            "sesaknafas" => 0.6,
            "demam" => 0.4,
            "keringat" => 0.6,
            "nafsumakan" => 0.4,
            "beratbadan" => 0.4
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

        $getCombinations = function ($arr, $len) use (&$getCombinations, &$product, &$denominator) {
            $count = count($arr);

            for ($i = 0; $i < $count; $i++) {
                $x = [$arr[$i]];
                if ($len === 1) {
                    $intersection = $masses[$arr[$i]];
                    $product *= $intersection;
                    $denominator += $intersection;
                } else {
                    $next = array_slice($arr, $i + 1);
                    $subComb = $getCombinations($next, $len - 1);
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

        return $product / $denominator;
    }
}