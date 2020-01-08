<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            Product Information
                        </h3>
                    </div>
                    <div class="box-body">
                        <form action="<?php echo base_url('products/products/create_product') ?>" method="post">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="radio-inline"><input type="radio" name="product_type" value="Sale" data-validation="required">Sale</label>
                                                <label class="radio-inline"><input type="radio" name="product_type" value="Purchase" data-validation="required">Purchase</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="product_name">Product Name</label>
                                                <input type="text" class="form-control input-lg" name="product_name" data-validation="required">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="product_code">Product Code</label>
                                                <input type="text" class="form-control" name="product_code" data-validation="required">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="product_category">Product Category</label>
                                                <select class="form-control" id="product_category" name="product_category">
                                                    <?php
                                                    foreach ($categories as $category) {
                                                        echo "<option value='' selected disabled hidden>Select</option>";
                                                        echo "<option value='.$category->id.'>$category->name</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="product_description">Description</label>
                                                <textarea class="form-control" name="product_description"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="product_price">Unit Price</label>
                                                <input type="text" class="form-control" name="product_price" data-validation="required">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="product_uom">Unit of Measure</label>
                                                <select type="text" class="form-control" id="product_uom" name="product_uom" data-validation="required">
                                                    <?php
                                                    foreach ($uoms as $uom) {
                                                        echo "<option value='.$uom->id.'>$uom->unit</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="product_min">Minimum Re-Order Level</label>
                                                <input type="text" class="form-control" name="product_min">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="product_max">Maximum Quantity</label>
                                                <input type="text" class="form-control" name="product_max" data-validation="required">
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-success btn-block btn-lg">Create Product</button>
                                </div>
                                <div class="col-md-4">
                                    <ul class="list-group">
                                        <li class="list-group-item">Barcode</li>
                                        <li class="list-group-item">On Hand Quantity <span class="badge">3</span></li>
                                        <li class="list-group-item">Forecasted Quantity <span class="badge">3</span></li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>




