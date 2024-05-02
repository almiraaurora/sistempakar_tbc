<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_analisis extends CI_Model{
    public function tampil_analisislatih(){
        return $this->db->get('tabel_analisislatih')->result();
    }
    function input_analisislatih($data,$table){
		$this->db->insert($table,$data);
    }

    public function insertData_datalatih($data) {
      return $this->db->insert('tabel_analisislatih', $data);
  }

    public function get_max_id_analisis() {
      $query = $this->db->query('SELECT MAX(id_datalatih) as max_id_analisis FROM tabel_datalatih');
      $row = $query->row();
      return $row->max_id_analisis;
    }

    function getCFdata(){
      $this->db->select('Bobot_batuk, Bobot_batukberdarah, Bobot_sesaknafas, Bobot_demam, Bobot_keringat, Bobot_nafsumakan, Bobot_beratbadan');
      $query = $this->db->get('tabel_bobot');
      return $query->result(); // Mengembalikan hasil query
    }


}