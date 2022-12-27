<?php

use chriskacerguis\RestServer\RestController;

defined('BASEPATH') OR exit('No direct script access allowed');

class Kegiatan extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->database();
    }

    public function getAll_get(){
        $kegiatan = $this->db->get_where('tb_1a',array('prodi_kode'=>'552011'));
        $this->response([
            'status' => 'success',
            'message' => 'Count Of Kegiatan',
            'jumlah' => $kegiatan->num_rows(),
            'data' => $kegiatan->result()
        ], 200);
    }
}