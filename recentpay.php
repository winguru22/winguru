<?php
		session_start();
	$uid = $_SESSION['_id'];
	
	$db_host="localhost";
	$db_username="root";
	$db_pass="";
	$db_name="colgame";

	$conn = mysqli_connect("$db_host","$db_username","$db_pass","$db_name") or die("error occurred");
	
	$sql = "SELECT * from tempwallet ORDER BY WALLET_ID DESC limit 40";
	$result = mysqli_query($conn, $sql);
	$rows = array();
	while($row = mysqli_fetch_assoc($result)){
		$rows[] = $row;
	}
	//print_r($rows);
?>


<!DOCTYPE html>
<html lang="en" style="font-size: 30.3px;">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width,initial-scale=1">
      <link rel="icon" href="favicon.ico">
      <title>game</title>
      
	  <link rel="stylesheet" href="vendor/bootstrap/bootstrap.min.css">
      <link href="css/app.css" rel="stylesheet">
	        <link rel="stylesheet" href="css/all.css">
	        <link rel="stylesheet" href="css/app.css">

      <link href="css/font-awesome.min.css" rel="stylesheet">
	  
	  <!--<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">-->
	  <link rel="stylesheet" href="datatables/dataTables.css">
	  <link rel="stylesheet" href="datatables/dataTables.responsive.css">
	  <link rel="stylesheet" href="datatables/dataTables.bootstrap.css">
   </head>
   <body data-spy="scroll" data-target="#navbar" class="static-layout">
      <noscript><strong>We're sorry but default doesn't work properly without JavaScript enabled. Please enable it to continue.</strong></noscript>
      <div data-v-a7e7a84c="" class="promotion">
         <nav data-v-a7e7a84c="" class="top_nav">
            <div data-v-a7e7a84c="" class="left"><a href="profile.php"><i class='fa fa-arrow-left fa-2x' style="margin-right:15px; color:white;" ></i></a><span data-v-a7e7a84c="">Recent Payments</span></div>
            <!--<div data-v-a7e7a84c="" class="right"><img data-v-a7e7a84c="" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAA30lEQVRoQ+2YUQ7CMAxD65uxkyFOxjhZEAeATKndocz7j1P7JVpVjCYfmvgYNvJvJE3EREQJeLREwZZlr0MkIu7lmIiFAB6/5FIiEfEcY9yIZ6pI7QA2G/kk0IlIjx2pDPQZNemyn3GoSk8bqaSmrDERZboVbROppKasSYl0+rP70kgcJd9+iWGukUqXfc0x5rvYyHyGXAUT4eY5r2Yi8xlyFVIioge6F4CdaeWIEcVda7ORLxgvRUTxQLd+R5gLqdRKR0vZnKltI8w0GVomwkiRqWEizDQZWibCSJGp8QahV0QzxiHkWgAAAABJRU5ErkJggg==" alt=""></div>-->
         </nav>
		 <div class='msg'></div>
		 <div class="container">
		 <div class="row">
			<div class="col-4">
				<i class="fa fa-trophy fa-2x" style="float:right;    margin-top: 3px;"></i>
			</div>
			<div class="col-8">
				<h4 style = "text-align:center; color:red;float:left">Result Record</h4>
			</div>
		</div>
		
		<table id="allrecords" class="table table-striped table-bordered table-sm cell-border order-column table-hover dt-responsive" style="width:100%">
		  <thead>
			<tr>
			    <th>ACTION</th>
				<th>WALLET ID</th>
				<th>USER ID</th> 
				<th>USERNAME</th>
				<th>MOBILE NO</th>
			    <th>AMOUNT</th>
			    <th>Pay Unique ID</th>
			    <th>DATE TIME</th>
			    <th>STATUS</th>
			    <th></th>
			
			
			
			</tr>
		  </thead>
		  <tbody>
			<?php 
				  $table;
				  foreach($rows as $k => $v){
					  $sql = "SELECT USERNAME, MOBILE_NO from users where USER_ID=".$v['USER_ID'];
					  $result = mysqli_query($conn, $sql);
					  $row = mysqli_fetch_assoc($result);
					  $table .= "<tr>";
					  if($v['PAY_STATUS'] == 'approved'){
						$table .= "<td>---</td>";
					}else{						
						$table .= "<td><button  class='approved'>Yes</button><button class=''>No</button></td>";
					}
                     $table .= "<td class='walletid'>".$v['WALLET_ID']."</td>";
                     $table .= "<td class='userid'>".$v['USER_ID']."</td>";
					 $table .= "<td>".$row['USERNAME']."</td>";
					 $table .= "<td>".$row['MOBILE_NO']."</td>";
                     $table .= "<td>".$v['WALLET_AMOUNT']."</td>";
						if($v['PAY_REF_ID'] == null){
							$table .= "<td>---</td>";
						}else{
							$table .= "<td>".$v['PAY_REF_ID']."</td>";
						}
                     $table .= "<td>".$v['CREATED_AT']."</td>";
					 $table .= "<td>".$v['PAY_STATUS']."</td>";
					
					$table .= "<td></td>";
					$table .= "</tr>";
					  
					  //foreach($v as $k1 => $v1){
						//echo $k1 ." = ". $v1;
					  //}
				  }
                  echo $table
				  
				  ?>
		  </tbody>
		</table>
	  </div></br>
         
        
         <div data-v-74fec56a="" data-v-a7e7a84c="" class="loading" style="display: none;">
            <div data-v-74fec56a="" class="v-dialog v-dialog--persistent" style="width: 300px; display: block;">
               <div data-v-74fec56a="" data-v-5197ff2a="" class="v-card v-sheet theme--dark teal">
                  <div data-v-74fec56a="" data-v-5197ff2a="" class="v-card__text">
                     <span data-v-74fec56a="">Loading</span>
                     <div data-v-74fec56a="" data-v-5197ff2a="" role="progressbar" aria-valuemin="0" aria-valuemax="100" class="v-progress-linear mb-0" style="height: 7px;">
                        <div data-v-74fec56a="" class="v-progress-linear__background white" style="height: 7px; opacity: 0.3; width: 100%;"></div>
                        <div data-v-74fec56a="" class="v-progress-linear__bar">
                           <div data-v-74fec56a="" class="v-progress-linear__bar__indeterminate v-progress-linear__bar__indeterminate--active">
                              <div data-v-74fec56a="" class="v-progress-linear__bar__indeterminate long white"></div>
                              <div data-v-74fec56a="" class="v-progress-linear__bar__indeterminate short white"></div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- <div data-v-a7e7a84c="" class="right_zz" style="display: none;"> -->
            <!-- <div data-v-a7e7a84c="" class="wrapper"> -->
               <!-- <ul data-v-a7e7a84c="" class="right_nav"> -->
                  <!-- <li data-v-a7e7a84c="">Bonus Record</li> -->
                  <!-- <li data-v-a7e7a84c="">Apply Record</li> -->
               <!-- </ul> -->
            <!-- </div> -->
         <!-- </div> -->
      </div>
	  
	  <script src="js/jquery.min.js"></script>
	  
	  
	  <script src="datatables/dataTables.js"></script>
