
<?php
$server = "localhost";
$user = "root";
$password = "";
$conn = new mysqli($server,$user,$password,"vpd");
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
// $createtime = str_replace("/","-","12/10/2018");
// echo $createtime;
// die;
?>
