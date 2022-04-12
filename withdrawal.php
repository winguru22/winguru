<?php
	session_start();
	$mybal = $_SESSION['balance'];
	$db_host="localhost";
	$db_username="root";
	$db_pass="";
	$db_name="colgame";
	
	$conn = mysqli_connect("$db_host","$db_username","$db_pass","$db_name") or die("error occurred");
	$i = $_SESSION['_id'];
	$sql = "SELECT WALLET_AMOUNT, RECHARGE_CYCLE from wallet where USER_ID=$i";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$wamt = $row['WALLET_AMOUNT'];
	 $rechargecycle = $row['RECHARGE_CYCLE'];
	//echo $rechargecycle = "'".$rechargecycle."'";
	$userid = $_SESSION['_id'];
	$sql = "SELECT BANK_ID, FIRSTNAME, ACCOUNTNO from banks WHERE USER_ID=$userid";
	$result = mysqli_query($conn, $sql);
	$rows = array();
	while($row = mysqli_fetch_assoc($result)){
		//print_r($row);
		$rows[] = $row;
	}
?>
<html lang="en" style="font-size: 32px;">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width,initial-scale=1">
      <link rel="icon" href="favicon.ico">
      <title>Game With</title>

	   <link rel="stylesheet" href="css/font-awesome.min.css">
	   <link href="css/app.css" rel="stylesheet">
	   
	   <style>
			#notification {
    position:fixed;
    top:54px;
    width:100%;
    z-index:105;
    text-align:center;
    font-weight:normal;
    font-size:14px;
    font-weight:bold;
    color:white;
    background-color:#FF7800;
    padding:5px;
}
#notification span.dismiss {
    border:2px solid #FFF;
    padding:0 5px;
    cursor:pointer;
    float:right;
    margin-right:10px;
}
#notification a {
    color:white;
    text-decoration:none;
    font-weight:bold
}
	   </style>
	   
   </head>
   <body style="font-size: 24px;">
      <noscript><strong>We're sorry but default doesn't work properly without JavaScript enabled. Please enable it to continue.</strong></noscript>
      <div data-v-51265586="" class="recharge">
         <nav data-v-51265586="" class="top_nav">
            <div data-v-51265586="" class="left"><a href="profile.php"><i class='fa fa-arrow-left fa-2x' style="margin-right:15px; color:white;" ></i></a><span data-v-51265586="">Withdrawal</span></div>
            <div data-v-be68bb7c="" class="right"><a href="paymentlist.php"><i class='fa fa-list fa-2x' style="margin-right:15px; color:white;" ></i></a></div>
         </nav>
         <div data-v-51265586="" class="recharge_box">
            <p data-v-51265586="" class="top_text">Balance: ₹ <span data-v-51265586=""><?php echo $mybal; ?></span></p>
            
            
            <div data-v-51265586="" class="code_input_box">
               <div data-v-51265586="" class="code_input"><i class="fa fa-cc-paypal fa-2x" style="margin-right:10px;"></i><input data-v-51265586="" type="text" id="withamt" placeholder="Enter withdrawal amount"></div>
            </div>
            <div data-v-51265586="" class="text_field">
               <p data-v-51265586="">Fee: <span data-v-51265586="" id="withdrawfee">0</span>,to account <span data-v-51265586="" id="withdrawtobank">0</span></p>
            </div>
            <div data-v-51265586="" class="payment_box">
               <p data-v-51265586="" class="payment_text">Payout</p>
               <div data-v-51265586="" role="radiogroup" class="van-radio-group">
                    <span style="display:block">
						<input data-v-51265586="" type="radio" class='radi' id="radi" name='radi' value='bank'>
						<label for="bank" style="margin-left:20px;">BANK</label>
					</span>
					<span  style="display:block">
						<input data-v-51265586="" type="radio" class='radi' id="radi" name='radi' value='upi'>
						<label for="upi" style="margin-left:20px;">UPI</label> 
					</span>
               </div>
            </div>
            <div data-v-51265586="" class="add_card">
               <div data-v-51265586="" class="van-collapse van-hairline--top-bottom">
                  <div data-v-51265586="" class="van-collapse-item">
                     <div role="button" tabindex="0" aria-expanded="false" onclick="dropdownShow()" id="selban" class="van-cell van-cell--clickable van-collapse-item__title">
                        <div class="van-cell__title">
                           <i class="fa fa-credit-card fa-2x"  style="margin-right:10px;"></i>
                           <div data-v-51265586="" style="margin-top:7px" class="nav_name" >Select Bank Card</div>
                        </div>
                        <i id="arrow" class="fa fa-arrow-down">
                           <!---->
                        </i>
                     </div>
					 
					 <div class="van-collapse-item__wrapper" id="banklist" style="display: none;">
						<div class="van-collapse-item__content" id='banklistt'>
							<?php 
								//print_r($rows);
								//foreach($rows as $k => $v){
								//	$bankid = $v['BANK_ID'];
								//	$display =  $v['FIRSTNAME']. "   ***".substr($v['ACCOUNTNO'], -4);
								//	echo "<div data-v-51265586='' class='nav_content' value=$bankid >".$display."</div>";
								//}
							?>
							<!--<div data-v-51265586="" class="nav_content">deep 123**678</div>
							<div data-v-51265586="" class="nav_content">sbi 231*****654</div>-->
							<a href="banklist.php" style="text-decoration: none;"><div data-v-51265586="" class="nav_content">Add Bank Card</div></a>
						</div>
					</div>
                  </div>
               </div>
            </div>
			<div id="bimsg"></div>
            <div data-v-51265586="" class="code_input_box">
               <div data-v-51265586="" class="code_input"><i class="fa fa-key fa-2x"  style="margin-right:10px;"></i><input data-v-51265586  type="password" id="password" placeholder="Enter your login password" ></div>
			   
            </div>
			<div id="pswmsg"></div>
			<p data-v-51265586="" class="top_text" style="font-size:15px;padding-bottom:0;">Minimum withdraw amount ₹ 350.</p>
            <div data-v-51265586="" class="recharge_btn"><button data-v-51265586="" id="withbtn">Withdrawal</button></div>
         </div>
         
         <div data-v-74fec56a="" data-v-51265586="" class="loading" style="display: none;">
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
      </div>
	  <div data-v-405e9a63="" data-v-d2db546c="" class="footer">
    <ul data-v-405e9a63="" class="nav_foot">
       <li data-v-405e9a63="" class=""><a href="./home.php"><i class="fa fa-home fa-2x"></i><span data-v-405e9a63=""><br> Home</span></a></li>
       <li data-v-405e9a63="" class=""><a href="./home.php"><i class="fa fa-search fa-2x"></i><span data-v-405e9a63=""><br>Search</span></a></li>
       <li data-v-405e9a63="" class=""><a href="./"><i class="fa fa-trophy fa-2x"></i><span data-v-405e9a63=""><br>Win</span></a></li>
       <li data-v-405e9a63="" class="active"><a href="profile.php"><i class="fa fa-user fa-2x"></i><span data-v-405e9a63=""><br>My</span></a></li>
    </ul>
