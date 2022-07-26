<?php include('server.php') ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Manage Khata</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body style="background-image: url('assest/img2.jpg');">
	<div class="d-flex justify-content-center align-items-center" style="height:100vh;">
	 
			<form method="post" action="register.php" class="forms border col-lg-5 col-md-7 col-sm-8 col-10 m-auto p-3" >
				<h3 class="text-center">Register</h3>
				<div class="form-wrapper">
					<?php include('errors.php'); ?>
				</div>
				<div class="form-wrapper">
					<label>Username</label>
					<input type="text" name="username" value="<?php echo $username; ?>" class="form-control">
				</div> 
				<div class="form-wrapper">
					<label>Email</label>
					<input type="email" name="email" value="<?php echo $email; ?>" class="form-control">
				</div>
				<div class="form-wrapper">
					<label>Password</label>
					<input type="password" name="password_1" class="form-control">
				</div>
				<div class="form-wrapper">
					<label>Confirm password</label>
					<input type="password" name="password_2" class="form-control">
				</div>
				<p class="text-center">
					Already a member? <a href="login.php">Sign in</a>
				</p>
				<div class="form-wrapper">
					<button type="submit" class="btn" name="reg_user">Register</button>
				</div>
			</form>
		 
	</div> 
</body>

</html>