<?php
include('config.php');
if(!isset($_GET["username"]) && !isset($_GET["password"])){
    header("Location: index.php");
    exit();
}
else{
    $username = $_GET["username"];
    $password = $_GET["password"];
    $password = password_hash($password,PASSWORD_DEFAULT);
    // echo $password;
    $query = "insert into accounts(username,password,type) values('".$username."','".$password."','U')";
    if($conn->query($query) === TRUE){
        echo "User Registered...";
    }
    else{
        echo $conn->error;
    }
}


?>