<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kombinasi extends CI_Model {

    public function getAllData() {
        $query = $this->db->get('tabel_hasil'); // Ganti 'nama_tabel' dengan nama tabel yang sesuai
        return $query->result(); // Mengembalikan hasil query
    }

    function input_dataakhir($data,$table){
        $this->db->insert($table,$data);
    }

    public function get_max_id_userakhir() {
        $query = $this->db->query('SELECT MAX(id_user) as max_id_user FROM tabel_user');
        $row = $query->row();
        return $row->max_id_user;
    }

            
            
}

 