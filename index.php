
<!DOCTYPE html>
<html>
	
	<head>
		<meta charset="utf-8">
		<title>Manage Khata</title>
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <!--Jquery  -->
	    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	    <!-- bootstrap -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
		<?php include('server.php') ?>
	</head>

<body style="background-image: url('assest/img2.jpg')">

	<div class="col-lg-10 col-md-10 col-12 m-auto   p-1">
		<!-- =============================header======================================= -->

		<div class="bg-primary p-2 text-light bg-gradient d-flex justify-content-between align-items-center col-lg-10 col-md-10 col-sm-10 col-xs-10 m-auto mt-5">
			<div class="d-flex justify-content-between align-items-center">
				<?php  if (isset($_SESSION['username'])) : ?>
				<h4 class="text-uppercase"><?php echo $_SESSION['username'];?></h4>
				<small>
					<strong>
					<?php 
			    $total = ($total_inc+$total_borrow)-($total_investment+$total_lend); 
				echo "(balance: ".$total.")";
				?>
					</strong>
				</small>
			</div>
			<h3><a href="index.php?logout='1'" class=" f-md text-decoration-none text-light text-uppercase">logout</a>
			</h3>
			<?php endif ?>
		</div>

		<!-- =============================Categories======================================= -->

		<div class="bg-info bg-gradien col-lg-10 p-2 col-md-10 col-sm-10 col-xs-10 m-auto mt-1">
			<div class="dropdown text-center">
				<h3>Enter Data</h3>
				<button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown"
					aria-expanded="false">
					-- Select Category --
				</button>
				<ul class="dropdown-menu">
					<li><a class="1 dropdown-item" href="#">To Lend</a></li>
					<li><a class="2 dropdown-item" href="#">Borrow</a></li>
					<li><a class="3 dropdown-item" href="#">Investment</a></li>
					<li><a class="4 dropdown-item" href="#">Income</a></li>
				</ul>
			</div>
		</div>
		<!-- ==============================Lender Data===================================== -->

		<div class="bg-info p-2  bg-gradient mb-5 forms lender-form col-lg-10 col-md-10 col-sm-10 col-xs-10 mt-1 m-auto overflow-hidden">

			<form method="post" action="index.php" class="mt-4 col-lg-8 col-md-10 col-sm-11 col-xs-11 m-auto">
				<?php include('errors.php');?>
				<h3 class="text-center">To Lend(Udhaar deyaa)</h3>
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
				<button type="submit" name="lender_data"
					class="btn btn-dark mt-4 d-flex align-item-center m-auto ">Submit</button>
			</form>


			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-4">
				<?php $results = mysqli_query($db, "SELECT * FROM lender WHERE u_id = '$u_id'"); ?>
				<h3 class="text-center">Lender Data</h3>
				<div class="row mt-4 justify-content-center">
					<div class="col-3 col-lg-5 col-md-12 col-sm-12 mb-md-2 col-12 mb-2 mb-md-2 mb-sm-2">
						<input type="text" name="from_date" id="from_date" class="form-control"
							placeholder="From Date" />
					</div>
					<div class="col-3 col-lg-5 col-md-12 col-sm-12 mb-md-2 mb-sm-2 mb-2 col-12">
						<input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" />
					</div>
					<div class="col-4 col-lg-2 col-md-4 col-sm-4 col-xs-4">
						<input type="button" name="filter" id="filter" value="Filter" class="btn btn-dark w-100" />
					</div>
				</div>
			</div>

			<table id="lender_table" class="m-auto table text-center table-sm table-borderless table-striped table-hover mt-4 ">
					<thead>
						<tr>
							<th class="p-0 m-0">Name</th>
							<th class="p-0 m-0">Amount</th>
							<th class="p-0 m-0">Description</th>
							<th class="p-0 m-0">Current Date</th>
							<th class="p-0 m-0">Return Date</th>
							<th colspan="2" class="p-0 m-0">Action</th>
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
							<a class="text-decoration-none" href="" data-bs-toggle="tooltip" data-bs-placement="top"
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

		<!-- ====================Borrower Data============================ -->

		<div class="bg-info p-2  bg-gradient mb-5 forms borrow-form col-lg-10 col-md-10 col-sm-10 col-xs-10 mt-1 m-auto overflow-hidden">

			<form method="post" action="index.php" class="mt-4 col-lg-8 col-md-10 col-sm-11 col-xs-11 m-auto">
				<h3 class="text-center">Borrow(Udhaar Layna)</h3>
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
				<button name="borrow_data" class="btn btn-dark mt-4 d-flex align-item-center m-auto "
					type="submit">Submit</button>
			</form>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-4">
				<?php $results = mysqli_query($db, "SELECT * FROM borrow WHERE u_id = '$u_id'"); ?>
				<h3 class="text-center">Borrower Data</h3>
				<div class="row mt-4 justify-content-center">
					<div class="col-3 col-lg-5 col-md-5 col-sm-12 mb-md-2 col-12 mb-2 mb-md-2 mb-sm-2">
						<input type="text" name="from_date" id="from_date" class="form-control"
							placeholder="From Date" />
					</div>
					<div class="col-3 col-lg-5 col-md-5 col-sm-12 mb-md-2 mb-sm-2 mb-2 col-12">
						<input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" />
					</div>
					<div class="col-4 col-lg-2 col-md-2 col-sm-4 col-xs-4">
						<input type="button" name="filter" id="filter" value="Filter" class="btn btn-dark w-100" />
					</div>
				</div>
			</div>

			<table class="m-auto table text-center table-sm table-borderless table-striped table-hover mt-4">
					<thead>
						<tr>
							<th class="p-0 m-0">Name</th>
							<th class="p-0 m-0">Amount</th>
							<th class="p-0 m-0">Description</th>
							<th class="p-0 m-0">Current Date</th>
							<th class="p-0 m-0">Return Date</th>
							<th class="p-0 m-0" colspan="2">Action</th>
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
							<a class="text-decoration-none" href="#">
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

		<!-- ====================Investment Data============================ -->

		<div class="bg-info p-2  bg-gradient mb-5 forms investment-form col-lg-10 col-md-10 col-sm-10 col-xs-10 mt-1 m-auto overflow-hidden">

			<form method="post" action="index.php" class="mt-4 col-lg-8 col-md-10 col-sm-11 col-xs-11 m-auto">
				<h3 class="text-center">Investment</h3>
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
				<button class="btn btn-dark mt-4 d-flex align-item-center m-auto " type="submit"
					name="investment_data">Submit</button>
			</form>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-4">
				<?php $results = mysqli_query($db, "SELECT * FROM investment WHERE u_id = '$u_id'"); ?>
				<h3 class="text-center">Investment Data</h3>
				<div class="row mt-4 justify-content-center">
					<div class="col-3 col-lg-5 col-md-5 col-sm-12 mb-md-2 col-12 mb-2 mb-md-2 mb-sm-2">
						<input type="text" name="from_date" id="from_date" class="form-control"
							placeholder="From Date" />
					</div>
					<div class="col-3 col-lg-5 col-md-5 col-sm-12 mb-md-2 mb-sm-2 mb-2 col-12">
						<input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" />
					</div>
					<div class="col-4 col-lg-2 col-md-2 col-sm-4 col-xs-4">
						<input type="button" name="filter" id="filter" value="Filter" class="btn btn-dark w-100" />
					</div>
				</div>
			</div>

			 
		<table class="table text-center table-bordered table-striped table-hover mt-4">
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

		<!-- ====================Income Data============================ -->


		<div class="bg-info p-2  bg-gradient mb-5 forms income-form col-lg-10 col-md-10 col-sm-10 col-xs-10 mt-1 m-auto overflow-hidden">


			<form method="post" action="index.php" class="mt-4 col-lg-8 col-md-10 col-sm-11 col-xs-11 m-auto">
				<h3 class="text-center">Income</h3>
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
				<button name="income_data" class="btn btn-dark mt-4 d-flex align-item-center m-auto "
					type="submit">Submit</button>
			</form>


			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-4">
				<?php $results = mysqli_query($db, "SELECT * FROM income WHERE u_id = '$u_id'"); ?>
				<h3 class="text-center">Income Data</h3>
				<div class="row mt-4 justify-content-center">
					<div class="col-3 col-lg-5 col-md-5 col-sm-12 mb-md-2 col-12 mb-2 mb-md-2 mb-sm-2">
						<input type="text" name="from_date" id="from_date" class="form-control"
							placeholder="From Date" />
					</div>
					<div class="col-3 col-lg-5 col-md-5 col-sm-12 mb-md-2 mb-sm-2 mb-2 col-12">
						<input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" />
					</div>
					<div class="col-4 col-lg-2 col-md-2 col-sm-4 col-xs-4">
						<input type="button" name="filter" id="filter" value="Filter" class="btn btn-dark w-100" />
					</div>
				</div>
			</div>

			 
		<table class="table text-center table-bordered table-striped table-hover mt-4">
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

	</div>



