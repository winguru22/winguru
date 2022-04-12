<?php
//print "two";
$db_host="localhost";
$db_username="root";
$db_pass="";
$db_name="colgame";

$conn = mysqli_connect("$db_host","$db_username","$db_pass","$db_name") or die("error occurred");
$sql = "SELECT sum(BET_AMOUNT) as TOTAL_AMOUNT from mygame WHERE BET_RESULT='pending'";
$result = mysqli_query($conn, $sql);

//print_r($result);
$totalamount = mysqli_fetch_assoc($result);
if($totalamount['TOTAL_AMOUNT'] == null){
	echo 'error no bet';
	echo $totalamt = 0;
}else{
echo $totalamt = $totalamount['TOTAL_AMOUNT'] ;
}
function getColorAmount($conn, $color){
	$sql = "SELECT sum(BET_AMOUNT) as TOTAL_AMOUNT from mygame WHERE BET_COLOR='$color' AND BET_RESULT='pending'";
	$result = mysqli_query($conn, $sql);
	if(!$result){
		echo 'error0';
	}
	$row = mysqli_fetch_assoc($result);
	//print_r($row);
	return $row;
}	

$totalamountgreen = getColorAmount($conn, 'green');
//echo $totalamountgreen['TOTAL_AMOUNT'];

$totalamountred = getColorAmount($conn, 'red');
//echo $totalamountred['TOTAL_AMOUNT'];

$totalamountviolet = getColorAmount($conn, 'violet');
//echo $totalamountviolet['TOTAL_AMOUNT'];

$numbers = array(1,2,3,4,5,6,7,8,9,0);
$rows;
foreach($numbers as $k){
	$sql = "SELECT sum(BET_AMOUNT) as TOTAL_AMOUNT from mygame WHERE BET_NUMBER='$k' and BET_RESULT='pending'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$rows['TOTAL_AMOUNT'.$k] = $row;
}
//print_r($rows);
//echo $rows['TOTAL_AMOUNT2']['TOTAL_AMOUNT'];
function amountToBeGiven($totalamountnumber, $totalamountcolor){
	$amounttobegivenonno = $totalamountnumber * 8.5;
	$amounttobegivenoncolor = $totalamountcolor * 2;
	$totalamountgiven = $amounttobegivenonno + $amounttobegivenoncolor;
	return $totalamountgiven;
}

function amountToBeGivenFZ($totalamountnumber, $totalamountcolor, $totalamountviolet){
	$amounttobegivenonno = $totalamountnumber * 8.5 ;
	$amounttobegivenoncolor = $totalamountcolor * 1.5;
	$amounttobegivenoncolorV = $totalamountviolet * 5.4;
	$totalamountgiven = $amounttobegivenonno + $amounttobegivenoncolor + $amounttobegivenoncolorV;
	return $totalamountgiven;
}
//For 1
	$amtgiven1 = amountToBeGiven($rows['TOTAL_AMOUNT1']['TOTAL_AMOUNT'], $totalamountgreen['TOTAL_AMOUNT']);

//For 2
	$amtgiven2 = amountToBeGiven($rows['TOTAL_AMOUNT2']['TOTAL_AMOUNT'], $totalamountred['TOTAL_AMOUNT']);

//For 3
	$amtgiven3 = amountToBeGiven($rows['TOTAL_AMOUNT3']['TOTAL_AMOUNT'], $totalamountgreen['TOTAL_AMOUNT']);

//For 4
	$amtgiven4 = amountToBeGiven($rows['TOTAL_AMOUNT4']['TOTAL_AMOUNT'], $totalamountred['TOTAL_AMOUNT']);

//For 5
	$amtgiven5 = amountToBeGivenFZ($rows['TOTAL_AMOUNT5']['TOTAL_AMOUNT'], $totalamountgreen['TOTAL_AMOUNT'], $totalamountviolet['TOTAL_AMOUNT']);

//For 6
	$amtgiven6 = amountToBeGiven($rows['TOTAL_AMOUNT6']['TOTAL_AMOUNT'], $totalamountred['TOTAL_AMOUNT']);

