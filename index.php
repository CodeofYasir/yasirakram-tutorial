<?php include('server.php') ?>
<?php
  
  if (!isset($_SESSION['username'])) {
	$_SESSION['msg'] = "You must log in first";
	
	header('location: login.php');
}
if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['username']);
  header("location: login.php");
}
$query = "SELECT * FROM lender WHERE u_id = '$u_id'";  
$result = mysqli_query($db, $query);
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Manage Khata</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--Jquery  -->
	<!-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"> -->
	<link rel="stylesheet" href="./css/style.css">
	<!-- bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
	<!-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"> -->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<!-- <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
	</script>

	<!-- Data table -->
	<script type="text/javascript" charset="utf8"
		src="https://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.0/jquery.dataTables.min.js"></script>
	<script type="text/javascript" charset="utf8"
		src="https://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.0/jquery.dataTables.js"></script>
	<link rel="stylesheet" type="text/css"
		href="https://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.0/css/jquery.dataTables.css">



</head>

<body>

	<div class="size col-lg-10 col-md-10 col-12 m-auto p-1">
		<!-- =============================header======================================= -->

		<div
			class="bg1 p-2 text-light align-items-center d-flex justify-content-between col-lg-10 col-md-10 col-sm-10 col-xs-10 m-auto mt-2">
			<div class="d-flex justify-content-center align-items-center">
				<?php  if (isset($_SESSION['username'])) : ?>
				<h3 class="text-uppercase">
					<?php echo $_SESSION['username'];?>
				</h3>
				<h5 class="text-lowercase">
					<?php 
				$total = ($total_inc+$total_borrow+$total_nrt)-($total_investment+$total_lend+$total_exp+ $total_nr);
				  echo "(balance: ".$total.")";
				?>
				</h5>
			</div>
			<h3>
				<a href="index.php?logout='1'" class="text-decoration-none text-light text-uppercase">logout</a>
			</h3>
			<?php endif ?>
		</div>

		<!-- =============================Categories======================================= -->

		<div class="row bg1 col-lg-10 p-2 col-md-10 col-sm-10 col-xs-10 m-auto mt-1 pb-3">
			<div class="col-lg-6 col-md-6 col-sm-6 col-12 dropdown text-center">
				<h3>Not received/Returned</h3>
				<button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown"
					aria-expanded="false">
					-- Select To See --
				</button>
				<ul id="bg" class="dropdown-menu">
					<li><a class="11 dropdown-item" href="#">Not received</a></li>
					<li><a class="12 dropdown-item" href="#">Not Returned</a></li>
				</ul>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-12 dropdown text-center">
				<h3>To Enter Data</h3>
				<button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown"
					aria-expanded="false">
					-- Select Category --
				</button>
				<ul id="bg" class="dropdown-menu">
					<li><a class="0 dropdown-item" href="#">Expenses</a></li>
					<li><a class="1 dropdown-item" href="#">To Lend</a></li>
					<li><a class="2 dropdown-item" href="#">Borrow</a></li>
					<li><a class="3 dropdown-item" href="#">Investment</a></li>
					<li><a class="4 dropdown-item" href="#">Income</a></li>
				</ul>
			</div>
		</div>

		<!-- ==============================Expenses Data=================================== -->

		<div
			class="p-2  bg1 mb-1 forms expenses-form col-lg-10 col-md-10 col-sm-10 col-xs-10 mt-1 m-auto overflow-hidden">

			<form method="post" action="index.php" class=" mt-4 col-lg-8 col-md-10 col-sm-11 col-xs-11 m-auto">
				<?php include('errors.php');?>
				<h3 class="text-center">Expenses(اخراجات)</h3>
				<div class="row mt-4">
					<div class="col">
						<input type="text" name="e_name" class="form-control" placeholder="Type">
					</div>
					<div class="col">
						<input type="text" name="e_amount" class="form-control" placeholder="Amount">
					</div>
				</div>
				<textarea name="e_desc" class="col-12 mt-4 p-1" id="desc" cols="10" rows="3"
					placeholder="Description"></textarea>
				<div class=" d-grid col-4 mx-auto">
					<button type="submit" name="expenses_data" class="btn btn-dark mt-4">Submit</button>
				</div>
			</form>

			<?php $results = mysqli_query($db, "SELECT * FROM expenses WHERE u_id = '$u_id'"); ?>
			<h3 class="text-center mt-4">Expenses Data</h3>
			<table id="expenses_table" class="table table-striped table-bordered table-dark text-center mt-4">
				<thead>
					<tr>
						<th class="p-0 m-0">Type</th>
						<th class="p-0 m-0">Amount</th>
						<th class="p-0 m-0">Description</th>
					</tr>
				</thead>
				<?php while ($row = mysqli_fetch_array($results)) { ?>
				<tr>
					<td class="p-0 m-0">
						<?php echo $row['e_name']; ?>
					</td>
					<td class="p-0 m-0">
						<?php echo $row['e_amont']; ?>
					</td>
					<td class="p-0 m-0">
						<?php echo $row['e_desc']; ?>
					</td>
				</tr>
				<?php } ?>
			</table>

			<h3 class="text-center mt-4">
				<?php echo $e_ans;?>
			</h3>
		</div>
		<script>
			$(document).ready(function () {
				$('#expenses_table').DataTable();
			});
		</script>
		<!-- ==============================Lender Data===================================== -->

		<div class="p-2 bg1 mb-1 forms lender-form col-lg-10 col-md-10 col-sm-10 col-xs-10 mt-1 m-auto overflow-hidden">

			<form method="post" action="index.php" class="mt-4 col-lg-8 col-md-10 col-sm-11 col-xs-11 m-auto">
				<?php include('errors.php');?>
				<h3 class="text-center">To Lend(ادھار دینا)</h3>
				<div class="row mt-4">
					<div class="col">
						<input type="text" name="l_name" class="form-control" placeholder="Name">
					</div>
					<div class="col">
						<input type="text" name="l_amount" class="form-control" placeholder="Amount">
					</div>
				</div>
				<textarea name="l_desc" class="col-12 mt-4 p-1" id="desc" cols="10" rows="3"
					placeholder="Description"></textarea>
				<div class="row">
					<div class="col">
						<label for="">Current date</label>
						<input type="date" name="l_cdate" class="form-control">
					</div>
					<div class="col">
						<label for="">Return date</label>
						<input type="date" name="l_rdate" class="form-control">
					</div>
				</div>
				<div class=" d-grid col-4 mx-auto">
					<button type="submit" name="lender_data" class="btn btn-dark mt-4">Submit</button>
				</div>
			</form>

			<?php $results = mysqli_query($db, "SELECT * FROM lender WHERE u_id = '$u_id'"); ?>
			<h3 class="text-center mt-4">Lender Data</h3>
			<table id="lender_table" class="table display table-striped table-bordered table-dark text-center  mt-4">
				<thead>
					<tr>
						<th class="p-0 m-0">Name</th>
						<th class="p-0 m-0">Amount</th>
						<th class="p-0 m-0">Desc</th>
						<th class="p-0 m-0">Current Date</th>
						<th class="p-0 m-0">Return Date</th>
						<th class="p-0 m-0">Action</th>
					</tr>
				</thead>
				<?php while ($row = mysqli_fetch_array($results)) { ?>
				<tr>
					<td class="p-0 m-0">
						<?php echo $row['l_name']; ?>
					</td>
					<td class="p-0 m-0">
						<?php echo $row['l_amont']; ?>
					</td>
					<td class="p-0 m-0">
						<?php echo $row['l_desc']; ?>
					</td>
					<td class="p-0 m-0">
						<?php echo $row['l_cdate']; ?>
					</td>
					<td class="p-0 m-0">
						<?php echo $row['l_rdate']; ?>
					</td>
					<td class="p-0 m-0">
						<a class="text-decoration-none" href="server.php?del=<?php echo $row['l_id']; ?>">
							<span class="badge text-bg-success">received</span>
						</a>
						<a class="text-decoration-none" href="server.php?notreceive_del=<?php echo $row['l_id']; ?>" data-bs-toggle="tooltip" data-bs-placement="top"
							data-bs-custom-class="custom-tooltip color-light"
							data-bs-title="If you know that you will never get this money">
							<span class="badge text-bg-warning">not received</span>
						</a>
					</td>
				</tr>
				<?php } ?>
			</table>
			<h3 class="text-center mt-4">
				<?php echo $l_ans;?>
			</h3>
		</div>
		<script>
			$(document).ready(function () {
				$('#lender_table').DataTable();
			});
		</script>
		<!-- ===================Lender Amount Not Received Data============================ -->
		<div
			class="p-2 bg1 mb-1 tables notreceive_table col-lg-10 col-md-10 col-sm-10 col-xs-10 mt-1 m-auto overflow-hidden">


			<?php $results = mysqli_query($db, "SELECT * FROM notreceived WHERE u_id = '$u_id'"); ?>
			<h3 class="text-center mt-4">Lender Amount Not Received</h3>
			<table id="notreceive_table" class="table display table-striped table-bordered table-dark text-center  mt-4">
				<thead>
					<tr>
						<th class="p-0 m-0">Name</th>
						<th class="p-0 m-0">Amount</th>
						<th class="p-0 m-0">Desc</th>
						<th class="p-0 m-0">Current Date</th>
						<th class="p-0 m-0">Return Date</th>
						<th class="p-0 m-0">Action</th>
					</tr>
				</thead>
				<?php while ($row = mysqli_fetch_array($results)) { ?>
				<tr>
					<td class="p-0 m-0">
						<?php echo $row['nr_name']; ?>
					</td>
					<td class="p-0 m-0">
						<?php echo $row['nr_amont']; ?>
					</td>
					<td class="p-0 m-0">
						<?php echo $row['nr_desc']; ?>
					</td>
					<td class="p-0 m-0">
						<?php echo $row['nr_cdate']; ?>
					</td>
					<td class="p-0 m-0">
						<?php echo $row['nr_rdate']; ?>
					</td>
					<td class="p-0 m-0">
						<a class="text-decoration-none" href="server.php?del_receive=<?php echo $row['nr_id']; ?>">
							<span class="badge text-bg-success">received</span>
						</a>
						 
					</td>
				</tr>
				<?php } ?>
			</table>
			<h3 class="text-center mt-4">
				<?php echo $nr_ans;?>
			</h3>
		</div>
		<script>
			$(document).ready(function () {
				$('#notreceive_table').DataTable();
			});
		</script>
		<!-- ====================Borrower Data============================ -->

		<div class="bg1 p-2 mb-1 forms borrow-form col-lg-10 col-md-10 col-sm-10 col-xs-10 mt-1 m-auto overflow-hidden">

			<form method="post" action="index.php" class="mt-4 col-lg-8 col-md-10 col-sm-11 col-xs-11 m-auto">
				<h3 class="text-center">Borrow(ادھار لینا)</h3>
				<?php include('errors.php'); ?>
				<div class="row mt-4">
					<div class="col ">
						<input type="text" name="b_name" class="form-control" placeholder="Name">
					</div>
					<div class="col">
						<input type="text" name="b_amont" class="form-control" placeholder="Amount">
					</div>
				</div>
				<textarea name="b_desc" class="col-12 mt-4 p-1" id="desc" cols="10" rows="3"
					placeholder="Description"></textarea>
				<div class="row">
					<div class="col">
						<label for="">Current date</label>
						<input type="date" name="b_cdate" class="form-control">
					</div>
					<div class="col">
						<label for="">Return date</label>
						<input type="date" name="b_rdate" class="form-control">
					</div>
				</div>
				<div class=" d-grid col-4 mx-auto">
					<button name="borrow_data" class="btn btn-dark mt-4" type="submit">Submit</button>
				</div>

			</form>

			<?php $results = mysqli_query($db, "SELECT * FROM borrow WHERE u_id = '$u_id'"); ?>
			<h3 class="text-center mt-4">Borrower Data</h3>
			<table id="borrow_table" class="table table-striped table-bordered table-dark text-center mt-4">
				<thead>
					<tr>
						<th class="p-0 m-0">Name</th>
						<th class="p-0 m-0">Amount</th>
						<th class="p-0 m-0">desc</th>
						<th class="p-0 m-0">Current Date</th>
						<th class="p-0 m-0">Return Date</th>
						<th class="p-0 m-0">Action</th>
					</tr>
				</thead>
				<?php while ($row = mysqli_fetch_array($results)) { ?>
				<tr>
					<td class="p-0 m-0">
						<?php echo $row['b_name']; ?>
					</td>
					<td class="p-0 m-0">
						<?php echo $row['b_amount']; ?>
					</td>
					<td class="p-0 m-0">
						<?php echo $row['b_desc']; ?>
					</td>
					<td class="p-0 m-0">
						<?php echo $row['b_cdate']; ?>
					</td>
					<td class="p-0 m-0">
						<?php echo $row['b_rdate']; ?>
					</td>
					<td class="p-0 m-0">
						<a class="text-decoration-none" href="server.php?del=<?php echo $row['b_id']; ?>">
							<span class="badge text-bg-success">return</span>
						</a>
						<a class="text-decoration-none" href="server.php?notreturn_del=<?php echo $row['b_id']; ?>">
							<span class="badge text-bg-warning">not return</span>
						</a>

					</td>
				</tr>
				<?php } ?>
			</table>


			<h3 class="text-center mt-4">
				<?php echo $b_ans;?>
			</h3>


		</div>
		<script>
			$(document).ready(function () {
				$('#borrow_table').DataTable();
			});
		</script>
		<!-- ====================Borrower Amount Not Return============================ -->

		<div
			class="bg1 p-2 mb-1 tables notreturn_table col-lg-10 col-md-10 col-sm-10 col-xs-10 mt-1 m-auto overflow-hidden">


			<?php $results = mysqli_query($db, "SELECT * FROM notreturn WHERE u_id = '$u_id'"); ?>
			<h3 class="text-center mt-4">Borrower Amount Not Returned</h3>
			<table id="notreturn_table" class="table table-striped table-bordered table-dark text-center mt-4">
				<thead>
					<tr>
						<th class="p-0 m-0">Name</th>
						<th class="p-0 m-0">Amount</th>
						<th class="p-0 m-0">desc</th>
						<th class="p-0 m-0">Current Date</th>
						<th class="p-0 m-0">Return Date</th>
						<th class="p-0 m-0">Action</th>
					</tr>
				</thead>
				<?php while ($row = mysqli_fetch_array($results)) { ?>
				<tr>
					<td class="p-0 m-0">
						<?php echo $row['nrt_name']; ?>
					</td>
					<td class="p-0 m-0">
						<?php echo $row['nrt_amount']; ?>
					</td>
					<td class="p-0 m-0">
						<?php echo $row['nrt_desc']; ?>
					</td>
					<td class="p-0 m-0">
						<?php echo $row['nrt_cdate']; ?>
					</td>
					<td class="p-0 m-0">
						<?php echo $row['nrt_rdate']; ?>
					</td>
					<td class="p-0 m-0">
						<a class="text-decoration-none" href="server.php?del_return=<?php echo $row['nrt_id']; ?>">
							<span class="badge text-bg-success">return</span>
						</a>
			 
					</td>
				</tr>
				<?php } ?>
			</table>


			<h3 class="text-center mt-4">
				<?php echo $nrt_ans;?>
			</h3>


		</div>
		<script>
			$(document).ready(function () {
				$('#notreturn_table').DataTable();
			});
		</script>

		<!-- ====================Investment Data============================ -->
		<div
			class="bg1 p-2 mb-1 forms investment-form col-lg-10 col-md-10 col-sm-10 col-xs-10 mt-1 m-auto overflow-hidden">

			<form method="post" action="index.php" class="mt-4 col-lg-8 col-md-10 col-sm-11 col-xs-11 m-auto">
				<h3 class="text-center">Investment(سرمایہ کاری)</h3>
				<?php include('errors.php'); ?>
				<div class="row mt-4">
					<div class="col ">
						<input type="text" name="i_name" class="form-control" placeholder="category">
					</div>
					<div class="col">
						<input type="text" name="i_amont" class="form-control" placeholder="Amount">
					</div>
				</div>
				<textarea name="i_desc" class="col-12 mt-4 p-1" id="desc" cols="10" rows="3"
					placeholder="Description"></textarea>
				<label for="">Current date</label>
				<input type="date" name="i_cdate" class="form-control">
				<div class=" d-grid col-4 mx-auto">
					<button class="btn btn-dark mt-4" type="submit" name="investment_data">Submit</button>
				</div>
			</form>



			<?php $results = mysqli_query($db, "SELECT * FROM investment WHERE u_id = '$u_id'"); ?>
			<h3 class="text-center mt-4">Investment Data</h3>

			<table id="investment_table" class="table table-striped table-bordered table-dark text-center mt-4">
				<thead>
					<tr>
						<th class="p-0 m-0">Category/Type</th>
						<th class="p-0 m-0">Amount</th>
						<th class="p-0 m-0">Description</th>
						<th class="p-0 m-0">Current Date</th>
					</tr>
				</thead>
				<?php while ($row = mysqli_fetch_array($results)) { ?>
				<tr>
					<td class="p-0 m-0">
						<?php echo $row['i_name']; ?>
					</td>
					<td class="p-0 m-0">
						<?php echo $row['i_amount']; ?>
					</td>
					<td class="p-0 m-0">
						<?php echo $row['i_desc']; ?>
					</td>
					<td class="p-0 m-0">
						<?php echo $row['i_cdate']; ?>
					</td>
				</tr>
				<?php } ?>
			</table>

			<h3 class="text-center mt-4">
				<?php echo $i_ans;?>
			</h3>

		</div>
		<script>
			$(document).ready(function () {
				$('#investment_table').DataTable();
			});
		</script>
		<!-- ====================Income Data============================ -->


		<div class="bg1 p-2 mb-1 forms income-form col-lg-10 col-md-10 col-sm-10 col-xs-10 mt-1 m-auto overflow-hidden">

			<form method="post" action="index.php" class="mt-4 col-lg-8 col-md-10 col-sm-11 col-xs-11 m-auto">
				<h3 class="text-center">Income(آمدنی)</h3>
				<?php include('errors.php'); ?>
				<div class="row mt-4">
					<div class="col ">
						<input type="text" name="inc_name" class="form-control" placeholder="category">
					</div>
					<div class="col">
						<input type="text" name="inc_amont" class="form-control" placeholder="Amount">
					</div>
				</div>
				<textarea name="inc_desc" class="col-12 mt-4 p-1" id="desc" cols="10" rows="3"
					placeholder="Description"></textarea>
				<label for="">Current date</label>
				<input type="date" name="inc_cdate" class="form-control">
				<div class=" d-grid col-4 mx-auto">
					<button name="income_data" class="btn btn-dark mt-4" type="submit">Submit</button>
				</div>
			</form>

			<?php $results = mysqli_query($db, "SELECT * FROM income WHERE u_id = '$u_id'"); ?>
			<h3 class="text-center mt-4">Income Data</h3>
			<table id="income_table" class="table table-striped table-bordered table-dark text-center mt-4">
				<thead>
					<tr>
						<th class="p-0 m-0">Category/Type</th>
						<th class="p-0 m-0">Amount</th>
						<th class="p-0 m-0">Description</th>
						<th class="p-0 m-0">Current Date</th>
					</tr>
				</thead>
				<?php while ($row = mysqli_fetch_array($results)) { ?>
				<tr>
					<td class="p-0 m-0">
						<?php echo $row['inc_name']; ?>
					</td>
					<td class="p-0 m-0">
						<?php echo $row['inc_amount']; ?>
					</td>
					<td class="p-0 m-0">
						<?php echo $row['inc_desc']; ?>
					</td>
					<td class="p-0 m-0">
						<?php echo $row['inc_cdate']; ?>
					</td>
				</tr>
				<?php } ?>
			</table>

			<h3 class="text-center mt-4">
				<?php echo $inc_ans;?>
			</h3>
		</div>
		<script>
			$(document).ready(function () {

				$('#income_table').DataTable();
			});
		</script>
	</div>

</body>

</html>


<!-- ================================categories change jquery -->
<script>
	$(document).ready(function () {
		$(".forms").css("display", "none");
		$(".tables").css("display", "none");
		$(".expenses-form").css("display", "block");
		$('.0').click(function () {
			$(".forms,.tables").css("display", "none");
			$(".expenses-form").css("display", "block");
		});

		$('.1').click(function () {
			$(".forms,.tables").css("display", "none");
			$(".lender-form").css("display", "block");
		});

		$('.2').click(function () {
			$(".forms,.tables").css("display", "none");
			$(".borrow-form").css("display", "block");
		});

		$('.3').click(function () {
			$(".forms,.tables").css("display", "none");
			$(".investment-form").css("display", "block");
		});

		$('.4').click(function () {
			$(".forms,.tables").css("display", "none");
			$(".income-form").css("display", "block");
		});
		$('.11').click(function () {
			$(".forms,.tables").css("display", "none");
			$(".notreceive_table").css("display", "block");
		});
		$('.12').click(function () {
			$(".forms,.tables").css("display", "none");
			$(".notreturn_table").css("display", "block");
		});
	});
</script>

<script>
	const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
	const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>