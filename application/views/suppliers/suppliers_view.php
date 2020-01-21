<div class="content-wrapper">
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

	<!-- add new supplier modal -->
	<div class="modal fade" tabindex="-1" role="dialog" id="add_supplier_modal">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Supplier Registration Form</h4>
				</div>
				<div class="modal-body">
					<form action="<?php echo base_url('suppliers/supplier/create_supplier'); ?>" method="post" role="form">
						<div class="box-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="radio-inline"><input type="radio" name="supplier_type" id="supplier_person" value="person" checked data-validation="required">Person</label>
                                            <label class="radio-inline"><input type="radio" name="supplier_type" id="supplier_company" value="company" data-validation="required">Company</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

							<div class="form-group">
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label id="supplier_label">First Name</label>
											<input type="text" class="form-control" id="first_name" name="first_name" data-validation="required">
										</div>
									</div>

									<div class="col-lg-6">
										<div class="form-group" id="supplier_last_name">
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
											<select class="form-control" name="city" id="supplier_city" data-validation="required">
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
											<input type="text" class="form-control" name="postal_code" id="supplier_postal_code" readonly>
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
											<input type="text" class="form-control" name="phone" pattern="[0-9]{9,10}">
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
    <!-- add new supplier modal end -->

    <!--supplier update modal-->
    <div class="modal fade" tabindex="-1" role="dialog" id="update_supplier_modal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update Supplier Information Form</h4>
                </div>
                <div class="modal-body">
                    <form action="<?php echo base_url('suppliers/supplier/update_supplier'); ?>" method="post" role="form">
                        <div class="box-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="radio-inline"><input type="radio" name="supplier_type" id="update_supplier_person" value="person" checked data-validation="required">Person</label>
                                            <label class="radio-inline"><input type="radio" name="supplier_type" id="update_supplier_company" value="company" data-validation="required">Company</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label id="update_supplier_label">First Name</label>
                                            <input type="text" class="form-control" name="first_name" id="update_first_name" data-validation="required">
                                            <input type="hidden" name="id" id="update_id">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group" id="update_supplier_ln">
                                            <label>Last Name</label>
                                            <input type="text" class="form-control" name="last_name" id="update_last_name" data-validation="required">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Street</label>
                                            <input type="text" class="form-control" name="street_one" id="update_street_one" data-validation="required">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Street Two</label>
                                            <input type="text" class="form-control" name="street_two" id="update_street_two">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>City</label>
                                            <select class="form-control" name="city" id="update_city" data-validation="required">
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
                                            <input type="text" class="form-control" name="postal_code" id="update_postal_code" readonly>
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
                                            <input type="text" class="form-control" name="update_phone" pattern="[0-9]{9,10}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control"root name="update_email">
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
    <!--end supplier update modal-->

    <!--supplier delete modal-->
    <div class="modal fade" tabindex="-1" role="dialog" id="delete_supplier_modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Warning</h4>
                </div>
                <div class="modal-body">
                    Are you sure want to delete this supplier?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> No </button>
                    <form action="<?php echo base_url('suppliers/supplier/delete_supplier') ?>" method="post" style="display: inline;">
                        <input type="hidden" name="id" id="delete_supplier_id"/>
                        <button type="submit" class="btn btn-danger"> Yes </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end supplier delete modal-->

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">
							Suppliers
						</h3>
						<div class="pull-right">
							<button class="btn btn-success" data-toggle="modal" data-target="#add_customer_modal">&nbsp;&nbsp;Add New Supplier</button>
						</div>
					</div>
					<div class="box-body">
						<table class="table table-bordered table-striped table-responsive data_tables display pageResize">
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

							<tbody id="supplier_table">
							<?php
							foreach ($suppliers as $supplier) { ?>
								<tr>
									<td><?php echo "SUP".$supplier->id; ?></td>
									<td><?php echo $supplier->first_name." ". $supplier->last_name; ?></td>
									<td>
										<?php
										echo $supplier->street_one.", ".$supplier->street_two.", ".$supplier->city."<br/>";
										echo $supplier->country."<br/>";
										?>
									</td>
									<td><?php echo $supplier->phone; ?></td>
									<td><?php echo $supplier->email; ?></td>
                                    <td class="text-center">
                                        <?php if($supplier->active == true) { ?>
											<a href="<?php echo base_url(); ?>suppliers/suppliers/inactive_supplier?id=<?php echo $supplier->id; ?>"><span class="label label-success">Active</span></a>
                                        <?php } else { ?>
											<a href="<?php echo base_url(); ?>suppliers/suppliers/active_supplier?id=<?php echo $supplier->id; ?>"><span class="label label-danger">Inactive</span></a>
                                        <?php } ?>
                                    </td>
									<td><?php echo $supplier->create_date; ?></td>
									<td class="text-center">
										<button class="btn btn-primary btn-sm" id="update_supplier" data-id="<?php echo $supplier->id; ?>">Update</button>
										<button class="btn btn-danger btn-sm" id="delete_supplier" data-id="<?php echo $supplier->id; ?>">Delete</button>
									</td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
    <!-- end Main content -->
</div>

<script>
	$(document).ready(function() {
        $('#supplier_table').on('click', '#update_supplier', function() {
            var id = $(this).attr('data-id');
            $.ajax({
                type: 'post',
                url: base_url + 'suppliers/supplier/get_single_item',
                async: false,
                dataType: 'json',
                data: {id: id},
                success: function (response) {
                    if(response[0]['supplier_type'] == 'person') {
                        $('#update_supplier_person').prop( "checked", true );
                        $('#update_supplier_label').text('First Name');
                        $('#update_supplier_ln').show();
                    }
                    else {
                        $('#update_supplier_company').prop( "checked", true );
                        $('#update_supplier_label').text('Company Name');
                        $('#update_supplier_ln').hide();
                    }

                    $('#update_id').val(response[0]['id']);
                    $('#update_first_name').val(response[0]['first_name']);
                    $('#update_last_name').val(response[0]['last_name']);
                    $('#update_street_one').val(response[0]['street_one']);
                    $('#update_street_two').val(response[0]['street_two']);
                    $('#update_city').val(response[0]['city']).change();
                    $('#update_phone').val(response[0]['phone']);
                    $('#update_email').val(response[0]['email']);
                    $('#update_supplier_modal').modal('show');
                },
            });
        })

        $('#supplier_table').on('click', '#delete_supplier', function() {
            var id = $(this).attr('data-id');
            $.ajax({
                type: 'post',
                url: base_url + 'suppliers/supplier/get_single_item',
                async: false,
                dataType: 'json',
                data: {id: id},
                success: function (response) {
                    $('#delete_supplier_id').val(response[0]['id']);
                    $('#delete_supplier_modal').modal('show');
                },
            });
        })

        $('input[name=supplier_type]').change(function(){
            var value = $(this).val();
            if(value == 'person') {
                $('#supplier_label').text('First Name');
                $('#supplier_last_name').show();
            }
            if(value == 'company') {
                $('#supplier_label').text('Company Name');
                $('#supplier_last_name').hide();
            }
        });

        $('input[name=supplier_type]').change(function(){
            var value = $(this).val();
            if(value == 'person') {
                $('#update_supplier_label').text('First Name');
                $('#update_supplier_ln').show();
            }
            if(value == 'company') {
                $('#update_supplier_label').text('Company Name');
                $('#update_supplier_ln').hide();
            }
        });

		$('#supplier_city').change(function() {
			let city = $(this).val();
			$.ajax({
				type: 'get',
				url: base_url + 'suppliers/supplier/get_postal_code',
				async: false,
				dataType: 'json',
				data: {'city': city},
				success: function (response) {
					$('#supplier_postal_code').val(response[0]['postcode']);
				},
			});
		});

		function set_post_code() {
			let city = $('#update_supplier_city').val();
			$.ajax({
				type: 'get',
				url: base_url + 'suppliers/supplier/get_postal_code',
				async: false,
				dataType: 'json',
				data: {'city': city},
				success: function (response) {
					if(response[0]) {
						$('#update_supplier_postal_code').val(response[0]['postcode']);
					}
				},
			});
		}
		set_post_code();

		$('#update_supplier_city').change(function() {
			let city = $(this).val();
			$.ajax({
				type: 'get',
				url: base_url + 'suppliers/supplier/get_postal_code',
				async: false,
				dataType: 'json',
				data: {'city': city},
				success: function (response) {
					$('#update_supplier_postal_code').val(response[0]['postcode']);
				},
			});
		});
	});
</script>



