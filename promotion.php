<?php
	session_start();
	$uid = $_SESSION['_id'];
	
	$db_host="localhost";
	$db_username="root";
	$db_pass="";
	$db_name="colgame";

	$conn = mysqli_connect("$db_host","$db_username","$db_pass","$db_name") or die("error occurred");
	
	$userid = $_SESSION['_id'];
	
	$sql = "SELECT REFERRAL_CODE from users WHERE USER_ID=$userid";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$refercode = $row['REFERRAL_CODE'];
	
	$sqlre = "SELECT REFER_EARNING from wallet WHERE USER_ID=$userid";
	$resultre = mysqli_query($conn, $sqlre);
	$rowre = mysqli_fetch_assoc($resultre);
	
	$sql0 = "SELECT USER_ID from users WHERE REFERRED_BY=$userid";
	$result0 = mysqli_query($conn, $sql0);
	if(!$result0){
		echo 'first level error';
	}else{
		$firstLevelRefer = mysqli_num_rows($result0);
		$rows0 = array();
		while($row0 = mysqli_fetch_assoc($result0)){ 
			$rows0[] = $row0;			
		}
		//get contri
		$firstLevelContri = array();
		$rowsloc = array();
		foreach($rows0 as $k => $v){
			foreach($v as $k1 => $v1){
				$sqlloc = "SELECT sum(BET_AMOUNT) as TOTAL_CONTRI from mygame WHERE USER_ID=$v1";
				$resultloc = mysqli_query($conn, $sqlloc);
				while($rowloc = mysqli_fetch_assoc($resultloc)){ 
					$rowsloc[] = $rowloc;			
				}
				//$firstLevelContri = mysqli
			}
		}
		foreach($rowsloc as $k =>$v){
			$firstLevelContri[] = $v['TOTAL_CONTRI'];
		}
		$firstLevelContriTotal = array_sum($firstLevelContri);
		$firstLevelContriAmt = $firstLevelContriTotal * 1.5 /100;
		//print_r($firstLevelContriAmt);
	}
		//second level people and contri
		$secondLevelReferArray = array();
		$rows1 = array();
		foreach($rows0 as $k => $v){
			foreach($v as $k1 => $v1){
				//print_r($v1);
				$sql1 = "SELECT USER_ID from users WHERE REFERRED_BY=$v1";
				$result1 = mysqli_query($conn, $sql1);
				$secondLevelReferArray[] = mysqli_num_rows($result1);
				
				
				while($row1 = mysqli_fetch_assoc($result1)){ 
					$rows1[] = $row1;			
				}
			}
		}
			//print_r($secondLevelReferArray);
		$secondLevelRefer = array_sum($secondLevelReferArray);
		//print_r($rows1);
		//get second level contri
		$secondLevelContri = array();
		$rowslsc = array();
		foreach($rows1 as $k => $v){
			foreach($v as $k1 => $v1){
				$sqllsc = "SELECT sum(BET_AMOUNT) as TOTAL_CONTRI from mygame WHERE USER_ID=$v1";
				$resultlsc = mysqli_query($conn, $sqllsc);
				while($rowlsc = mysqli_fetch_assoc($resultlsc)){ 
					$rowslsc[] = $rowlsc;			
				}
				//$firstLevelContri = mysqli
			}
		}
		foreach($rowslsc as $k =>$v){
			$secondLevelContri[] = $v['TOTAL_CONTRI'];
		}
		$secondLevelContriTotal = array_sum($secondLevelContri);
		$secondLevelContriAmt = $secondLevelContriTotal * 1 /100;
		//print_r($secondLevelContriAmt);
		
		
		//third level people and contri
		$thirdLevelReferArray = array();
		$rows2 = array();
		foreach($rows1 as $k => $v){
			foreach($v as $k1 => $v1){
				//print_r($v1);
				$sql2 = "SELECT USER_ID from users WHERE REFERRED_BY=$v1";
				$result2 = mysqli_query($conn, $sql2);
				$thirdLevelReferArray[] = mysqli_num_rows($result2);
				
				while($row2 = mysqli_fetch_assoc($result2)){ 
					$rows2[] = $row2;			
				}
			}
		}
		$thirdLevelRefer = array_sum($thirdLevelReferArray);
		//print_r($thirdLevelRefer);
		
		//get third level contri
		$thirdLevelContri = array();
		$rowsltc = array();
		foreach($rows2 as $k => $v){
			foreach($v as $k1 => $v1){
				$sqlltc = "SELECT sum(BET_AMOUNT) as TOTAL_CONTRI from mygame WHERE USER_ID=$v1";
				$resultltc = mysqli_query($conn, $sqlltc);
				while($rowltc = mysqli_fetch_assoc($resultltc)){ 
					$rowsltc[] = $rowltc;			
				}
				//$firstLevelContri = mysqli
			}
		}
		foreach($rowsltc as $k =>$v){
			$thirdLevelContri[] = $v['TOTAL_CONTRI'];
		}
		$thirdLevelContriTotal = array_sum($thirdLevelContri);
		$thirdLevelContriAmt = $thirdLevelContriTotal * 0.5 /100;
		//print_r($thirdLevelContriAmt);
		
		//total of people, bonus, contri
		$totalContri = $thirdLevelContriTotal + $secondLevelContriTotal + $firstLevelContriTotal;
		$totalPeople = $thirdLevelRefer + $secondLevelRefer + $firstLevelRefer;
		$totalBonus = $thirdLevelContriAmt + $secondLevelContriAmt + $firstLevelContriAmt;

