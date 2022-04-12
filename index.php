<?php 
	session_start();
	//echo $_SESSION['_id'];
	//echo session_id();
	if(isset($_SESSION['loggedin'])){
		$db_host="localhost";
$db_username="root";
$db_pass="";
$db_name="colgame";

$conn = mysqli_connect("$db_host","$db_username","$db_pass","$db_name") or die("error occurred");
		$i = $_SESSION['_id'];
		$sql = "SELECT WALLET_AMOUNT from wallet where USER_ID=$i";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		$amt = $row['WALLET_AMOUNT'];
		$_SESSION['balance'] = $amt;
		
		$sql = "SELECT * from newgame where RESULT='pending'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
//echo $row['STARTTIME'] . " ---   ";
date_default_timezone_set('Asia/Kolkata'); 
$datetime1 = new DateTime();
$datetime2 = new DateTime($row['STARTTIME']);
$interval = $datetime1->diff($datetime2);

$min = $interval->format('%i');
$sec = $interval->format('%s');
$timer = ($min * 60) + $sec;
//echo $timer;
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>MBRD by GetTemplates.co</title>
      <meta name="description" content="Roxy">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- External CSS -->
      <link rel="stylesheet" href="vendor/bootstrap/bootstrap.min.css">
      <link rel="stylesheet" href="vendor/select2/select2.min.css">
      <link rel="stylesheet" href="vendor/owlcarousel/owl.carousel.min.css">
      <link rel="stylesheet" href="vendor/lightcase/lightcase.css">
      
      <!-- Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Lato:300,400|Work+Sans:300,400,700" rel="stylesheet">
      <!-- CSS -->
      <link rel="stylesheet" href="css/style.min.css">
      <link rel="stylesheet" href="css/font-awesome.min.css">
	  
      <link rel="stylesheet" href="css/icon-font.min.css">
      <link rel="stylesheet" href="css/all.css">
      <link rel="stylesheet" href="css/app.css">
      <!--<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">-->
	  <link rel="stylesheet" href="datatables/dataTables.css">
	  <link rel="stylesheet" href="datatables/dataTables.responsive.css">
	  <link rel="stylesheet" href="datatables/dataTables.bootstrap.css">
      <!-- Modernizr JS for IE8 support of HTML5 elements and media queries -->
      <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script> -->
		<style>
.button {
  border: none;
  color: white;
  padding: 7px 23px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 2px 1px;
  cursor: pointer;
  border-radius: 12px;
}



.buttonA {background-color: #23F319 !important;} /* Green */
.buttonB {background-color: #FB0F00 !important;} /* Red */
.buttonC {background-color: #33B2FF !important;} /* #33B2FF */
.buttonD {background-color: #8D39D3 !important;} /* Violet */



/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}

/**.btnEnable {
  background-color:#E6F9D2;
  border:1px solid #97DE4C;
  color:#232323;
  cursor:pointer;
}**/

.btnDisable {
  background-color:#FCBABA !important;
  border:1px solid #DD3939;
  color:#232323;
  /***cursor:wait;***/
}


.icon{
  background-color: #FB0F00; /* red */
  border: none;
  color: white;
  padding: 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 10px;
  margin: 3px 1.5px;
  cursor: pointer;
}
.icon1{
  background-color: #23F319; /* green */
  border: none;
  color: white;
  padding: 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
   font-size: 10px;
  margin: 3px 1.5px;
  cursor: pointer;
}
.icon2{
 background-color: #8D39D3; /* voilet */
  border: none;
  color: white;
  padding: 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 10px;
  margin: 3px 1.5px;
  cursor: pointer;
}



/*******/
.fa-2x {
    font-size: 1.5em;
}
.agree_zz {
	z-index:1;
}

</style>
<script>
var hidden, visibilityChange;
if(typeof document.hidden !== "undefined") {
  hidden = "hidden";
  visibilityChange = "visibilitychange";
}
else if(typeof document.msHidden !== "undefined") {
  hidden = "msHidden";
  visibilityChange = "msvisibilitychange";
}
else if(typeof document.webkitHidden !== "undefined") {
  hidden = "webkitHidden";
  visibilityChange = "webkitvisibilitychange";
}
var tabSwitched = false,
  leaveTime = 0,
  timerHandle;

function doTimer() {
  timerHandle = setTimeout(function() {
    doTimer();
    leaveTime++;
  }, 1000);
}

function handleVisibilityChange() {
  if(leaveTime === 0){
    doTimer();
  }
    
  if(!document[hidden] && leaveTime > 5) {
    console.log('leaveTime: ' + leaveTime + ' seconds, do action');
    clearTimeout(timerHandle);
    leaveTime = 0;
	window.location.reload();
  }
  else if(!document[hidden] && leaveTime < 5){
    console.log('tab switched before 5 seconds');
    clearTimeout(timerHandle);
    leaveTime = 0;
  }
}

document.addEventListener(visibilityChange, handleVisibilityChange, false);
</script>
   </head>
   <body data-spy="scroll" data-target="#navbar" class="static-layout">
      
      <div id="side-search" class="sidenav">
         <a href="javascript:void(0)" id="side-search-close">&times;</a>
         <div class="sidenav-content">
            <form action="">
               <div class="input-group md-form form-sm form-2 pl-0">
                  <input class="form-control my-0 py-1 red-border" type="text" placeholder="Search" aria-label="Search">
                  <div class="input-group-append">
                     <button class="input-group-text red lighten-3" id="basic-text1">
                     <span class="lnr lnr-magnifier"></span>
                     </button>
                  </div>
               </div>
            </form>
         </div>
      </div>
      <div class="jumbotron d-flex align-items-center">
         <div class="container text-center">
            <h5 class="display-1 mb-4">Available balance : <?php echo $amt;?></h5>
			<a href="charge.php"><button type="link" class="button buttonC" id="recharge">Recharge</button></a>
			<button class="button buttonC open-button">Read Rule</button>
         </div>
		 
         
      </div></br>
	  <div class="msg" style="text-align: center;color: red;font-weight: 800;"></div>
	  <div class="container">
		<div class="row">
			<div class="col-6 w-50">
				<i class="fa fa-trophy fa-2x"  style="margin-left: 12px;"></i><strong> Period</strong>
				<p style="padding-left:10px;" class="gameno" id="gameno"><strong><?php echo $row['NEWGAME_ID']; ?></strong></p>
			</div>
			<div class="col-6 w-50">
				<i class="fa fa-clock-o fa-2x" style="margin-left: 12px;"></i><strong> Time</strong>
				<p style="padding-left:10px;" class="time" id="time"><strong>02 : 00</strong><i style="margin-left:5px;"class="fa fa-refresh" onclick="reloadpage()"></i></p>
			</div>
		</div>
	  </div>
	  <div class="container" style="margin-bottom:10px;">
		<div class="row" >
			<div class="col-4">
				<button type="button" id="myBtn" class="myBtn button buttonA open-button btnEnable" data-color="green" onclick="openForm(this)">Green</button>
			</div>
			<div class="col-4">
				<button type="button" id="myBtn" class="myBtn button buttonD open-button btnEnable" data-color="violet" onclick="openForm(this)">Violet</button>
			</div>
			<div class="col-4">
				<button type="button" id="myBtn" class="myBtn button buttonB open-button btnEnable" data-color="red" onclick="openForm(this)">Red</button>
			</div>
			
		</div>
	  </div>
	<ul data-v-31885ec9="" class="center_notes">
		
		<li data-v-31885ec9="">
			<ol data-v-31885ec9="" id="myBtn" class="myBtn buttonn buttonC open-button btnEnable" value="1" onclick="openForm(this)">1</ol>
		</li>
		<li data-v-31885ec9="">
			<ol data-v-31885ec9="" id="myBtn" class="myBtn buttonn buttonC open-button btnEnable" value="2" onclick="openForm(this)">2</ol>
		</li>
		<li data-v-31885ec9="">
			<ol data-v-31885ec9="" id="myBtn" class="myBtn buttonn buttonC open-button btnEnable" value="3" onclick="openForm(this)">3</ol>
		</li>
		<li data-v-31885ec9="">
			<ol data-v-31885ec9="" id="myBtn" class="myBtn buttonn buttonC open-button btnEnable" value="2" onclick="openForm(this)">4</ol>
		</li>
		<li data-v-31885ec9="">
			<ol data-v-31885ec9=""id="myBtn" class="myBtn buttonn buttonC open-button btnEnable" value="5" onclick="openForm(this)">5</ol>
		</li>
		<li data-v-31885ec9="">
			<ol data-v-31885ec9="" id="myBtn" class="myBtn buttonn buttonC open-button btnEnable" value="2" onclick="openForm(this)">6</ol>
		</li>
		<li data-v-31885ec9="">
			<ol data-v-31885ec9=""id="myBtn" class="myBtn buttonn buttonC open-button btnEnable" value="7" onclick="openForm(this)">7</ol>
		</li>
		<li data-v-31885ec9="">
			<ol data-v-31885ec9="" id="myBtn" class="myBtn buttonn buttonC open-button btnEnable" value="2" onclick="openForm(this)">8</ol>
		</li>
		<li data-v-31885ec9="">
			<ol data-v-31885ec9=""id="myBtn" class="myBtn buttonn buttonC open-button btnEnable" value="9" onclick="openForm(this)">9</ol>
		</li>
		<li data-v-31885ec9="">
			<ol data-v-31885ec9="" id="myBtn" class="myBtn buttonn buttonC open-button btnEnable" value="0" onclick="openForm(this)">0</ol>
		</li>
	</ul>	  
	  <!--<div class="container" style="margin-left: 10px;">
		<div class="row">
			<button type="button" id="myBtn" class="myBtn buttonn buttonA open-button btnEnable" value="1" onclick="openForm(this)">1</button>
			<button type="button" id="myBtn" class="myBtn buttonn buttonB open-button btnEnable" value="2" onclick="openForm(this)">2</button>
			<button type="button" id="myBtn" class="myBtn buttonn buttonA open-button btnEnable" value="3" onclick="openForm(this)">3</button>
			<button type="button" id="myBtn" class="myBtn buttonn buttonB open-button btnEnable" value="4" onclick="openForm(this)">4</button>
			<button type="button" id="myBtn" class="myBtn buttonn buttonD open-button btnEnable extclsf" value="5" onclick="openForm(this)">5</button>
			
			<button type="button" id="myBtn" class="myBtn buttonn buttonB open-button btnEnable" value="6" onclick="openForm(this)">6</button>
			<button type="button" id="myBtn" class="myBtn buttonn buttonA open-button btnEnable" value="7" onclick="openForm(this)">7</button>
			<button type="button" id="myBtn" class="myBtn buttonn buttonB open-button btnEnable" value="8" onclick="openForm(this)">8</button>
			<button type="button" id="myBtn" class="myBtn buttonn buttonA open-button btnEnable" value="9" onclick="openForm(this)">9</button>
			<button type="button" id="myBtn" class="myBtn buttonn buttonD open-button btnEnable extcls" value="0" onclick="openForm(this)">0</button>
	    </div>
	  </div>-->
	  <div class="form-popup" id="myForm">
  <form action="#" id='ogform' class="form-container">
    <div id="btndiv"> </div>
	<label for="Amount"><b>Amount</b></label>
    <input type="text" placeholder="Enter Amount" id='betamount' name="Amount" required>
    
    <button type="submit" id="betsubmit" class="btn">Submit</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
</div>

<div data-v-36d08a7e="" class="agree_zz" style="display:none;">
   <div data-v-36d08a7e="" class="wrapper">
      <p data-v-36d08a7e="" class="branch_title" style="background: rgb(76, 175, 80);">Join Green</p>
      <div data-v-36d08a7e="" class="branch_content">
         <p data-v-36d08a7e="" class="money">Contract Money</p>
         <div data-v-36d08a7e="" class="choose_money">
            <ul data-v-36d08a7e="" id="sizelist">
               <li data-v-36d08a7e="" data-value="10" class="active"><a href="#">10</a></li>
               <li data-v-36d08a7e="" data-value="100" class="">	 <a href="#">100</a></li>
               <li data-v-36d08a7e="" data-value="1000" class="">	 <a href="#">1000</a></li>
               <li data-v-36d08a7e="" data-value="10000" class="">	 <a href="#">10000</a></li>
            </ul>
         </div>
         <p data-v-36d08a7e="" class="money">Number</p>
         <div data-v-36d08a7e="" class="stepper">
            <div data-v-36d08a7e="" class="van-stepper">
				<button type="button" id="targetmin" class="fa fa-minus"></button>
				<input type="text" id="output2" value="1" style="border:none;text-align:center;width: 27px;" role="spinbutton" inputmode="decimal" aria-valuemax="Infinity" aria-valuemin="1" aria-valuenow="1" class="van-stepper__input">
				<button type="button" id="targetplus" class="fa fa-plus"></button>
			</div>
         </div>
         <p data-v-36d08a7e="" class="money">Total contract money is <span data-v-36d08a7e=""  id="content-container">10</span></p>
         <div data-v-36d08a7e="" class="agree_box">
            <div data-v-36d08a7e="" role="checkbox" tabindex="0" aria-checked="true" class="van-checkbox">
               <div class="van-checkbox__icon van-checkbox__icon--square van-checkbox__icon--checked">
                  <i class="van-icon van-icon-success" style="border-color: rgb(0, 0, 0); background-color: rgb(0, 0, 0);">
                     <!---->
                  </i>
               </div>
               <span class="van-checkbox__label" id="lowbalwarn"></span>
            </div>
         </div>
         <div data-v-36d08a7e="" class="close_btn">
			<button data-v-36d08a7e="" onclick="closeForm()">CANCEL</button>
			<button data-v-36d08a7e="" style="color: rgb(0, 137, 123);" id="betsubmit" onclick="sendBdata()">CONFIRM</button>
		</div>
      </div>
   </div>
</div>

	  </br>
	  <div class="container">
		 <div class="row">
			<div class="col-4">
				<i class="fa fa-trophy fa-2x" style="float:right;    margin-top: 3px;"></i>
			</div>
			<div class="col-8">
				<h4 style = "text-align:center; color:red;float:left">Result Record</h4>
			</div>
		</div>
		
		<table id="allrecords" class="table table-striped table-bordered table-sm" style="width:100%">
		  <thead>
			<tr>
				<th>Period</th>
				<th>Price</th> 
				<th>Number</th>
				<th>Result</th>
			</tr>
		  </thead>
		  <tbody>
			
		  </tbody>
		</table>
	  </div></br>
	  <div  class="container">
		<div class="row">
			<div class="col-4">
				<i class="fa fa-clipboard fa-2x" style="float:right;    margin-top: 3px;"></i>
			</div>
			<div class="col-8">
				<h4 style = "text-align:center; color:red;float:left">My Record</h4>
			</div>
		</div>
		  
		<table id="myrecords" class="table dt-responsive table-striped table-bordered table-sm" style="width:100%">
			<thead>
			<tr>
				<th>Period</th>
				<th>Price</th> 
				<th>Result</th>
				<th>Amount</th>
				<th>Color</th>
				<th>Number</th>
				<th>Created at</th>
				<th>Fee</th>
			</tr>
			</thead>
			<tbody>
			
			</tbody>
		</table>
	  </div>
      <footer class="mastfoot my-3">
         <div class="inner container">
            <div class="row">
               <div class="col-lg-4 col-md-12 d-flex align-items-center">
               </div>
               <div class="col-lg-4 col-md-12 d-flex align-items-center">
                  <p class="mx-auto text-center mb-0">&copy; 2021 Design by <a href="https://bigtechinc.xyz" target="_blank">BigTech Inc</a>.</p>
               </div>
               
            </div>
         </div>
      </footer>
      <!-- External JS -->
      <!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script> -->
      <script src="js/jquery.min.js"></script>
      <script src="vendor/bootstrap/popper.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
      <script src="vendor/bootstrap/bootstrap.min.js"></script>
      <script src="vendor/select2/select2.min.js "></script>
      <script src="vendor/owlcarousel/owl.carousel.min.js"></script>
      <script src="vendor/stellar/jquery.stellar.js" type="text/javascript" charset="utf-8"></script>
      <script src="vendor/isotope/isotope.min.js"></script>
      <script src="vendor/lightcase/lightcase.js"></script>
      <script src="vendor/waypoints/waypoint.min.js"></script>
	  
	  <script src="datatables/dataTables.js"></script>
<!--<script src="datatables/jquery.dataTables.min.js"></script>-->
<script src="datatables/dataTables.bootstrap.js"></script>
<script src="datatables/dataTables.responsive.js"></script>
	  <script>

function startTimer(duration, display) {
	var timer = duration, minutes, seconds;
	setInterval(function () {
		minutes = parseInt(timer / 60)
		seconds = parseInt(timer % 60);
		minutes = minutes < 10 ? "0" + minutes : minutes;
		seconds = seconds < 10 ? "0" + seconds : seconds;
		display.textContent = minutes + " :" + " " + seconds;
	
		if (--timer < 0) {
			timer = duration;
			}
		
		if (timer <= 30) {
			$(".myBtn").attr('disabled','disabled');
			$(".myBtn").addClass('btnDisable').removeClass("btnEnable");
			$(".myBtn").removeClass("extcls");
			$(".myBtn").removeClass("extclsf");
			document.getElementById("myForm").style.display = "none";
			myBtn.innerHTML = "Can't click now";
			return;
		}else if(timer > 30) {
			$(".myBtn").removeAttr('disabled');
			$(".myBtn").addClass('btnEnable').removeClass("btnDisable");
			myBtn.innerHTML = "click now";
			//window.location.reload();
			return;
		}else {
			console.log(timer);

		}
	}, 1000);
}

window.onload = function () {
 
	if(<?php echo $timer;?> <= 120){
		var fiveMinutes = <?php echo 120 - $timer;?>;
		display = document.querySelector('#time');
		startTimer(fiveMinutes, display);
		setTimeout(function(){ window.location.reload() }, fiveMinutes*1000);
	}
	getMyGame();
	getAllGame();
	//setTimeout(function(){
   //window.location.reload(1);
//}, 2000);

};

function reloadpage(){
	window.location.reload();
}

function getMyGame(){
	var fd = new FormData()
	fd.append('action', 'getMyGame');
	fd.append('userid', <?php echo $_SESSION['_id']?>);
	$.ajax({
        type: 'POST',
        url: 'loginback.php',
        data: fd, //({action: 'getMyGame', userid: <?php echo $_SESSION['_id'] ?>}),
        contentType: false,
        cache: false,
        processData:false,
        beforeSend: function(){
            $('.submitBtn').attr("disabled","disabled");
            $('#fupForm').css("opacity",".5");
        },
        success: function(msg){
			var msg2 = JSON.parse(msg);
            var arrcount = msg2.length;
			var html;
			for(var i = 0; i<arrcount; i++){
				html += "<tr><td>"+msg2[i]['NEWGAME_ID']+"</td>";
				if(msg2[i]['BET_RESULT_AMOUNT'] != 0){
					if(msg2[i]['BET_RESULT'] == 'Win'){
						html += "<td style='color:green;'>+"+msg2[i]['BET_RESULT_AMOUNT']+"</td>";
						html += "<td style='color:green;'>"+msg2[i]['BET_RESULT']+"</td>";
						html += "<td style='color:green;'>"+msg2[i]['BET_AMOUNT']+"</td>";
						html += "<td style='color:green;'>"+msg2[i]['BET_COLOR']+"</td>";
						html += "<td style='color:green;'>"+msg2[i]['BET_NUMBER']+"</td>";
						html += "<td style='color:green;'>"+msg2[i]['CREATED_AT']+"</td>";
						html += "<td style='color:green;'>"+msg2[i]['BET_FEE']+"</td></tr>";
					}else{
						html += "<td style='color:red;'>-"+msg2[i]['BET_RESULT_AMOUNT']+"</td>";
						html += "<td style='color:red;'>"+msg2[i]['BET_RESULT']+"</td>";
						html += "<td style='color:red;'>"+msg2[i]['BET_AMOUNT']+"</td>";
						html += "<td style='color:red;'>"+msg2[i]['BET_COLOR']+"</td>";
						html += "<td style='color:red;'>"+msg2[i]['BET_NUMBER']+"</td>";
						html += "<td style='color:red;'>"+msg2[i]['CREATED_AT']+"</td>";
						html += "<td style='color:red;'>"+msg2[i]['BET_FEE']+"</td></tr>";
					}
				}else{
					html += "<td>---</td>";
					html += "<td>"+msg2[i]['BET_RESULT']+"</td>";
					html += "<td>"+msg2[i]['BET_AMOUNT']+"</td>";
					html += "<td>"+msg2[i]['BET_COLOR']+"</td>";
					html += "<td>"+msg2[i]['BET_NUMBER']+"</td>";
					html += "<td>"+msg2[i]['CREATED_AT']+"</td>";
					html += "<td>"+msg2[i]['BET_FEE']+"</td></tr>";
				}
			}
			$('#myrecords').append(html).DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": false,
                "info": true,
                "autoWidth": false,
                "sDom": 'lfrtip'
            });
			//console.log(msg2);  
		}
	});
}
//get all game
function getAllGame(){
	var fd = new FormData()
	fd.append('action', 'getAllGame');
	//fd.append('userid', <?php echo $_SESSION['_id']?>);
	$.ajax({
        type: 'POST',
        url: 'loginback.php',
        data: fd, //({action: 'getMyGame', userid: <?php echo $_SESSION['_id'] ?>}),
        contentType: false,
        cache: false,
        processData:false,
        beforeSend: function(){
            $('.submitBtn').attr("disabled","disabled");
            $('#fupForm').css("opacity",".5");
        },
        success: function(msg){
			var msg2 = JSON.parse(msg);
            var arrcount = msg2.length;
			var html;
			
			for(var i = 0; i<arrcount; i++){
				if(msg2[i]['RESULT'] != 'pending'){
					html += "<tr><td style='vertical-align: middle;'>"+msg2[i]['NEWGAME_ID']+"</td>";
					html += "<td>"+msg2[i]['TOTAL_PRICE']+"</td>";
					html += "<td>"+msg2[i]['RESULT_NUMBER']+"</td>";
					if(msg2[i]['RESULT_NUMBER'] == 0 && msg2[i]['RESULT_COLOR'] == 'violet'){
						html += "<td style='text-align:center;'><div style='border-radius: 20%;' class='icon'> </div><div style='border-radius: 20%;' class='icon2'> </div></td>";
					}else if(msg2[i]['RESULT_NUMBER'] == 5 && msg2[i]['RESULT_COLOR'] == 'violet'){
						html += "<td style='text-align:center;'><div style='border-radius: 20%;' class='icon1'> </div><div style='border-radius: 20%;' class='icon2'> </div></td>";
					}else if(msg2[i]['RESULT_COLOR'] == 'green'){
						html += "<td style='text-align:center;'><div style='border-radius: 20%;' class='icon1'> </div></td>";
					}else{
						html += "<td style='text-align:center;'><div style='border-radius: 20%;' class='icon'> </div></td>";
					}
					html += "</tr>";
				}
			}
			$('#allrecords').append(html).DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": false,
                "info": true,
                "autoWidth": false,
                "sDom": 'lfrtip'
            });
			//console.log(msg2[14]);
				//console.log(msg2[14]['TOTAL_PRICE']);
		}
	});
}


