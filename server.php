<?php
session_start();


$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$cleardb_server = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db = substr($cleardb_url["path"],1);
$active_group = 'default';
$query_builder = TRUE;
$db = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);



// $username = "";
// $email    = "";
// $db = mysqli_connect('localhost', 'root', '', 'khata');



$errors = array(); 

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }
  
  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM `users` WHERE  username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result); 
   
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }
  
  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (username, email, password) 
  			  VALUES('$username', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	header('location: index.php');
  }
}
 
// LOGIN USER

if (isset($_POST['login_user'])) {
    $email = mysqli_real_escape_string($db, $_POST['email']); 
    $username = mysqli_real_escape_string($db, $_POST['username']); 
    $password = mysqli_real_escape_string($db, $_POST['password']);
  
    if (empty($email)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }  
    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM users WHERE username='$username', email='$email', password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
          $_SESSION['email'] = $email;
          $_SESSION['success'] = "You are now logged in";
          header('location: index.php');
        }else {
            array_push($errors, "Wrong username or password ");
        }
    }
  }

  error_reporting(0);
  $query = "SELECT u_id AS user_id FROM users where username ='".$_SESSION['username']."'";
  $result = mysqli_query($db, $query);
  while ($i = mysqli_fetch_assoc($result)) {
    // $id_ans = "ID is: ".$i['user_id'];
    $u_id = $i['user_id'];
  }
 
		 
  //============================= Submit Lender Data============================//
    if (isset($_POST['lender_data'])) {
    $l_name = mysqli_real_escape_string($db, $_POST['l_name']);
    $l_amount = mysqli_real_escape_string($db, $_POST['l_amount']);
    $l_desc = mysqli_real_escape_string($db, $_POST['l_desc']);
    $l_cdate = mysqli_real_escape_string($db, $_POST['l_cdate']);
    $l_rdate = mysqli_real_escape_string($db, $_POST['l_rdate']);
    
    if (empty($l_name)) {array_push($errors, "Name is required");}
    if (empty($l_amount)) {array_push($errors, "Amount is required");}
    if (empty($l_desc)) {array_push($errors, "Description is required");}
    if (empty($l_cdate)) {array_push($errors, "Current Date is required");}
    if (empty($l_rdate)) {array_push($errors, "Return Date is required");}
      
    if (count($errors) == 0) {
      $q= "INSERT INTO lender(u_id,l_name,l_amont,l_desc,l_cdate,l_rdate) 
      VALUES('$u_id','$l_name','$l_amount','$l_desc','$l_cdate','$l_rdate')";
      mysqli_query($db, $q);
      $_SESSION['l_name'] = $l_name;
      header('location: index.php');
    }
  } 
  
  $l_query = "SELECT SUM(l_amont) AS sum FROM `lender` WHERE u_id = '$u_id'";
  $result = mysqli_query($db, $l_query);
  while ($l = mysqli_fetch_assoc($result)) {
    $total_lend= $l['sum'] + 0;
    $l_ans = "Lender Total Amount is: "."". $total_lend;
  }
  if (isset($_GET['del'])) {
    $l_id = $_GET['del'];
    mysqli_query($db, "DELETE FROM lender WHERE `l_id`='$l_id'");
    header('location: index.php');
}