?>

<!DOCTYPE html>
<html lang="en" style="font-size: 30.3px;">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width,initial-scale=1">
      <link rel="icon" href="favicon.ico">
      <title>game</title>
      
      <link href="css/app.css" rel="stylesheet">
      <link href="css/font-awesome.min.css" rel="stylesheet">
   </head>
   <body style="font-size: 24px;">
      <noscript><strong>We're sorry but default doesn't work properly without JavaScript enabled. Please enable it to continue.</strong></noscript>
      <div data-v-a7e7a84c="" class="promotion">
         <nav data-v-a7e7a84c="" class="top_nav">
            <div data-v-a7e7a84c="" class="left"><a href="profile.php"><i class='fa fa-arrow-left fa-2x' style="margin-right:15px; color:white;" ></i></a><span data-v-a7e7a84c="">Promotion</span></div>
            <!--<div data-v-a7e7a84c="" class="right"><img data-v-a7e7a84c="" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAA30lEQVRoQ+2YUQ7CMAxD65uxkyFOxjhZEAeATKndocz7j1P7JVpVjCYfmvgYNvJvJE3EREQJeLREwZZlr0MkIu7lmIiFAB6/5FIiEfEcY9yIZ6pI7QA2G/kk0IlIjx2pDPQZNemyn3GoSk8bqaSmrDERZboVbROppKasSYl0+rP70kgcJd9+iWGukUqXfc0x5rvYyHyGXAUT4eY5r2Yi8xlyFVIioge6F4CdaeWIEcVda7ORLxgvRUTxQLd+R5gLqdRKR0vZnKltI8w0GVomwkiRqWEizDQZWibCSJGp8QahV0QzxiHkWgAAAABJRU5ErkJggg==" alt=""></div>-->
         </nav>
         <div data-v-a7e7a84c="" class="pro_content">
            <div data-v-a7e7a84c="" class="container">
               <div data-v-a7e7a84c="" class="headline">Bonus:₹ <span data-v-a7e7a84c=""><?php echo $totalBonus; ?></span></div>
            </div>
            <div data-v-a7e7a84c="" class="level_box">
               <div data-v-a7e7a84c="" class="level_content">
                  <div data-v-a7e7a84c="" class="level_list">
                     <ul data-v-a7e7a84c="" class="layout">
                        <li data-v-a7e7a84c="">
                           <ol data-v-a7e7a84c="">Total People</ol>
                           <ol data-v-a7e7a84c="" class="two_ol"><?php echo $totalPeople; ?></ol>
                        </li>
                        <li data-v-a7e7a84c="">
                           <ol data-v-a7e7a84c="">Contribution</ol>
                           <ol data-v-a7e7a84c="" class="two_ol">₹ <?php echo $totalContri; ?></ol>
                        </li>
                     </ul>
                     <div data-v-a7e7a84c="" class="layout_bot">
                        <div data-v-a7e7a84c="" class="bot_list">
                           <p data-v-a7e7a84c="" class="titles">My Promotion Code</p>
                           <p data-v-a7e7a84c="" id="codebox" class="answer"><?php echo $refercode;?></p>
						   
                        </div>
						<span id="msg2"></span>
                     <div data-v-a7e7a84c="" class="openlink"><button data-v-a7e7a84c=""  onclick="copyToClipboardMsg(document.getElementById('codebox'), 'msg2')" class="tag-read ripplegrey">Copy Code</button></div>
                        <div data-v-a7e7a84c="" class="bot_list">
                           <p data-v-a7e7a84c="" class="titles">My Promotion Link</p>
                           <p data-v-a7e7a84c="" id="copyTarget" class="answer heights">https://bigtecinc.xyz/signup.php?r_code=<?php echo $refercode;?> </p>
                        </div>
                     </div>
					 <span id="msg"></span>
                     <div data-v-a7e7a84c="" class="openlink"><button data-v-a7e7a84c="" value="https://bigtecinc.xyz/signup.php?r_code=<?php echo $refercode;?>" id="copyButton" class="tag-read ripplegrey">Copy Link</button></div>
					 <h4><b>Earning by Reffer </b></h4></br>
                     <p>Total Reffer Earning &nbsp;&nbsp;<span><?php echo $rowre['REFER_EARNING']; ?></span> </p></br>
					 <p>* Per Reffer Earning 20% & maximum 1100</p>
                  </div>
               </div>
            </div>
            <div data-v-a7e7a84c="" class="new_table">
               <ul data-v-a7e7a84c="" class="table_ul">
                  <li data-v-a7e7a84c="" class="table_head">
                     <ol data-v-a7e7a84c="">Level</ol>
                     <ol data-v-a7e7a84c="">Bonus</ol>
                     <ol data-v-a7e7a84c="">TotalPeople</ol>
                     <ol data-v-a7e7a84c="">Contribution</ol>
                     <ol data-v-a7e7a84c="">Scale</ol>
                  </li>
                  <li data-v-a7e7a84c="" class="table_body">
                     <ol data-v-a7e7a84c="">1</ol>
                     <ol data-v-a7e7a84c=""><?php echo $firstLevelContriAmt; ?></ol>
                     <ol data-v-a7e7a84c=""><?php echo $firstLevelRefer; ?></ol>
                     <ol data-v-a7e7a84c=""><?php echo $firstLevelContriTotal; ?></ol>
                     <ol data-v-a7e7a84c="">1.5</ol>
                  </li>
                  <li data-v-a7e7a84c="" class="table_body">
                     <ol data-v-a7e7a84c="">2</ol>
                     <ol data-v-a7e7a84c=""><?php echo $secondLevelContriAmt; ?></ol>
                     <ol data-v-a7e7a84c=""><?php echo $secondLevelRefer; ?></ol>
                     <ol data-v-a7e7a84c=""><?php echo $secondLevelContriTotal; ?></ol>
                     <ol data-v-a7e7a84c="">1</ol>
                  </li>
                  <li data-v-a7e7a84c="" class="table_body">
                     <ol data-v-a7e7a84c="">3</ol>
                     <ol data-v-a7e7a84c=""><?php echo $thirdLevelContriAmt; ?></ol>
                     <ol data-v-a7e7a84c=""><?php echo $thirdLevelRefer; ?></ol>
                     <ol data-v-a7e7a84c=""><?php echo $thirdLevelContriTotal; ?></ol>
                     <ol data-v-a7e7a84c="">0.5</ol>
                  </li>
               </ul>
            </div>
         </div>
        
         <div data-v-74fec56a="" data-v-a7e7a84c="" class="loading" style="display: none;">
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
         <!-- <div data-v-a7e7a84c="" class="right_zz" style="display: none;"> -->
            <!-- <div data-v-a7e7a84c="" class="wrapper"> -->
               <!-- <ul data-v-a7e7a84c="" class="right_nav"> -->
                  <!-- <li data-v-a7e7a84c="">Bonus Record</li> -->
                  <!-- <li data-v-a7e7a84c="">Apply Record</li> -->
               <!-- </ul> -->
            <!-- </div> -->
         <!-- </div> -->
      </div>
	  <div data-v-405e9a63="" data-v-d2db546c="" class="footer">
    <ul data-v-405e9a63="" class="nav_foot">
       <li data-v-405e9a63="" class=""><a href="./home.php"><i class="fa fa-home fa-2x"></i><span data-v-405e9a63=""><br> Home</span></a></li>
       <li data-v-405e9a63="" class=""><a href="./home.php"><i class="fa fa-search fa-2x"></i><span data-v-405e9a63=""><br>Search</span></a></li>
       <li data-v-405e9a63="" class=""><a href="./"><i class="fa fa-trophy fa-2x"></i><span data-v-405e9a63=""><br>Win</span></a></li>
       <li data-v-405e9a63="" class="active"><a href="profile.php"><i class="fa fa-user fa-2x"></i><span data-v-405e9a63=""><br>My</span></a></li>
    </ul>
