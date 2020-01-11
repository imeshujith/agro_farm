<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php foreach ($inventories as $inventory) { ?>
                <div class="col-md-3">
                    <div class="box">
                        <div class="box-body">
                            <h3 class="page-header"><?php echo $inventory->category; ?></h3>
                            <p>Total Products : <strong><?php echo $inventory->item_count; ?></strong></p>
                            <p>Total Quantity : <strong><?php echo $inventory->total_qty; ?></strong></p>
                            <p>Total Value : <strong>Rs.<?php echo $inventory->total_items; ?></strong></p>
                            <div class="text-right">
                                <form action="<?php echo base_url(); ?>products/stock" method="get">
                                    <input type="hidden" name="cat_id" id="cat_id" value="<?php echo $inventory->cat_id; ?>">
                                    <button class="btn btn-success" tye="button">View Inventory</button></a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
</div>




