<?php
//print "two";
$db_host="localhost";
$db_username="root";
$db_pass="";
$db_name="colgame";

$conn = mysqli_connect("$db_host","$db_username","$db_pass","$db_name") or die("error occurred");


date_default_timezone_set('Asia/Kolkata'); 
	$today =  date("Y-m-d H:i:s");

$dt = new DateTime($today);

$date = $dt->format('Y-m-d');
$time = $dt->format('H:i:s');

//echo $date, ' | ', $time;
//total amount played
$sql = "SELECT sum(TOTAL_PRICE) as total FROM newgame where STARTTIME between '$date 00:00:01' and '$today'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	echo "Total amount played today - ". $row['total'];
	echo "\n<br>";

//total amount given
$sqlg = "SELECT sum(BET_RESULT_AMOUNT) as totalg from mygame WHERE BET_RESULT='Loss' AND CREATED_AT between '$date 00:00:01' and '$today'";
$resultg = mysqli_query($conn, $sqlg);
$rowg = mysqli_fetch_assoc($resultg);
echo "Toatl earning today - " . $rowg['totalg'];
echo "\n<br>";


//total amount on single game
$sql = "SELECT sum(BET_AMOUNT) as TOTAL_AMOUNT from mygame WHERE BET_RESULT='pending'";
$result = mysqli_query($conn, $sql);
//print_r($result);
$totalamount = mysqli_fetch_assoc($result);
if($totalamount['TOTAL_AMOUNT'] == null){
	echo 'error no bet';
	echo $totalamt = 0;
}else{
echo $totalamt = $totalamount['TOTAL_AMOUNT'] ;
echo "\n<br>";
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

//calculate amount color wise
$allamtforus = array($amtgiven0, $amtgiven1, $amtgiven2, $amtgiven3, $amtgiven4, $amtgiven5, $amtgiven6, $amtgiven7, $amtgiven8, $amtgiven9);
//$allamtforus = array(1,4,1,1,1,1,1,1,1,1);
$sum = 0;
for($i=0;$i<=count($allamtforus);$i++){
	//echo $allamtforus[$i];
	//echo "\n<br>";
	if ($i % 2 == 0 && $i != 0 ) {
         $sumred += $allamtforus[$i];
    }else if($i % 2 != 0 && $i != 5){
		$sumgreen += $allamtforus[$i];
	}
		
}
echo "Total amount to be given on green - " . $totalgivegreen = $totalamountgreen['TOTAL_AMOUNT'] * 2;
echo "\n<br>";
echo "Total amount to be given on red - " . $totalgivered = $totalamountred['TOTAL_AMOUNT'] * 2;

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
echo "\n<br>";
echo "---";
echo "\n<br>";


$data3 = array_keys(array_intersect($allamt, [$resultamt]));
print_r($data3);
$var =  array_rand($data3);
echo $data3[$var];
echo "\n<br>";
echo "---";
echo "\n<br>";

//jfg
//if($resultamt != 0){
//	$resultno = array_search($resultamt,$allamt,true);
//}else{
//	$randomno = rand(0,9);
//	$resultno = 'for'.$randomno;
//}
//open result 
//$favcolor = 2000;
echo $resultno = $data3[$var];
echo "\n<br>";

$sql = "SELECT NEWGAME_ID, RESULT_NUMBER,RESULT_COLOR from newgame WHERE RESULT='PENDING'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo 'Current game id - ' . $row['NEWGAME_ID'];
echo "\n<br>";
echo 'Current game result no - ' . $row['RESULT_NUMBER'];
echo "\n<br>";
echo 'Current game result color - ' . $row['RESULT_COLOR'];

?>

<html>
<head>
	
      <link rel="stylesheet" href="vendor/bootstrap/bootstrap.min.css">
</head>

<body>
	<div class="container-fluid">
		<div class="row"> 
			<form action="#" method="POST" id="ogform">
				<label for="fname">Result</label>
				<input type="number" id="resultno" name="resultno"  min="0" max="9" placeholder="Your result no..">
				</br>
				<input type="submit" value="Submit">
			</form>
		</div>
	</div>
<script src="js/jquery.min.js"></script>
<script>
  $(document).ready(function(e){
    $("#ogform").on('submit', function(e){
        e.preventDefault();
		//var gameno = $("#gameno").text();
        var getData;
		var fd = new FormData(this);
		//alert(fd);
		fd.append('action', 'decresult');
		//fd.append('mono', "<?php echo $_SESSION['mobile']; ?>");
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
				if(msg == 'success'){
					window.location.reload();
					//window.location.href = './login.php';
				}else{
					
					$('#msg').text('Wrong otp, enter correct otp again');
				}
				
            }
        });
    });
   
});
	  </script>
</body>

</html>
