<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model{
    function tampil_data(){
		return $this->db->get('tabel_user');
	}
    function input_data($data,$table){
		$this->db->insert($table,$data);
	}
}