</div>
<div id="notification" style="display: none;">Check your info and try again
  <span class="dismiss"><a title="dismiss this notification">x</a></span>
</div>
		<script src="js/jquery.min.js"></script>
<script>
	function dropdownShow() {
			if($("#arrow").not(this).hasClass("fa-arrow-down")) {
				$("#arrow").not(this).toggleClass('fa-arrow-down fa-arrow-up');
			}else{
				$("#arrow").not(this).toggleClass('fa-arrow-down fa-arrow-up');			 
			}
			$('#banklist').toggle();
			
		};
	
	$(function () {
		
		$('#banklistt').on('click','.nav_content', function () {
			
			var bankVal = $(this).text();
			var bankId = $(this).attr( 'value');
			$('.nav_name').attr( 'value',bankId);
			$('.nav_name').text(bankVal);
			$('#bimsg').css({"display": "none"});
			dropdownShow();
		});
		var amt = <?php echo $mybal; ?>;
		if(amt < 350){
			$('#withbtn').attr('disabled', 'disabled');
			$('#withbtn').css({"backgroundColor": "#9a9393", "color": "white"});
			
		}
		
		//if($('.nav_name').attr('value') == undefined){
		//	$('#withbtn').attr('disabled', 'disabled');
		//	$('#withbtn').css({"backgroundColor": "#9a9393", "color": "white"});
		//}
	});
	
	$('#withamt').on('input', function() {
		if('#'){
		
		}
		var withdrawamt = $(this).val();
		var withdrawfee = withdrawamt * 5 /100;
		//if(withdrawamt < 350){
			//$('#withbtn').attr('disabled', 'disabled');
			//$('#withbtn').css({"backgroundColor": "#9a9393"});
		//}
		
		$("#withdrawfee").text(withdrawfee);
		var withdrawToBank = withdrawamt - withdrawfee;
		
		$("#withdrawtobank").text(withdrawToBank);
		//alert('<?php echo $rechargecycle; ?>');
		if((withdrawamt > <?php echo $mybal; ?> || withdrawamt < 350 ) || <?php echo "'".$rechargecycle."'"; ?> === 'F'){
			//alert('low bal');
			$('#withbtn').attr('disabled', 'disabled');
			$('#withbtn').css({"backgroundColor": "#9a9393"});
			
		}else{
			//alert('done');
			$('#withbtn').removeAttr("disabled");
			$('#withbtn').css({"backgroundColor": ""});
			
		}
	});
	$('#password').on('input', function() {
		$('#pswmsg').hide();
	});
	
	
	$(".dismiss").click(function(){
       $("#notification").fadeOut("slow");
});

