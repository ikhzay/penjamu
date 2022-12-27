<?php

use chriskacerguis\RestServer\RestController;

defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->database();
    }

    public function getAll_get(){
        $mahasiswa = $this->db->get_where('tb_2a',array('prodi_kode'=>'552011'));
        $this->response([
            'status' => 'success',
            'message' => 'Count Of Mahasiswa',
            'jumlah' => $mahasiswa->num_rows(),
            'data' => $mahasiswa->result()
        ], 200);
    }
}