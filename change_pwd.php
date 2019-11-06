<?php
session_start();
if(!isset($_SESSION["loggedin"])){
    header("Location: index.php");
    exit();    
}
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
            <div class="col-sm-6 border" id="upload_internal">
                    <h4>Change Password</h4>
                    <form onsubmit="return false;" id="submit_pwd" oninput='new_pwd_re.setCustomValidity(new_pwd.value != new_pwd_re.value ? "Passwords do not match." : "")'>
                    <div class="form-group">
                            <label for="re_enter">Enter Old Password</label>
                            <input type="password" class="form-control" required name="old_pwd">
                    </div>
                    <div class="form-group">
                            <label for="new_pwd">New Password</label>
                            <input type="password" class="form-control" required name="new_pwd" minlength="8">
                    </div>
                    <div class="form-group">
                            <label for="new_pwd_re">Re-enter New Password</label>
                            <input type="password" class="form-control"  name="new_pwd_re">
                    </div>
                    <button class="btn btn-primary" id="" name="change" type="submit">Change Password</button>
                    </form>

                </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-sm-6">
              <div id="upload_result">
              
              </div>
            </div>
          </div>
      </div>

    </main><!-- /.container -->


    <?php
    include_once("footer.php");    
    include_once("common-js.php");?>
    
    <script>
        $(document).ready(function(){
            $(".result").hide();
            $("#submit_pwd").submit(function(){
                $.ajax({
                    url:"pwd_req.php",
                    type:"POST",
                    dataType:"json",
                    data:$("#submit_pwd").serialize(),
                    success:function(res){
                        $(".result").show();
                        if(res.type == "success"){
                                $("#upload_result").html('<i class="fa fa-check" aria-hidden="true"></i>\
                                <center><h4>Password Changed...</h4>\
                                <p>Login Again.....</p></center>\
                                ');
                                setTimeout(() => {
                                window.location.replace("index.php");                                    
                                }, 2000);

                                }
                                else{
                                $("#upload_result").html('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>\
                                <center><h4>Password Change Failed....</h4>\
                                <p>Reason: '+res.reason+'</p></center>\
                                ');

                                }    
                    }
                    
                });
            });
        });
    </script>
    
</body>
</html>
