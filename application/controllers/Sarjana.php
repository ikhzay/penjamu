<?php

use chriskacerguis\RestServer\RestController;

defined('BASEPATH') OR exit('No direct script access allowed');

class Sarjana extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->database();
    }

    public function getAll_get(){
        $sarjana = $this->db->get_where('tb_8d_s1',array('prodi_kode'=>'552011'));
        $this->response([
            'status' => 'success',
            'message' => 'Count Of Sarjana',
            'jumlah' => $sarjana->num_rows(),
            'data' => $sarjana->result()
        ], 200);
    }
}