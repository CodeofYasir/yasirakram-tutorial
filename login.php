<?php include('server.php')?>
<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
	
	<title>Manage Khata</title>
</head>
<body style="background-image: url('assest/img2.jpg')">
	
	<div class="d-flex justify-content-center align-items-center" style="height:100vh;">
			<form id="loginform" class="forms border col-lg-4 col-md-5 col-sm-8 col-10 bg-info rounded-3 bg-gradient pt-5 pb-5 px-3 py-3 " method="post" action="login.php">
				<h3 class="text-center">Login</h3>
				<div class="form-wrapper">
					<label>Username</label>
					<input type="text" id="name" name="username" class="form-control" placeholder="User Name">
					<span class="form_error">Please enter username</span>
				</div>
				<div class="form-wrapper mt-4">
					<label>Password</label>
					<input type="password" id="password_1" name="password" placeholder="Password" class="form-control">
					<span class="form_error">Please enter your password</span>
				</div>
				<p class="text-center mt-4">
					Not yet a member? <a href="register.php">Sign up</a>
					<?php include('errors.php'); ?>
				</p>
				<div class="form-wrapper">
					<div class=" d-grid col-4 mx-auto">
					<button type="submit" id="submit" class="btn bg-dark text-white" name="login_user">Login</button>
					</div>
				</div>
				
			</form>
	</div>

<!-- =======================Jquery CDN====================== -->
<script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous">
</script>

<script>
	$(document).ready(function(){

		  $('.form_error').hide();
		  $('#submit').click(function(){
			   var name = $('#name').val();
			   var password_1 = $('#password_1').val();
			   var message = $('#message').val();
			   if(name== ''){
				  $('#name').next().show();
				  return false;
				}
				if(password_1== ''){
					$('#password_1').next().show();
					return false;
				}
				if(message== ''){
					$('#message').next().show();
					return false;
				}
				//ajax call php page
				$.post("index.php", $("#loginform").serialize(),  function(response) {
				$('#loginform').fadeOut('slow',function(){
					$('#success').html(response);
					$('#success').fadeIn('slow');
				 });
				 return false;
			  });
		  });
	});
	
	 
  </script> 


</body>

</html>