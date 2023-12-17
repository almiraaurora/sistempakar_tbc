<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_hasil extends CI_Model {

    public function getCFData() {
        // Fungsi untuk mengambil Certainty Factor (CF) dari database
        // Misalnya, mengambil data CF dari tabel CF
        $this->db->select('Bobot_batuk, Bobot_batukberdarah, Bobot_sesaknafas, Bobot_demam, Bobot_keringat, Bobot_nafsumakan, Bobot_beratbadan');
        $this->db->from('tabel_bobot');
        $query = $this->db->get();
        return $query->result();
    }
    function input_datacf($cf,$table){
		$this->db->insert($table,$cf);
	}

    public function getDSData() {
        // Fungsi untuk mengambil massa Dempster-Shafer (DS) dari database
        // Misalnya, mengambil data massa DS dari tabel DS
        $this->db->select('cf');
        $this->db->from('tabel_hasil');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_max_id_userakhir() {
		$query = $this->db->query('SELECT MAX(id_user) as max_id_user FROM tabel_user');
		$row = $query->row();
		return $row->max_id_user;
	}
}
