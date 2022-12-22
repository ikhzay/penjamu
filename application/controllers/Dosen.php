<?php

use chriskacerguis\RestServer\RestController;

defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->database();
    }

    public function getAll_get(){
        $dosen = $this->db->get_where('dosen',array('dosen_prodi'=>'552011'));
        $this->response([
            'status' => 'success',
            'message' => 'List Of Dosen',
            'jumlah' => $dosen->num_rows(),
            'data' => $dosen->result()
        ], 200);
    }

    
}