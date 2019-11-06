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
                    <h4>Vapour Pressure Deficit(VPD)</h4>
                    <form onsubmit="return false;" id="form_submit">
                    <div class="form-group">
                            <label for="air_temp">Air Temprature in plant community(<sup>o</sup>C)</label>
                            <input type="number" class="form-control" name="air_temp" required value="10" min="10" max="50" step="0.01">
                            <p style="font-size:12px;font-weight:bolder;">Range Between(10 to 50&#8451;)</p>
                    </div>
                    <div class="form-group">
                            <label for="rel_hum">Relative Humidity in plant community(%)</label>
                            <input type="number" class="form-control" name="rel_hum" required value="30" min="30" max="100" step="0.01">
                            <p style="font-size:12px;font-weight:bolder;">Range Between(30 to 100%)</p>
                    </div>

                    <button class="btn btn-primary" id="calc_vpd">Calculate</button>
                    </form>
                </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-sm-6 result border">

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
            $("#form_submit").submit(function(){
                var form_data = $("#form_submit").serializeArray();
                var temp = form_data[0].value;
                var hum = form_data[1].value;
                var calc_result = 0.7392 * ( 1 - hum/100 ) * Math.exp(0.058 * temp);
                $(".result").show();
                $(".result").html("<h5>VPD is: "+calc_result.toFixed(2) + "</h5>");
            })
        });
    </script>
    
</body>
</html>
