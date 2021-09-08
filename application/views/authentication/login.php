<!DOCTYPE html>
<html>
<head>
	<title> Smart Hybrid - HyperText Dev</title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

	<link rel="stylesheet" href="<?= base_url('assets/css/main.css')?>">
</head>

<body>

	<div class="container">
		<div class="col-md-6">
			
		</div>
		<div class="col-md-6">
			<form method="post" id="loginForm">
				<div class="row">

					<div class="form-group col-md-12">
						<label for="email_id">Email Id</label>
						<div>
					      	<input type="text" class="form-control" name="email_id">
					    </div>
					    <span class="error-class" id="email_id-error"></span>
					</div>

					<div class="form-group col-md-12">
						<label for="password">Password</label>
						<div>
					      	<input type="password" class="form-control" name="password">
					    </div>
					    <span class="error-class" id="password-error"></span>
					</div>

					<div class="col-md-12 form-group">
                        <div class="error-class" id="message-error"></div>    
                    </div>

					<div class="col-md-12">
						<button type="submit" class="btn btn-info float-right">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>

<script type="text/javascript">

$(document).ready(function(){

	$('#loginForm').submit(function(event){
        event.preventDefault();
        var form = $(this);
        var form_id = form.attr('id');

        $('.error-class').empty();
        var login_data = $(this).serialize();

        $.ajax({
            type: 'POST',
            url:'submit_login',
            data: login_data,
            success: function(response){
                if(response.status == false){
                    //check for validation error
                    if(response.data['error'] != ''){
                        $.each(response.data['error'], function(key, value){
                            $('#'+form_id+' #'+key + '-error').html(value);
                        });
                    }
                    if(response.message != ''){
                        $('#'+form_id+' #message-error').html(response.message);
                    }
                }
                if(response.status == true){
                	//sign up success.
                    window.location.href = 'dashboard';
                }
            }
        });
    });
});

</script>