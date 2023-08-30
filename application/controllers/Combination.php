<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Combination extends CI_Controller {
    public function index() {
    //     $gejala = $this->input->post('gejala'); // Ambil inputan gejala dari form

    //     // Mendapatkan data Certainty Factor (CF) dari database berdasarkan gejala
    //     $cfData = $this->M_gejala->getCFData($gejala);

    //     // Mendapatkan data Dempster-Shafer (DS) dari database berdasarkan gejala
    //     $dsData = $this->M_gejala->getDSData($gejala);

    //     // Menggabungkan himpunan dengan Certainty Factor (CF)
    //     $combinedCF = $this->combineSets($cfData, $cfData);
    //     echo "Combined CF:<br>";
    //     print_r($combinedCF);
    //     echo "<br>";

    //     // Menggabungkan massa dengan Dempster-Shafer (DS)
    //     $dsFactor = 0.7; // Faktor kecenderungan ke Dempster-Shafer (DS)
    //     $combinedMass = $this->combineMassWithDS($combinedCF, $dsData, $dsFactor);
    //     echo "Combined Mass with DS bias:<br>";
    //     print_r($combinedMass);
    //     echo "<br>";

    //     // Normalisasi massa hasil gabungan
    //     $normalizedCombinedMass = $this->normalizeMass($combinedMass);
    //     echo "Normalized Combined Mass:<br>";
    //     print_r($normalizedCombinedMass);
    //     echo "<br>";

    // }

    // // Fungsi untuk menghitung CF
    // private function calculateCF($value) {
    //     if ($value >= 0) {
    //         return $value;
    //     } else {
    //         return 0;
    //     }
    // }

    // // Fungsi untuk menggabungkan himpunan key dan value
    // private function combineSets($set1, $set2) {
    //     $result = array();
    //     foreach ($set1 as $key1 => $value1) {
    //         foreach ($set2 as $key2 => $value2) {
    //             // Menghitung CF baru dengan rumus kombinasi CF
    //             $newCF = $this->calculateCF($value1 * $value2);
    //             // Menggabungkan himpunan dengan menggunakan operator or
    //             $result[$key1 . $key2] = max($result[$key1 . $key2] ?? 0, $newCF);
    //         }
    //     }
    //     return $result;
    // }

    // // Fungsi untuk menggabungkan massa dengan kecenderungan ke Dempster-Shafer (DS)
    // private function combineMassWithDS($mass1, $mass2, $dsFactor) {
    //     $result = array();
    //     foreach ($mass1 as $key1 => $value1) {
    //         foreach ($mass2 as $key2 => $value2) {
    //             // Menggabungkan massa dengan menggunakan operator or
    //             $result[$key1 . $key2] = (1 - $dsFactor) * $value1 + $dsFactor * $value2;
    //         }
    //     }
    //     return $result;
    }

    
}
