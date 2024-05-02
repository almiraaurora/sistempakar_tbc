<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_hasil extends CI_Model {

    function tampil_hasil(){
      return $this->db->get('tabel_hasil3');
    } 
    function input_datacf($data,$table){
		$this->db->insert($table,$data);
	}

    function getCFdata(){
      $this->db->select('Bobot_batuk, Bobot_batukberdarah, Bobot_sesaknafas, Bobot_demam, Bobot_keringat, Bobot_nafsumakan, Bobot_beratbadan');
      $query = $this->db->get('tabel_bobot');
      return $query->result(); // Mengembalikan hasil query
    }

    public function get_max_id_userakhir() {
		$query = $this->db->query('SELECT MAX(id_user) as max_id_user FROM tabel_user');
		$row = $query->row();
		return $row->max_id_user;
	}

   
    
}
