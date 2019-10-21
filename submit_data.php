<?php
include('config.php');
//var_dump($_FILES);
$file = $_FILES["csv_data"]["tmp_name"];
    /* Map Rows and Loop Through Them */
    $rows   = array_map('str_getcsv', file($file));
    $header = array_shift($rows);
    $csv    = array();
    foreach($rows as $row) {
        $csv[] = array_combine($header, $row);
    }
    if($header[0] == "Date" && $header[1] == "Tapc" && $header[2] == "Eapc" && $header[3] == "Taos" && $header[4] == "Eaos"){
        for($i = 0; $i < count($csv); $i++){
            $query = "insert into dataset(Date,Tapc,Eapc,Taos,Eaos) 
            values('".$csv[$i]["Date"]."',
            '".$csv[$i]["Tapc"]."',
            '".$csv[$i]["Eapc"]."',
            '".$csv[$i]["Taos"]."',
            '".$csv[$i]["Eaos"]."'        
            )";
            if($conn->query($query) === TRUE){
                header('Content-type: application/json');
                echo json_encode(array("msg"=>"success"));
            }
            else{
                header('Content-type: application/json');
                echo json_encode(array("msg"=>"fail","reason"=>$conn->error));
            }
        }
    
    }
    else{
        header('Content-type: application/json');
        echo json_encode(array("msg"=>"fail","reason"=>"Wrong CSV Format..."));
    }


?>