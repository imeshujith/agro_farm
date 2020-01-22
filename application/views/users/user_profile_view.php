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
							User Profile
						</h3>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								<form class="form-horizontal" action="<?php echo base_url(); ?>users/UserProfile/update_profile" method="post" style="margin-top: 80px;">
									<div class="form-group">
										<label class="control-label col-sm-4">First Name</label>
										<div class="col-sm-4 col-offser">
											<input type="text" class="form-control" name="first_name" value="<?php echo $user[0]->first_name; ?>" data-validation="required">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-sm-4">Last Name</label>
										<div class="col-sm-4 col-offser">
											<input type="text" class="form-control" name="last_name" value="<?php echo $user[0]->last_name; ?>" data-validation="required">
										</div>
									</div>

									<div class="col-sm-12">
										<div class="col-sm-4"></div>
										<div class="col-sm-4"><button class="btn btn-success pull-right" style="margin-bottom: 80px;">Update Info</button></div>
									</div>
								</form>
							</div>

							<div class="col-md-6">
								<form class="form-horizontal" action="<?php echo base_url(); ?>users/UserProfile/update_password" method="post" style="margin-top: 80px;" id="password_form">
									<div class="form-group">
										<label class="control-label col-sm-4">Current Password</label>
										<div class="col-sm-4 col-offser">
											<input type="password" class="form-control" name="current_password" data-validation="required">
											<input type="hidden" class="form-control" name="id">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-sm-4">New Password</label>
										<div class="col-sm-4 col-offser">
											<input type="password" class="form-control" name="new_password" id="new_password" data-validation="required">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-sm-4">Re-Type Password</label>
										<div class="col-sm-4 col-offser">
											<input type="password" class="form-control" name="retype_password" id="new_reype" data-validation="required">
										</div>
									</div>

									<div class="col-sm-12">
										<div class="col-sm-4"></div>
										<div class="col-sm-4"><button class="btn btn-success pull-right" style="margin-bottom: 80px;">Update Password</button></div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<script type="text/javascript">
	$(function () {
		$("#password_form").submit(function() {
			var password = $("#new_password").val();
			var confirmPassword = $("#new_reype").val();
			if (password != confirmPassword) {
                Swal.fire('New password and Re-Type password does not match');
				return false;
			}
			return true;
		});
	});
</script>



