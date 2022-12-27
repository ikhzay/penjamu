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

    public function tingkat_get(){
        $kegiatan = $this->db->get_where('tb_1a',array('prodi_kode'=>'552011'))->result();
        $local=0;
        $nasional=0;
        $inter=0;

        foreach($kegiatan as $item){
            if($item->tingkat == 'L'){
                $local+=1;
            }
            else if($item->tingkat == 'N'){
                $nasional+=1;
            }
            else if($item->tingkat == 'I'){
                $inter+=1;
            }
        }

        $this->response([
            'status' => 'success',
            'message' => 'Count Of Kegiatan',
            'local' => $local,
            'nasional' => $nasional,
            'internasional' => $inter,
        ], 200);
    }
}