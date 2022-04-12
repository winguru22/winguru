<?php
session_start();
//echo $_SESSION['mobile'];
?>
<!DOCTYPE html>
<html>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="vendor/bootstrap/bootstrap.min.css">
	  <style>
		#cover {
    
    height: 100%;
    text-align: center;
    display: flex;
    align-items: center;
    position: relative;
}

#cover-caption {
    width: 100%;
    position: relative;
    z-index: 1;
}

/* only used for background overlay not needed for centering */
form:before {
    content: '';
    height: 100%;
    left: 0;
    position: absolute;
    top: 0;
    width: 100%;
    background-color: rgba(0,0,0,0.3);
    z-index: -1;
    border-radius: 10px;
}
	  </style>
<body>
	<div id="msg"></div>
<section id="cover" class="min-vh-100">
    <div id="cover-caption">
        <div class="container">
            <div class="row text-white">
                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
                    <h1 class="display-4 py-2 text-truncate">Verify OTP</h1>
                    <div class="px-2">
                        <form action="#" method="POST" id="ogform" class="justify-content-center">
                            
                            <div class="form-group">
                                <label>Enter OTP</label>
                                <input type="number" name='otp' class="form-control" placeholder="xxx-xxx">
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg">Verify</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="js/jquery.min.js"></script>
<script>
  $(document).ready(function(e){
    $("#ogform").on('submit', function(e){
        e.preventDefault();
		//var gameno = $("#gameno").text();
        var getData;
		var fd = new FormData(this);
		//alert(fd);
		fd.append('action', 'verify');
		fd.append('mono', "<?php echo $_SESSION['mobile']; ?>");
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
					window.location.href = './login.php';
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
