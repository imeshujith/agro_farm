<div class="content-wrapper">
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">
							Purchase Orders
						</h3>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-md-12">
								<table class="table table-bordered table-responsive data_tables display pageResize">
									<thead>
									<tr>
										<th>Number</th>
										<th>Supplier</th>
										<th>Order Date</th>
										<th>Payment Type</th>
										<th class="text-right">Total</th>
									</tr>
									</thead>
									<tbody>
									<?php foreach($purchase_orders as $order) { ?>
										<tr style="cursor:pointer;" data-href="<?php echo base_url(); ?>purchase/purchase/single_purchase_order?id=<?php echo $order->id; ?>" class="clickable-row">
											<td><?php echo $order->number.$order->id; ?></td>
											<td><?php echo $order->first_name.' '.$order->last_name; ?></td>
											<td><?php echo $order->date; ?></td>
											<td><?php echo $order->payment_type; ?></td>
											<td class="text-right">Rs.<?php echo number_format($order->total_amount, 2); ?></td>
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
	</section>
</div>
<script>
	$(".clickable-row").click(function() {
		window.location = $(this).data("href");
	});
</script>




