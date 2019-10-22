<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
// var_dump($_POST);
function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
$from = 'gchaudhary1995@gmail.com';
$rand_pass = randomPassword();
$to_email = 'gchaudhary1995@gmail.com';
$subject = 'Testing PHP Mail';
$message = '<html><body>';
$message .= '<p>Email:'. $_POST['email'] . '</p>';
$message .= '<p>Organisation:' . $_POST['organisation'] . '</p>';
$message .='<p>Designation:'. $_POST['designation'] . '</p>';
$message .='<p>Click Below to add his account to the module</p>';
$message .='<a href ="'.$_SERVER['SERVER_NAME'].'/save_request.php?username='.$_POST["name"].'">www.example.com</a>';
$message .='</body></html>';
// $message = wordwrap($message,1000);
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Create email headers
$headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
if(mail($to_email,$subject,$message,$headers)){

}
else{
    echo "something wrong..";
}
}
else{
    
?>
<!doctype html>
<html lang="en">
<?php include_once("common-head.php");?>
  <body>

    <?php 
    include_once("nav.php");
    ?>

    <main role="main" class="container">

      <div class="container">
          <div class="row justify-content-center">
          
            <div class="col-sm-6 border" id="">
            <center><h4>Register</h4></center>
              <form method="post" id="form_submit" onsubmit="return false;">                    
                <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email">
                </div>
                <div class="form-group">
                <label for="name">Name:</label>
                <input type="name" class="form-control" name="name">
                </div>
                <div class="form-group">
                <label for="organisation">Organisation Working:</label>
                <input type="text" class="form-control" name="organisation">
                </div>
                <div class="form-group">
                <label for="designation">Designation:</label>
                <input type="text" class="form-control" name="designation">
                </div>
                
                <div class="form-group">
                <input type="submit" class="form-control btn btn-dark" value="Register">
                </div>
              </form>

                </div>
          </div>


      </div>

    </main><!-- /.container -->


    <?php
    include_once("footer.php");    
    include_once("common-js.php");?>
    
    <script>
        $(document).ready(function(){
          $("#form_submit").submit(function(){
            $.ajax({
              url:"register.php",
              type:"POST",
              dataType:"json",
              data:$("#form_submit").serialize(),
              success:function(){

              }
            })
          })
        });
    </script>
    
</body>
</html>
<?php
}
?>