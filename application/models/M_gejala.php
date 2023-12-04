<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_gejala extends CI_Model{
    function tampil_data(){
		return $this->db->get('tabel_bobot');
	}
    function input_data($data,$table){
		$this->db->insert($table,$data);
	}
	public function get_max_id_user() {
		$query = $this->db->query('SELECT MAX(id_user) as max_id_user FROM tabel_user');
		$row = $query->row();
		return $row->max_id_user;
	}
	
}