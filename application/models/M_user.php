<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model{
    function input_data($data,$table){
		$this->db->insert($table,$data);
	}
}