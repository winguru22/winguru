<?php
//$_GET['r_code'];
?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="vendor/bootstrap/bootstrap.min.css">
<style>
body {font-family: Arial, Helvetica, sans-serif;}


/* Full-width input fields */
input[type=text], input[type=password] {
  width: auto;
  padding: 15px;
  margin: 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}
#cover {
    
    height: 100%;
    text-align: center;
    display: flex;
    align-items: center;
    position: relative;
}
input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

hr {
  border: 1px solid #f1f1f1;
  
}

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

button:hover {
  opacity:1;
}

/* Extra styles for the cancel button */
.cancelbtn {
  padding: 14px 20px;
  background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn, .signupbtn {
  float: left;
  width: 50%;
}

/* Add padding to container elements */
/*.container {
  padding: 16px;
}*/

/* Clear floats */
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
  .cancelbtn, .signupbtn {
     width: 100%;
  }
}
.center {
  margin-top: 5%;
  margin-bottom: 5%;
  border: 3px solid #73AD21;
  padding: 10px;
  height: 100%;
  text-align: center;
}
#cover-caption {
    width: 100%;
    position: relative;
    z-index: 1;
}
</style>
<body style="background-color:black ;">
<div id='msg' style="color:white;"></div>
<section id="cover" class="min-vh-100">
    <div id="cover-caption">
        <div class="container">
            <div class="row text-white">
                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
					<form class="justify-content-center form-horizontal" id="ogform" method="POST" action="#" style="border:1px solid #ccc;background-color:#4EB0F4 ;text-align:center;">
					
						<h1>Sign Up</h1>
						<p>Please fill in this form to create an account.</p>
						<hr>
						<div class="form-group">
							<label for="Username"><b>Username</b></label>
							<input class="form-control" style="margin-left:4px" type="text" placeholder="Enter Username" name="Username" required></br>
						</div>
						<div class="form-group">
							<label for="Mobile No"><b>Mobile No</b></label>
							<input class="form-control" style="margin-left:8px" type="text" placeholder="Enter Mobile No" name="Mobile No" required></br>
						</div>
						<div class="form-group">
							<label for="psw"><b>Password</b></label>
							<input class="form-control" style="margin-left:8px" type="password" placeholder="Enter Password" name="psw" required></br>    
						</div>
						<div class="form-group">
							<label for="psw"><b>Refer Code</b></label>
							<input class="form-control" type="text" placeholder="Enter referral code"  name="refcode"value=<?php echo $_GET['r_code'];?>></br>    
						</div>
						<div class="form-group">
							<label>
								<input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
							</label>
						</div>
						<p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>
						<hr>
						<div>
							<button style="width:auto;" type="button">Cancel</button>
							<button style="width:auto;" type="submit">Sign Up</button>
						</div>
					</form>
				</div>
            </div>
        </div>
    </div>
</section>
      <script src="js/jquery.min.js"></script>
<script>
	  $(document).ready(function(e){
    $("#ogform").on('submit', function(e){
        e.preventDefault();
		//var gameno = $("#gameno").text();
        var getData;
		var fd = new FormData(this);
		//alert(fd);
		fd.append('action', 'sign');
		//fd.append('gameno', gameno);
		//fd.append('btnVal', btnVal);
		//fd.append('btnColor', btnColor);
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
				if(msg == 'uc'){
					window.location.href = './login.php';
				}else{
					
					$('#msg').text('User already exist, Use another number');
				}
            }
        });
    });
   
});
	  </script>

</body>
</html>