</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
	integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

<!-- ================================categories change jquery -->

<!-- ================================categories change jquery -->
<script>
	$(document).ready(function () {
		$(".forms").css("display", "none");

		$('.1').click(function () {
			$(".borrow-form,.investment-form,.income-form").css("display", "none");
			$(".lender-form").css("display", "block");
		});

		$('.2').click(function () {
			$(".lender-form,.investment-form,.income-form").css("display", "none");
			$(".borrow-form").css("display", "block");
		});

		$('.3').click(function () {
			$(".lender-form,.borrow-form,.income-form").css("display", "none");
			$(".investment-form").css("display", "block");
		});

		$('.4').click(function () {
			$(".lender-form,.borrow-form,.investment-form").css("display", "none");
			$(".income-form").css("display", "block");
		});
	});
</script>

<script>
	const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
	const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>

<script>
	$(document).ready(function () {
		$.datepicker.setDefaults({
			dateFormat: 'yy-mm-dd'
		});
		$(function () {
			$("#from_date").datepicker();
			$("#to_date").datepicker();
		});
		$('#filter').click(function () {
			var from_date = $('#from_date').val();
			var to_date = $('#to_date').val();
			if (from_date != '' && to_date != '') {
				$.ajax({
					url: "server.php",
					method: "POST",
					data: {
						from_date: from_date,
						to_date: to_date
					},
					success: function (data) {
						$('#lender_table').html(data);
					}
				});
			} else {
				alert("Please Select Date");
			}
		});
	});
</script>