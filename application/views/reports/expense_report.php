<div class="content-wrapper">
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-body">
						<form action="<?php echo base_url(); ?>reports/reports/expense_report" method="post">
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
										<th>Purchase Number</th>
										<th>Payment Type</th>
										<th>Date</th>
										<th class="text-right">Total</th>
									</tr>
									</thead>
									<tbody>
									<?php if($purchases) { ?>
										<?php foreach ($purchases as $purchase) { ?>
											<tr>
												<td><?php echo $purchase->number.$purchase->id; ?></td>
												<td><?php echo $purchase->payment_type; ?></td>
												<td><?php echo $purchase->date; ?></td>
												<td class="text-right"><?php echo $purchase->total_amount; ?></td>
											</tr>
										<?php } } ?>
									<tr class="bg-gray-active">
										<td colspan="3" class="text-right"><strong>Total Income</strong></td>
										<td class="text-right"><strong>Rs.<?php if($total) { echo number_format($total[0]->sum, 2); } ?></strong></td>
									</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
	</section>
</div>




