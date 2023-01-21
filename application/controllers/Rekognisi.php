<?php

use chriskacerguis\RestServer\RestController;

defined('BASEPATH') OR exit('No direct script access allowed');

class Rekognisi extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->database();
    }

    public function grafik_get(){
        $sql_tahun = "SELECT tahun FROM tb_3b_1 WHERE prodi_kode = '552011' GROUP BY tahun DESC LIMIT 3";
        $tahun = $this->db->query($sql_tahun)->result();
        $thn = [];

        foreach($tahun as $t){
            array_push($thn,$t->tahun);
        }

        $sql_data = "
        SELECT tahun,tingkat FROM tb_3b_1 WHERE prodi_kode = '552011' 
        AND tahun IN (SELECT * from (select DISTINCT tahun 
                              FROM tb_3b_1 WHERE prodi_kode = '552011' GROUP BY tahun DESC LIMIT 3	) as t1)
                              ORDER BY tahun ASC;
        ";

        $data = $this->db->query($sql_data)->result();
        for($i=0 ; $i<sizeof($thn) ; $i++){
            $inter = 0;
            $nas = 0;
            $lokal = 0;
            foreach($data as $d){
                if ($d->tahun == $thn[$i]){
                    
                    if($d->tingkat == 3){
                        $inter++;
                    }else if($d->tingkat == 2){
                        $nas++;
                    }else{
                        $lokal++;
                    }
                }
            }
            $object[] = (object) [
                'tahun' => $thn[$i],
                'internasional' => $inter,
                'nasional' => $nas,
                'lokal' => $lokal,
            ];
        }
        $this->response([
            "status" => "success",
            "message"=> "Count Of Rekognisi",
            'data' => $object
        ], 200);
    }
}