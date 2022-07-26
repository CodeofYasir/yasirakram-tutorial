<?php include('server.php') ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>RegistrationForm_v2 by Colorlib</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- MATERIAL DESIGN ICONIC FONT -->
	<link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">

	<!-- STYLE CSS -->
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<div class="wrapper" style="background-image: url('images/img2.jpg');">
		<div class="inner">


			<form method="post" action="login.php">
				<h3>Login</h3>
				<div class="form-wrapper">
					<?php include('errors.php'); ?>
				</div>
				<div class="form-wrapper">
					<label>Username</label>
					<input type="text" name="username" class="form-control">
				</div>
				<div class="form-wrapper">
					<label>Password</label>
					<input type="password" name="password" class="form-control">
				</div>
				<p>
					Not yet a member? <a href="register.php">Sign up</a>
				</p>
				<div class="form-wrapper">
					<button type="submit" class="btn" name="login_user">Login</button>
				</div>
				
			</form>
		</div>
	</div>
</body>

</html>