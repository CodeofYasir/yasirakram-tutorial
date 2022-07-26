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



    // $db = mysqli_connect('localhost', 'root', '', 'khata');


$username = "";
$email    = "";
$errors = array(); 


// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  
  if ($password_1 != $password_2) {
	array_push($errors, "passwords do not match");
  }
  
  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM `users` WHERE  username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result); 
   
  if ($user) { // if user exists
    if ($user['username'] === $username ) {
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
  	header('location: login.php');
  }
}
 
// LOGIN USER

if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
  
   
    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
          $_SESSION['username'] = $username;
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
   
    $u_id = $i['user_id'];
  }
 


//============================= Submit Expenses Data============================//

if (isset($_POST['expenses_data'])) {
      $e_name = mysqli_real_escape_string($db, $_POST['e_name']);
      $e_amount = mysqli_real_escape_string($db, $_POST['e_amount']);
      $e_desc = mysqli_real_escape_string($db, $_POST['e_desc']);
        
      if (count($errors) == 0) {
        $q= "INSERT INTO expenses(u_id,e_name,e_amont,e_desc) 
        VALUES('$u_id','$e_name','$e_amount','$e_desc')";
        mysqli_query($db, $q);
        $_SESSION['e_name'] = $e_name;
        header('location: index.php');
      }
    } 
    $e_query = "SELECT SUM(e_amont) AS sum FROM `expenses` WHERE u_id = '$u_id'";
    $result = mysqli_query($db, $e_query);
    while ($e = mysqli_fetch_assoc($result)) {
      $total_exp= $e['sum'] + 0;
      $e_ans = "Expenses Total Amount is: "."". $total_exp;
}


  //============================= Submit Lender Data============================//
if (isset($_POST['lender_data'])) {
    $l_name = mysqli_real_escape_string($db, $_POST['l_name']);
    $l_amount = mysqli_real_escape_string($db, $_POST['l_amount']);
    $l_desc = mysqli_real_escape_string($db, $_POST['l_desc']);
    $l_cdate = mysqli_real_escape_string($db, $_POST['l_cdate']);
    $l_rdate = mysqli_real_escape_string($db, $_POST['l_rdate']);
    
   
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
    header('location: index.php?m=1');
}

//====================Lender Amount receive or Amount Not Receive===========================

if (isset($_GET['notreceive_del'])) {
  $l_id = $_GET['notreceive_del'];
  $sql ="INSERT INTO notreceived (u_id,nr_name,nr_amont,nr_desc,nr_cdate,nr_rdate) SELECT u_id,l_name,l_amont,l_desc,l_cdate,l_rdate FROM lender WHERE l_id = '$l_id';
  DELETE FROM lender WHERE `l_id`='$l_id'";

if ($db->multi_query($sql) === TRUE) {
  // echo "Data inserted successfully";
}
// else { // The user accessed the script directly
//   echo "That is not allowed!";
// }
header('location: index.php');
}

if (isset($_GET['del_receive'])) {
  $nr_id = $_GET['del_receive'];
  mysqli_query($db, "DELETE FROM notreceived WHERE `nr_id`='$nr_id'");
  header('location: index.php');
}
$nr_query = "SELECT SUM(nr_amont) AS sum FROM `notreceived` WHERE u_id = '$u_id'";
  $result = mysqli_query($db, $nr_query);
  while ($nr = mysqli_fetch_assoc($result)) {
    $total_nr= $nr['sum'] + 0;
    $nr_ans = "Lender Total Not Received Amount is: "."". $total_nr;
  }

 //============================= submit data for borrow===============================//

   if (isset($_POST['borrow_data'])) {
    $b_name = mysqli_real_escape_string($db, $_POST['b_name']);
    $b_amount = mysqli_real_escape_string($db, $_POST['b_amont']);
    $b_desc = mysqli_real_escape_string($db, $_POST['b_desc']);
    $b_cdate = mysqli_real_escape_string($db, $_POST['b_cdate']);
    $b_rdate = mysqli_real_escape_string($db, $_POST['b_rdate']);
    
    // if (empty($b_name)) {array_push($errors, "Name is required");}
    // if (empty($b_amount)) {array_push($errors, "Amount is required");}
    // if (empty($b_desc)) {array_push($errors, "Description is required");}
    // if (empty($b_cdate)) {array_push($errors, "Current Date is required");}
    // if (empty($b_rdate)) {array_push($errors, "Return Date is required");}
  
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
//====================Borrower Amount return or  Not return===========================
 

if (isset($_GET['notreturn_del'])) {
  $b_id = $_GET['notreturn_del'];
  $sql ="INSERT INTO notreturn (u_id,nrt_name,nrt_amount,nrt_desc,nrt_cdate,nrt_rdate) SELECT u_id,b_name,b_amount,b_desc,b_cdate,b_rdate FROM borrow WHERE b_id = '$b_id';
  DELETE FROM borrow WHERE `b_id`='$b_id'";
// Execute the queries with multi_query
if ($db->multi_query($sql) === TRUE) {
  // echo "Data inserted successfully";
}
// else { // The user accessed the script directly
//   echo "That is not allowed!";
// }
header('location: index.php');
}

if (isset($_GET['del_return'])) {
  $nrt_id = $_GET['del_return'];
  mysqli_query($db, "DELETE FROM notreturn WHERE `nrt_id`='$nrt_id'");
  header('location: index.php');
}
$nrt_query = "SELECT SUM(nrt_amount) AS sum FROM `notreturn` WHERE u_id = '$u_id'";
  $result = mysqli_query($db, $nrt_query);
  while ($nrt = mysqli_fetch_assoc($result)) {
    $total_nrt= $nrt['sum'] + 0;
    $nrt_ans = "Borrower Total Not Received Amount is: "."". $total_nrt;
}


  // submit data for investment
    if (isset($_POST['investment_data'])) {
      $i_name = mysqli_real_escape_string($db, $_POST['i_name']);
      $i_amount = mysqli_real_escape_string($db, $_POST['i_amont']);
      $i_desc = mysqli_real_escape_string($db, $_POST['i_desc']);
      $i_cdate = mysqli_real_escape_string($db, $_POST['i_cdate']);
      
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


// check return date is greater then current date 

// $results = mysqli_query($db, "SELECT * FROM lender WHERE u_id = '$u_id'"); 
// for($i=0;$i<$row = mysqli_fetch_array($results);$i++){


// $date = $row['l_rdate'];
// // checking if the last date has arrived
// if(strtotime("today") == strtotime($date)){
// echo $row['l_rdate']."last day to return <br>";
// }
// // checking if the last date hasn’t arrived yet
// else if(strtotime("today") > strtotime($date)){
//   echo $row['l_rdate']." \t date is passsed  <br>";
// }
// // printing a message in case the last date has passed already
// else{
//   echo $row['l_rdate']."\t you have some days <br>";
// }
    
// }
?>