//For 7
	$amtgiven7 = amountToBeGiven($rows['TOTAL_AMOUNT7']['TOTAL_AMOUNT'], $totalamountgreen['TOTAL_AMOUNT']);

//For 8
	$amtgiven8 = amountToBeGiven($rows['TOTAL_AMOUNT8']['TOTAL_AMOUNT'], $totalamountred['TOTAL_AMOUNT']);

//For 9
	$amtgiven9 = amountToBeGiven($rows['TOTAL_AMOUNT9']['TOTAL_AMOUNT'], $totalamountgreen['TOTAL_AMOUNT']);

//For 0
	$amtgiven0 = amountToBeGivenFZ($rows['TOTAL_AMOUNT0']['TOTAL_AMOUNT'], $totalamountred['TOTAL_AMOUNT'], $totalamountviolet['TOTAL_AMOUNT']);
	
	$allamt = array("for0"=>$amtgiven0, "for1"=>$amtgiven1, "for2"=>$amtgiven2, "for3"=>$amtgiven3, "for4"=>$amtgiven4, "for5"=>$amtgiven5, "for6"=>$amtgiven6, "for7"=>$amtgiven7, "for8"=>$amtgiven8, "for9"=>$amtgiven9);
print_r($allamt);

	echo "\n<br>";
function print2Smallest($arr, $arr_size){
    $INT_MAX = 2147483647;
     
    /* There should be atleast two elements */
    if ($arr_size < 2){
        echo(" Invalid Input ");
        return;
    }
    $first = $second = $INT_MAX;
    for ($i = 0; $i < $arr_size ; $i ++){
         
        /* If current element is smaller than first then update both first and second */
        if ($arr['for'.$i] < $first) {
            $second = $first;
            $first = $arr['for'.$i];
        }
 
        /* If arr[i] is in between first and second then update second */
        else if ($arr['for'.$i] < $second && $arr['for'.$i] != $first){
            $second = $arr['for'.$i];
				 }
    }
	return array($first, $second);
    //if ($second == $INT_MAX)
    //    echo("There is no second smallest element\n");
    //else
    //    echo "The smallest element is ",$first
    //         ," and second Smallest element is "
    //                                 , $second;
}
 
// Driver Code
//$arr = array(12, 13, 1, 10, 34, 1);
$n = count($allamt);
$second = print2Smallest($allamt, $n);
print_r($second);
	echo "\n<br>";
//if($second[1] > $totalamt){
	echo $resultamt = $second[0];
	//echo "\n<br>";
	//echo 'here';
	//echo "\n<br>";
//}else{
	//echo $resultamt = $second[1];
	//echo "\n<br>";
	//echo 'here as ';
	//echo "\n<br>";
//}


$data3 = array_keys(array_intersect($allamt, [$resultamt]));
//print_r($data3);
$var =  array_rand($data3);
//echo "\n-----The smallest element is: ", $sm, "\n";


echo $resultno = $data3[$var];
switch ($resultno) {
  case 'for0':
    $resultValue = 0;
    break;
  case 'for1':
    $resultValue =  1;
    break;
  case 'for2':
    $resultValue = 2;
    break;
  case 'for3':
    $resultValue = 3;
    break;
  case 'for4':
    $resultValue = 4;
    break;
  case 'for5':
    $resultValue = 5;
    break;
  case 'for6':
    $resultValue = 6;
    break;
  case 'for7':
    $resultValue = 7;
    break;
  case 'for8':
    $resultValue = 8;
    break;
  case 'for9':
    $resultValue = 9;
    break;	
  //default:
    //echo "Your favorite color is neither red, blue, nor green!";
}
//echo $resultValue . "\n";
$sql = "SELECT NEWGAME_ID, RESULT_NUMBER, RESULT_COLOR from newgame WHERE RESULT='PENDING'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$lastid = $row['NEWGAME_ID'];
$resultno = $row['RESULT_NUMBER'];
echo "Result color - " . $resultcolor = $row['RESULT_COLOR'];

