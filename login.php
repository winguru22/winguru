<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="vendor/bootstrap/bootstrap.min.css">
<link rel="stylesheet" href="css/app.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
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
hr {
  border: 1px solid #f1f1f1;
  
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
.container {
  padding: 16px;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: #474e5d;
  padding-top: 50px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* Style the horizontal ruler */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}
 
/* The Close Button (x) */
.close {
  position: absolute;
  right: 35px;
  top: 15px;
  font-size: 40px;
  font-weight: bold;
  color: #f1f1f1;
}

.close:hover,
.close:focus {
  color: #f44336;
  cursor: pointer;
}

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
  margin-left: 36%;
  width: 30%;
  border: 3px solid black;
  padding: 10px;
}
</style>
<body  style="background-color:black ;">
<div id="msg" style="color:white;"></div>
<section id="cover" class="min-vh-100">
    <div id="cover-caption">
        <div class="container">
            <div class="row text-white">
                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
					<form  class="justify-content-center form-horizontal" id="ogform" method="POST" action="#" style="border:1px solid #ccc;background-color:#4EB0F4 ;text-align:center;">
						<h1>Login</h1>
						<p><font size="4"> Please fill in this form to create an account.</font></p>
						<hr>
						<div class="form-group">
							<label class="control-label" for="Mobile No"> Mobile No</label>
							<input class="form-control" type="text" placeholder="Enter Mobile No" name="Mobile No" required></br>
						</div>
						<div class="form-group">
							<label class="control-label" for="psw"> Password</label>
							<input class="form-control" type="password" placeholder="Enter Password" name="psw" required></br>
						</div>
						<div class="form-group">
							<label class="control-label">
								<input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"><font size="4">  Remember me</font>
							</label>
						</div>
						<p style="margin-bottom:0"> By creating an account you agree to our <a href="#" style="color:dodgerblue"> Terms & Privacy</a>.</p>
						<div>
						<a href="./signup.php" class="buttonsign" style="width:auto;">Sign Up</button></a>
						<button style="width:auto;" type="type">Login</button>
						</div>
					</form>
				</div>
            </div>
        </div>
    </div>
	<div data-v-405e9a63="" data-v-d2db546c="" class="footer">
            <ul data-v-405e9a63="" class="nav_foot">
               <li data-v-405e9a63="" class=""><a href="./home.php"><i class="fa fa-home fa-2x"></i><span data-v-405e9a63=""><br> Home</span></a></li>
               <li data-v-405e9a63="" class=""><a href="./home.php"><i class="fa fa-search fa-2x"></i><span data-v-405e9a63=""><br>Search</span></a></li>
               <li data-v-405e9a63="" class=""><a href="./login.php"><i class="fa fa-user fa-2x"></i><span data-v-405e9a63=""><br>My</span></a></li>
               
            </ul>
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
		fd.append('action', 'login');
//		fd.append('mono', "<?php echo $_SESSION['mobile']; ?>");
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
				if(msg == 'Wrong Mobile no'){
					$('#msg').text('Wrong Mobile No, enter correct mobile no again');
					//window.location.href = './login.html';
				}else if(msg == 'Wrong Password'){
					
					$('#msg').text('Wrong Password, enter correct password');
				}else {
					window.location.href = './';
				}
				
            }
        });
    });
   
});
	  </script>

</body>
</html>
