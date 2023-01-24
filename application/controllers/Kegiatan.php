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
            'message' => 'Count Of Tingkat',
            'local' => $local,
            'nasional' => $nasional,
            'internasional' => $inter,
        ], 200);
    }

    public function bidang_get(){
        $kegiatan = $this->db->get_where('tb_1a',array('prodi_kode'=>'552011'))->result();
        $pendidikan=0;
        $penelitian=0;
        $lainnya=0;

        foreach($kegiatan as $item){
            if($item->bidang == 'P1'){
                $pendidikan+=1;
            }
            else if($item->bidang == 'P2'){
                $penelitian+=1;
            }
            else {
                $lainnya+=1;
            }
        }

        $this->response([
            'status' => 'success',
            'message' => 'Count Of Bidang',
            'pendidikan' => $pendidikan,
            'penelitian' => $penelitian,
            'lainnya' => $lainnya,
        ], 200);
    }
}