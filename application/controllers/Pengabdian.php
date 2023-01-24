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

    public function grafik_get(){
        $sql_tahun = "SELECT tahun FROM tb_7 WHERE prodi_kode = '552011' GROUP BY tahun DESC LIMIT 3";
        $tahun = $this->db->query($sql_tahun)->result();
        $thn = [];
        $mhs = 0;
        $dosen = 0;

        foreach($tahun as $t){
            array_push($thn,$t->tahun);
        }

        $object = [];
        for($i=0 ; $i<sizeof($thn) ; $i++){
            $ts = "
                SELECT dosen,tahun,nama_mhs FROM tb_7 WHERE prodi_kode = '552011' 
                AND tahun = '".$thn[$i]."' ORDER BY tahun ASC;
            ";
            $ts_data = $this->db->query($ts)->result();
            $data = $this->jml_data($ts_data);

            $mhs+=$data[0];
            $dosen+=$data[1];

            $object[] = (object) [
                'tahun' => $thn[$i],
                'mhs' => $data[0],
                'dosen' => $data[1]
              ];
        }
        $this->response([
            "status" => "success",
            "message"=> "Count Of Penelitian",
            "mahasiswa" => $mhs,
            "dosen" => $dosen,
            "data" => $object
        ], 200);
    }

    function jml_data(array $data){
        $mhs = [];
        $dos = [];
        foreach($data as $d){
            $kk = explode (',',$d->nama_mhs);
            foreach($kk as $k){
                array_push($mhs,ltrim($k));
            }
        }

        foreach($data as $d){
            $kk = explode (',',$d->dosen);
            foreach($kk as $k){
                array_push($dos,ltrim($k));
            }
        }

        $mhs = array_unique($mhs);
        $dos = array_unique($dos);
        $mahasiswa = [];
        $dosen = [];

        foreach($mhs as $m){
            array_push($mahasiswa,$m);
        }
        foreach($dos as $d){
            array_push($dosen,$d);
        }

        return [sizeof($mahasiswa),sizeof($dosen)];
    }
}