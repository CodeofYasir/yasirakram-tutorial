<?php include('server.php')?>
<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- STYLE CSS -->
	<!-- <link rel="stylesheet" href="./css/style.css"> -->
	
	<title>Manage Khata</title>
</head>
<body>
	
	<div class="wrapper" style="background-image: url('assest/img2.jpg');">
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