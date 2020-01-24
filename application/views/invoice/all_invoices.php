<div class="content-wrapper">
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header with-border">r
						<h3 class="box-title">
							Invoices
						</h3>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-md-12">
								<table class="table table-bordered table-responsive data_tables display pageResize">
									<thead>
									<tr>
										<th>Invoice Number</th>
										<th>Customer</th>
										<th>Shipping Address</th>
										<th>Payment Type</th>
										<th class="text-right">Invoice Date</th>
										<th class="text-right">Total</th>
										<th class="text-center">Status</th>
									</tr>
									</thead>
									<tbody>
									<?php foreach($invoices as $invoice) { ?>
										<tr style="cursor:pointer;" data-href="<?php echo base_url(); ?>invoice/invoice/single_invoice?id=<?php echo $invoice->id; ?>" class="clickable-row <?php if($invoice->status == 'Cancel') { echo 'bg-danger text-danger';} elseif($invoice->status == 'Draft') { echo 'bg-warning text-warning';} ?>">
											<td><?php echo $invoice->number.$invoice->id; ?></td>
											<td><?php echo $invoice->first_name.' '.$invoice->last_name; ?></td>
											<td>
												<?php echo $invoice->street_one.', '.$invoice->street_two; ?><br>
												<?php echo $invoice->customer_city; ?><br>
											</td>
											<td><?php echo $invoice->payment_type; ?></td>
											<td class="text-right"><?php echo $invoice->date; ?></td>
											<td class="text-right">Rs.<?php echo number_format($invoice->total_amount, 2); ?></td>
											<td class="text-center"><?php echo $invoice->status; ?></td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</div>
</section>
</div>
<script>
	$(".clickable-row").click(function() {
		window.location = $(this).data("href");
	});
</script>




