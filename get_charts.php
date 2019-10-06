<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Starter Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/dateTimePicker.css">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-expand-sm navbar-dark bg-primary mb-3">
        <div class="container">
            <a class="navbar-brand" href="/">Logo</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a href="" class="nav-link dropdown-toggle"
                            data-toggle="dropdown" id="navbarDropdownMenuLink">Your Ideas</a>
                            <div class="dropdown-menu">
                                <a href="#" class="dropdown-item">Ideas</a>
                                <a href="#" class="dropdown-item">Add</a>
                            </div>
                        </li>
                        <li class="nav-item">
                        <a href="#" class="nav-link">Logout</a>
                    </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">Login</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Register</a>
                        </li>
                </ul>
            </div>
        </div>
    </nav>

    <main role="main" class="container-fluid" id="page-container">

      <div class="container">
		<div class="row justify-content-center">
        <h4 id="show_data"></h4>
            <div class="col-6">
            <form action="" id="upload_req" onsubmit="return false;">
            <div class="row justify-content-center">
            <div class="col-6 form-group">
            <label for="starts">Start Date:</label>
            <input type="text" name="starts" class="form-control" id="example1">
            </div>
            <div class="col-6 form-group">
            <label for="ends">End Date:</label>
            <input type="text" name="ends" class="form-control" id="example2">
            </div>
            
            <div class="col-6 form-group">
            <input type="submit" class="btn btn-dark col-12 form-control" value="Submit">
            </div>
            


            </div>
            
                <!-- <input type="text" name="ends">
                <input type="text" class="form-control" id="example"> -->
            </form>

		      </div>

	  
	    	</div>
        
   
          </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12" id="res">
                    <h4>Results:</h4>
                    <canvas id="myChart" width="" height=""></canvas>
                </div>
            </div>

        </div>

        </div>
        </div>


    </main><!-- /.container -->
    <div class="container-fluid" id="footer">
        <footer class="container">
            <center>Copyright @ <?php echo Date("Y", strtotime("now"));?></center>
        </footer>    
        </div>    

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
    <script src="js/datetimePicker.js"></script>
    <script>
	$(document).ready(function(){
    $("#res").hide();
    var min_date,max_date;
        $.ajax({
            url:'get_res.php',
            type:'GET',
            dataType:'json',
            success:function(res){

                $("#show_data").html("Data is Available from: " + res.minDate + " to " + res.maxDate);
                min_date = res.minDate;
                max_date = res.maxDate;
                console.log(min_date);
                $('#example1').datetimepicker({
                    format:'YYYY/MM/DD HH:mm:ss',
                    sideBySide:true,
                    minDate:min_date,
                    maxDate:max_date            
                });
                $('#example2').datetimepicker({
                    format:'YYYY/MM/DD HH:mm:ss',
                    sideBySide:true,
                    minDate:min_date,
                    maxDate:max_date,
                });
            }
        });

 		$("#upload_req").submit(function(){
            $.ajax({
                url:"get_res.php",
                type:"POST",
                data:$(this).serialize(),
                success:function(res){
                    $("#res").show();
                    var time = [];
                    var inside_vpd = [];
                    var outside_vpd = [];
                    for(var i = 0; i < res.length; i++){
                        if(res[i].Date == "0"){
                            time[i] = res[i].Date1;
                            // console.log("Fired...");
                        }
                        else{
                            time[i] = res[i].Date + ":00";
                        }
                        var sat_vap_pressure = 0.7392 * Math.exp(0.06264 * res[i].Tapc * (Math.exp(-0.0019 * res[i].Date)));
                        var actual_vap_pressure = 0.8427 * (res[i].Eapc) / 100 * Math.exp(0.06264 * res[i].Tapc * Math.exp(-0.0019 * res[i].Date) - 0.00021 * res[i].Date);
                         inside_vpd[i] = sat_vap_pressure - actual_vap_pressure;
                        // inside_temp[i] = res[i].Tapc;
                        // inside_hum = res[i].Eapc;
                        // outside_temp = res[i].Taos;
                        outside_vpd[i] = 0.7392 * ( 1 - res[i].Eaos/100 ) * Math.exp(0.058 * res[i].Taos);
                    }
                    console.log(time);
                    console.log(outside_vpd);
                    var ctx = document.getElementById('myChart');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: time,
                    datasets: [
                        {
                        label: 'Inside Vapour Pressure Deficits',
                        data: inside_vpd,
                        fill:false,
                        borderColor:'rgb(255,0,0)' 
                    },
                    {
                        label:'Outside Vapour Pressure Deficts',
                        data: outside_vpd,
                        fill:false,
                        borderColor:'rgb(0,255,0)'
                    }],
                    
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: false
                            },

                        }]
                    },
                    responsive:true,
                    intersect:true,
                }
            });
                }
            })
        })
	
	
	
	})
	
	
	
	
	
	
    </script>
        <script>
            
            </script>
  </body>
</html>
