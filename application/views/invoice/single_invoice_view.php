<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
						<h3 class="box-title">
							Invoice - <span class="label label-success"><?php echo $invoice[0]->status; ?></span>
						</h3>
                        <div class="pull-right">
							<?php if($invoice[0]->status == 'Draft') { ?>
								<a href="<?php echo base_url(); ?>invoice/invoice/cancel_invoice?id=<?php echo $invoice[0]->id; ?>" class="btn btn-danger btn-sm">Cancel Invoice</a>
								<a href="<?php echo base_url(); ?>invoice/invoice/confirm_invoice?id=<?php echo $invoice[0]->id; ?>" class="btn btn-primary btn-sm">Confirm Invoice</a>
							<?php } elseif($invoice[0]->status != 'Draft' && $invoice[0]->status != 'Cancel') { ?>
								<a href="<?php echo base_url(); ?>delivery/delivery/single_delivery_order?id=<?php echo $do_id[0]->id; ?>" class="btn btn-primary btn-sm">View Delivery Order</a>
							<?php } ?>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <address>
                                    <span style="font-size: 26px;"><?php echo $company[0]->name; ?></span><br>
                                    <?php echo $company[0]->street; ?><br>
                                    <?php echo $company[0]->city; ?><br>
                                    <?php echo $company[0]->country; ?><br>
                                    Phone: <?php echo $company[0]->phone; ?> | Mobile : <?php echo $company[0]->mobile; ?><br>
                                    Email: <?php echo $company[0]->email; ?>
                                </address>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-9">
                                <h3>Invoice # <?php echo $invoice[0]->number.$invoice[0]->id; ?></h3>
                                <p><strong>Invoice Date :</strong> <?php echo $invoice[0]->date; ?></p>
                                <p><strong>Payment Type :</strong> <?php echo $invoice[0]->payment_type; ?></p>
                            </div>

                            <div class="col-md-3">
                                <address >
                                    <strong>Customer Address</strong><br/>
                                    <span style="font-size: 26px;"><?php echo $invoice[0]->first_name. ' '.$invoice[0]->last_name; ?></span><br>
                                    <?php echo $invoice[0]->street_one; ?><br>
                                    <?php echo $invoice[0]->street_two; ?><br>
                                    <?php echo $invoice[0]->customer_city; ?><br>
                                    Phone: <?php echo $invoice[0]->customer_phone; ?><br>
                                    Email: <?php echo $invoice[0]->customer_email; ?>
                                </address>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-md-12">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product</th>
                                        <th>Unit Price</th>
                                        <th>Quantity</th>
                                        <th>UoM</th>
                                        <th>Discount</th>
                                        <th>Tax</th>
                                        <th class="text-right">Subtotal</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $count = 1; ?>
                                    <?php foreach($invoice_lines as $line) { ?>
                                        <tr>
                                            <td><?php echo $count; $count++ ?></td>
                                            <td><?php echo $line->product; ?></td>
                                            <td><?php echo number_format($line->price, 2); ?></td>
                                            <td><?php echo number_format($line->quantity, 2); ?></td>
                                            <td><?php echo $line->uom; ?></td>
                                            <td><?php echo number_format($line->discount, 2); ?></td>
                                            <td><?php echo number_format($line->tax, 2); ?></td>
                                            <td class="text-right"><?php echo number_format($line->total, 2); ?></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row clearfix" style="margin-top:20px">
                            <div class="pull-right col-md-4">
                                <table class="table table-condensed">
                                    <tbody>
                                    <tr>
                                        <th class="text-right"><strong>Amount Untaxed</strong></th>
                                        <td class="text-right">
                                            <p> Rs.<?php echo number_format($invoice[0]->total_untax, 2); ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-right"><strong>Total Tax</strong></th>
                                        <td class="text-right">
                                            <p> Rs.<?php echo number_format($invoice[0]->total_tax, 2); ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-right"><strong>Total Discount</strong></th>
                                        <td class="text-right">
                                            <p> - Rs.<?php echo number_format($invoice[0]->total_discount, 2); ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-right"><h4><strong>Amount Total</strong></h4></th>
                                        <td class="text-right">
                                            <h4> Rs.<?php echo number_format($invoice[0]->total_amount, 2); ?></h4>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
					<div class="box-footer">
						<a href="<?php echo base_url(); ?>invoice/invoice/print_invoice?id=<?php echo $invoice[0]->id; ?>" target="_blank" class="btn btn-default"><i class="fa fa-print" aria-hidden="true"></i> Print Invoice</a>
					</div>
                </div>
            </div>
        </div>
    </section>
</div>





