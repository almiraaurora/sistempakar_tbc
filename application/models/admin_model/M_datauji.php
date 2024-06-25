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

    public function get_datauji_by_id($id) {
        $this->db->where('id_datauji', $id);
        $query = $this->db->get('tabel_datauji');
        return $query->row();
    }

    public function getDataforAnalisisUji() {
        //$this->db->select('id_datalatih, Bobot_batuk, Bobot_batukberdarah, Bobot_sesaknafas, Bobot_demam, Bobot_keringat, Bobot_nafsumakan, Bobot_beratbadan, label');
        $query = $this->db->get('tabel_datauji');
        return $query->result_array();
    }

    function update_datauji($id, $data) {
        $this->db->where('id_datauji', $id);
        $this->db->update('tabel_datauji', $data);
    }

    function delete_datauji($id) {
         // Pertama hapus record terkait di tabel_analisislatih
        $this->db->where('id_analisisuji', $id);
        $this->db->delete('tabel_analisisuji');

        $this->db->where('id_datauji', $id);
        $this->db->delete('tabel_datauji');
    }
}