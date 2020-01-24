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

	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">
							Stock
						</h3>
					</div>
					<div class="box-body">
						<table class="table table-bordered table-striped data_tables">
							<thead>
							<tr>
								<th>Code</th>
								<th>Name</th>
								<th class="text-right">Unit Price</th>
								<th class="text-right">Quantity</th>
								<th>UoM</th>
								<th class="text-right">Total Value</th>
								<th>Inventory Level</th>
								<th></th>
							</tr>
							</thead>
							<tbody id="stock_table">
							<?php foreach($products as $product) { ?>
								<tr>
									<td><?php echo $product->code.$product->number; ?></td>
									<td><?php echo $product->name; ?></td>
									<td class="text-right">Rs.<?php echo $product->price; ?></td>
									<td class="text-right"><?php echo $product->quantity; ?></td>
									<td><?php echo $product->uom; ?></td>
                                    <td class="text-right">Rs.<?php echo $product->total; ?></td>
									<td width="20%">
										<div class="progress">
											<?php if(0 <= $product->inventory_level && $product->inventory_level <= 30) { ?>
												<div class="progress-bar progress-bar-striped progress-bar-danger active" role="progressbar"
													 aria-valuenow="<?php echo $product->inventory_level; ?>>" aria-valuemin="0" aria-valuemax="30" style="width:<?php echo $product->inventory_level; ?>%">
													<?php echo round($product->inventory_level, 2); ?>%
												</div>
											<?php } ?>

											<?php if(31 <= $product->inventory_level && $product->inventory_level <= 60) { ?>
												<div class="progress-bar progress-bar-striped progress-bar-warning active" role="progressbar"
													 aria-valuenow="<?php echo $product->inventory_level; ?>>" aria-valuemin="31" aria-valuemax="60" style="width:<?php echo $product->inventory_level; ?>%">
													<?php echo round($product->inventory_level, 2); ?>%
												</div>
											<?php } ?>

											<?php if(61 <= $product->inventory_level && $product->inventory_level <= 100) { ?>
												<div class="progress-bar progress-bar-striped progress-bar-success active" role="progressbar"
													 aria-valuenow="<?php echo $product->inventory_level; ?>>" aria-valuemin="61" aria-valuemax="100" style="width:<?php echo $product->inventory_level; ?>%">
													<?php echo round($product->inventory_level, 2); ?>%
												</div>
											<?php } ?>
										</div>
									</td>
									<td class="text-center" width="10%">
                                        <?php if($this->session->userdata('type') != 'Sales Person') { ?><button class="btn  btn-primary btn-sm" id="update_stock_button" data-id="<?php echo $product->id; ?>">Update Qty</button><?php } ?>
									</td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>

                    <!--quantity update modal-->
                    <div class="modal fade" tabindex="-1" role="dialog" id="stock_quantity_modal">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Quantity Update</h4>
                                </div>
                                <div class="modal-body">
                                    <form action="<?php echo base_url('products/products/update_quantity') ?>" method="post" role="form" id="quantity_update_form">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <input type="text" class="form-control" id="stock_product" readonly/>
                                                        <input type="hidden" class="form-control" name="id" id="stock_product_id"/>
                                                        <input type="hidden" class="form-control" name="cat_id" id="stock_cat_id"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Current Quantity</label>
                                                        <input type="text" class="form-control" name="current_qty" id="stock_current_quantity" readonly/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Minimum Quantity</label>
                                                        <input type="text" class="form-control" id="stock_quantity_minimum" readonly/>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Maximum Quantity</label>
                                                        <input type="text" class="form-control" id="stock_quantity_maximum" readonly/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Add New Quantity</label>
                                                        <input type="text" class="form-control" name="stock_new_quantity" id="stock_new_quantity" data-validation="required"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"> Cancel </button>
                                    <button type="submit" class="btn btn-success"> Update </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end quantity update modal-->
				</div>
			</div>
		</div>
	</section>
</div>

<script>
    $(document).ready(function() {
        $('#stock_table').on('click', '#update_stock_button', function() {
            var id = $(this).attr('data-id');
            $.ajax({
                type: 'post',
                url: base_url + 'products/products/view_single_product',
                async: false,
                dataType: 'json',
                data: {id: id},
                success: function (response) {
                    $('#stock_product_id').val(response[0]['id']);
                    $('#stock_product').val(response[0]['name']);
                    $('#stock_cat_id').val(response[0]['category_id']);
                    $('#stock_current_quantity').val(response[0]['quantity']);
                    $('#stock_quantity_minimum').val(response[0]['minimum_qty']);
                    $('#stock_quantity_maximum').val(response[0]['maximum_qty']);
                    $('#stock_quantity_modal').modal('show');
                },
            });
        })

        $(function () {
            $("#quantity_update_form").submit(function () {
                var quantity = $("#stock_new_quantity").val();
                var maximum = $("#stock_quantity_maximum").val();
                if (parseInt(quantity) > parseInt(maximum)) {
                    Swal.fire(' Inventory level exceeded. Check your product quantity and maximum quantity.');
                    return false;
                }
                return true;
            });
        });
    });
</script>
