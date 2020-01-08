<div class="content-wrapper">
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<form id="purchase_line_form" method="post" action="<?php echo base_url(); ?>purchase/purchase/create_purchase">
						<div class="box-header with-border">
							<h3 class="box-title">
								Create Purchase Order
							</h3>
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
								<div class="col-md-6">
									<div class="row">
										<div class="col-md-6 pull-right">
											<div class="form-group">
												<label for="invoice_customer">Supplier</label>
												<select class="form-control" name="supplier_name" data-validation="required">
													<option selected disabled>Select Supplier</option>
													<?php
													foreach ($suppliers as $supplier) {
														echo '<option value="'.$supplier->id.'">'.$supplier->first_name.' '.$supplier->last_name.'</option>';
													}
													?>
												</select>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6 pull-right">
											<div class="form-group">
												<label>Payment Type</label>
												<select type="text" class="form-control" name="purchase_payment" data-validation="required">
													<option selected disabled>Select Payment Type</option>
													<option value="Cash">Cash</option>
													<option value="Bank">Bank</option>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 pull-left">
									<div class="form-group">
										<label>Purchase Order Date</label>
										<input type="date" class="form-control" id="purchase_order_date" name="purchase_date" placeholder="Purchase Order Date" required>
									</div>
								</div>
							</div>

							<div class="row clearfix">
								<div class="col-md-12">
									<table class="table table-bordered table-striped">
										<thead>
										<th>#</th>
										<th>Product</th>
										<th>Unit Price</th>
										<th>Quantity</th>
										<th>Subtotal</th>
										<th class="text-center" width="2%"><button id="add_purchase_line" type="button" class="btn btn-success btn-xs"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
										</thead>
										<tbody id="purchase_lines">
										</tbody>
									</table>
								</div>
							</div>
							<div class="row clearfix" style="margin-top:20px">
								<div class="pull-right col-md-5">
									<table class="table table-bordered" id="tab_logic_total">
										<tbody>
										<tr>
											<th class="text-right">Amount Total Rs.</th>
											<td class="text-left">
												<input type="text" name='purchase_subtotal' id="purchase_subtotal" placeholder='0.00' class="form-control" readonly/>
											</td>
										</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="box-footer">
								<button class="btn btn-primary" type="submit">Create Purchase Order</button>
							</div>
					</form>
				</div>
			</div>
	</section>
</div>

<script>
	$(document).ready(function() {
		$(document).on('click', '#add_purchase_line', function() {
			$.ajax({
				url: base_url + 'purchase/purchase/generate_new_po_line',
				success: function (response) {
					var options = response
					var row = "";
					row += '<tr>';
					row += '<td></td>';
					row += '<td><input type="text" name="purchase_product[]" id="purchase_product" class="form-control" required/></td>';
					row += '<td><input type="text" name="purchase_price[]" id="purchase_price" class="form-control" required/></td>';
					row += '<td><input type="text" name="purchase_qty[]" id="purchase_qty" class="form-control" placeholder="0.00" required/></td>';
					row += '<td><input type="text" name="purchase_total[]" id="purchase_total" class="form-control" readonly required/></td>';
					row += '<td class="text-center"><button type="button" class="btn btn-danger btn-xs" id="remove_purchase"><i class="fa fa-minus" aria-hidden="true"></i></button></td></tr>';

					$('#purchase_lines').append(row);
				},
			});
		});

		$(document).on('click', '#remove_purchase', function (){
			$(this).closest('tr').remove();
			var subtotal = 0;

			$("#purchase_lines tr").each(function () {
				var price = $(this).find('#purchase_price').val();
				var quantity = $(this).find('#purchase_qty').val();
				subtotal += price * quantity;
			});

			$("#purchase_subtotal").val(subtotal.toFixed(2));
		});

		$('#purchase_lines').on('change paste keyup', '#purchase_price, #purchase_qty', function (){
			var price = $(this).closest("tr").find('#purchase_price').val();
			var quantity = $(this).closest("tr").find('#purchase_qty').val();
			var total = price * quantity;
			var subtotal = 0;
			$(this).closest("tr").find('#purchase_total').val(total.toFixed(2));

			$("#purchase_lines tr").each(function () {
				var price = $(this).find('#purchase_price').val();
				var quantity = $(this).find('#purchase_qty').val();
				subtotal += price * quantity;
			});

			$("#purchase_subtotal").val(subtotal.toFixed(2));
		});

		$(function () {
			$("#purchase_line_form").submit(function() {
				var purchase_date = $('#purchase_order_date').val();
				var fullDate = new Date();
				var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) :(fullDate.getMonth()+1);
				var currentDate = fullDate.getFullYear()+ "-" + twoDigitMonth + "-" + fullDate.getDate() ;
				var rows = $('#purchase_lines tr').length;
				if(new Date(purchase_date) > new Date(currentDate)) {
                    Swal.fire('You cannot select future date for purchase order');
					return false;
				}
				if(rows < 1) {
                    Swal.fire('You cannot create a purchase order with empty lines');
					return false;
				}
				return true;
			});
		});
	});

</script>



