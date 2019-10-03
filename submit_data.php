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
    for($i = 0; $i < count($csv); $i++){
        $query = "insert into dataset(Date,Tapc,Eapc,Taos,Eaos) 
        values('".$csv[$i]["Date"]."',
        '".$csv[$i]["Tapc"]."',
        '".$csv[$i]["Eapc"]."',
        '".$csv[$i]["Taos"]."',
        '".$csv[$i]["Eaos"]."'        
        )";
        if($conn->query($query) === TRUE){
            echo "Value Stored...";
        }
        else{
            echo "Something wrong...";
        }
    }
header('Content-type: application/json');
echo json_encode($csv);

?>