<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF/8 ");

    include_once("../api/config/database.php");
    include_once("../objects/vpd.php");

    $database = new Database();
    $db = $database->getConnection();
    $vpd_records = array();
    $vpd = new VPD($db);

    $vpd->id = isset($_GET["id"]) ? $_GET["id"] : die();
    // echo $vpd->id;
    $stmt = $vpd->readOne();
    if($vpd->Date != null){
        $vpd_records = array(
            "id" => $vpd->id,
            "Date" => $vpd->Date,
            "Tapc" => $vpd->Tapc,
            "Eapc" => $vpd->Eapc,
            "Taos" => $vpd->Taos,
            "Eaos" => $vpd->Eaos,
            "cdate" => $vpd->cdate
        );
        http_response_code(200);
        // echo "yoo";
        echo json_encode($vpd_records);
    }
    else{
        http_response_code(404);
        echo json_encode(array("message"=>"No Data Available"));
    }

?>