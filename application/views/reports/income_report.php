<div class="content-wrapper">
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-body">
						<form action="<?php echo base_url(); ?>reports/reports/income_report" method="post">
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
									<button class="btn btn-primary">Generate Report</button>
								</div>
							</div>
						</form>

						<h3 style="margin-top: 50px;" class="text-center"><u><?php if($title) echo $title; ?></u></h3>

						<div class="row" style="margin-top: 50px;">
							<div class="col-md-12">
								<table class="table table-bordered table-striped table-responsive">
									<thead>
									<tr class="bg-black-gradient">
										<th>Invoice Number</th>
										<th>Payment Type</th>
										<th>Date</th>
										<th class="text-right">Total</th>
									</tr>
									</thead>
									<tbody>
									<?php if($invoices) { ?>
										<?php foreach ($invoices as $invoice) { ?>
											<tr>
												<td><?php echo $invoice->number.$invoice->id; ?></td>
												<td><?php echo $invoice->payment_type; ?></td>
												<td><?php echo $invoice->date; ?></td>
												<td class="text-right"><?php echo number_format($invoice->total_amount, 2); ?></td>
											</tr>
										<?php } } ?>
									</tbody>
									<tr class="bg-gray-active">
										<td colspan="3" class="text-right"><strong>Total Income</strong></td>
										<td class="text-right"><strong>Rs.<?php if($sum) { echo number_format($sum[0]->sum, 2); } ?></strong></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
	</section>
</div>




