<!doctype html>
<html lang="en">
  
<?php include_once("common-head.php");?>
  <body>

<?php include_once("nav.php");?>
    
    <main role="main" class="container-fluid" id="page-container">

      <div class="container-fluid">
		<div class="row justify-content-center">
        <h4 id="show_data"></h4>
            <div class="col-sm-6">
            <form action="" id="upload_req" onsubmit="return false;">
            <div class="row justify-content-center">
            <div class="col-sm-6 form-group">
            <label for="starts">Start Date:</label>
            <input type="text" name="starts" class="form-control" id="example1">
            </div>
            <div class="col-sm-6 form-group">
            <label for="ends">End Date:</label>
            <input type="text" name="ends" class="form-control" id="example2">
            </div>
            
            <div class="col-sm-6 form-group">
            <input type="submit" class="btn btn-dark col-sm-12 form-control" value="Submit">
            </div>
            


            </div>
            
                <!-- <input type="text" name="ends">
                <input type="text" class="form-control" id="example"> -->
            </form>

		      </div>

	  
	    	</div>
        
   
          </div>
        <div class="container-fluid">
            <div class="row justify-content-center" id="res">        
                <div class="col-sm-12">
                <div id="card">
                <!-- <h4> Comparing Outside VPD With Arellano's Equation </h4> -->
                <div id="chartContainer" style="height: 70vh; width: 100%;"></div>
                </div>
                </div>                
                
                </div>

             

        </div>

        </div>
        </div>


    </main><!-- /.container -->
        

    <?php
    include_once("footer.php");    
    include_once("common-js.php");
    ?>
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
                    var dateTime = [];
                    var inside_vpd = [];
                    var arellano_inside_vpd = [];
                    var outside_vpd = [];
                    var arellano_outside_vpd = [];
                    for(var i = 0; i < res.length; i++){
                        if(res[i].Date == "0"){
                            time[i] = res[i].Date1;
                            // console.log("Fired...");
                        }
                        else{
                            time[i] = res[i].Date + ":00";
                        }
                        dateTime[i] = res[i].Date2;
                        var sat_vap_pressure = 0.7392 * Math.exp(0.06264 * res[i].Tapc * (Math.exp(-0.0019 * res[i].Date)));
                        var actual_vap_pressure = 0.8427 * (res[i].Eapc) / 100 * Math.exp(0.06264 * res[i].Tapc * Math.exp(-0.0019 * res[i].Date) - 0.00021 * res[i].Date);
                         inside_vpd[i] = sat_vap_pressure - actual_vap_pressure;
                         inside_vpd[i] = inside_vpd[i].toFixed(2);
                        // inside_temp[i] = res[i].Tapc;
                        // inside_hum = res[i].Eapc;
                        // outside_temp = res[i].Taos;
                        outside_vpd[i] = 0.7392 * ( 1 - res[i].Eaos/100 ) * Math.exp(0.058 * res[i].Taos);
                        outside_vpd[i] = outside_vpd[i].toFixed(2);
                        arellano_inside_vpd[i] = 0.61078 * Math.exp((17.269* parseFloat(res[i].Tapc) ) / (273.3 + parseFloat(res[i].Tapc)) ) * ( 1 - parseFloat(res[i].Eapc) /100);
                        arellano_inside_vpd[i] = arellano_inside_vpd[i].toFixed(2);
                        // arellano_inside_vpd[i] = 0.61078 * Math.exp((17.269 * res[i].Tapc) / (res[i].Tapc + 237.3)) * (1 -res[i].Eapc / 100);
                        arellano_outside_vpd[i] = 0.61078 * Math.exp((17.269* parseFloat(res[i].Tapc) ) / (273.3 + parseFloat(res[i].Tapc)) ) * ( 1 - parseFloat(res[i].Eapc) /100);
                        arellano_outside_vpd[i] = arellano_outside_vpd[i].toFixed(2);
                    }
                    // console.log(time);
                    // console.log(arellano_inside_vpd);
                    // console.log(arellano_outside_vpd);
                    var insideVsOutside = [];
                    var insideVsInside_1 = [];
                    var outsideVsOutside_1 = [];
                    for(var i = 0; i < inside_vpd.length; i++){
                        insideVsOutside[i] = outside_vpd[i] - inside_vpd[i];
                        insideVsOutside[i] = Math.abs(insideVsOutside[i].toFixed(2));
                    }
                    for(var i = 0; i < inside_vpd.length; i++){
                        insideVsInside_1[i] = inside_vpd[i] - arellano_inside_vpd[i];
                        insideVsInside_1[i] = Math.abs(insideVsInside_1[i].toFixed(2));
                    }
                    for(var i = 0; i < inside_vpd.length; i++){
                        outsideVsOutside_1[i] = outside_vpd[i] - arellano_outside_vpd[i];
                        outsideVsOutside_1[i] = Math.abs(outsideVsOutside_1[i].toFixed(2));
                    }
                    var insideColors = [];
                    var outsideColors = [];
                    var otherColors = [];
                    var otherColors2 = [];
                    var gridColors = [];
                    var insideRadius = [];
                    $.each(inside_vpd, function( index,value ) {
                        if(value < 0.53 || value > 1.10){
                            insideColors[index]="";
                            insideRadius[index] = 2;
                        }else{
                            insideColors[index] ="rgb(255,166,0)";
                            insideRadius[index] = 6;
                        }
                        });
                        $.each(outside_vpd, function( index,value ) {
                        if(value < 0.53 || value > 1.10){
                            outsideColors[index]="";
                        }else{
                            outsideColors[index]="rgb(5,125,27)";
                        }
                        });
                        $.each(arellano_inside_vpd, function( index,value ) {
                        if(value < 0.53 || value > 1.10){
                            otherColors[index]="";
                        }else{
                            otherColors[index]="rgb(0,63,92)";
                        }
                        });
                        $.each(arellano_outside_vpd, function( index,value ) {
                        if(value < 0.53 || value > 1.10){
                            otherColors2[index]="";
                        }else{
                            otherColors2[index]="rgb(0,63,92)";
                        }
                        });
                        var x = time;
            // var time = time.map(i => parseFloat(i));
            var inside_vpd = inside_vpd.map(i => parseFloat(i));
            var outside_vpd = outside_vpd.map(i => parseFloat(i));
            console.log(outside_vpd);
            var dataPoints = [];
            var x2 = [1,2,3];
            var y2 = [4,5,6];
            var dataPoints1 = [];
            for (var i = 0; i < inside_vpd.length; i++) {
            dataPoints.push({
                label: dateTime[i],
                x: new Date(dateTime[i]),
                y: inside_vpd[i]
            });
            }
            for (var i = 0; i < outside_vpd.length; i++) {
            dataPoints1.push({
                label: dateTime[i],
                x : new Date(dateTime[i]),
                y: outside_vpd[i]
            });
            }
            // console.log(dataPoints1);
            // console.log(dataPoints);
            var chart = new CanvasJS.Chart("chartContainer", {
		title:{
			text: "VPD ' vs VPD''"              
        },
        zoomEnabled: true,
        legend: {
       horizontalAlign: "center", // "center" , "right"
       verticalAlign: "top",  // "top" , "bottom"
       fontSize: 15,
       itemclick:toggleDataSeries,
       cursor: "pointer"
        },
        axisX: {
            intervalType: "hour",
            valueFormatString: "YYYY-MM-DD HH:mm:ss",
            labelMaxWidth: 100, // change label width accordingly
        },
        axisY:{
            stripLines:[{
                value:1.10,
                label:"Maximum" 
            },
            {
                value:0.52,
                label:"Minimum"
            }
        ]
        },
		data: [              
		{
			// Change type to "doughnut", "line", "splineArea", etc.
            type: "line",
            showInLegend: true,
            legendText: "VPD'",
			dataPoints: dataPoints,
        },
        {
            type: "line",
            showInLegend: true,
            legendText: "VPD\'\'",
            dataPoints: dataPoints1,
        }
		]
	});
    chart.render();
    function toggleDataSeries(e) {
	if(typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else {
		e.dataSeries.visible = true;            
	}
	chart.render();
}


                }
            })
        })
	
	
	
	})
	
	
	
	
	
	
    </script>
        <script>
            
            </script>
  </body>
</html>
