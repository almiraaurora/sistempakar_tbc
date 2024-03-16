<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_datauji extends CI_Model{
    public function tampil_datauji(){
        return $this->db->get('tabel_datauji')->result();
    }
    function input_datauji($data,$table){
		$this->db->insert($table,$data);
        // $this->db->set($data);
        // $this->db->insert($table);
	}


}