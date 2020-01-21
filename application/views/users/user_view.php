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

    <!-- user create modal-->
    <div class="modal fade" tabindex="-1" role="dialog" id="create_user_modal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Create New User</h4>
                </div>
                <div class="modal-body">
                    <form role="form" action="<?php echo base_url('users/users/create_user') ?>" method="post">
                        <div class="box-body">
                            <div class="alert alert-danger"  id="email_duplicate_alert" style="display: none;">
                                <strong>Warning!</strong> The entered Email address already exist in the system
                            </div>
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
                    <button type="reset" class="btn btn-default" id="button_create_reset">Reset</button>
                    <button type="submit" class="btn btn-success" id="button_create_save">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end user create modal-->

    <!--user update modal-->
    <div class="modal fade" tabindex="-1" role="dialog" id="update_user_modal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update User</h4>
                </div>
                <div class="modal-body">
                    <form role="form" action="<?php echo base_url('users/users/update_user') ?>" method="post">
                        <div class="alert alert-danger" id="email_update_duplicate_alert" style="display: none;">
                            <strong>Warning!</strong> The entered Email address already exist in the system
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="first_name">First Name</label>
										<input type="hidden" name="id" id="update_user_id"/>
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
                                <input type="hidden" id="fixed_email"/>
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
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="button_update_close">Close</button>
                    <button type="submit" class="btn btn-success" id="button_update_save">Save</button>
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
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Warrning!</h4>
                </div>
                <div class="modal-body">
                    <span>Are you sure want to delete this user ?</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> No </button>
                    <form action="<?php echo base_url('users/users/delete_user') ?>" method="post" style="display: inline;">
                        <input type="hidden" name="id" id="delete_customer_id"/>
                        <button type="submit" class="btn btn-danger"> Yes </button>
                    </form>
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
                            <button class="pull-right btn btn-success" data-toggle="modal" data-target="#create_user_modal" id="create_user_btn"><i class="fa fa-user-plus"></i> Create New User</button>
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
                                    <th>Last Login</th>
									<th class="text-center">Status</th>
                                    <th class="text-center">Create Date</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                                </thead>

                                <tbody id="system_users">
                                <?php foreach ($users as $user) { ?>
                                    <tr>
                                        <td>EMP<?php echo $user->id; ?></td>
                                        <td><?php echo $user->first_name.' '.$user->last_name; ?></td>
                                        <td><?php echo $user->email; ?></td>
                                        <td><?php echo $user->user_type; ?></td>
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
                                            <button class="btn btn-primary btn-xs" id="update_user" data-id="<?php echo $user->id; ?>">Update</button>
                                            <button class="btn btn-danger btn-xs" id="delete_user" data-id="<?php echo $user->id; ?>">Delete</button>
                                        </td>
                                    </tr>
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
		$('#system_users').on('click', '#update_user', function() {
            $('#email_update_duplicate_alert').hide();
			var id = $(this).attr('data-id');
			$.ajax({
				type: 'post',
				url: base_url + 'users/users/get_single_item',
				async: false,
				dataType: 'json',
				data: {id: id},
				success: function (response) {
					$('#update_user_id').val(response[0]['id']);
					$('#update_first_name').val(response[0]['first_name']);
					$('#update_last_name').val(response[0]['last_name']);
					$('#update_email').val(response[0]['email']);
					$('#fixed_email').val(response[0]['email']);
					$('#update_user_type').val(response[0]['user_type']).change();
					$('#update_user_modal').modal('show');
				},
			});

			var fixed_email = $('#fixed_email').val();

            $('#update_email').change(function () {
                var new_email = $('#update_email').val()
                if(fixed_email != new_email) {
                    var email = $("#update_email").val();
                    $.ajax({
                        type: 'post',
                        url: base_url + 'users/users/check_email_address',
                        async: false,
                        dataType: 'json',
                        data: {email: email},
                        success: function (response) {
                            if(response == true) {
                                $('#email_update_duplicate_alert').show();
                                $("#button_update_save").attr("disabled", true);
                            }
                            else {
                                $('#email_update_duplicate_alert').hide();
                                $('#button_update_save').removeAttr("disabled");
                            }
                        },
                    });
                }
                else {
                    $('#email_update_duplicate_alert').hide();
                    $('#button_update_save').removeAttr("disabled");
                }
            });

            $('#button_update_close').click(function () {
                $('#email_update_duplicate_alert').hide();
                $('#button_update_save').removeAttr("disabled");
            })
		});

        $('#email').change(function () {
            var email = $("#email").val();
            $.ajax({
                type: 'post',
                url: base_url + 'users/users/check_email_address',
                async: false,
                dataType: 'json',
                data: {email: email},
                success: function (response) {
                    if(response == true) {
                        $('#email_duplicate_alert').show();
                        $("#button_create_save").attr("disabled", true);
                    }
                    else {
                        $('#email_duplicate_alert').hide();
                        $('#button_create_save').removeAttr("disabled");
                    }
                },
            });
        });

        $('#button_create_reset').click(function () {
            $('#email_duplicate_alert').hide();
            $('#button_create_save').removeAttr("disabled");
        })

		$('#system_users').on('click', '#delete_user', function() {
			var id = $(this).attr('data-id');
			$.ajax({
				type: 'post',
				url: base_url + 'users/users/get_single_item',
				async: false,
				dataType: 'json',
				data: {id: id},
				success: function (response) {
					$('#delete_customer_id').val(response[0]['id']);
					$('#user_delete_modal').modal('show');
				},
			});
		})
	});

</script>

