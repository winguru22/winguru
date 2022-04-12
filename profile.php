<?php
	session_start();
	$uid = $_SESSION['_id'];
	
	$db_host="localhost";
	$db_username="root";
	$db_pass="";
	$db_name="colgame";

	$conn = mysqli_connect("$db_host","$db_username","$db_pass","$db_name") or die("error occurred");
	$sql = "SELECT * from users WHERE USER_ID=$uid";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	//print_r($row);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta name="viewport" content="width=device-width , initial-scale=1.0">
	
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/app.css">
	
	<style>
		/***
User Profile Sidebar by @keenthemes
A component of Metronic Theme - #1 Selling Bootstrap 3 Admin Theme in Themeforest: http://j.mp/metronictheme
Licensed under MIT
***/

body {
  background: #F1F3FA;
}

/* Profile container 
.profile {
  margin-left: 1%;
  
}*/

/* Profile sidebar */
.profile-sidebar {
  padding: 20px 0 10px 0;
  background: #fff;
}

.profile-userpic img {
  float: none;
  margin: 0 auto;
  width: 30%;
  height: 50%;
  -webkit-border-radius: 50% !important;
  -moz-border-radius: 50% !important;
  border-radius: 50% !important;
}

.profile-usertitle {
  text-align: center;
  margin-top: 8px;
}

.profile-usertitle-name {
  color: #5a7391;
  font-size: 16px;
  font-weight: 600;
  margin-bottom: 7px;
}

.profile-usertitle-job {
  text-transform: uppercase;
  color: #5b9bd1;
  font-size: 12px;
  font-weight: 600;
  margin-bottom: 15px;
}

.profile-userbuttons {
  text-align: center;
  margin-top: 10px;
}

.profile-userbuttons .btn {
  text-transform: uppercase;
  font-size: 11px;
  font-weight: 600;
  padding: 6px 15px;
  margin-right: 5px;
}

.profile-userbuttons .btn:last-child {
  margin-right: 0px;
}
    
.profile-usermenu {
  margin-top: 30px;
}

.profile-usermenu ul li {
  border-bottom: 1px solid #f0f4f7;
}

.profile-usermenu ul li:last-child {
  border-bottom: none;
}

.profile-usermenu ul li a {
  color: #93a3b5;
  font-size: 14px;
  font-weight: 400;
}

.profile-usermenu ul li a i {
  margin-right: 8px;
  font-size: 14px;
}

.profile-usermenu ul li a:hover {
  background-color: #fafcfd;
  color: #5b9bd1;
}

.profile-usermenu ul li.active {
  border-bottom: none;
}

.profile-usermenu ul li.active a {
  color: #5b9bd1;
  background-color: #f6f9fb;
  border-left: 2px solid #5b9bd1;
  margin-left: -2px;
}

/* Profile Content */
.profile-content {
  padding: 20px;
  background: #fff;
  min-height: 460px;
}

.dropdown {
  position: relative;
  display: inline-block;
  padding-top: 9px;
    padding-bottom: 9px;
	width:100%;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
  display: block;
}
.dropdown:hover{
  background-color: #fafcfd;
  color: #5b9bd1;
}
.dropdown:hover .dropbtn {
  background-color: #3e8e41;
}
.container{
	padding-right: 0;
    padding-left: 0; 
    margin-right: 0; 
    margin-left: 0;
}
.row{
	margin: 0;
}
.col-md-3{
	padding: 0;
	margin-bottom:25px;
}

	</style>
</head>
<body>
	<div style="width: 100%;" class="container">
	<nav data-v-51265586="" class="top_nav">
            <div data-v-51265586="" class="left"><a href="./"><i class='fa fa-arrow-left fa-2x'style="margin-right:15px; color:white;" ></i></a><span data-v-51265586="">Profile</span></div>
         </nav>
		 
    <div class="row profile">
		<div class="col-md-3">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
					<img src="img/profile.png" class="img-responsive" alt="">
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name" >
						<?php echo $row['USERNAME'];?>
					</div>
					<div class="profile-usertitle-job">
						<?php echo $row['MOBILE_NO'];?>
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR BUTTONS -->
				<div class="profile-userbuttons">
					<a href="charge.php"><button type="button" class="btn btn-success btn-sm">Recharge</button></a>
					<a href="novice.php"><button type="button" class="btn btn-danger btn-sm" >Novice Tutorial</button></a>
				</div>
				<!-- END SIDEBAR BUTTONS -->
				<!-- SIDEBAR MENU -->
				<div class="profile-usermenu">
					<ul class="nav" >
						<li class="active">
							<a href="#">
							<i class="fa fa-home"></i>
							Order </a>
						</li>
						<li>
							<a href="#">
							<i class="fa fa-user"></i>
							Account Settings </a>
						</li>
						<li style="margin-left:15px;">
							<div class="dropdown">
								<a href="#">
								<i class="fa fa-money"></i>
								Wallet</a>
								<div class="dropdown-content">
									<a href="charge.php">Recharge</a>
									<a href="withdrawal.php">Withdrawal</a>
								</div>
							</div>
							
						</li>
						<li>
							<a href="banklist.php">
							<i class="fa fa-bank"></i>
							Bank Card </a>
						</li>
						<li>
							<a href="upilist.php">
							<i class="fa fa-underline"></i>
							UPI </a>
						</li>
						<li>
							<a href="promotion.php">
							<i class="fa fa-podcast"></i>
							Promotion </a>
						</li>
						<li>
							<a href="#" target="_blank">
							<i class="fa fa-address-card"></i>
							Address </a>
						</li>
						<li>
							<a href="#">
							<i class="fa fa-medkit"></i>
							Help </a>
						</li>
					</ul>
				</div>
				<!-- END MENU -->
			</div>
		</div>
		
	</div>
</div>
<br>
<div data-v-405e9a63="" data-v-d2db546c="" class="footer">
    <ul data-v-405e9a63="" class="nav_foot">
       <li data-v-405e9a63="" class=""><a href="./home.php"><i class="fa fa-home fa-2x"></i><span data-v-405e9a63=""><br> Home</span></a></li>
       <li data-v-405e9a63="" class=""><a href="./home.php"><i class="fa fa-search fa-2x"></i><span data-v-405e9a63=""><br>Search</span></a></li>
       <li data-v-405e9a63="" class=""><a href="./"><i class="fa fa-trophy fa-2x"></i><span data-v-405e9a63=""><br>Win</span></a></li>
       <li data-v-405e9a63="" class="active"><a href="profile.php"><i class="fa fa-user fa-2x"></i><span data-v-405e9a63=""><br>My</span></a></li>
    </ul>
</div>
</body>
</html>
