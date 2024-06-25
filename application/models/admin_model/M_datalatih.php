<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_datalatih extends CI_Model{
    public function tampil_datalatih(){
        return $this->db->get('tabel_datalatih')->result();
    }
    function input_datalatih($data,$table){
		$this->db->insert($table,$data);
        // $this->db->set($data);
        // $this->db->insert($table);
	}
    
    public function get_max_id() {
        $this->db->select_max('id_datalatih');
        $query = $this->db->get('tabel_datalatih');
        return $query->row()->id_datalatih;
    }

    // Metode untuk mengambil data dari tabel datalatih untuk analisis
    public function getDataforAnalisis() {
        //$this->db->select('id_datalatih, Bobot_batuk, Bobot_batukberdarah, Bobot_sesaknafas, Bobot_demam, Bobot_keringat, Bobot_nafsumakan, Bobot_beratbadan, label');
        $query = $this->db->get('tabel_datalatih');
        return $query->result_array();
    }

    public function get_datalatih_by_id($id) {
        $this->db->where('id_datalatih', $id);
        $query = $this->db->get('tabel_datalatih');
        return $query->row();
    }
    

    function update_datalatih($id, $data) {
        $this->db->where('id_datalatih', $id);
        $this->db->update('tabel_datalatih', $data);
    }

    function delete_datalatih($id) {
         // Pertama hapus record terkait di tabel_analisislatih
        $this->db->where('id_analisislatih', $id);
        $this->db->delete('tabel_analisislatih');

        $this->db->where('id_datalatih', $id);
        $this->db->delete('tabel_datalatih');
    }


}