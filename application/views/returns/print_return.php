<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>AgroFarm Management System</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets/bower_components/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets/bower_components/Ionicons/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/AdminLTE.min.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body onload="window.print();">
<div class="wrapper">
	<!-- Main content -->
	<section class="invoice" style="margin-top: 25px; border: none;">
		<div class="row">
			<div class="col-md-8 col-md-offset-2" style="box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24)">

				<div class="row">
					<div class="col-xs-12">
						<h2 class="page-header">
							<i class="fa fa-globe"></i> <?php echo $company[0]->name; ?> - Invoice
							<small class="pull-right">Printed Date: <?php echo date('d/m/Y'); ?></small>
						</h2>
					</div>
					<!-- /.col -->
				</div>

				<div class="row invoice-info">
					<div class="col-sm-4 invoice-col">
						<address >
							<strong>Customer Address</strong><br/>
							<span><?php echo $return[0]->first_name. ' '.$return[0]->last_name; ?></span><br>
							<?php echo $return[0]->street_one; ?><br>
							<?php echo $return[0]->street_two; ?><br>
							<?php echo $return[0]->customer_city; ?><br>
							Phone: <?php echo $return[0]->customer_phone; ?><br>
							Email: <?php echo $return[0]->customer_email; ?>
						</address>
					</div>
					<div class="col-sm-4 invoice-col">
						<b>Return # </b> <?php echo $return[0]->number.$return[0]->id; ?><br>
						<br>
						<b>Order Date: </b> <?php echo $return[0]->date; ?><br>
						<b>Payment Type:</b> <?php echo $return[0]->payment_type; ?><br>
					</div>
					<div class="col-sm-4 invoice-col">
						<address>
							<span><?php echo $company[0]->name; ?></span><br>
							<?php echo $company[0]->street; ?><br>
							<?php echo $company[0]->city; ?><br>
							<?php echo $company[0]->country; ?><br>
							Phone: <?php echo $company[0]->phone; ?> | Mobile : <?php echo $company[0]->mobile; ?><br>
							Email: <?php echo $company[0]->email; ?>
						</address>
					</div>
					<!-- /.col -->
				</div>

				<div class="row">
					<div class="col-xs-12 table-responsive">
						<table class="table table-striped">
							<thead>
							<tr>
								<th>#</th>
								<th>Product</th>
								<th>Unit Price</th>
								<th>Quantity</th>
								<th>UoM</th>
								<th>Discount</th>
								<th>Tax</th>
								<th class="text-right">Subtotal</th>
							</tr>
							</thead>
							<tbody>
							<?php $count = 1; ?>
							<?php foreach($return_lines as $line) { ?>
								<tr>
									<td><?php echo $count; $count++ ?></td>
									<td><?php echo $line->product; ?></td>
									<td><?php echo number_format($line->price, 2); ?></td>
									<td><?php echo number_format($line->quantity, 2); ?></td>
									<td><?php echo $line->uom; ?></td>
									<td><?php echo number_format($line->discount, 2); ?></td>
									<td><?php echo number_format($line->tax, 2); ?></td>
									<td class="text-right"><?php echo number_format($line->total, 2); ?></td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>

				<div class="row">
					<div class="col-xs-6 col-xs-offset-6" style="margin-top: 20px;">
						<div class="table-responsive">
							<table class="table">
								<tr>
									<th class="text-right">Total Untaxed</th>
									<td class="text-right">Rs.<?php echo number_format($return[0]->total_untax, 2); ?></td>
								</tr>
								<tr>
									<th class="text-right">Total Tax</th>
									<td class="text-right">Rs.<?php echo number_format($return[0]->total_tax, 2); ?></td>
								</tr>
								<tr>
									<th class="text-right">Total Discount</th>
									<td class="text-right">Rs.<?php echo number_format($return[0]->total_discount, 2); ?></td>
								</tr>
								<tr>
									<th class="text-right">Amount Total</th>
									<td class="text-right">Rs.<?php echo number_format($return[0]->total_amount, 2); ?></td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
</body>
</html>