</div>
	  <script src="js/jquery.min.js"></script>
	  <script>
		document.getElementById("copyButton").addEventListener("click", function() {
    copyToClipboardMsg(document.getElementById("copyTarget"), "msg");
});

//document.getElementById("pasteTarget").addEventListener("mousedown", function() {
  //  this.value = "";
//});


function copyToClipboardMsg(elem, msgElem) {
	  var succeed = copyToClipboard(elem);
    var msg;
    if (!succeed) {
        msg = "Copy not supported or blocked.  Press Ctrl+c to copy."
    } else {
        msg = "Referral Code copied to the clipboard."
    }
    if (typeof msgElem === "string") {
        msgElem = document.getElementById(msgElem);
    }
    msgElem.innerHTML = msg;
    setTimeout(function() {
        msgElem.innerHTML = "";
    }, 2000);
}

function copyToClipboard(elem) {
	  // create hidden text element, if it doesn't already exist
    var targetId = "_hiddenCopyText_";
    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
    var origSelectionStart, origSelectionEnd;
    if (isInput) {
        // can just use the original source element for the selection and copy
        target = elem;
        origSelectionStart = elem.selectionStart;
        origSelectionEnd = elem.selectionEnd;
    } else {
        // must use a temporary form element for the selection and copy
        target = document.getElementById(targetId);
        if (!target) {
            var target = document.createElement("textarea");
            target.style.position = "absolute";
            target.style.left = "-9999px";
            target.style.top = "0";
            target.id = targetId;
            document.body.appendChild(target);
        }
        target.textContent = elem.textContent;
    }
    // select the content
    var currentFocus = document.activeElement;
    target.focus();
    target.setSelectionRange(0, target.value.length);
    
    // copy the selection
    var succeed;
    try {
    	  succeed = document.execCommand("copy");
    } catch(e) {
        succeed = false;
    }
    // restore original focus
    if (currentFocus && typeof currentFocus.focus === "function") {
        currentFocus.focus();
    }
    
    if (isInput) {
        // restore prior selection
        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
    } else {
        // clear temporary content
        target.textContent = "";
    }
    return succeed;
}
	  </script>
   </body>
</html>