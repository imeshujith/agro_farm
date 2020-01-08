<div class="content-wrapper">
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">
							Returns
						</h3>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-md-12">
								<table class="table table-bordered table-responsive data_tables display pageResize">
									<thead>
									<tr>
										<th>Return Number</th>
										<th>Customer</th>
										<th>Invoice Nimber</th>
										<th>Payment Type</th>
										<th class="text-right">Return Date</th>
										<th class="text-right">Total</th>
										<th class="text-center">Status</th>
									</tr>
									</thead>
									<tbody>
									<?php foreach($returns as $return) { ?>
										<tr style="cursor:pointer;" data-href="<?php echo base_url(); ?>returns/returns/single_return?id=<?php echo $return->id; ?>" class="clickable-row <?php if($return->status == 'Cancel') { echo 'bg-danger text-danger';} elseif($return->status == 'Draft') { echo 'bg-warning text-warning';} ?>">
											<td><?php echo $return->number.$return->id; ?></td>
											<td><?php echo $return->first_name.' '.$return->last_name; ?></td>
											<td>
												<?php echo $return->street_one.', '.$return->street_two; ?><br>
												<?php echo $return->customer_city; ?><br>
											</td>
											<td><?php echo $return->payment_type; ?></td>
											<td class="text-right"><?php echo $return->date; ?></td>
											<td class="text-right">Rs.<?php echo number_format($return->total_amount, 2); ?></td>
											<td class="text-center"><?php echo $return->status; ?></td>
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