//setTimeout(function() { $("#notification").hide(); }, 5000);
	// $("#sizelist").on("click", 'a', function(e){
    // e.preventDefault();
    // var $this = $(this).parent();
    // $this.addClass("active").siblings().removeClass("active");
	// var finalval = $this.data("value") * $('#output2').val();
    // $("#content-container").text(finalval);
// });

	$('.radi').on("click", function(){
		var btval = $(this).val();
		//alert(btval);
		var fd = new FormData();
		fd.append('action', 'getpaymlist');
			fd.append('paymtype', btval);
			fd.append('userid', "<?php echo $_SESSION['_id']; ?>");
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
				//alert('done');
				var msg2 = JSON.parse(msg);
				
				var selOpts = "";
				//console.log(msg2);
				$.each(msg2, function(k, v){
					
					var name = msg2[0].FIRSTNAME;
					if(btval === 'bank'){
						var id = msg2[0].BANK_ID;
						var account = msg2[0].ACCOUNTNO;
					}else{
						var id = msg2[0].UPILIST_ID;
						account = msg2[0].UPI_ID;
					}
					
					
					selOpts += 	"<div data-v-51265586='' class='nav_content' value="+id+" >"+name +" - "+account+"</div>";
				});
				$('#banklistt').empty();
				selOpts += "<a href='banklist.php' style='text-decoration: none;'><div data-v-51265586='' class='nav_content'>Add Bank Card</div></a>";
				$('#banklistt').prepend(selOpts);
				
			}
		});
	});
			$(document).ready(function(){
				$('#withbtn').attr('disabled', 'disabled');
			$('#withbtn').css({"backgroundColor": "#9a9393", "color": "white"});
		$("#withbtn").on('click', function(){
			
			var fd = new FormData();
			var bankid = $('.nav_name').attr('value');
			fd.append('userid', "<?php echo $_SESSION['_id']; ?>");
			fd.append('action', 'withdrawreq');
			fd.append('bankid', bankid);
			
			var fee = $("#withdrawfee").text();
			var amounttobank = $("#withdrawtobank").text();
			var password = $("#password").val();
			var payMtype = $('input[name="radi"]:checked').val();
			fd.append('paymethod', payMtype);
			fd.append('password', password);
			fd.append('fee', fee);
			fd.append('amounttobank', amounttobank);
			console.log(fd);
			if(password !== '' && bankid !== undefined){
				$.ajax({
					type: 'POST',
					url: 'loginback.php',
					data: fd,
					contentType: false,
					cache: false,
					processData:false,
					beforeSend: function(){
						$('#withbtn').attr("disabled","disabled");
						$('#withbtn').css("backgroundColor", "#9a9393");
					},
					success: function(msg){
						//console.log(msg); 
						if(msg == 'success'){
							//window.location.href = './paymentlist.php';
						}else if(msg == 'password' ){
							$("#notification").text("Wrong Password");
							$("#notification").fadeIn("slow");
							$(function() {
								setTimeout(function() {
									$("#notification").hide()
								}, 5000);
							});
							//$('#msg').text('Hit some error, Please try again');
						}else{
							$("#notification").fadeIn("slow");
							$(function() {
								setTimeout(function() {
									$("#notification").hide()
								}, 5000);
							});
						}
					}
				});
				
			}else{
				if(password === '' && bankid === undefined){
					$('#pswmsg').text('Password can not be blank');
					$('#pswmsg').show();
					$('#bimsg').text('Select bank first');
				}else if(bankid === undefined){
					$('#bimsg').text('Select bank first');
				}else if(password === ''){
					$('#pswmsg').text('Password can not be blank');
					$('#pswmsg').show();
					
					//$('#bimsg').text('Select bank first');
				}
			}
		});
   
	});
			
		</script>
   </body>
</html>
