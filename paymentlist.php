<?php
	session_start();
$userid =  $_SESSION['_id'];
//echo $_SESSION['balance'];


$db_host="localhost";
$db_username="root";
$db_pass="";
$db_name="colgame";

$conn = mysqli_connect("$db_host","$db_username","$db_pass","$db_name") or die("error occurred");

$sql = "SELECT * from withdraw WHERE USER_ID=$userid";
$result = mysqli_query($conn, $sql);
$rows = array();
	while($row = mysqli_fetch_assoc($result)){
		//print_r($row);
		$rows[] = $row;
	}
 //echo 'here';
?>
<html lang="en" style="font-size: 36px;">
   <head>
      <style id="stndz-style">div[class*="item-container-obpd"], a[data-redirect*="paid.outbrain.com"], a[onmousedown*="paid.outbrain.com"] { display: none !important; } a div[class*="item-container-ad"] { height: 0px !important; overflow: hidden !important; position: absolute !important; } div[data-item-syndicated="true"] { display: none !important; } .grv_is_sponsored { display: none !important; } .zergnet-widget-related { display: none !important; } 
	  a {
		text-decoration: none;
	  }
	  </style>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width,initial-scale=1">
      <link rel="icon" href="favicon.ico">
      <title>Trova</title>
      
      <link href="css/app.css" rel="stylesheet">
      <link href="css/font-awesome.min.css" rel="stylesheet">
	  
   </head>
   <body style="font-size: 36px;" data-new-gr-c-s-check-loaded="14.1017.0" data-gr-ext-installed="">
      <noscript><strong>We're sorry but default doesn't work properly without JavaScript enabled. Please enable it to continue.</strong></noscript>
      <div data-v-be68bb7c="" class="bankcard">
         <nav data-v-be68bb7c="" class="top_nav">
            <div data-v-be68bb7c="" class="left"><a href="profile.php"><i class='fa fa-arrow-left fa-2x' style="margin-right:15px; color:white;" ></i></a><span data-v-be68bb7c="">Withdrawl list</span></div>
            
         </nav>
         <div data-v-be68bb7c="" class="address_list" style="margin-top: 15px;">
            <ul data-v-be68bb7c="" class="list_ul">
				<?php 
			   //print_r($rows);
			   $html;
			   if(!empty($rows)){
				
				foreach($rows as $k => $v){
				   //print_r($v);
					
						//echo $v[]
					
						$html .= "<li data-v-be68bb7c=''><ol data-v-be68bb7c='' class='left_icon'><i class='fa fa-credit-card-alt fa-2x' ></i></ol><ol data-v-be68bb7c='' class='center' style='padding: 5px;;'><p data-v-be68bb7c='' class='amttobank'>".$v['AMOUNT_TO_BANK']."</p><p data-v-be68bb7c='' class='info_text'>".$v['REMARKS']."</p></ol>";
						if($v['STATUS'] == 'processing'){
							$html .= "<ol data-v-be68bb7c='' class='right_icon'>
								<i class='fa fa-cogs fa-2x' ></i>
							</ol>";
						}else{
							$html .= "<ol data-v-be68bb7c='' class='right_icon'>
								<i class='fa fa-check-circle fa-2x' ></i>
							</ol>";
						}
					$html .= "</li>";
				}
			   echo $html;
			   }else{
				   echo "<p style='text-align: -webkit-center;'>No withdrawal request</p>";
			   }
			   
			   ?>
				
				<!--<li data-v-be68bb7c="">
                  <ol data-v-be68bb7c="" class="left_icon"><i class='fa fa-credit-card-alt fa-2x' ></i></ol>
                  <ol data-v-be68bb7c="" class="center">
                     <p data-v-be68bb7c="" class="name">deep</p>
                     <p data-v-be68bb7c="" class="info_text">12345678</p>
                  </ol>
                  <ol data-v-be68bb7c="" class="right_icon"><i class='fa fa-info-circle fa-2x' ></i></ol>
               </li>
               <li data-v-be68bb7c="">
                  <ol data-v-be68bb7c="" class="left_icon"><i class='fa fa-credit-card-alt fa-2x' ></i></ol>
                  <ol data-v-be68bb7c="" class="center">
                     <p data-v-be68bb7c="" class="name">peed</p>
                     <p data-v-be68bb7c="" class="info_text">23126547654</p>
                  </ol>
                  <ol data-v-be68bb7c="" class="right_icon"><i class='fa fa-info-circle fa-2x' ></i></ol>
               </li>-->
            </ul>
		</div>
         <div data-v-405e9a63="" data-v-d2db546c="" class="footer">
    <ul data-v-405e9a63="" class="nav_foot">
       <li data-v-405e9a63="" class=""><a href="./home.php"><i class="fa fa-home fa-2x"></i><span data-v-405e9a63=""><br> Home</span></a></li>
       <li data-v-405e9a63="" class=""><a href="./home.php"><i class="fa fa-search fa-2x"></i><span data-v-405e9a63=""><br>Search</span></a></li>
       <li data-v-405e9a63="" class=""><a href="./"><i class="fa fa-trophy fa-2x"></i><span data-v-405e9a63=""><br>Win</span></a></li>
       <li data-v-405e9a63="" class="active"><a href="profile.php"><i class="fa fa-user fa-2x"></i><span data-v-405e9a63=""><br>My</span></a></li>
    </ul>
</div>
         <div data-v-74fec56a="" data-v-be68bb7c="" class="loading" style="display: none;">
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
         <div data-v-be68bb7c="" class="delete_zz" style="display: none;">
            <div data-v-be68bb7c="" class="warpper">
               <p data-v-be68bb7c="" class="title">Confirm</p>
               <p data-v-be68bb7c="" class="text">Do you want to delete this bank card? <span data-v-be68bb7c="">张飒 854625463254222568</span></p>
               <div data-v-be68bb7c="" class="bot_btn"><button data-v-be68bb7c="">CANCEL</button><button data-v-be68bb7c="" class="btn">DELETE</button></div>
            </div>
         </div>
      </div>
	  
	  
      <!--<script src="js/app.21b0331c.js"></script>-->
	  <script src="js/jquery.min.js"></script>
   </body>
</html>