$(document).ready(function(e){
    $("#ogform").on('submit', function(e){
        e.preventDefault();
		var gameno = $("#gameno").text();
        var getData;
		var fd = new FormData(this);
		//alert(fd);
		fd.append('userid', <?php echo $_SESSION['_id']?>);
		fd.append('gameno', gameno);
		fd.append('btnVal', btnVal);
		fd.append('btnColor', btnColor);
		fd.append('action', 'bet');
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
					    $('.msg').text('Bet not placed, refresh page');
					}
			}
        });
    });
   
});
	  </script>
	  <div class="modal fade" id="modelWindow" role="dialog">
            <div class="modal-dialog modal-sm vertical-align-center">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Recharge</h4>
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  
                </div>
                <div class="modal-body">
                    Body text here
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                </div>
              </div>
            </div>
        </div>


	  <script>
	  //$(document).ready(function () {
  //$('#myrecords').DataTable();
  //$('.dataTables_length').addClass('bs-select');
//});
// $('#recharge').click(function() {
   // $('#modelWindow').modal('show');
// });
//$("#betamount").change(function(){
	
     
	 
function BusinessLogic(){
 var selText = $('#sizelist li.active a').text();

	return selText;
} 
$('#targetplus').click(function() {
    $('#output2').val(function(i, val) { return val*1+1 });
	$("#content-container").text($('#output2').val() * BusinessLogic());
});

