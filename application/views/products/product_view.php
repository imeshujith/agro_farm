<div class="content-wrapper">
    <!--alert message-->
    <?php if($this->session->flashdata('alert')) { ?>
        <script type="text/javascript">
            $(document).ready(function() {
                $.notify({
                        message: '<?php echo $this->session->flashdata('alert')['message']?>'
                    },
                    {
                        type: '<?php echo $this->session->flashdata('alert')['type']?>',
                        placement: {
                            from: "bottom",
                            align: "right"
                        },
                        animate: {
                            enter: 'animated fadeInDown',
                            exit: 'animated fadeOutUp'
                        },
                    });
            });
        </script>
    <?php } ?>

    <!-- create new product modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="create_product_modal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Create New Product Form</h4>
                </div>
                <div class="modal-body">
                    <form action="<?php echo base_url('products/products/create_product'); ?>" method="post" role="form" id="create_product_form">
                        <div class="box-body">
                            <div class="form-group">
                                <div class="row">
                                      <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" name="name" data-validation="required">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea type="text" class="form-control" name="description"></textarea>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select class="form-control" name="category" data-validation="required">
                                            <option selected disabled hidden>Select</option>
                                            <?php
                                            foreach ($categories as $category) { ?>
                                                <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Unit Price</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">Rs.</span>
                                            <input type="text" class="form-control" name="price" placeholder="0.00" data-validation="number" data-validation-allowing="range[0.01;1000000.00],float">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Quantity</label>
                                            <input type="text" class="form-control" name="quantity" id="new_product_quantity" data-validation="number" data-validation-allowing="range[0;1000000.00],float">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Unit of Measure</label>
                                            <select type="text" class="form-control" name="unit_of_measure" data-validation="required">
                                                <?php
                                                foreach ($uoms as $uom) {
                                                    echo "<option selected disabled hidden>Select</option>";
                                                    echo "<option value='.$uom->id.'>$uom->unit</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Minimum Quantity</label>
                                            <input type="text" class="form-control" name="minimum" id="new_product_minimum" data-validation="number" data-validation-allowing="range[0.01;1000000.00],float">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Maximum Quantity</label>
                                            <input type="text" class="form-control" name="maximum" id="new_product_maximum" data-validation="number" data-validation-allowing="range[0.01;1000000.00],float">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-default">Reset</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            Products
                        </h3>
                        <div class="pull-right">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#create_product_modal"> Add New Product</button>
                        </div>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-striped data_tables display pageResize">
                            <thead>
                            <tr>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th class="text-right">Quantity</th>
                                <th class="text-left">UoM</th>
                                <th class="text-right">Unit Price</th>
                                <th width="15%"></th>
                            </tr>
                            </thead>
                            <tbody id="product_table">
                            <?php
                            foreach ($products as $product) { ?>
                                <tr>
                                    <td><?php echo $product->code.$product->number; ?></td>
                                    <td><?php echo $product->name; ?></td>
                                    <td><?php echo $product->category; ?></td>
                                    <td class="text-right"><?php echo $product->quantity; ?></td>
                                    <td class="text-left"><?php echo $product->uom; ?></td>
                                    <td class="text-right"><?php echo $product->price; ?></td>
                                    <td class="text-center">
                                        <button class="btn btn-primary btn-xs" id="update_product" data-id="<?php echo $product->id; ?>">Update</button>
                                        <button class="btn btn-danger btn-xs" id="delete_product" data-id="<?php echo $product->id; ?>">Delete</button>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>

                        <!--product update modal-->
                        <div class="modal fade" tabindex="-1" role="dialog" id="update_product_modal">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Create New Product Form</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?php echo base_url('products/products/update_product'); ?>" method="post" role="form" id="update_product_from">
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label>Code</label>
                                                                    <input type="text" class="form-control" name="code" id="update_product_code">
                                                                    <input type="hidden" class="form-control" name="id" id="update_product_id">
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label>Name</label>
                                                                    <input type="text" class="form-control" name="name" id="update_product_name" data-validation="required">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Description</label>
                                                        <textarea type="text" class="form-control" id="update_product_desc" name="description"></textarea>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label>Category</label>
                                                                <select class="form-control" name="category" id="update_product_category" data-validation="required">
                                                                    <?php
                                                                    foreach ($categories as $category) { ?>
                                                                        <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label>Unit Price</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">Rs.</span>
                                                                    <input type="text" class="form-control" name="price" id="update_product_price" placeholder="0.00" data-validation="number" data-validation-allowing="range[0.01;1000000.00],float">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label>Unit of Measure</label>
                                                                <select type="text" class="form-control" name="unit_of_measure" id="update_product_uom" data-validation="required">
                                                                    <?php
                                                                    foreach ($uoms as $uom) { ?>
                                                                        <option value="<?php echo $uom->id; ?>"><?php echo $uom->unit; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <label>Quantity</label>
                                                                <input type="text" class="form-control" name="quantity" id="update_product_quantity" data-validation="number" data-validation-allowing="range[0.01;1000000.00],float">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label>Minimum Quantity</label>
                                                                    <input type="text" class="form-control" name="minimum" id="update_product_minimum" data-validation="number" data-validation-allowing="range[0.01;1000000.00],float">
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label>Maximum Quantity</label>
                                                                    <input type="text" class="form-control" name="maximum" id="update_product_maximum" data-validation="number" data-validation-allowing="range[0.01;1000000.00],float">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label>Warranty</label>
                                                                    <select type="text" class="form-control" name="warranty" id="update_product_warranty" data-validation="required">
                                                                        <option selected disabled>Select warranty</option>
                                                                        <option value="0">No Warranty</option>
                                                                        <option value="1">1 Year</option>
                                                                        <option value="2">2 Year</option>
                                                                        <option value="5">5 Year</option>
                                                                        <option value="6">Life Time</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end product update modal-->

                        <!--product delete modal-->
                        <div class="modal fade" tabindex="-1" role="dialog" id="delete_product_modal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title text-danger">Warning</h4>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure want to delete this product?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal"> No </button>
                                        <form action="<?php echo base_url('products/products/delete_product') ?>" method="post" style="display: inline;">
                                            <input type="hidden" value="<?php echo $product->id; ?>" name="id" id="delete_product_id"/>
                                            <button type="submit" class="btn btn-danger"> Yes </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end product delete modal-->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    $(document).ready(function() {
        $('#product_table').on('click', '#update_product', function() {
            var id = $(this).attr('data-id');
            $.ajax({
                type: 'post',
                url: base_url + 'products/products/view_single_product',
                async: false,
                dataType: 'json',
                data: {id: id},
                success: function (response) {
                    $('#update_product_id').val(response[0]['id']);
                    $('#update_product_code').val(response[0]['code']);
                    $('#update_product_name').val(response[0]['name']);
                    $('#update_product_desc').text(response[0]['description']);
                    $('#update_product_category').val(response[0]['category_id']).change();;
                    $('#update_product_price').val(response[0]['price']);
                    $('#update_product_uom').val(response[0]['uom_id']).change();;
                    $('#update_product_quantity').val(response[0]['quantity']);
                    $('#update_product_minimum').val(response[0]['minimum_qty']);
                    $('#update_product_maximum').val(response[0]['maximum_qty']);
                    $('#update_product_warranty').val(response[0]['warranty']).change();
                    $('#update_product_modal').modal('show');
                },
            });
        })

        $('#product_table').on('click', '#delete_product', function() {
            var id = $(this).attr('data-id');
            $.ajax({
                type: 'post',
                url: base_url + 'products/products/view_single_product',
                async: false,
                dataType: 'json',
                data: {id: id},
                success: function (response) {
                    $('#delete_product_id').val(response[0]['id']);
                    $('#delete_product_modal').modal('show');
                },
            });
        })

        $(function () {
            $("#create_product_form").submit(function() {
                var quantity = $("#new_product_quantity").val();
                var maximum = $("#new_product_maximum").val();
                if (parseInt(quantity) > parseInt(maximum)) {
                    Swal.fire(' Inventory level exceeded. Check your product quantity and maximum quantity.');
                    return false;
                }
                return true;
            });

            $("#update_product_from").submit(function() {
                var quantity = $("#update_product_quantity").val();
                var maximum = $("#update_product_maximum").val();
                if (parseInt(quantity) > parseInt(maximum)) {
                    Swal.fire(' Inventory level exceeded. Check your product quantity and maximum quantity.');
                    return false;
                }
                return true;
            });

            $("#update_product_from").submit(function() {
                var minimum = $("#update_product_minimum").val();
                var maximum = $("#update_product_maximum").val();
                if (parseInt(minimum) > parseInt(maximum)) {
                    Swal.fire('Minimum quantity must be lower than to maximum quantity');
                    return false;
                }
                return true;
            });

            $("#create_product_form").submit(function() {
                var minimum = $("#new_product_minimum").val();
                var maximum = $("#new_product_maximum").val();
                if (parseInt(minimum) > parseInt(maximum)) {
                    Swal.fire('Minimum quantity must be lower than to maximum quantity');
                    return false;
                }
                return true;
            });
        });
    });

</script>




