<?php
session_start();
//echo $_SESSION['_id'];
//echo $_SESSION['balance'];
$phpVar =  $_COOKIE['reamt'];

   //echo $phpVar;

$db_host="localhost";
$db_username="root";
$db_pass="";
$db_name="colgame";

$conn = mysqli_connect("$db_host","$db_username","$db_pass","$db_name") or die("error occurred");
$sql = 'SELECT UPI from upis';
function getUpi($conn, $sql){
	//echo $sql;
	$result = mysqli_query($conn, $sql);
	if(!$result){
		echo 'error';
	}
	$rows = array();
	while($row = mysqli_fetch_assoc($result)){
		//print_r($row);
		$rows[] = $row;
	}
	//print_r($rows);
	//for($rows as $k => $v){
	//	print_r($v);
	//}
	$i = rand(0,1);
	echo $rows[$i]['UPI'];
}
//getUpi($conn, $sql);
?>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="vendor/bootstrap/bootstrap.min.css">
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
.inu {
	width: auto;
	margin: 0;
	display: inline-block;
	border: none;
	background: #f1f1f1;
    border-radius: .25rem;
	
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

/* Add padding to container elements */
.container {
  padding: 16px;
}

/* Style the horizontal ruler */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

</style>
<body  style="background-color: #4eb0f4;">
<div id="msg" style="color:white;"></div>
<section id="cover" class="min-vh-100" style="margin-top: 127px;">
  <div id="cover-caption">
    <div class="container">
      <div class="row text-white">
        <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
		  <form  class="justify-content-center form-horizontal" id="ogform" method="POST" action="#" style="border:1px solid #ccc;background-color:#4EB0F4 ;text-align:center;">
			<h2>Your payment of <?php echo $phpVar; ?> is under process. Will be added to wallet in 2 mins. Go to <a href="./">Homepage</a></h2>
		  </form>
		</div>
      </div>
    </div>
  </div>
</section>
<script src="js/jquery.min.js"></script>
<script src="vendor/bootstrap/popper.min.js"></script>
<script src="vendor/bootstrap/bootstrap.min.js"></script>