// PHP  program to find smallest and
// second smallest elements
 if($resultValue == 1){
	 $betcolor = 'green';
	 if($resultno == 0 && $resultcolor == '0'){
		echo $sql = "UPDATE newgame SET RESULT='declared', TOTAL_PRICE=".$totalamt.", RESULT_NUMBER=$resultValue, RESULT_COLOR='$betcolor' WHERE NEWGAME_ID=$lastid";
	 }else{
		echo $sql = "UPDATE newgame SET RESULT='declared', TOTAL_PRICE=".$totalamt." WHERE NEWGAME_ID=$lastid";
	 }
	echo "\n<br>";
	$result = mysqli_query($conn, $sql);
	if($result){
		//echo 'here';
		
		date_default_timezone_set('Asia/Kolkata'); 
		$time = date("Y-m-d H:i:s");
		$resulttime = date("Y-m-d H:i:s", strtotime("$time") + 1.5*60);
		$sql = "INSERT INTO newgame(STARTTIME, RESULT,ACTIVE) VALUES('$time', 'pending', 'Y')";
		$result = mysqli_query($conn, $sql);
	}else{
		echo 'error1';
	}
 }else if($resultValue == 2){
	 $betcolor = 'red';
	if($resultno == 0 && $resultcolor == '0'){
		echo $sql = "UPDATE newgame SET RESULT='declared', TOTAL_PRICE=".$totalamt.", RESULT_NUMBER=$resultValue, RESULT_COLOR='$betcolor' WHERE NEWGAME_ID=$lastid";
	 }else{
		echo $sql = "UPDATE newgame SET RESULT='declared', TOTAL_PRICE=".$totalamt." WHERE NEWGAME_ID=$lastid";
	 }
	echo "\n<br>";
	$result = mysqli_query($conn, $sql);
	echo "\n<br>";	
	if($result){
		//echo 'here';
		date_default_timezone_set('Asia/Kolkata'); 
		$time = date("Y-m-d H:i:s");
		$resulttime = date("Y-m-d H:i:s", strtotime("$time") + 1.5*60);
		$sql = "INSERT INTO newgame(STARTTIME, RESULT,ACTIVE) VALUES('$time', 'pending', 'Y')";
		$result = mysqli_query($conn, $sql);
	}else{
		echo 'error';
	}
 }else if($resultValue == 3){
	 $betcolor = 'green';
	if($resultno == 0 && $resultcolor == '0'){
		echo $sql = "UPDATE newgame SET RESULT='declared', TOTAL_PRICE=".$totalamt.", RESULT_NUMBER=$resultValue, RESULT_COLOR='$betcolor' WHERE NEWGAME_ID=$lastid";
	 }else{
		echo $sql = "UPDATE newgame SET RESULT='declared', TOTAL_PRICE=".$totalamt." WHERE NEWGAME_ID=$lastid";
	 }
	echo "\n<br>";
	$result = mysqli_query($conn, $sql);
	if($result){
		//echo 'here';
		date_default_timezone_set('Asia/Kolkata'); 
		$time = date("Y-m-d H:i:s");
		$resulttime = date("Y-m-d H:i:s", strtotime("$time") + 1.5*60);
		$sql = "INSERT INTO newgame(STARTTIME, RESULT,ACTIVE) VALUES('$time', 'pending', 'Y')";
		$result = mysqli_query($conn, $sql);
	}else{
		echo 'error';
	}
 }else if($resultValue == 4){
	 $betcolor = 'red';
	if($resultno == 0 && $resultcolor == '0'){
		echo $sql = "UPDATE newgame SET RESULT='declared', TOTAL_PRICE=".$totalamt.", RESULT_NUMBER=$resultValue, RESULT_COLOR='$betcolor' WHERE NEWGAME_ID=$lastid";
	 }else{
		echo $sql = "UPDATE newgame SET RESULT='declared', TOTAL_PRICE=".$totalamt." WHERE NEWGAME_ID=$lastid";
	 }
	echo "\n<br>";
	$result = mysqli_query($conn, $sql);
	if($result){
		//echo 'here';
		date_default_timezone_set('Asia/Kolkata'); 
		$time = date("Y-m-d H:i:s");
		$resulttime = date("Y-m-d H:i:s", strtotime("$time") + 1.5*60);
		$sql = "INSERT INTO newgame(STARTTIME, RESULT,ACTIVE) VALUES('$time', 'pending', 'Y')";
		$result = mysqli_query($conn, $sql);
	}else{
		echo 'error';
	}
 }else if($resultValue == 5){
	 $betcolor = 'violet';
	if($resultno == 0 && $resultcolor == '0'){
		echo $sql = "UPDATE newgame SET RESULT='declared', TOTAL_PRICE=".$totalamt.", RESULT_NUMBER=$resultValue, RESULT_COLOR='$betcolor' WHERE NEWGAME_ID=$lastid";
	 }else{
		echo $sql = "UPDATE newgame SET RESULT='declared', TOTAL_PRICE=".$totalamt." WHERE NEWGAME_ID=$lastid";
	 }
	echo "\n<br>";
	$result = mysqli_query($conn, $sql);
	if($result){
		//echo 'here';
		date_default_timezone_set('Asia/Kolkata'); 
		$time = date("Y-m-d H:i:s");
		$resulttime = date("Y-m-d H:i:s", strtotime("$time") + 1.5*60);
		$sql = "INSERT INTO newgame(STARTTIME, RESULT,ACTIVE) VALUES('$time', 'pending', 'Y')";
		$result = mysqli_query($conn, $sql);
	}else{
		echo 'error';
	}
 }else if($resultValue == 6){
	 $betcolor = 'red';
	if($resultno == 0 && $resultcolor == '0'){
		echo $sql = "UPDATE newgame SET RESULT='declared', TOTAL_PRICE=".$totalamt.", RESULT_NUMBER=$resultValue, RESULT_COLOR='$betcolor' WHERE NEWGAME_ID=$lastid";
	 }else{
		echo $sql = "UPDATE newgame SET RESULT='declared', TOTAL_PRICE=".$totalamt." WHERE NEWGAME_ID=$lastid";
	 }
	echo "\n<br>";
	$result = mysqli_query($conn, $sql);
	if($result){
		//echo 'here';
		date_default_timezone_set('Asia/Kolkata'); 
		$time = date("Y-m-d H:i:s");
		$resulttime = date("Y-m-d H:i:s", strtotime("$time") + 1.5*60);
		$sql = "INSERT INTO newgame(STARTTIME, RESULT,ACTIVE) VALUES('$time', 'pending', 'Y')";
		$result = mysqli_query($conn, $sql);
	}else{
		echo 'error';
	}
 }else if($resultValue == 7){
	 $betcolor = 'green';
	if($resultno == 0 && $resultcolor == '0'){
		echo $sql = "UPDATE newgame SET RESULT='declared', TOTAL_PRICE=".$totalamt.", RESULT_NUMBER=$resultValue, RESULT_COLOR='$betcolor' WHERE NEWGAME_ID=$lastid";
	 }else{
		echo $sql = "UPDATE newgame SET RESULT='declared', TOTAL_PRICE=".$totalamt." WHERE NEWGAME_ID=$lastid";
	 }
	echo "\n<br>";
	$result = mysqli_query($conn, $sql);
	if($result){
		//echo 'here';
		date_default_timezone_set('Asia/Kolkata'); 
		$time = date("Y-m-d H:i:s");
		$resulttime = date("Y-m-d H:i:s", strtotime("$time") + 1.5*60);
		$sql = "INSERT INTO newgame(STARTTIME, RESULT,ACTIVE) VALUES('$time', 'pending', 'Y')";
		$result = mysqli_query($conn, $sql);
	}else{
		echo 'error';
	}
 }else if($resultValue == 8){
	 $betcolor = 'red';
	if($resultno == 0 && $resultcolor == '0'){
		echo $sql = "UPDATE newgame SET RESULT='declared', TOTAL_PRICE=".$totalamt.", RESULT_NUMBER=$resultValue, RESULT_COLOR='$betcolor' WHERE NEWGAME_ID=$lastid";
	 }else{
		echo $sql = "UPDATE newgame SET RESULT='declared', TOTAL_PRICE=".$totalamt." WHERE NEWGAME_ID=$lastid";
	 }
	
	echo "\n<br>";
	$result = mysqli_query($conn, $sql);
	if($result){
		//echo 'here';
		date_default_timezone_set('Asia/Kolkata'); 
		$time = date("Y-m-d H:i:s");
		$resulttime = date("Y-m-d H:i:s", strtotime("$time") + 1.5*60);
		$sql = "INSERT INTO newgame(STARTTIME, RESULT,ACTIVE) VALUES('$time', 'pending', 'Y')";
		$result = mysqli_query($conn, $sql);
	}else{
		echo 'error';
	}
 }else if($resultValue == 9){
	 $betcolor = 'green';
	if($resultno == 0 && $resultcolor == '0'){
		echo $sql = "UPDATE newgame SET RESULT='declared', TOTAL_PRICE=".$totalamt.", RESULT_NUMBER=$resultValue, RESULT_COLOR='$betcolor' WHERE NEWGAME_ID=$lastid";
	 }else{
		echo $sql = "UPDATE newgame SET RESULT='declared', TOTAL_PRICE=".$totalamt." WHERE NEWGAME_ID=$lastid";
	 }
	echo "\n<br>";
	$result = mysqli_query($conn, $sql);
	if($result){
		//echo 'here';
		date_default_timezone_set('Asia/Kolkata'); 
		$time = date("Y-m-d H:i:s");
		$resulttime = date("Y-m-d H:i:s", strtotime("$time") + 1.5*60);
		$sql = "INSERT INTO newgame(STARTTIME, RESULT,ACTIVE) VALUES('$time', 'pending', 'Y')";
		$result = mysqli_query($conn, $sql);
	}else{
		echo 'error';
	}
 }else if($resultValue == 0){
	 $betcolor = 'violet';
	if($resultno == 0 && $resultcolor == '0'){
		echo $sql = "UPDATE newgame SET RESULT='declared', TOTAL_PRICE=".$totalamt.", RESULT_NUMBER=$resultValue, RESULT_COLOR='$betcolor' WHERE NEWGAME_ID=$lastid";
	 }else{
		echo $sql = "UPDATE newgame SET RESULT='declared', TOTAL_PRICE=".$totalamt." WHERE NEWGAME_ID=$lastid";
	 }
	echo "\n<br>";
	$result = mysqli_query($conn, $sql);
	if($result){
		//echo 'here';
		
		date_default_timezone_set('Asia/Kolkata'); 
		$time = date("Y-m-d H:i:s");
		$resulttime = date("Y-m-d H:i:s", strtotime("$time") + 1.5*60);
		$sql = "INSERT INTO newgame(STARTTIME, RESULT,ACTIVE) VALUES('$time', 'pending', 'Y')";
		$result = mysqli_query($conn, $sql);
	}else{
		echo 'error';
	}
 }


