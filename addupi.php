<?php
	session_start();
	//echo $_SESSION['_id'];
?>
<html lang="en" style="font-size: 32px;">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width,initial-scale=1">
      <link rel="icon" href="favicon.ico">
      <title>game</title>
	  <link rel="stylesheet" href="css/font-awesome.min.css">
      <link href="css/app.css" rel="stylesheet">
	  <style>
		a {
			text-decoration: none;
		}
	  
		input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
input[type=email] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
input[type=submit] {
  width: 100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.main {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
   </style>
   </head>
   <body style="font-size: 24px;">
      <noscript><strong>We're sorry but default doesn't work properly without JavaScript enabled. Please enable it to continue.</strong></noscript>
      <div data-v-d2db546c="" class="addbankcard">
         <nav data-v-d2db546c="" class="top_nav">
            <div data-v-d2db546c="" class="left"><a href="upilist.php"><i class='fa fa-arrow-left fa-2x' style="margin-right:15px; color:white;" ></i></a><span data-v-d2db546c="">Add UPI ID</span></div>
         </nav>
         <div class="main">
			<form action="#" id="myform" method="POST">
				<label for="firstname">Name</label>
				<input type="text" id="firstname" name="firstname" placeholder="Your name.." required>
			
				<label for="upiid">UPI ID</label>
				<input type="text" id="upiid" name="upiid" placeholder="Your upi id ..." required>
								
				<label for="state">State/Territory</label>
				<input type="text" id="state" name="state" placeholder="Your State/Territory.." required>
				
				<label for="city">City</label>
				<input type="text" id="city" name="city" placeholder="Your City.." required>
				
				<label for="mobileno">Mobile Number</label>
				<input type="text" id="mobileno" name="mobileno" placeholder="Your Mobile Number.." required>
				
				<label for="email">Email</label>
				<input type="email" id="email" name="email" placeholder="Your Email.." required>


				<!-- <label for="country">Country</label> -->
				<!-- <select id="country" name="country"> -->
				<!-- <option value="australia">Australia</option> -->
				<!-- <option value="canada">Canada</option> -->
				<!-- <option value="usa">USA</option> -->
				<!-- </select> -->
			
				<input type="submit" value="Submit">
			</form>
			</div>
         <div data-v-405e9a63="" data-v-d2db546c="" class="footer">
			<ul data-v-405e9a63="" class="nav_foot">
				<li data-v-405e9a63="" class=""><a href="./home.php"><i class="fa fa-home fa-2x"></i><span data-v-405e9a63=""><br> Home</span></a></li>
				<li data-v-405e9a63="" class=""><a href="./home.php"><i class="fa fa-search fa-2x"></i><span data-v-405e9a63=""><br>Search</span></a></li>
				<li data-v-405e9a63="" class=""><a href="./"><i class="fa fa-trophy fa-2x"></i><span data-v-405e9a63=""><br>Win</span></a></li>
				<li data-v-405e9a63="" class="active"><a href="profile.php"><i class="fa fa-user fa-2x"></i><span data-v-405e9a63=""><br>My</span></a></li>
			</ul>
		 </div>
      </div>
	  <script src="js/jquery.min.js"></script>
<script>
	$(document).ready(function(e){
    $("#myform").on('submit', function(e){
        e.preventDefault();
		//var gameno = $("#gameno").text();
        //var getData;
		var fd = new FormData(this);
		
		fd.append('userid', <?php echo $_SESSION['_id']?>);
		
		fd.append('action', 'addupi');
		console.log(fd);
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
						window.location.href = './upilist.php';
					}
			}
        });
    });
   
});
</script>
   </body>
</html>