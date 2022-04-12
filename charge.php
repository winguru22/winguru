<?php
session_start();
//echo $_SESSION['_id'];
//echo $_SESSION['balance'];

?>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="vendor/bootstrap/bootstrap.min.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/app.css">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: auto;
  padding: 15px;
  margin: 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

/* Add a background color when the inputs get focus */
input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for all buttons */
button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
    
}
h1 {
	margin:0;
}
button:hover {
  opacity:1;
}

.buttonsign {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.buttonsign:hover {
  opacity:1;
  text-decoration:none;
  color:white;
}

/* Add padding to container elements 
.container {
  padding: 16px;
}*/

/* Style the horizontal ruler */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

</style>
<body  style="background-color:white ;">
<nav data-v-51265586="" class="top_nav">
            <div data-v-51265586="" class="left"><a href="./profile.php"><i class='fa fa-arrow-left fa-2x'style="margin-right:15px; color:white;" ></i></a><span data-v-51265586="">Recharge</span></div>
         </nav>
<div id="msg" style="color:white;"></div>
<section id="cover" class="min-vh-100">
    <div id="cover-caption">
        <div class="container">
            <div class="row text-white">
                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form " style="padding:0;">
					<form  class="justify-content-center form-horizontal" id="ogform" method="POST" action="#" style="border:1px solid #ccc;background-color:#4EB0F4 ;text-align:center;">
						<h1>Recharge</h1>
						<p><font size="4"> Please fill the amount to recharge.</font></p>
						<hr>
						<h2>Balance : <?php echo $_SESSION['balance'];?> </h2> 
						<div class="form-group">
							
							<input class="form-control" id="inputamt" type="text" placeholder="Enter amount" name="amount" required></br>
						</div>
						<div class="msg" style="color:red;font-weight:600"></div>
						<div class="form-group">
							<p class="btn btn-primary btn-md center-block amtbtn" style="width:auto">300</p>
							<p class="btn btn-primary btn-md center-block amtbtn" style="width:auto">500</p>
							<p class="btn btn-primary btn-md center-block amtbtn" style="width:auto">1000</p></br>
						</div>
						<p><font size="3"> Minimun recharge 300.</font></p>
						<a href="./" class="buttonsign" style="width:auto;">Back</button></a>
						<button style="width:auto;" type="type">Recharge</button>
						</div>
					</form>
				</div>
            </div>
        </div>
    </div>
</section>
<script src="js/jquery.min.js"></script>
<script>
$(function() {
  $('.amtbtn').click(function() {
	var val = $(this).text();
    $('#inputamt').val(val);
  });
});
</script>
<script>
	$(document).ready(function(e){
		$("#ogform").on('submit', function(e){
			e.preventDefault();
			var rechargeamt = $("#inputamt").val();
			var getData;
			var fd = new FormData(this);
			//alert(fd);
			fd.append('userid', "<?php echo $_SESSION['_id']; ?>");
			fd.append('action', 'recharge');
			//fd.append('btnVal', btnVal);
			//fd.append('btnColor', btnColor);
			//console.log(rechargeamt);
			var now = new Date();
			now.setTime(now.getTime() + (1 * 60 * 1000));
			 document.cookie = "reamt="+rechargeamt;
			 document.cookie = "expires=" + now.toUTCString();
			if(rechargeamt < 300){
				//alert('here');
				$('.msg').text('Minimun 300 recharge allowed');
			}else{ //alert('in else'); 
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
						if(msg == 'success'){
							window.location.href = './paycon.php';
						}else{
							
							$('#msg').text('Hit some error, Please try again');
						}
					}
				});
			}
		});
   
	});
</script>