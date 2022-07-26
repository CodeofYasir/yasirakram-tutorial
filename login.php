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
	
	<div class="col-lg-5 col-md-7 col-sm-8 col-10 m-auto">
			<form class="forms border m-auto" method="post" action="login.php">
				<h3 class="text-center">Login</h3>
				<div class="form-wrapper text-center">
					<?php include('errors.php'); ?>
				</div>
				<div class="form-wrapper">
					<label>Username</label>
					<input type="text" name="username" class="form-control">
				</div>
				<div class="form-wrapper mt-4">
					<label>Password</label>
					<input type="password" name="password" class="form-control">
				</div>
				<p class="text-center mt-4">
					Not yet a member? <a href="register.php">Sign up</a>
				</p>
				<div class="form-wrapper">
					<button type="submit" class="btn btn-secondary mt-4 d-flex align-item-center m-auto" name="login_user">Login</button>
				</div>
				
			</form>
	</div>
</body>

</html>