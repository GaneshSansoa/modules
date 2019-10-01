<?php
//var_dump($_FILES);
$file = $_FILES["csv_data"]["tmp_name"];
    /* Map Rows and Loop Through Them */
    $rows   = array_map('str_getcsv', file($file));
    $header = array_shift($rows);
    $csv    = array();
    foreach($rows as $row) {
        $csv[] = array_combine($header, $row);
    }
header('Content-type: application/json');
echo json_encode($csv);

?>