<div class="content-wrapper">
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-aqua">
					<div class="inner">
						<h3><?php echo $user[0]->total_users; ?></h3>
						<p>Total Users</p>
					</div>
					<div class="icon">
						<i class="fa fa-user" aria-hidden="true"></i>
					</div>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-olive">
					<div class="inner">
						<h3><?php echo $product[0]->total_products; ?></h3>
						<p>Total Products</p>
					</div>
					<div class="icon">
						<i class="fa fa-cubes" aria-hidden="true"></i>
					</div>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-yellow">
					<div class="inner">
						<h3><?php echo $customer[0]->total_customers; ?></h3>
						<p>Total Customers</p>
					</div>
					<div class="icon">
						<i class="fa fa-users" aria-hidden="true"></i>
					</div>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-red">
					<div class="inner">
						<h3><?php echo $supplier[0]->total_suppliers; ?></h3>
						<p>Total Suppliers</p></p>
					</div>
					<div class="icon">
						<i class="fa fa-truck" aria-hidden="true"></i>
					</div>
				</div>
			</div>
			<!-- ./col -->
		</div>
		<div class="row">
			<section class="col-lg-7 connectedSortable">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">
							Current Month Invoices
						</h3>
					</div>
					<div class="box-body">
						<table class="table table-bordered table-responsive data_tables display pageResize">
							<thead>
							<tr>
								<th>Invoice Number</th>
								<th>Customer</th>
								<th class="text-right">Invoice Date</th>
								<th class="text-right">Total</th>
							</tr>
							</thead>
							<tbody>
							<?php foreach($invoices as $invoice) { ?>
								<tr style="cursor:pointer;" data-href="<?php echo base_url(); ?>invoice/invoice/single_invoice?id=<?php echo $invoice->id; ?>" class="clickable-row <?php if($invoice->status == 'Cancel') { echo 'bg-danger text-danger';} elseif($invoice->status == 'Draft') { echo 'bg-warning text-warning';} ?>">
									<td><?php echo $invoice->number.sprintf("%04d", $invoice->id); ?></td>
									<td><?php echo $invoice->first_name.' '.$invoice->last_name; ?></td>
									<td class="text-right"><?php echo $invoice->date; ?></td>
									<td class="text-right">Rs.<?php echo number_format($invoice->total_amount, 2); ?></td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>

				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">
							Stock Inventory Levels
						</h3>
					</div>
					<div class="box-body">
						<table class="table table-bordered table-striped data_tables">
							<thead>
							<tr>
								<th>Name</th>
								<th class="text-right">Unit Price</th>
								<th class="text-right">Quantity</th>
								<th>Inventory Level</th>
							</tr>
							</thead>
							<tbody>
							<?php foreach($stocks as $stock) { ?>
								<tr>
									<td><?php echo $stock->name; ?></td>
									<td class="text-right">Rs.<?php echo $stock->price; ?></td>
									<td class="text-right"><?php echo $stock->quantity; ?></td>
									<td width="20%">
										<div class="progress">
											<?php if(0 <= $stock->inventory_level && $stock->inventory_level <= 30) { ?>
												<div class="progress-bar progress-bar-striped progress-bar-danger active" role="progressbar"
													 aria-valuenow="<?php echo $stock->inventory_level; ?>>" aria-valuemin="0" aria-valuemax="30" style="width:<?php echo $stock->inventory_level; ?>%">
													<?php echo round($stock->inventory_level, 2); ?>%
												</div>
											<?php } ?>

											<?php if(31 <= $stock->inventory_level && $stock->inventory_level <= 60) { ?>
												<div class="progress-bar progress-bar-striped progress-bar-warning active" role="progressbar"
													 aria-valuenow="<?php echo $stock->inventory_level; ?>>" aria-valuemin="31" aria-valuemax="60" style="width:<?php echo $stock->inventory_level; ?>%">
													<?php echo round($stock->inventory_level, 2); ?>%
												</div>
											<?php } ?>

											<?php if(61 <= $stock->inventory_level && $stock->inventory_level <= 100) { ?>
												<div class="progress-bar progress-bar-striped progress-bar-success active" role="progressbar"
													 aria-valuenow="<?php echo $stock->inventory_level; ?>>" aria-valuemin="61" aria-valuemax="100" style="width:<?php echo $stock->inventory_level; ?>%">
													<?php echo round($stock->inventory_level, 2); ?>%
												</div>
											<?php } ?>
										</div>
									</td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</section>

			<section class="col-lg-5 connectedSortable">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">
							Product Categoris
						</h3>
					</div>
					<div class="box-body">
						<canvas id="pieChart" style="height:250px"></canvas>
					</div>
				</div>

				<div class="box">
					<div id="calendar"></div>
				</div>
			</section>
		</div>
	</section>
</div>
<script>
	$(document).ready(function(){
		$(function () {
			/* ChartJS
			 * -------
			 * Here we will create a few charts using ChartJS
			 */

			//-------------
			//- PIE CHART -
			//-------------
			// Get context with jQuery - using jQuery's .get() method.
			var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
			var pieChart       = new Chart(pieChartCanvas);
			var PieData        = <?php if($piechart) { echo $piechart; } ?> ;
			var pieOptions     = {
				//Boolean - Whether we should show a stroke on each segment
				segmentShowStroke    : true,
				//String - The colour of each segment stroke
				segmentStrokeColor   : '#fff',
				//Number - The width of each segment stroke
				segmentStrokeWidth   : 2,
				//Number - The percentage of the chart that we cut out of the middle
				percentageInnerCutout: 50, // This is 0 for Pie charts
				//Number - Amount of animation steps
				animationSteps       : 100,
				//String - Animation easing effect
				animationEasing      : 'easeOutBounce',
				//Boolean - Whether we animate the rotation of the Doughnut
				animateRotate        : true,
				//Boolean - Whether we animate scaling the Doughnut from the centre
				animateScale         : false,
				//Boolean - whether to make the chart responsive to window resizing
				responsive           : true,
				// Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
				maintainAspectRatio  : true,
				//String - A legend template
				legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
			}
			//Create pie or douhnut chart
			// You can switch between pie and douhnut using the method below.
			pieChart.Doughnut(PieData, pieOptions)
		})
	})

</script>
