<?php
/**
 * Created by PhpStorm.
 * User: rebecca
 * Date: 7/17/2019
 * Time: 10:43 PM
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="<?php echo base_url() ?>assets/images/company/<?php echo $company[0]->logo; ?>" type="image/gif" sizes="16x16">
	<title>AgroFarm Management System</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets/bower_components/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets/bower_components/Ionicons/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/AdminLTE.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
	<!-- bootstrap datepicker -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
	<!-- Full Calendar -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/fullcalendar/dist/fullcalendar.min.css">
	<!-- AdminLTE Skins -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/skins/_all-skins.min.css">
	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	<!--  Animate css  -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets/css/animate.css">
	<!-- bootstrap wysihtml5 - text editor -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	<!-- Custom css files -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets/css/style.css"/>
	<!-- jQuery 3 -->
	<script src="<?php echo base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
</head>

<body class="fixed sidebar-mini sidebar-mini-expand-feature skin-green-light" style="height: auto; min-height: 100%;" onload="startTime()">
<!-- Site wrapper -->
<div class="wrapper">

	<!-- ================== Start Header ============================= -->
	<header class="main-header fixed">
		<!-- Logo -->
		<a href="#" class="logo">
			<!-- logo for regular state and mobile devices -->
			<span class="logo-lg"><b>Agro</b>Farm</span>
		</a>
		<!-- Header Navbar: style can be found in header.less -->
		<nav class="navbar navbar-static-top">
			<!-- Sidebar toggle button-->
			<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>

			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
					<li>
						<p class="navbar-text" style="color: #fff;" href="#" id="datetime"></p>
					</li>
					<li>
						<a href="<?php echo base_url(); ?>users/UserProfile"><?php echo $this->session->userdata('name') ;?></a>
					</li>
					<li>
						<a href="#" data-toggle="modal" data-target="#logout_modal"><i class="fa fa-sign-out"></i> Logout</a>
					</li>
				</ul>
			</div>
		</nav>
	</header>
	<!-- ================== End Header ============================= -->

	<!-- ================== Start Side Bar ============================ -->
	<aside class="main-sidebar">
		<!-- sidebar: style can be found in sidebar.less -->
		<section class="sidebar">
			<ul class="sidebar-menu">
				<?php if($this->session->userdata('type') != 'Sales Person') { ?>
					<li>
						<a href="<?php echo base_url(); ?>home">
							<i class="fa fa-tachometer"></i> &nbsp;&nbsp;<span>Dashboard</span>
							<span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
						</a>
					</li>
				<?php } ?>

				<?php if($this->session->userdata('type') != 'Logistic Manager') { ?>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-cubes"></i> &nbsp;&nbsp;<span>Inventory</span>
							<span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
							<ul class="treeview-menu">
								<li><a href="<?php echo base_url(); ?>products/inventory"><i class="fa fa-angle-right"></i> Inventory</a></li>
								<li><a href="<?php echo base_url(); ?>products/products"><i class="fa fa-angle-right"></i> Products</a></li>
								<li><a href="<?php echo base_url(); ?>products/categories"><i class="fa fa-angle-right"></i> Product Categories</a></li>
								<li><a href="<?php echo base_url(); ?>products/uom"><i class="fa fa-angle-right"></i> Unit of Measures</a></li>
							</ul>
						</a>
					</li>
				<?php } ?>

				<?php if($this->session->userdata('type') != 'Logistic Manager') { ?>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-shopping-bag"></i> &nbsp;&nbsp;<span>Purchase</span>
							<span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
							<ul class="treeview-menu">
								<li><a href="<?php echo base_url(); ?>purchase/purchase"><i class="fa fa-angle-right"></i> Create PO</a></li>
								<li><a href="<?php echo base_url(); ?>purchase/purchase/view_purchase_orders"><i class="fa fa-angle-right"></i> View PO</a></li>
							</ul>
						</a>
					</li>
				<?php } ?>

				<?php if($this->session->userdata('type') == 'Admin' || $this->session->userdata('type') ==  'Accountant' || $this->session->userdata('type') ==  'Sales Person') { ?>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-money"></i> &nbsp;&nbsp;<span>Invoices</span>
							<span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
							<ul class="treeview-menu">
								<li><a href="<?php echo base_url(); ?>invoice/invoice"><i class="fa fa-angle-right"></i> Create Invoice</a></li>
								<li><a href="<?php echo base_url(); ?>invoice/invoice/all_invoices"><i class="fa fa-angle-right"></i> View Invoices</a></li>
							</ul>
						</a>
					</li>
				<?php } ?>

				<?php if($this->session->userdata('type') != 'Accountant') { ?>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-truck"></i> &nbsp;&nbsp;<span>Delivery Orders</span>
							<span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
							<ul class="treeview-menu">
								<li><a href="<?php echo base_url(); ?>delivery/delivery/all_delivery_orders"><i class="fa fa-angle-right"></i> View Delivery Orders</a></li>
								<li><a href="<?php echo base_url(); ?>delivery/delivery/delivery_calendar_view"><i class="fa fa-angle-right"></i> Delivery Calendar</a></li>
								<li><a href="<?php echo base_url(); ?>delivery/DeliveryPersons"><i class="fa fa-angle-right"></i> Delivery Persons </a></li>
							</ul>
						</a>
					</li>
				<?php } ?>

				<li>
					<a href="<?php echo base_url(); ?>suppliers/supplier">
						<i class="fa fa-tree"></i> &nbsp;&nbsp;<span>Suppliers</span>
						<span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
					</a>
				</li>
				<li>
					<a href="<?php echo base_url(); ?>customers/customer">
						<i class="fa fa-users"></i> &nbsp;&nbsp;<span>Customers</span>
						<span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
					</a>
				</li>
				<li>
					<a href="<?php echo base_url(); ?>email/email">
						<i class="fa fa-envelope"></i> &nbsp;&nbsp;<span>Emails</span>
						<span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
					</a>
				</li>

				<?php if($this->session->userdata('type') != 'Sales Person') { ?>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-file-text-o"></i> &nbsp;&nbsp;<span>Reports</span>
							<span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
							<ul class="treeview-menu">
								<li><a href="<?php echo base_url(); ?>reports/reports/income_report"><i class="fa fa-angle-right"></i> Income Report</a></li>
								<li><a href="<?php echo base_url(); ?>reports/reports/expense_report"><i class="fa fa-angle-right"></i> Expense Report</a></li>
								<li><a href="<?php echo base_url(); ?>reports/reports/stock_report"><i class="fa fa-angle-right"></i> Stock Report</a></li>
								<li><a href="<?php echo base_url(); ?>reports/reports/delivery_report"><i class="fa fa-angle-right"></i> Delivery Report </a></li>
<!--								<li><a href="--><?php //echo base_url(); ?><!--reports/reports/customer_report"><i class="fa fa-angle-right"></i> Customer Report </a></li>-->
								<li><a href="<?php echo base_url(); ?>reports/reports/yearly_income_expense_report"><i class="fa fa-angle-right"></i> Yearly I&E Report </a></li>
<!--								<li><a href="--><?php //echo base_url(); ?><!--reports/reports/monthly_income_expense_report"><i class="fa fa-angle-right"></i> Monthly Income & Expense Report </a></li>-->
							</ul>
						</a>
					</li>
				<?php } ?>

				<?php if($this->session->userdata('type') == 'Admin') { ?>
					<li>
						<a href="<?php echo base_url(); ?>base/company">
							<i class="fa fa-building-o"></i> &nbsp;&nbsp;<span>Company Details</span>
							<span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
						</a>
					</li>
				<?php } ?>

				<?php if($this->session->userdata('type') == 'Admin') { ?>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-user"></i> &nbsp;&nbsp;<span>System Users</span>
							<span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
							<ul class="treeview-menu">
								<li><a href="<?php echo base_url(); ?>users/users"><i class="fa fa-angle-right"></i> Users</a></li>
								<li><a href="<?php echo base_url(); ?>users/UserManagement"><i class="fa fa-angle-right"></i> User Access</a></li>
							</ul>
						</a>
					</li>
				<?php } ?>
			</ul>
</div>
</section>
<!-- /.sidebar -->
</aside>
<!-- ================== End Side Bar =========================== -->

<!-- logout modal-->
<div class="modal fade" tabindex="-1" role="dialog" id="logout_modal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Logout</h4>
			</div>
			<div class="modal-body">
				<span>Are you sure want to logout ?</span>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"> No </button>
				<a href="<?php echo base_url('login/logout'); ?>" class="btn btn-success"> Yes </a>
			</div>
		</div>
	</div>
</div>
