<?php
include("config.php");
// var_dump($_POST);
$start = $_POST["starts"];
$end = $_POST["ends"];
$query = "select * from dataset where Date between '".$start."' and '".$end."'";
$res = $conn->query($query);
$data = array();
if($res->num_rows > 0){
    $i = 0;
    while($row = mysqli_fetch_assoc($res)){
        $data[$i] = array();
        $data[$i]["Date"] = $row["Date"];
        $data[$i]["Tapc"] = $row["Tapc"];
        $data[$i]["Eapc"] = $row["Eapc"];
        $data[$i]["Taos"] = $row["Taos"];
        $data[$i]["Eaos"] = $row["Eaos"];
        $i++;
    }
}
header('Content-type: application/json');
echo json_encode($data);
?>