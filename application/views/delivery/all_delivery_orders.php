<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            Delivery Orders
                        </h3>
                    </div>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-striped table-responsive data_tables">
                            <thead>
                            <tr>
                                <th>Order Number</th>
                                <th>Customer</th>
                                <th>City</th>
                                <th>Schedule Date</th>
                                <th>Shipped Date</th>
                                <th>Delivery Date</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
							<?php foreach ($orders as $order) { ?>
								<tr style="cursor:pointer;" data-href="<?php echo base_url(); ?>delivery/delivery/single_delivery_order?id=<?php echo $order->id; ?>" class="clickable-row">
									<td><?php echo $order->number.' '.$order->id; ?></td>
									<td><?php echo $order->first_name.' '.$order->last_name; ?></td>
									<td><?php echo  $order->customer_city; ?></td>
									<td><?php if($order->scheduled_date) {echo  $order->scheduled_date;} else {echo 'N/A';} ?></td>
									<td><?php if($order->shipped_date) {echo  $order->shipped_date;} else {echo 'N/A';} ?></td>
									<td><?php if($order->delivered_date) {echo  $order->delivered_date;} else {echo 'N/A';} ?></td>
									<td><?php echo $order->status; ?></td>
								</tr>
							<?php } ?>
                            </tbody>
                        </table>
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
