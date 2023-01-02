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

    public function pendidikan_get(){
        $dosen = $this->db->get_where('dosen',array('dosen_prodi'=>'552011'))->result();
        $s2=0;
        $s3=0;
        foreach($dosen as $pen){
            if($pen->dosen_pendidikan=='S2'){
                $s2+=1;
            }
            else if($pen->dosen_pendidikan=='S3'){
                $s3+=1;
            }
        }
        $this->response([
            'status' => 'success',
            'message' => 'Count Of Dosen',
            'S2' => $s2,
            'S3' => $s3
        ], 200);
    }

   
}