$('#targetmin').click(function() {
    $('#output2').val(function(i, val) { 
		
    	if(val>=2){
			
    		return val*1-1;
        }else {
			return 1;
		}
    });
	$("#content-container").text($('#output2').val() * BusinessLogic());
});

$("#sizelist").on("click", 'a', function(e){
    e.preventDefault();
    var $this = $(this).parent();
    $this.addClass("active").siblings().removeClass("active");
	var finalval = $this.data("value") * $('#output2').val();
    $("#content-container").text(finalval);
});


	var btnVal;
	var btnColor;
	function openForm(e) {
		
		$('.agree_zz').show();
		
		btnVal = e.getAttribute("value");
		btnColor = e.getAttribute("data-color");
		if (!e.hasAttribute("value")) {
			btnVal = null;
		}
		if(btnColor == 'green'){
			$(".branch_title").css({"background": "rgb(35, 243, 25)"});
			$(".branch_title").text('Join ' + btnColor);
		}else if(btnColor == 'red'){
			$(".branch_title").css({"background": "rgb(251, 15, 0)"});
			$(".branch_title").text('Join ' + btnColor);
		}else if(btnColor == 'violet'){
			$(".branch_title").css({"background": "rgb(35, 243, 211)"});
			$(".branch_title").text('Join ' + btnColor);
		}else{
			$(".branch_title").css({"background": "rgb(51, 178, 255)"});
			$(".branch_title").text('Join ' + btnVal);
		}			
	}

	function closeForm() {
		$('.agree_zz').hide();
	}
