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

    public function grafik_get(){
        $sql_tahun = "SELECT tahun FROM tb_6 WHERE prodi_kode = '552011' GROUP BY tahun DESC LIMIT 3";
        $tahun = $this->db->query($sql_tahun)->result();
        $thn = [];

        foreach($tahun as $t){
            array_push($thn,$t->tahun);
        }

        $object = [];
        for($i=0 ; $i<sizeof($thn) ; $i++){
            $ts = "
                SELECT dosen,tahun,mahasiswa FROM tb_6 WHERE prodi_kode = '552011' 
                AND tahun = '".$thn[$i]."' ORDER BY tahun ASC;
            ";
            $ts_data = $this->db->query($ts)->result();
            $data = $this->jml_data($ts_data);
            $object[] = (object) [
                'tahun' => $thn[$i],
                'mhs' => $data[0],
                'dosen' => $data[1]
              ];
        }
        $this->response([
            "status" => "success",
            "message"=> "Count Of Penelitian",
            'data' => $object
        ], 200);
    }

    function jml_data(array $data){
        $mhs = [];
        $dos = [];
        foreach($data as $d){
            $kk = explode (',',$d->mahasiswa);
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