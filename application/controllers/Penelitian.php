<?php

use chriskacerguis\RestServer\RestController;

defined('BASEPATH') OR exit('No direct script access allowed');

class Penelitian extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->database();
    }

    public function getAll_get(){
        $penelitian = $this->db->get_where('tb_6',array('prodi_kode'=>'552011'));
        $this->response([
            'status' => 'success',
            'message' => 'Count Of Penelitian',
            'jumlah' => $penelitian->num_rows(),
            'data' => $penelitian->result()
        ], 200);
    }
}