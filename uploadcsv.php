<!doctype html>
<html lang="en">
<?php include_once("common-head.php");?>
  <body>
  <?php include_once("nav.php");?>


    <main role="main" class="container">

      <div class="container">
		<div class="row justify-content-center">
		  <div class="col-sm-6">
			   <form method="post" class="border" onsubmit="return false;" id="upload_data" >
			   <div class="form-group">
               <label for="csv_data"><strong>Upload CSV:</strong></label>
               <input type="file" class="form-control-file border" required name="csv_data">
			   </div>
               <div>
               <div class="form-group">
               <input type="submit" name="uplaod" class="form-control btn btn-dark" value="Upload">
                </div>
			   </form>			
		  </div>
	  
		</div>
	<!-- <table id="show_data" class="table_data table table-border">
		
	</table> -->
    <canvas id="myChart" width="400" height="400"></canvas>

      </div>

    </main><!-- /.container -->


    <?php 
    include_once("footer.php");    
    include_once("common-js.php");?>
    <script>
	$(document).ready(function(){
		$("#upload_data").submit(function(){
			$.ajax({
				url:"submit_data.php",
				type:"POST",
				contentType:false,
				processData:false,
				data:new FormData($("#upload_data")[0]),
				beforeSend:function(){

				},
				success:function(res){
				// $.each(res,function(key,value){
				// $("#show_data").append("<tr>")
				// 	$.each(value, function(key,value){
				// 		// console.log(key + ": " + value);
				// 		$("#show_data").append("<td>"+ value +"</td>")
				// 	})
				// $("#show_data").append("</tr>")

				})
				
				}
			
			});
		
		
		})
	
	
	
	})
	
	
	
	
	
	
    </script>

  </body>
</html>
