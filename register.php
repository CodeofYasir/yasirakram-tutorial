<?php include('server.php') ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Manage Khata</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

</head>
<body style="background-image: url('assest/img2.jpg');">

	<div class="d-flex justify-content-center align-items-center" style="height:100vh;">
	 
			<form method="post" action="register.php" class="forms border col-lg-5 col-md-7 col-sm-8 col-10 m-auto p-3" >
				<h3 class="text-center">Register</h3>
				<div class="form-wrapper">
					<?php include('errors.php'); ?>
				</div>
				<div class="form-wrapper mt-4">
					<label>Username</label>
					<input type="text" name="username" value="<?php echo $username; ?>" class="form-control">
				</div> 
				<div class="form-wrapper mt-4">
					<label>Email</label>
					<input type="email" name="email" value="<?php echo $email; ?>" class="form-control">
				</div>
				<div class="form-wrapper mt-4">
					<label>Password</label>
					<input type="password" name="password_1" class="form-control">
				</div>
				<div class="form-wrapper mt-4">
					<label>Confirm password</label>
					<input type="password" name="password_2" class="form-control">
				</div>
				<p class="text-center mt-4">
					Already a member? <a href="login.php">Sign in</a>
				</p>
				<div class="form-wrapper mt-4">
					<button type="submit" class="btn btn-secondary mt-4 d-flex align-item-center m-auto" name="reg_user">Register</button>
				</div>
			</form>
		 
	</div> 
</body>

</html>