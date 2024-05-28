<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_analisis extends CI_Model{
    public function tampil_analisislatih(){
        return $this->db->get('tabel_analisislatih')->result();
    }
    function input_analisislatih($data){
		$this->db->insert('tabel_analisislatih',$data);
    }

    public function getAnalisisById($id) {
      $this->db->where('id_analisislatih', $id);
      $query = $this->db->get('tabel_analisislatih');
      return $query->row_array();
    }

    public function updateData_datalatih($id, $data) {
      $this->db->where('id_analisislatih', $id);
      $this->db->set($data);
      $this->db->update('tabel_analisislatih', $data);
   }

    public function insertData_datalatih($data) {
    $this->db->insert('tabel_analisislatih', $data);
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