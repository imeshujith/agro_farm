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

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">
							Customers
						</h3>
						<div class="pull-right">
							<button class="btn btn-success" data-toggle="modal" data-target="#add_customer_modal">&nbsp;&nbsp;Add New Customer</button>
						</div>
					</div>
					<div class="box-body">
						<table class="table table-bordered table-striped table-responsive data_tables">
							<thead>
							<tr>
								<th>Code</th>
								<th>Name</th>
								<th>Address</th>
								<th>Phone</th>
								<th>Email</th>
                                <th class="text-center">Status</th>
								<th>Create Date</th>
								<th width="20%"></th>
							</tr>
							</thead>

							<tbody id="customer_table">
							<?php
							foreach ($customers as $customer) { ?>
								<tr>
									<td><?php echo "CUS".sprintf("%04d", $customer->id); ?></td>
									<td><?php echo $customer->first_name." ". $customer->last_name; ?></td>
									<td>
										<?php
										echo $customer->street_one.", ".$customer->street_two.", ".$customer->city."<br/>";
										echo $customer->country."<br/>";
										?>
									</td>
									<td><?php echo $customer->phone; ?></td>
									<td><?php if($customer->email) { echo $customer->email; } else { echo '-';} ?></td>
                                    <td class="text-center">
                                        <?php if($customer->active == true) { ?>
                                            <span class="label label-success">Active</span>
                                        <?php } else { ?>
                                            <span class="label label-danger">Inactive</span>
                                        <?php } ?>
                                    </td>
									<td><?php echo $customer->create_date; ?></td>
									<td class="text-center">
                                        <?php if($customer->active == true) { ?>
                                            <a href="<?php echo base_url(); ?>customers/customer/inactive_customer?id=<?php echo $customer->id; ?>" class="btn btn-default btn-sm">Inactive</a>
                                        <?php } else { ?>
                                            <a href="<?php echo base_url(); ?>customers/customer/active_customer?id=<?php echo $customer->id; ?>" class="btn btn-default btn-sm">Active</a>
                                        <?php } ?>
										<button class="btn btn-primary btn-sm" id="update_customer" data-id="<?php echo $customer->id; ?>">Update</button>
										<button class="btn btn-danger btn-sm" id="delete_customer" data-id="<?php echo $customer->id; ?>">Delete</button>
									</td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<!-- add new customer modal -->
		<div class="modal fade" tabindex="-1" role="dialog" id="add_customer_modal">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Customer Registration Form</h4>
					</div>
					<div class="modal-body">
						<form action="<?php echo base_url('customers/customer/create_customer'); ?>" method="post" role="form">
							<div class="box-body">
								<div class="form-group">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label>First Name</label>
												<input type="text" class="form-control" id="first_name" name="first_name" data-validation="required">
											</div>
										</div>

										<div class="col-lg-6">
											<div class="form-group">
												<label>Last Name</label>
												<input type="text" class="form-control" name="last_name" data-validation="required">
											</div>
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label>Street</label>
												<input type="text" class="form-control" name="street_one" data-validation="required">
											</div>
										</div>

										<div class="col-lg-6">
											<div class="form-group">
												<label>Street Two</label>
												<input type="text" class="form-control" name="street_two">
											</div>
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label>City</label>
												<select class="form-control" name="city" id="customer_city" data-validation="required">
													<?php
													echo '<option selected="selected" disabled>Select One</option>';
													foreach ($cities as $city) { ?>
														<option value="<?php echo $city->name_en; ?>"><?php echo $city->name_en; ?></option>
													<?php }	?>
												</select>
											</div>
										</div>

										<div class="col-lg-6">
											<div class="form-group">
												<label>Postal Code</label>
												<input type="text" class="form-control" name="postal_code" id="customer_postal_code" readonly>
											</div>
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Country</label>
												<select class="form-control" name="country" data-validation="required">
													<?php foreach ($countries as $country) {
														if($country->country_name == 'Sri Lanka') { ?>
															<option value="<?php echo $country->country_name; ?>"><?php echo $country->country_name; ?></option>
														<?php }} ?>
												</select>
											</div>
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label>Phone</label>
												<input type="text" class="form-control" name="phone" pattern="[0-9]{9,10}"">
											</div>
										</div>

										<div class="col-lg-6">
											<div class="form-group">
												<label>Email</label>
												<input type="email" class="form-control" name="email">
											</div>
										</div>
									</div>
								</div>
							</div>
					</div>
					<div class="modal-footer">
						<button type="reset" class="btn btn-default">Reset</button>
						<button type="submit" class="btn btn-success">Submit</button>
					</div>
					</form>
				</div>
			</div>
		</div>
		<!-- end add new customer modal -->

		<!--customer update modal-->
		<div class="modal fade" tabindex="-1" role="dialog" id="update_customer_modal">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Update Customer Information Form</h4>
					</div>
					<div class="modal-body">
						<form action="<?php echo base_url('customers/customer/update_customer'); ?>" method="post" role="form">
							<div class="box-body">
								<div class="form-group">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label>First Name</label>
												<input type="text" class="form-control" value="" name="first_name" id="update_customer_first_name" data-validation="required">
												<input type="hidden" value="" name="id" id="update_customer_id">
											</div>
										</div>

										<div class="col-lg-6">
											<div class="form-group">
												<label>Last Name</label>
												<input type="text" class="form-control" value="" name="last_name" id="update_customer_last_name" data-validation="required">
											</div>
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label>Street</label>
												<input type="text" class="form-control" value="" name="street_one" id="update_customer_street_one" data-validation="required">
											</div>
										</div>

										<div class="col-lg-6">
											<div class="form-group">
												<label>Street Two</label>
												<input type="text" class="form-control" value="" name="street_two" id="update_customer_street_two">
											</div>
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label>City</label>
												<select class="form-control" name="city" id="update_customer_city" data-validation="required">
													<?php
													foreach ($cities as $city) { ?>
														<option value="<?php echo $city->name_en; ?>"><?php echo $city->name_en; ?></option>
													<?php }	?>
												</select>
											</div>
										</div>

										<div class="col-lg-6">
											<div class="form-group">
												<label>Postal Code</label>
												<input type="text" class="form-control" name="postal_code" id="update_customer_postal_code" readonly>
											</div>
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Country</label>
												<select class="form-control" name="country" id="update_customer_country" data-validation="required">
													<?php foreach ($countries as $country) {
														if($country->country_name == 'Sri Lanka') { ?>
															<option value="<?php echo $country->country_name; ?>"><?php echo $country->country_name; ?></option>
														<?php }} ?>
												</select>
											</div>
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label>Phone</label>
												<input type="text" class="form-control" name="phone" id="update_customer_phone" pattern="[0-9]{9,10}">
											</div>
										</div>

										<div class="col-lg-6">
											<div class="form-group">
												<label>Email</label>
												<input type="email" class="form-control" id="update_customer_email" name="email">
											</div>
										</div>
									</div>
								</div>
							</div>
					</div>
					<div class="modal-footer">
						<button type="button" data-dismiss="modal" class="btn btn-default">Cancel</button>
						<button type="submit" class="btn btn-success">Update</button>
					</div>
					</form>
				</div>
			</div>
		</div>
		<!--end customer update modal-->

		<!--customer delete modal-->
		<div class="modal fade" tabindex="-1" role="dialog" id="delete_customer_modal">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title text-danger">Warning</h4>
					</div>
					<div class="modal-body">
						Are you sure want to delete this customer?
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal"> No </button>
						<form action="<?php echo base_url('customers/customer/delete_customer') ?>" method="post" style="display: inline;">
							<input type="hidden" value="<?php echo $customer->id; ?>" name="id" id="delete_customer_id"/>
							<button type="submit" class="btn btn-danger"> Yes </button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!--end customer delete modal-->
	</section>
</div>

<script>
	$(document).ready(function() {
		$('#customer_city').change(function() {
			let city = $(this).val();
			$.ajax({
				type: 'get',
				url: base_url + 'customers/customer/get_postal_code',
				async: false,
				dataType: 'json',
				data: {'city': city},
				success: function (response) {
					$('#customer_postal_code').val(response[0]['postcode']);
				},
			});
		});

		function set_post_code() {
			let city = $('#update_customer_city').val();
			$.ajax({
				type: 'get',
				url: base_url + 'customers/customer/get_postal_code',
				async: false,
				dataType: 'json',
				data: {'city': city},
				success: function (response) {
					if(response[0]) {
						$('#update_customer_postal_code').val(response[0]['postcode']);
					}
				},
			});
		}
		set_post_code();

		$('#update_customer_city').change(function() {
			let city = $(this).val();
			$.ajax({
				type: 'get',
				url: base_url + 'customers/customer/get_postal_code',
				async: false,
				dataType: 'json',
				data: {'city': city},
				success: function (response) {
					$('#update_customer_postal_code').val(response[0]['postcode']);
				},
			});
		});

		$('#customer_table').on('click', '#update_customer', function() {
			var id = $(this).attr('data-id');
			$.ajax({
				type: 'post',
				url: base_url + 'customers/customer/get_single_item',
				async: false,
				dataType: 'json',
				data: {id: id},
				success: function (response) {
					$('#update_customer_id').val(response[0]['id']);
					$('#update_customer_first_name').val(response[0]['first_name']);
					$('#update_customer_last_name').val(response[0]['last_name']);
					$('#update_customer_street_one').val(response[0]['street_one']);
					$('#update_customer_street_two').val(response[0]['street_two']);
					$('#update_customer_city').val(response[0]['city']).change();
					$('#update_customer_phone').val(response[0]['phone']);
					$('#update_customer_email').val(response[0]['email']);
					$('#update_customer_modal').modal('show');
				},
			});
		})

		$('#customer_table').on('click', '#delete_customer', function() {
			var id = $(this).attr('data-id');
			$.ajax({
				type: 'post',
				url: base_url + 'customers/customer/get_single_item',
				async: false,
				dataType: 'json',
				data: {id: id},
				success: function (response) {
					$('#delete_customer_id').val(response[0]['id']);
					$('#delete_customer_modal').modal('show');
				},
			});
		})
	});

</script>




