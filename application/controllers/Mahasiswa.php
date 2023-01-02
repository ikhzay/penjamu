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
        $mahasiswa = $this->db->get_where('tb_2a',array('prodi_kode'=>'552011'),6,1);
        $this->response([
            'status' => 'success',
            'message' => 'Count Of Mahasiswa',
            'jumlah' => $mahasiswa->num_rows(),
            'data' => $mahasiswa->result()
        ], 200);
    }

    public function pendaftar_get(){
        $mahasiswa = $this->db->get_where('tb_2a',array('prodi_kode'=>'552011'),6,1)->result();
        $i=-1;
        $jml=0;
        foreach($mahasiswa as $item){
            $i+=1;
            $jml+=$item->pendaftar;
        }
        $rata2=$jml/($i+1);
        $this->response([
            'status' => 'success',
            'message' => 'Count Of Mahasiswa',
            'jumlah' => $jml,
            'rata_rata' => $rata2,
            'pendaftar' => $mahasiswa[$i]->pendaftar
        ], 200);
    }

    public function grafik_get(){
        $mahasiswa = $this->db->select('tahun,lulus_seleksi,baru_reguler,aktif_reguler')->get_where('tb_2a',array('prodi_kode'=>'552011'),6,1)->result();
        $this->response([
            'status' => 'success',
            'message' => 'Count Of Mahasiswa',
            'data' => $mahasiswa
        ], 200);
    }
}