<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FormUpdateDataUji extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('admin_model/M_datauji');
        $this->load->helper('url');
    }

    public function index($id = null) {
        if ($id === null) {
            $id = $this->input->post('id');
        }

        if ($id === null) {
            show_error('No identifier provided', 500);
        }

        $data['u'] = $this->M_datauji->get_datauji_by_id($id);

        if (!$data['u']) {
            show_404();
        }

        $data['title'] = "Update Data Uji";
        $data['isi'] = 'admin/formUpdate_datauji';

        $this->load->view('layout/all', $data);
    }

    public function update_bobotdatalatih() {
        $id = $this->input->post('id');
        $data = array(
            'Bobot_batuk' => $this->input->post('Bobot_batuk'),
            'Bobot_batukberdarah' => $this->input->post('Bobot_batukberdarah'),
            'Bobot_sesaknafas' => $this->input->post('Bobot_sesaknafas'),
            'Bobot_demam' => $this->input->post('Bobot_demam'),
            'Bobot_keringat' => $this->input->post('Bobot_keringat'),
            'Bobot_nafsumakan' => $this->input->post('Bobot_nafsumakan'),
            'Bobot_beratbadan' => $this->input->post('Bobot_beratbadan')
        );

        $this->M_datalatih->update_datauji($id, $data);
        redirect('DataLatih');
    }
}