// ==============lender filter
if(isset($_POST["from_date"], $_POST["to_date"]))  
 {  
      $db = mysqli_connect('localhost', 'root', '', 'khata');        
      $output = '';  
      $query = "SELECT * FROM lender  
           WHERE l_rdate BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."' AND u_id = '$u_id'";  
      $result = mysqli_query($db, $query);  
      $output .= '  
           <table class="table table-bordered">  
                <tr>  
                     <th width="5%">ID</th>  
                     <th width="10%">Name</th>  
                     <th width="10%">Amount</th>  
                     <th width="10%">Deacriptopm</th>  
                     <th width="12%">Current Date</th>  
                     <th width="12%">Return Date</th>
                     <th colspan="2">Action</th>  
                </tr>  
      ';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '  
                     <tr>  
                          <td>'. $row["l_id"] .'</td>  
                          <td>'. $row["l_name"] .'</td>  
                          <td>'. $row["l_amont"] .'</td>  
                          <td>'. $row["l_desc"] .'</td>  
                          <td>'. $row["l_cdate"] .'</td>  
                          <td>'. $row["l_rdate"] .'</td>
                          <td>
							            <a href="server.php?del=<?php echo '.$row["l_id"].'?>" class="text-decoration-none">
								          <span class="badge text-bg-success">received</span>
							            </a>
							            <a href="#" data-bs-toggle="tooltip" data-bs-placement="top"
								          data-bs-custom-class="custom-tooltip color-light"
								          data-bs-title="If you know that you will never get this money"
                          class="text-decoration-none">
								          <span class="badge text-bg-warning">not received</span>
							            </a>
						              </td>  
                     </tr>  
                ';  
           }  
      }  
      else  
      {  
           $output .= '  
                <tr>  
                     <td colspan="5">No Record Found</td>  
                </tr>  
           ';  
      }  
      $output .= '</table>';  
      echo $output;  
 }


  //============================= submit data for borrow===============================//
   if (isset($_POST['borrow_data'])) {
    $b_name = mysqli_real_escape_string($db, $_POST['b_name']);
    $b_amount = mysqli_real_escape_string($db, $_POST['b_amont']);
    $b_desc = mysqli_real_escape_string($db, $_POST['b_desc']);
    $b_cdate = mysqli_real_escape_string($db, $_POST['b_cdate']);
    $b_rdate = mysqli_real_escape_string($db, $_POST['b_rdate']);
    
    if (empty($b_name)) {array_push($errors, "Name is required");}
    if (empty($b_amount)) {array_push($errors, "Amount is required");}
    if (empty($b_desc)) {array_push($errors, "Description is required");}
    if (empty($b_cdate)) {array_push($errors, "Current Date is required");}
    if (empty($b_rdate)) {array_push($errors, "Return Date is required");}
  
    if (count($errors) == 0) {
      $qu= "INSERT INTO borrow(u_id,b_name,b_amount,b_desc,b_cdate,b_rdate) 
      VALUES('$u_id','$b_name','$b_amount','$b_desc','$b_cdate','$b_rdate')";
      mysqli_query($db, $qu);
      $_SESSION['b_name'] = $b_name;
      header('location: index.php');
    }
  } 
  
  $b_query = "SELECT SUM(b_amount) AS sum FROM `borrow` WHERE u_id = '$u_id'";
  $result = mysqli_query($db, $b_query);
  while ($b = mysqli_fetch_assoc($result)) {
    $total_borrow= $b['sum']+ 0;
    $b_ans = "Borrower Total Amount is: "."".$total_borrow;
  }
  if (isset($_GET['del'])) {
    $b_id = $_GET['del'];
    mysqli_query($db, "DELETE FROM borrow WHERE `b_id`='$b_id'");
    header('location: index.php');
}

  // submit data for investment
    if (isset($_POST['investment_data'])) {
      $i_name = mysqli_real_escape_string($db, $_POST['i_name']);
      $i_amount = mysqli_real_escape_string($db, $_POST['i_amont']);
      $i_desc = mysqli_real_escape_string($db, $_POST['i_desc']);
      $i_cdate = mysqli_real_escape_string($db, $_POST['i_cdate']);
      
      if (empty($i_name)) {array_push($errors, "Name is required");}
      if (empty($i_amount)) {array_push($errors, "Amount is required");}
      if (empty($i_desc)) {array_push($errors, "Description is required");}
      if (empty($i_cdate)) {array_push($errors, "Current Date is required");}
     
     
      
     
      if (count($errors) == 0) {
        $qu= "INSERT INTO investment(u_id,i_name,i_amount,i_desc,i_cdate) 
        VALUES('$u_id','$i_name','$i_amount','$i_desc','$i_cdate')";
        mysqli_query($db, $qu);
        $_SESSION['i_name'] = $i_name;
        header('location: index.php');
      }
    } 
  $i_query = "SELECT SUM(i_amount) AS sum FROM `investment` WHERE u_id = '$u_id'";
  $result = mysqli_query($db, $i_query);
  while ($i = mysqli_fetch_assoc($result)) {
    $total_investment= $i['sum']+ 0;
    $i_ans = "Investment Total Amount is: "."".$total_investment;
  }

   

// submit data for income
if (isset($_POST['income_data'])) {
  $inc_name = mysqli_real_escape_string($db, $_POST['inc_name']);
  $inc_amount = mysqli_real_escape_string($db, $_POST['inc_amont']);
  $inc_desc = mysqli_real_escape_string($db, $_POST['inc_desc']);
  $inc_cdate = mysqli_real_escape_string($db, $_POST['inc_cdate']);
  
  if (empty($inc_name)) {array_push($errors, "Name is required");}
  if (empty($inc_amount)) {array_push($errors, "Amount is required");}
  if (empty($inc_desc)) {array_push($errors, "Description is required");}
  if (empty($inc_cdate)) {array_push($errors, "Current Date is required");}
 
 
  
 
  if (count($errors) == 0) {
    $qu= "INSERT INTO income(u_id,inc_name,inc_amount,inc_desc,inc_cdate) 
    VALUES('$u_id','$inc_name','$inc_amount','$inc_desc','$inc_cdate')";
    mysqli_query($db, $qu);
    $_SESSION['inc_name'] = $inc_name;
    header('location: index.php');
  }
}

$inc_query = "SELECT SUM(inc_amount) AS sum FROM `income` WHERE u_id = '$u_id'";
$result = mysqli_query($db, $inc_query);
while ($inc = mysqli_fetch_assoc($result)) {
  $total_inc= $inc['sum']+ 0;
  $inc_ans = "Income Total Amount is: "."".$total_inc;
}
  ?>