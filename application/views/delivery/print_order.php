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
			<div class="col-md-6 col-md-offset-3" style="box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24)">

				<div class="row">
					<div class="col-xs-12">
						<h2 class="page-header">
							<i class="fa fa-globe"></i> <?php echo $company[0]->name; ?> - Delivery Order
							<small class="pull-right">Printed Date: <?php echo date('d/m/Y'); ?></small>
						</h2>
					</div>
					<!-- /.col -->
				</div>

				<div class="row invoice-info">
					<div class="col-sm-4 invoice-col">
						<address >
							<strong>Shipping Address</strong><br>
							<span><?php echo $order[0]->first_name.' '.$order[0]->last_name; ?>,</span><br>
							<?php echo $order[0]->street_one; ?>,<br>
							<?php echo $order[0]->street_two; ?>,<br>
							<?php echo $order[0]->customer_city; ?>, <?php echo $order[0]->customer_country; ?><br>
							Phone: <?php echo $order[0]->customer_phone; ?><br>
							Email: <?php echo $order[0]->customer_email; ?>
						</address>
					</div>
					<div class="col-sm-4 col-sm-offset-4 invoice-col">
						<b>Invoice # </b> <?php echo $order[0]->number.$order[0]->id; ?><br>
						<b>Shipped Date: </b> <?php echo $order[0]->shipped_date; ?><br>
						<b>Delivery Person: </b> <?php echo $order[0]->person; ?><br>
					</div>
					<!-- /.col -->
				</div>

				<div class="row">
					<div class="col-xs-12 table-responsive">
						<table class="table table-striped">
							<thead>
							<tr>
								<th>#</th>
								<th>Product Code</th>
								<th>Product</th>
								<th class="text-right">Quantity</th>
								<th>Unit Of Measure</th>
							</tr>
							</thead>
							<tbody>
							<?php $i = 1; ?>
							<?php foreach ($order_lines as $line) { ?>
								<tr>
									<td><?php echo $i++; ?></td>
									<td><?php echo $line->code; ?></td>
									<td><?php echo $line->product; ?></td>
									<td class="text-right"><?php echo $line->quantity; ?></td>
									<td><?php echo $line->uom; ?></td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>

				<div class="row" style="margin-top: 50px;">
					<div class="col-md-3">
                        <p class="text-center">........................................</p>
						<p class="text-center">Customer NIC</p>
					</div>
					<div class="col-md-3">
                        <p class="text-center">........................................</p>
						<p class="text-center">Customer Signature</p>
					</div>
					<div class="col-md-3">
                        <p class="text-center">........................................</p>
						<p class="text-center">Received Date</p>
					</div>
					<div class="col-md-3">
						<p class="text-center">........................................</p>
						<p class="text-center">Delivery Person Signature</p>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12 bg-gray-light text-center">
						All items are received good quality
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
</body>
</html>
