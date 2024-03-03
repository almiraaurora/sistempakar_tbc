<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_datalatih extends CI_Model{
    public function tampil_datalatih(){
        return $this->db->get('tabel_datalatih')->result();
    }
    function input_datalatih($data,$table){
		//$this->db->insert($table,$data);
        $this->db->set($data);
        $this->db->insert($table);
	}


}