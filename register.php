<?php include('server.php') ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Manage Khata</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
		<link rel="stylesheet" href="./css/style.css">

</head>

<body style="background: radial-gradient(#002D62,#0a2351);">

	<div class="d-flex justify-content-center align-items-center" style="height:100vh;">

		<form method="post" id="contactform" action="register.php"
			class="forms border col-lg-4 col-md-5 col-sm-8 col-10 rounded-3 pt-5 pb-5 px-3 py-3">
			<h3 class="text-center">Register</h3>

			<div class="form-wrapper mt-4">
				<label>Username</label>
				<input type="text" id="name" name="username" class="form-control" placeholder="User Name">
				<span class="form_error">Please enter username</span>
			</div>
			<div class="form-wrapper mt-4">
				<label>Email</label>
				<input type="email" id="email" name="email" class="form-control" placeholder="Email">
				<span class="form_error">Please enter your email</span>
				<span class="form_error" id="invalid_email">This email is not valid</span>
			</div>
			<div class="form-wrapper mt-4">
				<label>Password</label>
				<input type="password" id="password_1" name="password_1" class="form-control" placeholder="Password">
				<span class="form_error">Please enter your password</span>
			</div>
			<div class="form-wrapper mt-4">
				<label>Confirm password</label>
				<input type="password" name="password_2" id="password_2" class="form-control"
					placeholder="Confirm Password">
				<span class="form_error">Please enter your password</span>
			</div>
			<p class="text-center mt-4">
				<?php include('errors.php'); ?>
				Already a member? <a href="login.php">Sign in</a>
			</p>
			<div class="form-wrapper mt-4">
				<div class=" d-grid col-4 mx-auto">
					<button type="submit" id="submit" class="btn bg-dark text-white" name="reg_user">Register</button>
				</div>
			</div>
			<div id="success" style="color:red;"></div>
		</form>
	</div>



	<!-- =======================Jquery CDN====================== -->
	<script src="https://code.jquery.com/jquery-3.6.0.js"
		integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous">
	</script>

	<script>
		$(document).ready(function () {
			$('.form_error').hide();
			$('#submit').click(function () {
				var name = $('#name').val();
				var email = $('#email').val();
				var password_1 = $('#password_1').val();
				var password_2 = $('#password_2').val();
				// var message = $('#message').val();
				if (name == '') {
					$('#name').next().show();
					return false;
				}
				if (email == '') {
					$('#email').next().show();
					return false;
				}
				if (IsEmail(email) == false) {
					$('#invalid_email').show();
					return false;
				}
				if (password_1 == '') {
					$('#password_1').next().show();
					return false;
				}
				if (password_2 == '') {
					$('#password_2').next().show();
					return false;
				}
				// if (message == '') {
				// 	$('#message').next().show();
				// 	return false;
				// }
				//ajax call php page
				$.post("login.php", $("#contactform").serialize(), function (response) {
					$('#contactform').fadeOut('slow', function () {
						$('#success').html(response);
						$('#success').fadeIn('slow');
					});
					return false;
				});
			});

			function IsEmail(email) {
				var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				if (!regex.test(email)) {
					return false;
				} else {
					return true;
				}
			}
		});
	</script>
</body>

</html>