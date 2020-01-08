<div class="content-wrapper">
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<form id="return_line_form" method="post" action="<?php echo base_url(); ?>returns/returns/create_return">
						<div class="box-header with-border">
							<h3 class="box-title">
								Create Return
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
												<label for="invoice_customer">Customer</label>
												<select class="form-control" name="return_customer" data-validation="required">
													<option selected disabled>Select Customer</option>
													<?php
													foreach ($customers as $customer) {
														echo '<option value="'.$customer->id.'">'.$customer->first_name.' '.$customer->last_name.'</option>';
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
												<select type="text" class="form-control" name="return_payment"  data-validation="required">
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
										<label>Invoice Number</label>
										<input type="text" class="form-control" name="return_invoice" placeholder="Invoice Number" value="INV/" required>
										<input type="hidden" class="form-control" name="return_invoice_number">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 pull-left">
									<div class="form-group">
										<label>Return Date</label>
										<input type="date" class="form-control" name="return_date" id="return_date" placeholder="Return Date" required>
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
										<th>UoM</th>
										<th>Discount</th>
										<th>Tax</th>
										<th>Subtotal</th>
										<th class="text-center" width="2%"><button type="button" class="btn btn-success btn-xs" id="add_return_line"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
										</thead>
										<tbody id="return_lines">
										</tbody>
									</table>
								</div>
							</div>
							<div class="row clearfix" style="margin-top:20px">
								<div class="pull-right col-md-6">
									<table class="table table-bordered" id="tab_logic_total">
										<tbody>
										<tr>
											<th class="text-right">Amount Rs.</th>
											<td class="text-left"><input type="text" name='return_total_amount' id="return_total_amount" placeholder='0.00' class="form-control" readonly/></td>
										</tr>
										<tr>
											<th class="text-right">Total Tax Rs.</th>
											<td class="text-left">
												<input type="text" class="form-control" name="return_total_tax" id="return_total_tax" placeholder="0.00" readonly>
											</td>
										</tr>
										<tr>
											<th class="text-right">Total Discount Rs.</th>
											<td class="text-left"><input type="text" name='return_total_discount' id="return_total_discount" placeholder='0.00' class="form-control" readonly/></td>
										</tr>
										<tr>
											<th class="text-right">Total Rs.</th>
											<td class="text-left"><input type="text" name='return_subtotal' id="return_subtotal" placeholder='0.00' class="form-control" readonly/></td>
										</tr>
										</tbody>
									</table>
								</div>
							</div>
					</form>
					<div class="box-footer">
						<button class="btn btn-primary" type="submit">Create Return</button>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<script>
	$(document).ready(function() {
		$(document).on('click', '#add_return_line', function() {
			$.ajax({
				url: base_url + 'invoice/invoice/generate_new_invoice_line',
				success: function (response) {
					var options = response
					var row = "";
					row += '<tr>';
					row += '<td></td>';
					row += '<td><select name="return_product[]" id="return_product" class="form-control">' + options + '</select></td>';
					row += '<td><input type="text" name="return_price[]" id="return_price" class="form-control" required/></td>';
					row += '<td><input type="text" name="return_qty[]" id="return_qty" class="form-control" placeholder="0.00" required/></td>';
					row += '<td><input type="text" name="return_uom[]" id="return_uom" class="form-control" readonly/><input type="hidden" name="return_uom_id[]" id="return_uom_id" class="form-control"/></td>';
					row += '<td><input type="text" name="return_discount[]" id="return_discount" class="form-control" value="0.00"/></td>';
					row += '<td><input type="text" name="return_tax[]" id="return_tax" class="form-control" value="15"/></td>';
					row += '<td><input type="text" name="return_total[]" id="return_total" class="form-control" readonly/></td>';
					row += '<td class="text-center"><button type="button" class="btn btn-danger btn-xs" id="remove_return_line"><i class="fa fa-minus" aria-hidden="true"></i></button></td>';

					$('#return_lines').append(row);
				},
			});
		});

		$(document).on('click', '#remove_return_line', function (){
			$(this).closest('tr').remove();

			var total_tax = 0;
			var total_discount = 0;
			var total_amount = 0;
			var order_total = 0;

			$("#return_lines tr").each(function () {
				var price = $(this).find('#return_price').val();
				var quantity = $(this).find('#return_qty').val();
				var discount = $(this).find('#return_discount').val();
				var tax = $(this).find('#return_tax').val();

				total_amount += price * quantity;
				total_tax += ((price * quantity) * tax) / 100;
				total_discount += (price * quantity) - ((price * quantity) - discount);
				order_total = total_amount - total_discount + total_tax;
			});

			$("#return_total_amount").val(total_amount.toFixed(2));
			$("#return_total_tax").val(total_tax.toFixed(2));
			$("#return_total_discount").val(total_discount.toFixed(2));
			$("#return_subtotal").val(order_total.toFixed(2));
		});

		$('#return_lines').on('change', '#return_product', function (){
			var id = $(this).val();
			var price;
			var uom_id;
			var uom;
			$.ajax({
				type: 'post',
				url: base_url + 'products/products/view_single_product',
				async: false,
				dataType: 'json',
				data: {id: id},
				success: function (response) {
					price = response[0]['price'];
					uom_id = response[0]['unit_of_measures_id'];
					uom = response[0]['uom'];
				},
			});
			$(this).closest("tr").find('#return_price').val(price);
			$(this).closest("tr").find('#return_uom_id').val(uom_id);
			$(this).closest("tr").find('#return_uom').val(uom);
		});


		$('#return_lines').on('change paste keyup', '#return_price, #return_qty, #return_discount', function () {
			var line_total = 0;
			var total_tax = 0;
			var total_discount = 0;
			var total_amount = 0;
			var order_total = 0;

			var line_price = $(this).closest("tr").find('#return_price').val();
			var line_quantity = $(this).closest("tr").find('#return_qty').val();
			var line_discount = $(this).closest("tr").find('#return_discount').val();

			// calculate each line subtotal value
			line_total = (line_price * line_quantity) - line_discount;
			$(this).closest("tr").find('#return_total').val(line_total.toFixed(2));

			// calculate entire purchase order value
			$("#return_lines tr").each(function () {
				var price = $(this).find('#return_price').val();
				var quantity = $(this).find('#return_qty').val();
				var discount = $(this).find('#return_discount').val();
				var tax = $(this).find('#return_tax').val();

				total_amount += price * quantity;
				total_tax += ((price * quantity) * tax) / 100;
				total_discount += (price * quantity) - ((price * quantity) - discount);
				order_total = total_amount - total_discount + total_tax;
			});

			$("#return_total_amount").val(total_amount.toFixed(2));
			$("#return_total_tax").val(total_tax.toFixed(2));
			$("#return_total_discount").val(total_discount.toFixed(2));
			$("#return_subtotal").val(order_total.toFixed(2));
		});

		$(function () {
			$("#return_line_form").submit(function() {
				var invoice_date = $('#return_date').val();
				var fullDate = new Date();
				var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) :(fullDate.getMonth()+1);
				var currentDate = fullDate.getFullYear()+ "-" + twoDigitMonth + "-" + fullDate.getDate() ;
				var rows = $('#return_lines tr').length;
				if(new Date(invoice_date) > new Date(currentDate)) {
					Swal.fire('You cannot select future date for invoice');
					return false;
				}
				if(rows < 1) {
					Swal.fire('You cannot create a invoice with empty products');
					return false;
				}
				return true;
			});
		});
	});

</script>




