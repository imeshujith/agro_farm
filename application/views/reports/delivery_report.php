<div class="content-wrapper">
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-body">
						<form action="<?php echo base_url(); ?>reports/reports/delivery_report" method="post">
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>From Date</label>
										<input type="date" class="form-control" name="from_date" required>
									</div>
								</div>

								<div class="col-md-3">
									<div class="form-group">
										<label>To Date</label>
										<input type="date" class="form-control" name="to_date" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<button class="btn btn-success">Generate Report</button>
								</div>
							</div>
						</form>

						<h3 style="margin-top: 50px;" class="text-center"><u><?php if($title) echo $title; ?></u></h3>

						<div class="row" style="margin-top: 50px;">
							<div class="col-md-12">
								<table class="table table-bordered table-striped table-responsive">
									<thead>
									<tr class="bg-black-gradient">
										<th>Number</th>
										<th>Customer</th>
										<th>Invoice Number</th>
										<th>Schedule Date</th>
										<th>Shipped Date</th>
										<th>Delivered Date</th>
										<th>Delivery Person</th>
										<th>Status</th>
									</tr>
									</thead>
									<tbody>
									<?php if($dos) { ?>
										<?php foreach ($dos as $do) { ?>
											<tr>
												<td><?php echo $do->number.$do->id; ?></td>
												<td><?php echo $do->first_name.' '.$do->last_name; ?></td>
												<td><?php echo $do->invoice_number.$do->invoice_id; ?></td>
												<td><?php echo $do->scheduled_date; ?></td>
												<td><?php echo $do->shipped_date; ?></td>
												<td><?php echo $do->delivered_date; ?></td>
												<td><?php echo $do->person_name; ?></td>
												<td><?php echo $do->status; ?></td>
											</tr>
										<?php } } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
	</section>
</div>