function disen() {
	alert('ok');
	$('#betsubmit').attr('disabled','disabled');
	  if(0 > <?php echo $amt; ?>){
        /*if it is*/
		 $('#betsubmit').prop('disabled', true);
		 //$('#content-container').prop('disabled', true);
		 $('#betsubmit').text('Low Balance');
		 $("#betsubmit").css({"backgroundColor":"black","color":"white"});
		 console.log(<?php echo $amt; ?>);
      }else{
		$('#content-container').on('input', function() {
			if(parseInt('#content-container'.value) > <?php echo $amt; ?>){
				$('#betsubmit').prop('disabled', true);
				//$('#betamount').prop('disabled', true);
				$('#betsubmit').text('Low Balance');
				$("#betsubmit").css({"backgroundColor":"black","color":"white"});
			}else{
				//alert('ok');
				$('#betsubmit').prop('disabled', false);
				$('#content-container').prop('disabled', true);
				$('#betsubmit').text('Submit');
				$("#betsubmit").css({"backgroundColor":"#04AA6D","color":"white"});
				console.log(<?php echo $amt; ?>);
			}
		});
	 }
};
	
	function sendBdata(){
		var gameno = $("#gameno").text();
		var Amount = $("#content-container").text();
		
		var fd = new FormData();
		//alert(fd);
		fd.append('userid', <?php echo $_SESSION['_id']?>);
		fd.append('gameno', gameno);
		fd.append('Amount', Amount);
		fd.append('btnVal', btnVal);
		fd.append('btnColor', btnColor);
		fd.append('action', 'bet');
		if(Amount < <?php echo $amt; ?>){
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
							//closeForm();
							//$('.msg').text('Bet placed');
							window.location.reload();
						}else{
							$('.msg').text('Bet not placed, refresh page');
						}
				}
			});
		}else{
			//alert('No balance');
			$("#lowbalwarn").text('Low Balance to play, Please recharge');
		}
}
</script>
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
<?php
	}else{
		$_SESSION['message'] =  "Login to access dashboard"; 
		header("location:./home.php");
	}	
?>