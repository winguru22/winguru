<?php 
//wget -O /dev/null https://bigtecinc.xyz/cronj.sh
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta name="viewport" content="width=device-width , initial-scale=1.0">
	<link rel="stylesheet" href="css/font-awesome.min.css">
<style>
    #sizelist ul{
      list-style-type: none;
      }
    #sizelist ul li{
      float: left;
      display: inline;
      margin-right: 5px;
      width: auto;
      overflow: hidden;
      }
    #sizelist ul li a{
       display: block;
       border: 1px solid #CCCCCC;
       padding: 5px 6px 5px 6px;
       margin: 1px;
       }
    #sizelist .select a{
      border: 2px solid #FF6701;
      margin: 0px;
    }
    #sizelist ul li a:hover {
      border: 2px solid #FF6701;
      margin: 0px;
      }
</style>
<link rel="stylesheet" href="css/app.css">
</head>
<body>
<button type="button" id="openpop" data-color="green" onclick="opcl(this)">click</button>
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
               <span class="van-checkbox__label">I agree <span data-v-36d08a7e="" class="greencolor">PRESALE RULE</span></span>
            </div>
         </div>
         <div data-v-36d08a7e="" class="close_btn">
			<button data-v-36d08a7e="" onclick="opcl()">CANCEL</button>
			<button data-v-36d08a7e="" style="color: rgb(0, 137, 123);">CONFIRM</button>
		</div>
      </div>
   </div>
</div>

<!--<ul id="sizelist">
  <li data-value="10" class="select"><a href="#">10</a></li>
  <li data-value="100">				 <a href="#">100</a></li>
  <li data-value="1000">			 <a href="#">1000</a></li>
  <li data-value="10000">			 <a href="#">10000</a></li>
</ul>

<button id="targetplus" type="button">+</button>
<div id="output"><input id="output2" value="1" type='text'></div>
<button id="targetmin" type="button">-</button>
<div id="content-container">
10
</div>-->



<script src="js/jquery.min.js"></script>
<script>
function BusinessLogic()
{
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
function opcl(e) {     
   $('.agree_zz').toggle();
   
   btnColor = e.getAttribute("data-color");
	if(btnColor == 'green'){
		$("#myParagraph").css({"background": "rgb(76, 175, 80);"});
	}
};
//$("#openpop").on("click", function(e){
//    
//    $('.agree_zz').show();
//    
//})
//$(".close_btn").on("click", function(e){
//    
//    $('.agree_zz').hide();
//    
//})
//$("#content-container").on("change", function(e){
//    e.preventDefault();
//    //var $this = $(this).parent();
//    //$this.addClass("select").siblings().removeClass("select");
//	var txt = $(this).text();
//	console.log(txt);
//    $("#content-container").text($this.data("value"));
//})

</script>