$sql = "SELECT RESULT_NUMBER, RESULT_COLOR from newgame where NEWGAME_ID=$lastid";
 $result = mysqli_query($conn, $sql);
if(!$result){
echo 'error';
}else{
//echo 'success';
$row = mysqli_fetch_assoc($result);
echo $resultno = $row['RESULT_NUMBER'];
echo "\n<br>";
echo $resultcolor = $row['RESULT_COLOR'];
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
			if(!$result){ echo 'error';}
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
			if(!$resultfwup){
				echo 'error2';
			}
			if($v['BET_COLOR'] == $resultcolor2){
				echo $sqlfrup = "UPDATE mygame SET BET_RESULT='Win', BET_RESULT_AMOUNT=$amttobegive where USER_ID=$userid and BET_RESULT='pending' and BET_COLOR='$resultcolor2' and BET_AMOUNT=$betamount";
				echo "\n<br>";
				$resultfrup = mysqli_query($conn, $sqlfrup);
				if(!$resultfrup){
				echo 'error3';
			}
			}else{
				echo $sqlfrup = "UPDATE mygame SET BET_RESULT='Win', BET_RESULT_AMOUNT=$amttobegive where USER_ID=$userid and BET_RESULT='pending' and BET_COLOR='$resultcolor' and BET_AMOUNT=$betamount";
				echo "\n<br>";
				$resultfrup = mysqli_query($conn, $sqlfrup);
				if(!$resultfrup){
				echo 'error4';
			}
			}
			
		}elseif($v['BET_COLOR'] != $resultcolor && $v['BET_NUMBER'] != $resultno){
			$userid = $v['USER_ID'] ;
			$betamount = $v['BET_AMOUNT'];
			echo $sqlfrup = "UPDATE mygame SET BET_RESULT='Loss', BET_RESULT_AMOUNT=$betamount where USER_ID=$userid and BET_RESULT='pending' and BET_AMOUNT=$betamount";
			
			
			$resultfrup = mysqli_query($conn, $sqlfrup);
			if(!$resultfrup){
				echo 'error5';
			}
			
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
			$resultfwup = mysqli_query($conn,$sqlfwup);
			if($v['BET_COLOR'] == $resultcolor2){
				echo $sqlfrup = "UPDATE mygame SET BET_RESULT='Win', BET_RESULT_AMOUNT=$amttobegive where USER_ID=$userid and BET_RESULT='pending' and BET_COLOR='$resultcolor2' and BET_AMOUNT=$betamount";
				echo "\n<br>";
				$resultfrup = mysqli_query($conn, $sqlfrup);
			}else{
				echo $sqlfrup = "UPDATE mygame SET BET_RESULT='Win', BET_RESULT_AMOUNT=$amttobegive where USER_ID=$userid and BET_RESULT='pending' and BET_COLOR='$resultcolor' and BET_AMOUNT=$betamount";
				echo "\n<br>";
				$resultfrup = mysqli_query($conn, $sqlfrup);
			}
			
		}elseif($v['BET_COLOR'] != $resultcolor && $v['BET_NUMBER'] != $resultno){
			$userid = $v['USER_ID'] ;
			$betamount = $v['BET_AMOUNT'];
			echo $sqlfrup = "UPDATE mygame SET BET_RESULT='Loss', BET_RESULT_AMOUNT=$betamount where USER_ID=$userid and BET_RESULT='pending'  and BET_AMOUNT=$betamount";
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
		
		echo $sqlfrup = "UPDATE mygame SET BET_RESULT='Win', BET_RESULT_AMOUNT=$amttobegive where USER_ID=$userid and BET_RESULT='pending' and BET_COLOR='$resultcolor' and BET_AMOUNT=$betamount";
		echo "\n<br>";
		$resultfrup = mysqli_query($conn, $sqlfrup);
		if(!$resultfrup){
				echo 'error111';
			}
			
	}elseif($v['BET_COLOR'] != $resultcolor && $v['BET_NUMBER'] != $resultno){
			$userid = $v['USER_ID'] ;
			$betamount = $v['BET_AMOUNT'];
			$betno= $v['BET_NUMBER'];
			$betcolor= $v['BET_COLOR'];
			if($betno == null){ 
				echo $sqlfrup = "UPDATE mygame SET BET_RESULT='Loss', BET_RESULT_AMOUNT=$betamount where USER_ID=$userid and BET_RESULT='pending' and BET_AMOUNT=$betamount AND BET_COLOR='$betcolor'";
			}else{
				echo $sqlfrup = "UPDATE mygame SET BET_RESULT='Loss', BET_RESULT_AMOUNT=$betamount where USER_ID=$userid and BET_RESULT='pending' and BET_AMOUNT=$betamount AND BET_COLOR='$betcolor' and BET_NUMBER=$betno";
			}
			echo "\n<br>";
			$resultfrup = mysqli_query($conn, $sqlfrup);
			if(!$resultfrup){
				echo 'error6';
			}
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
		
		echo $sqlfrup = "UPDATE mygame SET BET_RESULT='Win', BET_RESULT_AMOUNT=$amttobegive where USER_ID=$userid and BET_RESULT='pending' and BET_NUMBER='$resultno' and BET_AMOUNT=$betamount";
		echo "\n<br>";
		$resultfrup = mysqli_query($conn, $sqlfrup);
		
	}
}
?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>

<script>

setTimeout(function () { window.location.reload(); }, 2*60*1000);
// just show current time stamp to see time of last refresh.
//document.write(new Date());
</script>