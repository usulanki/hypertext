<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>

	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<style>
	body{
		background-image: url('<?=base_url()?>/assets/images/login-bg.jpg');
		background-repeat: no-repeat;
		background-size: cover;
		overflow: hidden;
	}

	.overflow{
		background-color: rgba(1, 1, 1, 0.85);
		position: absolute;
		z-index: 400;
		height: 100%;
		width: 100%;
	}
	.login-main{
		position: absolute;
		z-index: 500;
		height: 100%;
		width: 100%;
		left: 0;
		top: 0;
	}
	.login-app-name{
		color: #fff;
		font-size: 50px;
		font-weight: bold;
		padding: 100px ;
	}

	.login-app-slogan{
		color: #fff;
		font-size: 30px;
		font-weight: bold;
		padding: 100px ;
		padding-top: 10px;
	}

	.login-box{
		background-color: #fff;
		padding: 20px 90px 130px 80px;
        border-radius: 5px;
	}

	.btn-login{
		background-color: #001399;
		width: 100%;
		color: #fff;
		font-weight: bold;
		box-shadow: -2px 8px 9px -8px rgba(22,132,188,0.75);
		-webkit-box-shadow: -2px 8px 9px -8px rgba(22,132,188,0.75);
		-moz-box-shadow: -2px 8px 9px -8px rgba(22,132,188,0.75);
opacity: 0.8;
	}

	.login-input{
		border: none;
		border-bottom: 1px solid darkred;
		width: 100%;
	}
</style>

</head>
<body>

	<div class="overflow"></div>

    <div class="login-main">
       <div class="row">
		   <div class="col-md-7">
		      <div class="login-app-name">
		      	 Smart Hybrid Office Automation
		      </div>
		      <div class="login-app-slogan">
		      	 Work from anywhere
		      </div>
		   </div>

		   <div style="text-align: center;background-color: ;padding: 50px;height: 100vh;" class="col-md-5 text-center">
               <div class="login-box">

               	<div class="row text-left">

               		<div style="margin-top: 20px;font-size: 22px;" class="col-md-12">
               			Login
               		</div>
               		<div style="margin-top: 30px;" class="col-md-12">
               			<div>Email</div>
               			<input type="" id="email" class="login-input" name="">
               		</div>
               		<div style="margin-top: 30px;" class="col-md-12">
               			<div>Password</div>
               			<input type="password" id="password" class="login-input" name="">
               		</div>

               		<div style="margin-top: 30px;" class="col-md-12">
               			<button id="login-btn" type="button" class="btn btn-login">Login</button>
               			<div style="margin-top:9px">
               				<small>Terms & conditions</small>
               			</div>
               		</div>
               	</div>
               </div>
		   </div>
		</div>
    </div>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


<script>
	
	$('#login-btn').click(function(){
		var email = $('#email').val();
		var password = $('#password').val();

		if(email.trim()=='' || password==''){
			return
		}


		$.ajax({
                        type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                        url:  "<?=base_url();?>login/authenticateUser",
                        data:{email:email,password:password} ,
                        dataType: 'json', // what type of data do we expect back from the server
                        encode: true
                    })
                    // using the done promise callback
                    .done(function(data) {
                    if(data.status==false){
                    
         
               
                    }

                     if(data.status==true){
                        location.href=data.redirect_url;
                    }
                    })
                    // using the fail promise callback
                    .fail(function(data) {
                      $('#submit-btn').prop('disabled',false);
                       console.log(data);
                    });

	})

</script>


</body>
</html>