<?php
set_time_limit(0);

$db_host="localhost";
$db_username="root";
$db_pass="";
$db_name="colgame";

$conn = mysqli_connect("$db_host","$db_username","$db_pass","$db_name") or die("error occurred");
//$data;
date_default_timezone_set('Asia/Kolkata'); 
 $time = date("Y-m-d H:i:s");
 $resulttime = date("Y-m-d H:i:s", strtotime("$time") + 1.5*60);
 $sql = "SELECT RESULT_NUMBER, RESULT_COLOR from newgame where NEWGAME_ID=1266";
 $result = mysqli_query($conn, $sql);
if(!$result){
echo 'error';
}else{
//echo 'success';
$row = mysqli_fetch_assoc($result);
echo $resultno = 2;//$row['RESULT_NUMBER'];
echo "\n<br>";
echo $resultcolor = 'red';//$row['RESULT_COLOR'];
echo "\n<br>";
}
$sql = "SELECT * from mygame where BET_RESULT='pending'";
$result = mysqli_query($conn, $sql);
$rows = array();
while($row = mysqli_fetch_assoc($result)){
	$rows[] = $row;
}
//print_r($rows);
foreach($rows as $k => $v){
	//print_r($v);
	if($resultcolor == 'violet' && $resultno == 5){
		$resultcolor2 = 'green';
		if($v['BET_COLOR'] == $resultcolor || $v['BET_COLOR'] === $resultcolor2){
			$userid = $v['USER_ID'] ;
			//echo "\n";
			echo $betamount = $v['BET_AMOUNT'];
			echo "\n<br>";
			$sql ="SELECT WALLET_AMOUNT from wallet where USER_ID=$userid ";
			$result = mysqli_query($conn, $sql);
			//if(!$result){ echo 'error';}
			$row = mysqli_fetch_assoc($result);
			$walletamt = $row['WALLET_AMOUNT'];
			if($v['BET_COLOR'] == $resultcolor2){
				$amttobegive = $betamount * 1.5 ;
				echo "\n<br>";
				 $updatewalletamtlt = $walletamt + $amttobegive;
				echo "\n<br>";
			}else{
				$amttobegive = $betamount * 5.4 ;
				echo "\n<br>";
				$updatewalletamtlt = $walletamt + $amttobegive;
				echo "\n<br>";
			}
			echo $sqlfwup = "UPDATE wallet SET WALLET_AMOUNT=$updatewalletamtlt where USER_ID=$userid"; 
			echo "\n<br>";
			$resultfwup = mysqli_query($conn,$sqlfwup);
			if($v['BET_COLOR'] == $resultcolor2){
				echo $sqlfrup = "UPDATE mygame SET BET_RESULT=Win, BET_RESULT_AMOUNT=$amttobegive where USER_ID=$userid and BET_RESULT='pending' and BET_COLOR=$resultcolor2";
				echo "\n<br>";
				$resultfrup = mysqli_query($conn, $sqlfrup);
			}else{
				echo $sqlfrup = "UPDATE mygame SET BET_RESULT=Win, BET_RESULT_AMOUNT=$amttobegive where USER_ID=$userid and BET_RESULT='pending' and BET_COLOR=$resultcolor";
				echo "\n<br>";
				$resultfrup = mysqli_query($conn, $sqlfrup);
			}
			
		}elseif($v['BET_COLOR'] != $resultcolor && $v['BET_NUMBER'] != $resultno){
			$userid = $v['USER_ID'] ;
			$betamount = $v['BET_AMOUNT'];
			echo $sqlfrup = "UPDATE mygame SET BET_RESULT=Loss, BET_RESULT_AMOUNT=$betamount where USER_ID=$userid and BET_RESULT='pending' and BET_COLOR=$resultcolor";
			$resultfrup = mysqli_query($conn, $sqlfrup);
			
		}
	}else if($resultcolor == 'violet' && $resultno == 0){
		$resultcolor2 = 'red';
		if($v['BET_COLOR'] == $resultcolor || $v['BET_COLOR'] === $resultcolor2){
			$userid = $v['USER_ID'] ;
			//echo "\n";
			echo $betamount = $v['BET_AMOUNT'];
			echo "\n<br>";
			$sql ="SELECT WALLET_AMOUNT from wallet where USER_ID=$userid ";
			$result = mysqli_query($conn, $sql);
			//if(!$result){ echo 'error';}
			$row = mysqli_fetch_assoc($result);
			echo $walletamt = $row['WALLET_AMOUNT'];
			echo "\n<br>";
			if($v['BET_COLOR'] == $resultcolor2){
				$amttobegive = $betamount * 1.5 ;
				echo "\n<br>";
				 $updatewalletamtlt = $walletamt + $amttobegive;
				echo "\n<br>";
			}else{
				$amttobegive = $betamount * 5.4 ;
				echo "\n<br>";
				$updatewalletamtlt = $walletamt + $amttobegive;
				echo "\n<br>";
			}
			echo $sqlfwup = "UPDATE wallet SET WALLET_AMOUNT=$updatewalletamtlt where USER_ID=$userid"; 
			echo "\n<br>";
			//$resultfwup = mysqli_query($conn,$sqllsup);
			if($v['BET_COLOR'] == $resultcolor2){
				echo $sqlfrup = "UPDATE mygame SET BET_RESULT=Win, BET_RESULT_AMOUNT=$amttobegive where USER_ID=$userid and BET_RESULT='pending' and BET_COLOR=$resultcolor2";
				echo "\n<br>";
				$resultfrup = mysqli_query($conn, $sqlfrup);
			}else{
				echo $sqlfrup = "UPDATE mygame SET BET_RESULT=Win, BET_RESULT_AMOUNT=$amttobegive where USER_ID=$userid and BET_RESULT='pending' and BET_COLOR=$resultcolor";
				echo "\n<br>";
				$resultfrup = mysqli_query($conn, $sqlfrup);
			}
			
		}elseif($v['BET_COLOR'] != $resultcolor && $v['BET_NUMBER'] != $resultno){
			$userid = $v['USER_ID'] ;
			$betamount = $v['BET_AMOUNT'];
			echo $sqlfrup = "UPDATE mygame SET BET_RESULT=Loss, BET_RESULT_AMOUNT=$betamount where USER_ID=$userid and BET_RESULT='pending' and BET_COLOR=$resultcolor";
			$resultfrup = mysqli_query($conn, $sqlfrup);
		}
	}else if($resultcolor == $v['BET_COLOR']){
		
		$userid = $v['USER_ID'] ;
		//echo "\n";
		echo $betamount = $v['BET_AMOUNT'];
		echo "\n<br>";
		$sql ="SELECT WALLET_AMOUNT from wallet where USER_ID=$userid ";
		$result = mysqli_query($conn, $sql);
		//if(!$result){ echo 'error';}
		$row = mysqli_fetch_assoc($result);
		echo $walletamt = $row['WALLET_AMOUNT'];
		echo "\n<br>";
		
		$amttobegive = $betamount * 2 ;
		echo "\n<br>";
		$updatewalletamtlt = $walletamt + $amttobegive;
		echo "\n<br>";
		
		echo $sqlfwup = "UPDATE wallet SET WALLET_AMOUNT=$updatewalletamtlt where USER_ID=$userid"; 
		echo "\n<br>";
		$resultfwup = mysqli_query($conn,$sqlfwup);
		
		echo $sqlfrup = "UPDATE mygame SET BET_RESULT=Win, BET_RESULT_AMOUNT=$amttobegive where USER_ID=$userid and BET_RESULT='pending' and BET_COLOR=$resultcolor";
		echo "\n<br>";
		$resultfrup = mysqli_query($conn, $sqlfrup);
			
	}elseif($v['BET_COLOR'] != $resultcolor && $v['BET_NUMBER'] != $resultno){
			$userid = $v['USER_ID'] ;
			$betamount = $v['BET_AMOUNT'];
			echo $sqlfrup = "UPDATE mygame SET BET_RESULT=Loss, BET_RESULT_AMOUNT=$betamount where USER_ID=$userid and BET_RESULT='pending'";
			echo "\n<br>";
			$resultfrup = mysqli_query($conn, $sqlfrup);
		}
	
	if($v['BET_NUMBER'] == $resultno ){
		//echo $v['MYGAME_ID'] . "-";
		//echo $v['USER_ID'] . "\n";
		//echo 'here';
		$userid = $v['USER_ID'] ;
		//echo "\n";
		echo $betamount = $v['BET_AMOUNT'];
		echo "\n<br>";
		$sql ="SELECT WALLET_AMOUNT from wallet where USER_ID=$userid ";
		$result = mysqli_query($conn, $sql);
		//if(!$result){ echo 'error';}
		$row = mysqli_fetch_assoc($result);
		echo $walletamt = $row['WALLET_AMOUNT'];
		echo "\n<br>";
		
			$amttobegive = $betamount * 8.5 ;
			echo "\n<br>";
			 $updatewalletamtlt = $walletamt + $amttobegive;
			echo "\n<br>";
		
		echo $sqlfwup = "UPDATE wallet SET WALLET_AMOUNT=$updatewalletamtlt where USER_ID=$userid"; 
		echo "\n<br>";
		$resultfwup = mysqli_query($conn,$sqlfwup);
		
		echo $sqlfrup = "UPDATE mygame SET BET_RESULT=Win, BET_RESULT_AMOUNT=$amttobegive where USER_ID=$userid and BET_RESULT='pending' and BET_NUMBER=$resultno";
		echo "\n<br>";
		$resultfrup = mysqli_query($conn, $sqlfrup);
		
	}
}
?>
	
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>

<script>

//setTimeout(function () { window.location.reload(); }, 2*60*1000);
// just show current time stamp to see time of last refresh.
//document.write(new Date());
</script>