<div class="content-wrapper">
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">
							<strong>Delivery Order - </strong> <span class="label label-success"><?php echo $order[0]->status; ?></span>
						</h3>
						<form action="<?php echo base_url(); ?>delivery/delivery/schedule_delivery" method="post" class="form-horizontal" style="display: inline">
							<div class="pull-right">
								<?php if($order[0]->status == 'Draft') { ?>
									<a href="<?php echo base_url(); ?>delivery/delivery/cancel_delivery?id=<?php echo $order[0]->id; ?>" class="btn btn-danger btn-sm">Mark as Cancel</a>
									<input type="hidden" name="id" value="<?php echo $order[0]->id; ?>">
									<button type="submit" class="btn btn-warning btn-sm">Schedule Shipment</button>
								<?php } ?>

								<?php if($order[0]->status == 'Scheduled') { ?>
									<a href="<?php echo base_url(); ?>delivery/delivery/shipped_delivery?id=<?php echo $order[0]->id; ?>" class="btn btn-info btn-sm">Mark as Shipped</a>
								<?php } ?>

								<?php if($order[0]->status == 'Shipped') { ?>
									<a href="<?php echo base_url(); ?>delivery/delivery/order_delivered?id=<?php echo $order[0]->id; ?>" class="btn btn-success btn-sm">Mark as Delivered</a>
								<?php } ?>
							</div>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								<address>
									<strong>Shipping Address</strong><br>
									<span style="font-size: 22px;"><?php echo $order[0]->first_name.' '.$order[0]->last_name; ?>,</span><br>
									<?php echo $order[0]->street_one; ?>,<br>
									<?php echo $order[0]->street_two; ?>,<br>
									<?php echo $order[0]->customer_city; ?>, <?php echo $order[0]->customer_country; ?><br>
									Phone: <?php echo $order[0]->customer_phone; ?><br>
									Email: <?php echo $order[0]->customer_email; ?>
								</address>
							</div>

							<div class="col-md-6 text-right">
								<div class="form-group">
									<label class="control-label col-sm-4" style="margin-bottom: 5px;">Schedule Date:</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="scheduled_date" id="datepicker" placeholder="yyyy/mm/dd" value="<?php echo $order[0]->scheduled_date; ?>" required <?php if($order[0]->status != 'Draft') { echo "readonly"; } ?> style="margin-bottom: 5px;">
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-sm-4" style="margin-bottom: 5px;">Delivery Person:</label>
									<div class="col-sm-8">
										<select class="form-control" name="delivery_person" data-validation="required" <?php if($order[0]->status != 'Draft') { echo "readonly"; } ?> style="margin-bottom: 5px;">
											<option selected disabled>Select Delivery Person</option>
											<?php
											foreach ($persons as $person) { ?>
												<option value="<?php echo $person->id; ?>" <?php echo $person->id == $order[0]->delivery_persons_id ? 'selected="selected"' : Null ?>><?php echo $person->name.' - '.$person->nic ?></option>
											<?php } ?>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-sm-4" style="margin-bottom: 5px;">Shipped Date:</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="shipped_date" value="<?php echo $order[0]->shipped_date; ?>" readonly style="margin-bottom: 5px;">
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-sm-4" style="margin-bottom: 5px;">Completed Date:</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="completed_date" value="<?php echo $order[0]->delivered_date; ?>" readonly style="margin-bottom: 5px;">
									</div>
								</div>
							</div>
						</div>

						<div class="row" style="margin-bottom: 20px;">
							<div class="col-md-6">
								<h3>Order # <?php echo $order[0]->number.$order[0]->id; ?></h3>
							</div>
						</div>

						<table id="example2" class="table table-bordered table-striped table-responsive data_tables">
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
						</form>
					</div>
					<div class="box-footer">
						<?php if($order[0]->status != 'Draft') { ?>
                            <a href="<?php echo base_url(); ?>delivery/delivery/print_order?id=<?php echo $order[0]->id; ?>" target="_blank" class="btn btn-default"><i class="fa fa-print" aria-hidden="true"></i> Print DO</a>
                        <?php } ?>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
