<div class="content-wrapper">
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-body">
						<form action="" method="post">
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Year</label>
										<select class="form-control" name="year" data-validation="required">
											<option selected disabled>Select year</option>
											<option>2020</option>
											<option>2019</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<button class="btn btn-primary">Generate Report</button>
								</div>
							</div>
						</form>

						<h3 class="text-center" style="margin-top: 50px;"><u><?php if($title) { echo $title; } ?></u></h3>

						<div class="row" style="margin-top: 50px;">
							<div class="col-md-12">
								<table class="table table-bordered table-striped table-responsive">
									<thead>
									<tr class="bg-black-gradient">
										<th>Invoice Number</th>
										<th>Customer</th>
										<th>Payment Type</th>
										<th>Date</th>
										<th class="text-right">Total Amount</th>
									</tr>
									</thead>
									<tbody>
									<?php if($invoices) { ?>
										<?php foreach ($invoices as $invoice) { ?>
											<tr>
												<td><?php echo $invoice->number.$invoice->id; ?></td>
												<td><?php echo $invoice->first_name.' '.$invoice->last_name; ?></td>
												<td><?php echo $invoice->payment_type; ?></td>
												<td><?php echo $invoice->date; ?></td>
												<td class="text-right"><?php echo number_format($invoice->total_amount, 2); ?></td>
											</tr>
										<?php } } ?>
									<tr class="bg-gray-active">
										<td colspan="4" class="text-right"><strong>Total Incomes</strong></td>
										<td></td>
									</tr>
									</tbody>
								</table>

								<table class="table table-bordered table-striped table-responsive">
									<thead>
									<tr class="bg-black-gradient">
										<th>PO Number</th>
										<th>Supplier</th>
										<th>Payment Type</th>
										<th>Date</th>
										<th class="text-right">Total Amount</th>
									</tr>
									<?php if($pos) { ?>
										<?php foreach ($pos as $po) { ?>
											<tr>
												<td><?php echo $po->number.$invoice->id; ?></td>
												<td><?php echo $po->first_name.' '.$invoice->last_name; ?></td>
												<td><?php echo $po->payment_type; ?></td>
												<td><?php echo $po->date; ?></td>
												<td class="text-right"><?php echo number_format($po->total_amount, 2); ?></td>
											</tr>
										<?php } } ?>
									<tr class="bg-gray-active">
										<td colspan="4" class="text-right"><strong>Total Expenses</strong></td>
										<td></td>
									</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
	</section>
</div>
