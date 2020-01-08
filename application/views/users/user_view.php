<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            User Management
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">User Management</a></li>
        </ol>
    </section>

    <!-- user modal-->
    <div class="modal fade" tabindex="-1" role="dialog" id="user_modal">
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
                                        placeholder="First Name">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name"
                                        placeholder="Last Name">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" id="email" name="email"
                                placeholder="Enter email">
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
                    <div class="box-header">
                        <button class="pull-right btn btn-success" id="create_user"><i class="fa fa-user-plus"></i> Create New User</button>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example2" class="table table-bordered table-striped" id="products">
                                <thead>
                                    <tr>
                                        <th>User Id</th>
                                        <th>Full Name</td>
                                        <th>Email</th>
                                        <th>User Type</th>
                                        <th>Status</th>
                                        <th>Last Login</th>
                                        <th>Create Date</th>
                                        <th>Edit Date</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>

                                <tbody id="all_users"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end content -->
</div>
