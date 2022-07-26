<?php include('server.php')?>
<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./css/style.css">
	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
	
	<title>Manage Khata</title>
</head>
<body>
	
	<div class="bgall d-flex justify-content-center align-items-center" style="height:100vh;">
			<form id="loginform" class="forms bg1 col-lg-4 col-md-5 col-sm-8 col-10 rounded-3 pt-5 pb-5 px-3 py-3 " method="post" action="login.php">
				<h3 class="text-center text-uppercase">Login</h3>
				<div class="form-wrapper">
					<label>Username</label>
					<input type="text" id="name" name="username" class="form-control" placeholder="User Name">
					 
				</div>
				<div class="form-wrapper mt-2">
					<label>Password</label>
					<input type="password" id="password_1" name="password" placeholder="Password" class="form-control">
					 
				</div>
				<p class="text-center error"><?php include('errors.php'); ?></p>
				<p class="text-center mt-2">
					Not yet a member? <a href="register.php">Sign up</a>
				</p>
				<div class="form-wrapper ">
					<div class=" d-grid col-4 mx-auto">
					<button type="submit" id="submit" class="btn text-uppercase" name="login_user">Login</button>
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
	
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<script>
	$.validator.addMethod("noSpace",function(value,element){
		return value == '' || value.trim().length != 0 
	}, "Spaces are not allowed");
	
      $('#loginform').validate({
        rules: {
            username: {
				required:true,
				noSpace: true
			},
            password: {
                required: true,
            }
        },
		messages: {
            username: {
				required:"username is required!"
			},
            password: {
                required: "password is required!",
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
	
</script>
</body>

</html>