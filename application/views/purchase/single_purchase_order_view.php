<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <a href="<?php echo base_url(); ?>purchase/purchase/print_purchase?id=<?php echo $purchase_order[0]->id; ?>" target="_blank" class="btn btn-default"><i class="fa fa-print" aria-hidden="true"></i> Print PO</a>
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
                                <h3>Purchase Order # <?php echo $purchase_order[0]->number.$purchase_order[0]->id; ?></h3>
                                <p><strong>Purchase Order Date :</strong> <?php echo $purchase_order[0]->date; ?></p>
                                <p><strong>Payment Type :</strong> <?php echo $purchase_order[0]->payment_type; ?></p>
                            </div>

                            <div class="col-md-3">
                                <address >
                                    <strong>Supplier Address</strong><br/>
                                    <span style="font-size: 26px;"><?php echo $purchase_order[0]->first_name. ' '.$purchase_order[0]->last_name; ?></span><br>
                                    <?php echo $purchase_order[0]->street_one; ?><br>
                                    <?php echo $purchase_order[0]->street_two; ?><br>
                                    <?php echo $purchase_order[0]->supplier_city; ?><br>
                                    Phone: <?php echo $purchase_order[0]->supplier_phone; ?><br>
                                    Email: <?php echo $purchase_order[0]->supplier_email; ?>
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
                                        <th>Subtotal</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php $count = 1; ?>
                                        <?php foreach($purchase_order_lines as $line) { ?>
                                            <tr>
                                                <td><?php echo $count; $count++ ?></td>
                                                <td><?php echo $line->product; ?></td>
                                                <td><?php echo number_format($line->price, 2); ?></td>
                                                <td><?php echo number_format($line->quantity, 2); ?></td>
                                                <td class="text-right"><?php echo number_format($line->total, 2); ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row clearfix" style="margin-top:20px">
                            <div class="pull-right col-md-4">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <th class="text-right">Amount Total</th>
                                        <td class="text-right">
                                            <p> Rs.<?php echo number_format($purchase_order[0]->total_amount, 2); ?></p>
                                        </td>
                                    </tr>
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





