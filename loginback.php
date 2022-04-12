<?php
//print_r($_REQUEST);
//$data = json_decode(file_get_contents('php://input'), true);
session_start();
$db_host="localhost";
$db_username="root";
$db_pass="";
$db_name="colgame";

$conn = mysqli_connect("$db_host","$db_username","$db_pass","$db_name") or die("error occurred");
//$data;

if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'sign'){
//print_r($_REQUEST);
//$data = $_REQUEST;
	function random_strings($length_of_string) { 
		$str_result = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz'; 
		return substr(str_shuffle($str_result), 0, $length_of_string); 
	} 
	
	// This function will generate 
	// Random string of length 10 
	$refcode =   substr($_REQUEST['Mobile_No'], -5) . random_strings(5);
	//$otp =rand(100000,999999);
	//echo $refcode;
	$name=$_POST['Username'];
	$mobile = $_POST['Mobile_No'];
	$pass = $_POST['psw'];
	$refco = $_POST['refcode'];
	$sql = "SELECT USER_ID from users where REFERRAL_CODE='$refco'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$referredby = $row['USER_ID'];
	
                              
	
	
	date_default_timezone_set('Asia/Kolkata'); 
	$createdate =  date("Y-m-d H:i:s");
	$query = "SELECT * from users where Mobile_No = '$mobile'";
	$result = mysqli_query($conn, $query);
	$subname = substr($name, 0, 3);
	$refcode = $refcode . strtoupper($subname);
	//echo $refcode;
	if(mysqli_num_rows($result) == 0){
		
		if($refco != NULL){
			$query="INSERT INTO users(USERNAME,MOBILE_NO,MOBILE_NO_VERIFIED,PASSWORD,REFERRAL_CODE,REFERRED_BY,ROLE,CREATED_AT,ACTIVE) VALUES ('$name','$mobile','No','$pass','$refcode','$referredby',0,'$createdate','Y')";
			$data = mysqli_query($conn,$query)or die(mysqli_error($conn));
				if($data){
					
					$toPrint = "USER Created";
					$_SESSION['mobile'] = $mobile;
					$_SESSION['message'] =  $toPrint;
					$_SESSION['email'] = $email;
					//echo 'uc';
					$newuserid = mysqli_insert_id($conn); 
			
					date_default_timezone_set('Asia/Kolkata'); 
					$createdate =  date("Y-m-d H:i:s");
					
					$sql = "INSERT into wallet(USER_ID, CREATED_AT) VALUES($newuserid, '$createdate')";
					$result= mysqli_query($conn, $sql);
					
						echo 'uc';
					
				}else{
					echo 'unc';
				}
			//header("location:./verify.php");
		}else{
			$query="INSERT INTO users(USERNAME,MOBILE_NO,MOBILE_NO_VERIFIED,PASSWORD,REFERRAL_CODE,ROLE,CREATED_AT,ACTIVE) VALUES ('$name','$mobile','No','$pass','$refcode',0,'$createdate','Y')";
			$data = mysqli_query($conn,$query)or die(mysqli_error($conn)); 
			if($data){
					
					$toPrint = "USER Created";
					$_SESSION['mobile'] = $mobile;
					$_SESSION['message'] =  $toPrint;
					$_SESSION['email'] = $email;
					//echo 'uc';
					$newuserid = mysqli_insert_id($conn); 
			
					date_default_timezone_set('Asia/Kolkata'); 
					$createdate =  date("Y-m-d H:i:s");
					
					$sql = "INSERT into wallet(USER_ID, CREATED_AT) VALUES($newuserid, '$createdate')";
					$result= mysqli_query($conn, $sql);
					
						echo 'uc';
					
				}else{
					echo 'unc';
				}
		}
		
		
	}else{
			$_SESSION['message'] =  "USER already exist"; 
			echo 'du';
			//header("location:./singup.html");
	}

}else if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'verify'){
	//$otp = 6247;
	$mono = $_REQUEST['mono'];
	$sql = "SELECT USER_ID,OTP from tempusers where MOBILE_NO=$mono";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	//echo $row['OTP'];
	$userid = $row['USER_ID'];
	if($_REQUEST['otp'] == $row['OTP']){
		//echo json_encode($_REQUEST);
		
		$sql = "INSERT INTO `users`(`USERNAME`, `MOBILE_NO`, `MOBILE_NO_VERIFIED`, `PASSWORD`, `REFERRAL_CODE`, `REFERRED_BY`, `ROLE`, `CREATED_AT`, `ACTIVE`) SELECT `USERNAME`, `MOBILE_NO`, 'YES', `PASSWORD`, `REFERRAL_CODE`, `REFERRED_BY`, 0 ,`CREATED_AT`, `ACTIVE` FROM `tempusers` WHERE USER_ID = $userid";
		$result = mysqli_query($conn, $sql);
		if($result){
			$newuserid = mysqli_insert_id($conn); 
			
			date_default_timezone_set('Asia/Kolkata'); 
			$createdate =  date("Y-m-d H:i:s");
			
			$sql = "INSERT into wallet(USER_ID, CREATED_AT) VALUES($newuserid, '$createdate')";
			$result= mysqli_query($conn, $sql);
			$sql = "DELETE FROM `tempusers` WHERE `MOBILE_NO` = $mono";
			$result = mysqli_query($conn, $sql);
			if($result){
				echo 'success';
			}else{
				echo 'del query error';
			}
			
			
		}else{
			echo 'query errors';
		}
	}else{
		echo 'error';
	}
}
else if ($_REQUEST['action'] && $_REQUEST['action'] == 'login'){
	//echo json_encode($_REQUEST);
	//print_r($_REQUEST);
	$mobile = $_REQUEST['Mobile_No'];
	$pass = $_REQUEST['psw'];
	//echo $mobile . " ---- " . $pass;
	
	$sql2 = "select * from users where MOBILE_NO =$mobile";
	$rs1 = mysqli_query($conn, $sql2);
	if (mysqli_num_rows($rs1)!=1 ){
			session_start();
			$_SESSION['message'] =  "Wrong mobile no"; 
			//header("location:./login.html");
			//echo $sql2;
		echo "Wrong Mobile no";
		exit;
	}else{
		$row = mysqli_fetch_assoc($rs1);
		if($row['PASSWORD'] == $pass){
			echo 'logged in';
			
			session_start();
			$_SESSION['loggedin']= true;
			$_SESSION['_id']= $row['USER_ID'];
			$_SESSION['rc']= $row['REFCODE'];
			$SID = session_id();
			$request_header = json_encode($_SERVER);
			$sql3 = "INSERT INTO session_logs (USER_ID, SESSION_ID, DATE_TIME, REQUEST_HEADER) VALUES (".$row['USER_ID'].",'".$SID."','".date('Y-m-d H:i:s') ."','".$request_header."')";
			$sql4 = "INSERT INTO active_sessions (USER_ID, SESSION_ID) VALUES (".$row['USER_ID'].",'".$SID."')";
			$rs2 = mysqli_query($conn, $sql3);
			$rs3 = mysqli_query($conn, $sql4);
			if(!$rs2){
				echo "error";
			}else if($row['ROLE'] == 1){
				$_SESSION['role'] = 'admin';
				echo 'admin';
				//header("location:./admin/admindash.php");
			}else{
				$_SESSION['role'] = 'normal user';
				echo 'nornal';
				//header("location:./dashboard.php");
			}
			//header("Location:/");
			//exit();
				
		}else{
			session_start();
			$_SESSION['message'] =  "Wrong Password"; 
			//header("location:./login.php");
			echo 'Wrong Password'; // . " " .$sql2;
		}
	}
}else if ($_REQUEST['action'] && $_REQUEST['action'] == 'recharge'){
	$amount = $_REQUEST['amount'];
	$userid = $_REQUEST['userid'];
	//echo $amount ." ... ". $userid;
	date_default_timezone_set('Asia/Kolkata'); 
	$createdate =  date("Y-m-d H:i:s");
	
	$sql = "INSERT into tempwallet(USER_ID, WALLET_AMOUNT, CREATED_AT, PAY_STATUS) VALUES($userid, $amount, '$createdate', 'pending' )";
	$result = mysqli_query($conn, $sql);
	if($result){
		echo 'success';
	}else{
		echo 'error';
	}
}else if ($_REQUEST['action'] && $_REQUEST['action'] == 'upref'){
	//print_r($_REQUEST);
	$payrefno = $_REQUEST['payrefno'];
	$userid = $_REQUEST['userid'];
	$rechargeamt = $_REQUEST['rechargeamt'];
	
	$sql = "UPDATE tempwallet SET PAY_REF_ID=$payrefno WHERE USER_ID=$userid and WALLET_AMOUNT=$rechargeamt and PAY_STATUS='pending'";
	$result = mysqli_query($conn, $sql);
	if($result){
		echo 'success';
	}else{
		echo 'error';
	}
	
}else if ($_REQUEST['action'] && $_REQUEST['action'] == 'conpay'){
	//print_r($_REQUEST);
	$userid = $_REQUEST['userid'];
	$walletid = $_REQUEST['walletid'];
	
	$sql1 = "SELECT WALLET_AMOUNT from tempwallet where USER_ID=$userid and WALLET_ID=$walletid and PAY_REF_ID IS NOT NULL";
	$result1 = mysqli_query($conn, $sql1);
	$rows = mysqli_fetch_assoc($result1);
	if($result1 && mysqli_num_rows($result1) == 1){
		$sql2 = "SELECT WALLET_AMOUNT, RECHARGE_CYCLE from wallet where USER_ID=$userid";
		$result2 = mysqli_query($conn, $sql2);
		if($result2){
			$row = mysqli_fetch_assoc($result2);
			$rechargecycle = $row['RECHARGE_CYCLE'];
			$wamt = $row['WALLET_AMOUNT'];
			$uwamt = $wamt + $rows['WALLET_AMOUNT'];
			
			date_default_timezone_set('Asia/Kolkata'); 
			$updated =  date("Y-m-d H:i:s");
			$sql3 = "UPDATE `wallet` SET `WALLET_AMOUNT`=$uwamt,RECHARGE_CYCLE='FF', `UPDATED_AT`='$updated' WHERE USER_ID= $userid";
			$result3 = mysqli_query($conn, $sql3);
			if($result3){
				if($rechargecycle == 'F'){
					$sql4 = "SELECT REFERRED_BY from users WHERE USER_ID=$userid";
					$result4 = mysqli_query($conn, $sql4);
					$row = mysqli_fetch_assoc($result4);
					$referedby =  $row['REFERRED_BY'];
			
					$firstToRef = 20/100*$rows['WALLET_AMOUNT'];
					if($firstToRef > 1100){
						$firstToRef = 1100;
					}
					$sql5 = "SELECT WALLET_AMOUNT, REFER_EARNING from wallet where USER_ID=$referedby";
					$result5 = mysqli_query($conn, $sql5);
					if($result5){
						$row = mysqli_fetch_assoc($result5);
						$wamt = $row['WALLET_AMOUNT'];
						$ubyref = $wamt + $firstToRef;
						$reamt = $row['REFER_EARNING'];
						$reamtu = $reamt + $firstToRef;
						$sql6 = "UPDATE wallet SET REFER_EARNING=$reamtu where USER_ID=$referedby";
						$result6 = mysqli_query($conn, $sql6);
						if($result6){
							$sql7 = "UPDATE tempwallet SET PAY_STATUS='approved' where USER_ID=$userid AND WALLET_ID=$walletid";
							$result7 = mysqli_query($conn, $sql7);
							if($result7){
								echo 'success';
							}else{
								echo 'twerror';
							}
						}else{
							echo "rwuperror";
						}
					}else{
						echo 'grerror';
					}
				}else{
					$sql7 = "UPDATE tempwallet SET PAY_STATUS='approved' where USER_ID=$userid AND WALLET_ID=$walletid";
					$result7 = mysqli_query($conn, $sql7);
					if($result7){
						echo 'success';
					}else{
						echo 'twerror';
					}
				}
			}else{
				echo 'uwerror';
			}
		}else{
			echo 'gwerror';
		}
	}else{
		echo 'qerror';
	}
	
	
}else if($_REQUEST['action'] && $_REQUEST['action'] == 'bet'){
	//echo 'success';
	$amount = $_REQUEST['Amount'];
	$userid = $_REQUEST['userid'];
	$gameno = $_REQUEST['gameno'];
	$btnVal = $_REQUEST['btnVal'];
	$btnColor = $_REQUEST['btnColor'];
	$sqlngi = "SELECT NEWGAME_ID from newgame WHERE RESULT='pending'";
	$resultngi = mysqli_query($conn, $sqlngi);
	$row = mysqli_fetch_assoc($resultngi);
	$currentngi = $row['NEWGAME_ID'];
	//echo $currentngi;
	if($gameno == $currentngi){
		$betfee = (5 / 100) * $amount;
		$betamount = $amount - $betfee;
	
		date_default_timezone_set('Asia/Kolkata'); 
		$createdate =  date("Y-m-d H:i:s");
		
			$sql = "INSERT INTO mygame(NEWGAME_ID, USER_ID, BET_COLOR, BET_NUMBER, BET_AMOUNT,BET_FEE, BET_RESULT, CREATED_AT) VALUES ($gameno, $userid, '$btnColor', $btnVal, $betamount, $betfee, 'pending', '$createdate' )";
		
		
		$result = mysqli_query($conn, $sql);
		if(!$result){
			echo "error";
		}else{
			//echo "success";
			$firstLevel = 1.5/100*$betamount;
			//echo "\n";
			$secondLevel = 1/100*$betamount;
			//echo "\n";
			$thirdLevel = 0.5/100*$betamount;
			
			$sql0 = "SELECT REFERRED_BY from users WHERE USER_ID=$userid";
			$result0 = mysqli_query($conn, $sql0);
			if(!$result0){
				echo 'first level error';
			}else{
				$row0 = mysqli_fetch_assoc($result0); 
				$firstLevelRef = $row0['REFERRED_BY'];
				if($firstLevelRef != 0 && $firstLevelRef != null){
					$sqllo = "SELECT WALLET_AMOUNT from wallet where USER_ID=$firstLevelRef";
					$resultlo = mysqli_query($conn, $sqllo);
					$rowlo = mysqli_fetch_assoc($resultlo);
					$walletamtlo = $rowlo['WALLET_AMOUNT'];
					//echo "\n";
					$updatewalletamtlo = $walletamtlo + $firstLevel;
					
					$sqlloup = "UPDATE wallet SET WALLET_AMOUNT=$updatewalletamtlo where USER_ID=$firstLevelRef"; 
					$result = mysqli_query($conn,$sqlloup);
					if($result){
						//echo 'Level one wallet update done';
					}else{
						echo 'error in level one wallet update';
					}
				}
				if($firstLevelRef != 0 && $firstLevelRef != null){
					$sql1 = "SELECT REFERRED_BY from users WHERE USER_ID=$firstLevelRef";
					$result1 = mysqli_query($conn, $sql1);
					if(!$result1){
						echo 'second level error';
					}else{
						$row1 = mysqli_fetch_assoc($result1); 
						$secondLevelRef = $row1['REFERRED_BY'];
						
						if($secondLevelRef != 0 && $secondLevelRef != null){
							$sqlls = "SELECT WALLET_AMOUNT from wallet where USER_ID=$secondLevelRef";
							$resultls = mysqli_query($conn, $sqlls);
							$rowls = mysqli_fetch_assoc($resultls);
							$walletamtls = $rowls['WALLET_AMOUNT'];
							echo "\n";
							$updatewalletamtls = $walletamtls + $secondLevel;
							
							$sqllsup = "UPDATE wallet SET WALLET_AMOUNT=$updatewalletamtls where USER_ID=$secondLevelRef"; 
							$resultlsup = mysqli_query($conn,$sqllsup);
							if($resultlsup){
								echo 'Level two wallet update done';
							}else{
								echo 'error in level two wallet update';
							}
							//echo 'here';
						}
						if($secondLevelRef != 0 && $secondLevelRef != null){
							echo $sql2 = "SELECT    REFERRED_BY from users WHERE USER_ID=$secondLevelRef";
							$result2 = mysqli_query($conn, $sql2);
							if(!$result2){
								echo 'third level error';
							}else{
								$row2 = mysqli_fetch_assoc($result2); 
								$thirdLevelRef = $row2['REFERRED_BY'];
								
								if($thirdLevelRef != 0 && $thirdLevelRef != null){
									$sqllt = "SELECT WALLET_AMOUNT from wallet where USER_ID=$thirdLevelRef";
									$resultlt = mysqli_query($conn, $sqllt);
									$rowlt = mysqli_fetch_assoc($resultlt);
									$walletamtlt = $rowlt['WALLET_AMOUNT'];
									echo "\n";
									$updatewalletamtlt = $walletamtlt + $thirdLevel;
									
									$sqllsup = "UPDATE wallet SET WALLET_AMOUNT=$updatewalletamtlt where USER_ID=$thirdLevelRef"; 
									$resultlsup = mysqli_query($conn,$sqllsup);
									if($resultlsup){
										echo 'Level three wallet update done';
									}else{
										echo 'error in level three wallet update';
									}
								}
							}
						}
					}
				}
			}
			
			$sql = "SELECT WALLET_ID, WALLET_AMOUNT, REFER_EARNING from wallet WHERE USER_ID=$userid";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_assoc($result);
					
			$currentamt = $row['WALLET_AMOUNT'];
			$currentreferearning = $row['REFER_EARNING'];
			$walletid = $row['WALLET_ID'];
			if($currentreferearning != 0){
				//update refer earning	deduction 28/6		
				$deducefromreferearning = $amount * 15/100;
				if($currentreferearning >= $deducefromreferearning ){
					$updatereferearning = $currentreferearning - $deducefromreferearning;
				
					$deducefromwallet = $amount - $deducefromreferearning;
					$updateamt = $currentamt - $deducefromwallet;
					$sql = "UPDATE wallet SET WALLET_AMOUNT=$updateamt, REFER_EARNING=$updatereferearning where USER_ID=$userid and WALLET_ID=$walletid";
				}else{
					//$updatereferearning = 0;
					
					$deducefromwallet = $amount - $currentreferearning;
					$updateamt = $currentamt - $deducefromwallet;
					$sql = "UPDATE wallet SET WALLET_AMOUNT=$updateamt, REFER_EARNING=$updatereferearning where USER_ID=$userid and WALLET_ID=$walletid";
					
				}
				
			}else{
				
				$updateamt = $currentamt - $amount;
				$sql = "UPDATE wallet SET WALLET_AMOUNT=$updateamt where USER_ID=$userid and WALLET_ID=$walletid";
			}
			$result = mysqli_query($conn, $sql);
			if(!$result){
				echo 'error here';
			}else{
				echo 'success';
			}
		}
	}else{
		echo 'error ngi';
	}
}else if($_REQUEST['action'] && $_REQUEST['action'] == 'getMyGame'){
	//echo "here";
	$userid = $_REQUEST['userid'];
	$sql = "SELECT * from mygame where USER_ID=$userid  ORDER BY `MYGAME_ID` DESC ";
	$result = mysqli_query($conn, $sql);
	if(!$result){
		echo 'error';
	}else{
		//echo 'success';
		$rows = array();
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		//print_r($rows);
		echo json_encode($rows);
	}
}else if($_REQUEST['action'] && $_REQUEST['action'] == 'getAllGame'){
	//echo "here";
	$userid = $_REQUEST['userid'];
	$sql = "SELECT * from newgame ORDER BY NEWGAME_ID desc limit 100";
	$result = mysqli_query($conn, $sql);
	if(!$result){
		echo 'error';
	}else{
		//echo 'success';
		$rows = array();
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		//print_r($rows);
		echo json_encode($rows);
	}
}else if($_REQUEST['action'] && $_REQUEST['action'] == 'decresult'){
	$resultno = $_REQUEST['resultno'];
	//echo $resultno;
	if ($resultno % 2 == 0 && $resultno != 0 ) {
         $color = 'red';
    }else if($resultno % 2 != 0 && $resultno != 5){
		$color = 'green';
	}else {
		$color = 'violet';
	}
	//echo $color;
	$sql = "UPDATE newgame SET RESULT_NUMBER=$resultno, RESULT_COLOR='$color' WHERE RESULT='pending'";
	 
	//echo "\n<br>";
	$result = mysqli_query($conn, $sql);
	if($result){
		echo "success";
	}else{
		echo "error";
	}
}else if($_REQUEST['action'] && $_REQUEST['action'] == 'addbank'){
	//print_r($_REQUEST);
	$name = $_REQUEST['firstname'];
	$ifsccode = $_REQUEST['ifsccode'];
	$bankname = $_REQUEST['bankname'];
	$accountno = $_REQUEST['accountno'];
	$state = $_REQUEST['state'];
	$city = $_REQUEST['city'];
	$address = $_REQUEST['address'];
	$mobileno = $_REQUEST['mobileno'];
	$email = $_REQUEST['email'];
	$userid = $_REQUEST['userid'];
	date_default_timezone_set('Asia/Kolkata'); 
	$createdate =  date("Y-m-d H:i:s");
	
	$sql = "INSERT into banks(USER_ID, FIRSTNAME, IFSCCODE, BANKNAME, ACCOUNTNO, STATE, CITY, ADDRESS, MOBILENO, EMAIL,CREATED_AT) VALUES($userid, '$name', '$ifsccode', '$bankname', $accountno, '$state', '$city', '$address', $mobileno, '$email', '$createdate')";
	$result = mysqli_query($conn, $sql);
	if($result){
		echo 'success';
	}else{
		echo 'error';
	}
		
}else if($_REQUEST['action'] && $_REQUEST['action'] == 'addupi'){
	//print_r($_REQUEST);
	$name = $_REQUEST['firstname'];
	$upiid = $_REQUEST['upiid'];
	$state = $_REQUEST['state'];
	$city = $_REQUEST['city'];
	$mobileno = $_REQUEST['mobileno'];
	$email = $_REQUEST['email'];
	$userid = $_REQUEST['userid'];
	date_default_timezone_set('Asia/Kolkata'); 
	$createdate =  date("Y-m-d H:i:s");
	
	$sql = "INSERT into upilist(USER_ID, FIRSTNAME, UPI_ID, STATE, CITY, MOBILE_NO, EMAIL ,CREATED_AT) VALUES($userid, '$name', '$upiid', '$state', '$city', $mobileno, '$email', '$createdate')";
	$result = mysqli_query($conn, $sql);
	if($result){
		echo 'success';
	}else{
		echo 'error';
		//print_r($_REQUEST);
	}
		
}else if($_REQUEST['action'] && $_REQUEST['action'] == 'getpaymlist'){
	//print_r($_REQUEST);
	$userid = $_REQUEST['userid'];
	$paymtype = $_REQUEST['paymtype'];
	if($paymtype == 'bank'){
		$tablename = 'banks';
	}else if($paymtype == 'upi'){
		$tablename = 'upilist';
	}
	
	$sql = "SELECT * from ".$tablename . " where USER_ID = " .$userid;
	$result = mysqli_query($conn, $sql);
	if($result){
		//echo 'success';
		$rows = array();
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		//print_r($rows);
		echo json_encode($rows);
	}else{
		echo 'error';
		//print_r($_REQUEST);
	}
		
}else if($_REQUEST['action'] && $_REQUEST['action'] == 'withdrawreq'){
	//print_r($_REQUEST);
	$userid = $_REQUEST['userid'];
	$bankid = $_REQUEST['bankid'];
	$password = $_REQUEST['password'];
	$fee = $_REQUEST['fee'];
	$amounttobank = $_REQUEST['amounttobank'];
	$otp =rand(100000,999999);
	
	$sql = "SELECT MOBILE_NO, PASSWORD from users WHERE USER_ID=$userid";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	if($password == $row['PASSWORD']){
		$mobileno = $row['MOBILE_NO'];
		
		$sqlw = "SELECT WALLET_AMOUNT from wallet WHERE USER_ID=$userid";
		$resultw = mysqli_query($conn, $sqlw);
		$roww = mysqli_fetch_assoc($resultw);
		$walletamt = $roww['WALLET_AMOUNT'];
		$totalamt = $fee + $amounttobank;
		$updatewalletamt = $walletamt - $totalamt;
		
		$_SESSION['balance'] = $updatewalletamt;
		date_default_timezone_set('Asia/Kolkata'); 
		$createdate =  date("Y-m-d H:i:s");	
		
		$sql1 = "INSERT into withdraw(USER_ID, BANK_ID, FEE, AMOUNT_TO_BANK, CREATED_AT,OTP , OTP_VERIFIED, STATUS, REMARKS) VALUES($userid, $bankid, $fee, $amounttobank, '$createdate',$otp, 'No', 'processing', 'Your payment will shortly be added to your bank acccount' )";
		$result1 = mysqli_query($conn, $sql1);
		if($result1){
			//echo 'success';
			$sqluw = "UPDATE wallet SET WALLET_AMOUNT=$updatewalletamt WHERE USER_ID=$userid";
			$resultuw = mysqli_query($conn, $sqluw);
			if($resultuw){
				echo 'success';
			}else{
				echo 'error';
			}
		//require 'phpmailer/PHPMailerAutoload.php';
		//
		//$mail = new PHPMailer();
		//
		////$mail->SMTPDebug = 2;
		//$mail->isSMTP();                                      
		//$mail->Host = 'smtp.gmail.com';
		//$mail->SMTPAuth = true;                               
		//$mail->Username = 'winguruinfo@gmail.com';   //sender email Id             
		//$mail->Password = 'Winguru@95';            //sender email's password               
		//$mail->SMTPSecure = 'tls';                       
		//$mail->Port = 587;
		//
		//$mail->From = 'winguruinfo@gmail.com';
		//$mail->FromName = 'Win Guru';
		//$mail->addAddress('rahardeep75@gmail.com');                                
		//
		//$mail->IsHTML(true);
		//$mail->Subject = 'New user WinGuru';
		//$mail->Body    = "OTP for $mobileno for amount $amounttobank withdrawl is :- $otp";
		//if(!$mail->send()) {
		//	echo 'Message could not be sent.';
		//	echo 'Mailer Error: ' . $mail->ErrorInfo;
		//} else {
		//	//echo 'Message has been sent';
		//} 
			
		}else{
			echo 'error';
		}
	}else{
		echo 'password';
	}
}else{
	echo 'error';
}






























