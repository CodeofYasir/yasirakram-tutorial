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

<body>

	<div class="bgall d-flex justify-content-center align-items-center" style="height:100vh;">

		<form method="post" id="form" action="register.php"
			class="forms bg1 col-lg-4 col-md-5 col-sm-8 col-10 rounded-3 pt-5 pb-5 px-3 py-3">
			<h3 class="text-center text-uppercase">Sign up</h3>

			<div class="form-wrapper mt-2">
				<label>Username</label>
				<input type="text" id="name" name="username" class="form-control" placeholder="User Name">
			</div>
			<div class="form-wrapper mt-2">
				<label>Email</label>
				<input type="email" id="email" name="email" class="form-control" placeholder="Email">
			</div>
			<div class="form-wrapper mt-2">
				<label>Password</label>
				<input type="password" id="password_1" name="password_1" class="form-control" placeholder="Password">
			</div>
			<div class="form-wrapper mt-2">
				<label>Confirm password</label>
				<input type="password" name="password_2" id="password_2" class="form-control"
					placeholder="Confirm Password">
			</div>
			<p class="text-center error"><?php include('errors.php'); ?></p>
			<p class="text-center mt-2">
				Already a member? <a href="login.php">Sign in</a>
			</p>
			<div class="form-wrapper mt-2">
				<div class=" d-grid col-4 mx-auto">
					<button type="submit" id="submit" value="Validate!" class="btn text-uppercase" name="reg_user">sign up</button>
				</div>
			</div>
		</form>
	</div>



	<!-- =======================Jquery CDN====================== -->
	
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<script>
	$.validator.addMethod("noSpace",function(value,element){
		return value == '' || value.trim().length != 0 
	}, "Spaces are not allowed");

	$.validator.addMethod("laxEmail", function(value,element) {
    // allow any non-whitespace characters as the host part
    return this.optional(element) || /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@(?:\S{1,63})$/.test(value );
    }, 'Please enter a valid email address.');
	
	$.validator.addMethod("strong_password", function (value, element) {
    let password = value;
    if (!(/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@#$%&])(.{8,20}$)/.test(password))) {
        return false;
    }
    return true;
}, function (value, element) {
    let password = $(element).val();
    if (!(/^(.{8,20}$)/.test(password))) {
        return 'Password must be between 8 to 20 characters long.';
    }
    else if (!(/^(?=.*[A-Z])/.test(password))) {
        return 'Password must contain at least one uppercase.';
    }
    else if (!(/^(?=.*[a-z])/.test(password))) {
        return 'Password must contain at least one lowercase.';
    }
    else if (!(/^(?=.*[0-9])/.test(password))) {
        return 'Password must contain at least one digit.';
    }
    else if (!(/^(?=.*[@#$%&])/.test(password))) {
        return "Password must contain special characters from @#$%&.";
    }
    return false;
});

      $('#form').validate({
        rules: {
            username: {
				required:true,
				noSpace: true
			},
            email: {
                required: true,
                // email: true,
				laxEmail:true
            },
			
            password_1: {
                required: true,
				strong_password: true,
            },
            password_2: {
				required: true,
				equalTo:"#password_1"
				}
        },
		messages: {
            username: {
				required:"username is required!"
			},
            email: {
                required: "email is required!",
				laxEmail:true
            },
			
            password_1: {
                required: "password is required!",
            },
            password_2: {
				required: 'please confirm password!'
				}
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
	
</script>
</body>

</html>