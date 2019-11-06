<?php
session_start();
if(!isset($_SESSION["loggedin"])){
    header("Location: index.php");
}
if(isset($_SERVER["REQUEST_METHOD"]) == "POST"){
    include_once("config.php");
    $password = $_POST["old_pwd"];
    $new_password = $_POST["new_pwd"];
    $new_password1 = $_POST["new_pwd_re"];
    // var_dump($_POST);
    $id = $_SESSION["id"];
    // echo $id;
    $query = "select * from accounts where id = '".$id."'";
    $result = $conn->query($query);
    $hash;
    // var_dump($result);
    if($result->num_rows > 0){
        while($row = mysqli_fetch_assoc($result)){
            $hash = $row["password"];
        }
        if(password_verify($password,$hash)){
            if($new_password == $new_password1){
                $hash1 = password_hash($new_password,PASSWORD_DEFAULT);
                $query = "update accounts set password ='".$hash1."' where id='".$id."'";
                if($conn->query($query) === TRUE){
                    session_unset();
                    session_destroy();
                    header('Content-type: application/json');
                    echo json_encode(array("type"=>"success"));
                }

            }
            else{
                header('Content-type: application/json');
                echo json_encode(array("type"=>"error","reason"=>"New Password Doesn't Match..."));
            }
        }
        else{
            header('Content-type: application/json');
            echo json_encode(array("type"=>"error","reason"=>"Wrong Password..."));
        }
    }

}


?>