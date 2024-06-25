<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_analisis extends CI_Model{
    public function tampil_analisislatih(){
        return $this->db->get('tabel_analisislatih')->result();
    }

    public function tampil_analisisuji(){
      return $this->db->get('tabel_analisisuji')->result();
  }
    function input_analisislatih($data){
		$this->db->insert('tabel_analisislatih',$data);
    }

    function input_analisisuji($data_uji){
      $this->db->insert('tabel_analisisuji',$data_uji);
      }

    public function getAnalisisById($id) {
      $this->db->where('id_analisislatih', $id);
      $query = $this->db->get('tabel_analisislatih');
      return $query->row_array();
    }

    public function getAnalisisByIdUji($id) {
      $this->db->where('id_analisisuji', $id);
      $query = $this->db->get('tabel_analisisuji');
      return $query->row_array();
    }

    public function getCFdataById($id_datalatih) {
      $this->db->where('id_datalatih', $id_datalatih);
      $query = $this->db->get('tabel_datalatih'); // Sesuaikan dengan nama tabel yang sesuai
  
      if ($query->num_rows() > 0) {
          return $query->result(); // Mengembalikan hasil sebagai array objek
      } else {
          return array(); // Mengembalikan array kosong jika tidak ada hasil
      }
    }

    public function getCFdataByIdUji($id_datauji) {
      $this->db->where('id_datauji', $id_datauji);
      $query = $this->db->get('tabel_datauji'); // Sesuaikan dengan nama tabel yang sesuai
  
      if ($query->num_rows() > 0) {
          return $query->result(); // Mengembalikan hasil sebagai array objek
      } else {
          return array(); // Mengembalikan array kosong jika tidak ada hasil
      }
    }

    public function updateData_datalatih($id, $data) {
      $this->db->where('id_analisislatih', $id);
      // $this->db->set($data);
      $this->db->update('tabel_analisislatih', $data);
   }

   public function updateData_datauji($id, $data) {
    $this->db->where('id_analisisuji', $id);
    // $this->db->set($data);
    $this->db->update('tabel_analisisuji', $data);
 }

    public function insertData_ConfusionMatrix($data) {
    $this->db->insert('tabel_cmlatih', $data);
   }

   public function insertData_ConfusionMatrixUji($data) {
    $this->db->insert('tabel_cmuji', $data);
   }

   public function getLatestConfusionMatrix() {
    $this->db->order_by('id_CMlatih', 'DESC'); // Sesuaikan dengan primary key tabel Anda
    $query = $this->db->get('tabel_cmlatih', 1); // Ambil satu data terbaru
    return $query->row_array();
  }

  public function getLatestConfusionMatrixUji() {
    $this->db->order_by('id_CMuji', 'DESC'); // Sesuaikan dengan primary key tabel Anda
    $query = $this->db->get('tabel_cmuji', 1); // Ambil satu data terbaru
    return $query->row_array();
}

    public function get_max_id_analisis() {
      //$query = $this->db->query('SELECT MAX(id_datalatih) as max_id_analisis FROM tabel_datalatih');
      $this->db->select_max('id_datalatih');
      $query = $this->db->get('tabel_datalatih');
      $row = $query->row();
      return $row->max_id_analisis;
    }

    function getCFdata(){
      $this->db->select('Bobot_batuk, Bobot_batukberdarah, Bobot_sesaknafas, Bobot_demam, Bobot_keringat, Bobot_nafsumakan, Bobot_beratbadan');
      $query = $this->db->get('tabel_datalatih');
      return $query->result(); // Mengembalikan hasil query
    }

    function getDataLatih(){
      $this->db->select('Bobot_batuk, Bobot_batukberdarah, Bobot_sesaknafas, Bobot_demam, Bobot_keringat, Bobot_nafsumakan, Bobot_beratbadan','label');
      $query = $this->db->get('tabel_datalatih');
    }


}