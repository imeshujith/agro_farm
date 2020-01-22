<div class="content-wrapper">
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">
							User Permission Management
						</h3>
					</div>
					<div class="box-body">
						<table class="table table-bordered table-striped">
							<thead>
							<tr>
								<th>Access Level</th>
								<th>Access Modules</th>
								<th>Operations</th>
							</tr>
							</thead>
							<tbody>
                            <?php if($this->session->userdata('type') == 'Admin') { ?>
							<tr>
								<td>Admin</td>
								<td>
									<ul>
										<li>Dashboard</li>
										<li>Inventory</li>
										<li>Purchase</li>
										<li>Invoice</li>
										<li>Delivery Orders</li>
										<li>Suppliers</li>
										<li>Customers</li>
										<li>Email</li>
										<li>Reports</li>
										<li>Company Details</li>
										<li>System Users</li>
									</ul>
								</td>
								<td>
									<ul>
										<li>View</li>
										<li>Create</li>
										<li>Update</li>
										<li>Delete</li>
									</ul>
								</td>
							</tr>
                            <?php } ?>
                            <?php if($this->session->userdata('type') == 'Inventory Manager' || $this->session->userdata('type') == 'Admin') { ?>
							<tr>
								<td>Inventory Manager</td>
								<td>
									<ul>
                                        <li>Dashboard</li>
										<li>Inventory</li>
										<li>Purchase</li>
										<li>Delivery Orders</li>
										<li>Suppliers</li>
										<li>Customers</li>
										<li>Email</li>
										<li>Reports</li>
									</ul>
								</td>
								<td>
									<ul>
										<li>View</li>
										<li>Create</li>
										<li>Update</li>
										<li>Delete</li>
									</ul>
								</td>
							</tr>
                            <?php } ?>
                            <?php if($this->session->userdata('type') == 'Accountant' || $this->session->userdata('type') == 'Admin') { ?>
							<tr>
								<td>Accountant</td>
								<td>
									<ul>
                                        <li>Dashboard</li>
										<li>Inventory</li>
										<li>Purchase</li>
										<li>Invoice</li>
										<li>Suppliers</li>
										<li>Customers</li>
										<li>Email</li>
										<li>Reports</li>
									</ul>
								</td>
								<td>
									<ul>
										<li>View</li>
										<li>Create</li>
										<li>Update</li>
										<li>Delete</li>
									</ul>
								</td>
							</tr>
                            <?php } ?>
                            <?php if($this->session->userdata('type') == 'Logistic Manager' || $this->session->userdata('type') == 'Admin') { ?>
							<tr>
								<td>Logistic Manager</td>
								<td>
									<ul>
                                        <li>Dashboard</li>
										<li>Inventory</li>
										<li>Delivery Orders</li>
										<li>Customers</li>
										<li>Email</li>
										<li>Reports</li>
									</ul>
								</td>
								<td>
									<ul>
										<li>View</li>
										<li>Create</li>
										<li>Update</li>
										<li>Delete</li>
									</ul>
								</td>
							</tr>
                            <?php } ?>
                            <?php if($this->session->userdata('type') == 'Sales Person' || $this->session->userdata('type') == 'Admin') { ?>
							<tr>
								<td>Sales Person</td>
								<td>
									<ul>
										<li>Inventory</li>
										<li>Purchase</li>
										<li>Invoice</li>
										<li>Delivery Orders</li>
										<li>Suppliers</li>
										<li>Customers</li>
										<li>Email</li>
									</ul>
								</td>
								<td>
									<ul>
										<li>View</li>
										<li>Create</li>
										<li>Update</li>
									</ul>
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
</div>






