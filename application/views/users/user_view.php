<div class="content-wrapper">
    <!-- user modal-->
    <div class="modal fade" tabindex="-1" role="dialog" id="create_user_modal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create New User</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger alert-dismissible" role="alert" id="user_error">
                        <span id="error_message"></span>
                    </div>
                    <form role="form" action="" method="post" id="user_form">
                        <div class="box-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="first_name">First Name</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name"
                                               placeholder="First Name" data-validation="required">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name"
                                               placeholder="Last Name" data-validation="required">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" id="email" name="email"
                                       placeholder="Enter email" data-validation="email">
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="first_name">User Type</label>
                                        <select name="user_type" class="form-control" data-validation="required">
                                            <option disabled selected>Select one</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Inventory Manager">Inventory Manager</option>
                                            <option value="Accountant">Accountant</option>
                                            <option value="Logistic Manager">Logistic Manager</option>
                                            <option value="Sales Person">Sales Person</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="user_id"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="button_close" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="button_save">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!--user update modal-->
    <div class="modal fade" tabindex="-1" role="dialog" id="update_user_modal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create New User</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger alert-dismissible" role="alert" id="user_error">
                        <span id="error_message"></span>
                    </div>
                    <form role="form" action="" method="post" id="user_form">
                        <div class="box-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="first_name">First Name</label>
										<input type="hidden" name="id" id="update_id"/>
                                        <input type="text" class="form-control" id="update_first_name" name="first_name"
                                               placeholder="First Name" data-validation="required">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" class="form-control" id="update_last_name" name="last_name"
                                               placeholder="Last Name" data-validation="required">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" id="update_email" name="email"
                                       placeholder="Enter email" data-validation="email">
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="first_name">User Type</label>
                                        <select name="user_type" id="update_user_type" class="form-control" data-validation="required">
                                            <option disabled selected>Select one</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Inventory Manager">Inventory Manager</option>
                                            <option value="Accountant">Accountant</option>
                                            <option value="Logistic Manager">Logistic Manager</option>
                                            <option value="Sales Person">Sales Person</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="button_close" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="button_save">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- user delete modal-->
    <div class="modal fade" tabindex="-1" role="dialog" id="user_delete_modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Warrning!</h4>
                </div>
                <div class="modal-body">
                    <span>Are you sure want to delete this user ?</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="button_delete">Delete</button>
                </div>
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
                            Users
                        </h3>
                        <div class="pull-right">
                            <button class="pull-right btn btn-success" data-toggle="modal" data-target="create_user_modal"><i class="fa fa-user-plus"></i> Create New User</button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped data-tables">
                                <thead>
                                <tr>
                                    <th>User Id</th>
                                    <th>Full Name</td>
                                    <th>Email</th>
                                    <th>User Type</th>
                                    <th>Status</th>
                                    <th>Last Login</th>
									<th class="text-center">Status</th>
                                    <th class="text-center">Create Date</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                                </thead>

                                <tbody id="system_users">
                                <?php foreach ($users as $user) { ?>
                                    <td><?php echo $user->id; ?></td>
                                    <td><?php echo $user->first_name.' '.$user->last_name; ?></td>
                                    <td><?php echo $user->email; ?></td>
                                    <td><?php echo $user->user_type; ?></td>
                                    <td><?php echo $user->active; ?></td>
                                    <td><?php echo $user->last_login; ?></td>
									<td class="text-center">
										<?php if($user->active == true) { ?>
											<a href="<?php base_url(); ?>users/inactive_user?id=<?php echo $user->id; ?>"><span class="label label-success">Active</span></a>
										<?php } else { ?>
											<a href="<?php base_url(); ?>users/active_user?id=<?php echo $user->id; ?>"><span class="label label-danger">Inactive</span></a>
										<?php } ?>
									</td>
                                    <td class="text-center"><?php echo $user->create_date; ?></td>
                                    <td class="text-center">
                                        <button class="btn btn-primary btn-xs" data-id="<?php echo $user->id; ?>">Update</button>
                                        <button class="btn btn-danger btn-xs" data-id="<?php echo $user->id; ?>">Delete</button>
                                    </td>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end content -->
</div>

<script>
	$(document).ready(function() {
		$('#users_table').on('click', '#update_users', function() {
			var id = $(this).attr('data-id');
			$.ajax({
				type: 'post',
				url: base_url + 'users/users/get_single_item',
				async: false,
				dataType: 'json',
				data: {id: id},
				success: function (response) {
					if(response[0]['customer_type'] == 'person') {
						$('#update_customer_person').prop( "checked", true );
						$('#update_customer_label').text('First Name');
						$('#update_last_name').show();
					}
					else {
						$('#update_customer_company').prop( "checked", true );
						$('#update_customer_label').text('Company Name');
						$('#update_last_name').hide();
					}

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

