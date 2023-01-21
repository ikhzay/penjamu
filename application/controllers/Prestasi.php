<?php

use chriskacerguis\RestServer\RestController;

defined('BASEPATH') OR exit('No direct script access allowed');

class Prestasi extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->database();
    }

    public function grafik_get(){
        $sql_tahun = "SELECT tahun_perolehan as tahun FROM tb_8b_1 WHERE prodi_kode = '552011' GROUP BY tahun_perolehan DESC LIMIT 3";
        $tahun = $this->db->query($sql_tahun)->result();
        $thn = [];

        foreach($tahun as $t){
            array_push($thn,$t->tahun);
        }

        $sql_data = "
        SELECT tahun_perolehan as tahun,tingkat FROM tb_8b_1 WHERE prodi_kode = '552011' 
        AND tahun_perolehan IN (SELECT * FROM (SELECT DISTINCT tahun_perolehan 
                              FROM tb_8b_1 WHERE prodi_kode = '552011' GROUP BY tahun_perolehan DESC LIMIT 3) AS t1)
                              ORDER BY tahun_perolehan ASC
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
            "message"=> "Count Of Prestasi",
            'data' => $object
        ], 200);
    }
}