/** Login code
if($_POST['email'] != NULL && $_POST['pass'] != NULL){
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	$sql2 = "select * from users where EMAIL ='$email'";
	$rs1 = mysqli_query($conn, $sql2);
	if (mysqli_num_rows($rs1)!=1 ){
			session_start();
			$_SESSION['message'] =  "Wrong email"; 
			header("location:./login.php");
			//echo $sql2;
		//echo "Email not matched";
		exit;
	}else{
		$row = mysqli_fetch_assoc($rs1);
		if($row['PASSWORD'] == $pass){
			//echo 'logged in success';
			session_start();
			$_SESSION['loggedin']= true;
			$_SESSION['_id']= $row['USER_ID'];
			$_SESSION['rc']= $row['REFCODE'];
			$SID = session_id();
			$request_header = json_encode($_SERVER);
			$sql3 = "INSERT INTO session_logs (USER_ID, SESSION_ID, DATE_TIME, REQUEST_HEADER) VALUES (".$row['USER_ID'].",'".$SID."','".date('Y-m-d H:i:s') ."','".$request_header."')";
			$sql4 = "INSERT INTO active_sessions (USER_ID, SESSION_ID) VALUES (".$row['USER_ID'].",'".$SID."')";
			$rs2 = mysqli_query($conn, $sql3);
			$rs3 = mysqli_query($conn, $sql4);
			if(!$rs2){
				echo "error";
			}else if($row['ROLE'] == 1){
				$_SESSION['role'] = 'admin';
				//echo 'admin';
				header("location:./admin/admindash.php");
			}else{
				$_SESSION['role'] = 'normal user';
				//echo 'logged in';
				header("location:./dashboard.php");
			}
				//header("Location:/");
				//exit();
				
		}else{
			session_start();
			$_SESSION['message'] =  "Wrong Password"; 
			header("location:./login.php");
			//echo 'Password' . " " .$sql2;
		}
	}
}else{
			session_start();
			$_SESSION['message'] =  "Fill all fields"; 
			header("location:./login.php");
}

**/










?>