<!--<script src="datatables/jquery.dataTables.min.js"></script>-->
<script src="datatables/dataTables.bootstrap.js"></script>
<script src="datatables/dataTables.responsive.js"></script>
	  <script>
		$(document).ready(function(){
    $(document).on('click', ".approved",function(){
        var userid = $(this).parent().siblings('.userid').text();
        var walletid = $(this).parent().siblings('.walletid').text();
       var actionval = $(this).text();
        var fd = new FormData();
		
		fd.append('userid', userid);
		fd.append('walletid', walletid);
		//fd.append('btnVal', btnVal);
		//fd.append('btnColor', btnColor);
		fd.append('action', 'conpay');
		fd.append('actionval', actionval);
		//console.log(fd);
		//console.log(fd);
        $.ajax({
            type: 'POST',
            url: 'loginback.php',
            data: fd,
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $('.submitBtn').attr("disabled","disabled");
                $('#fupForm').css("opacity",".5");
            },
            success: function(msg){
				
                console.log(msg); 
					if(msg === 'success'){
						window.location.reload();
					}else{
						//window.location.reload();
						$('.msg').text('error');
					}
			}
        });
    });
});
	
	
			
			$(document).ready(function() {
    $('#allrecords').DataTable( {
        responsive: {
            details: {
                type: 'column',
                target: -1
            }
        },
        columnDefs: [ {
            className: 'control',
            orderable: false,
            targets:   -1
        } ]
    } );
} );





	  </script>
   </body>
</html>