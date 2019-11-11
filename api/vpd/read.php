<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once("../api/config/database.php");
    include_once("../objects/vpd.php");
    $database = new Database();
    $db = $database->getConnection();

    $vpd = new VPD($db);
    $limit = isset($_GET["limit"]) ? $_GET["limit"] : null;
    $stmt = $vpd->read($limit);
    $num = $stmt->rowCount();

    if($num > 0){
        
        $vpd_arr = array();
        $vpd_arr["records"] = array();

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $vpd_items = array(
                "id" => $id,
                "Date" => $Date,
                "Tapc" => $Tapc,
                "Eapc" => $Eapc,
                "Taos" => $Taos,
                "Eaos" => $Eaos,
                "cdate" => $cdate
            );
            array_push($vpd_arr["records"], $vpd_items);
        }
        http_response_code(200);
        echo json_encode($vpd_arr);
    }
    else{
        http_response_code(400);
        echo json_encode(array("type"=>"failure"));
    }



?>