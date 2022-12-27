<?php

use chriskacerguis\RestServer\RestController;

defined('BASEPATH') OR exit('No direct script access allowed');

class Pengabdian extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->database();
    }

    public function getAll_get(){
        $pengabdian = $this->db->get_where('tb_7',array('prodi_kode'=>'552011'));
        $this->response([
            'status' => 'success',
            'message' => 'Count Of Pengabdian',
            'jumlah' => $pengabdian->num_rows(),
            'data' => $pengabdian->result()
        ], 200);
    }
}