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
							Company Informations
						</h3>
					</div>
					<div class="box-body">
						<div class="container">
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-4 text-center">
											<?php if($company_details) { ?>
												<img src="<?php echo base_url(); ?>assets/images/company/<?php echo $company_details[0]->logo; ?>" class="img img-thumbnail img-responsive" data-validation="required"/>
											<?php } else { ?>
												<div style="width: 100%; height: 300px; background: #868e96; border-radius: 5px; color: #fff;"></div>
											<?php } ?>
											<h4>Company Logo</h4>
										</div>
										<div class="col-md-6">
											<form class="form-horizontal" action="<?php echo base_url(); ?>base/company/update" method="post" enctype="multipart/form-data" name="company_form">
												<div class="form-group">
													<label class="control-label col-sm-4">Company Name</label>
													<div class="col-sm-8">
														<input type="text" class="form-control" name="company_name" value="<?php echo $company_details ? $company_details[0]->name: '' ?>" data-validation="required">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-sm-4">Street</label>
													<div class="col-sm-8">
														<input type="text" class="form-control" name="company_street" value="<?php echo $company_details ? $company_details[0]->street: '' ?>" data-validation="required">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-sm-4">City</label>
													<div class="col-sm-8">
														<select class="form-control" name="company_city" data-validation="required">
															<?php
															if($company_details) {
																foreach ($cities as $city) { ?>
																	<option <?php echo $company_details[0]->city == $city->name_en ? 'selected="selected"' : Null ?> ><?php echo $city->name_en; ?></option>
																<?php }
															}
															else {
																echo '<option selected="selected" disabled>Select One</option>';
																foreach ($cities as $city) {
																	echo '<option>'.$city->name_en.'</option>';
																}
															}
															?>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-sm-4">Country</label>
													<div class="col-sm-8">
														<select class="form-control" name="company_country" data-validation="required">
															<?php foreach ($countries as $country) {
																if($country->country_name == 'Sri Lanka') {
																	?>
																	<option><?php echo $country->country_name; ?></option>
																<?php }} ?>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-sm-4">Phone Number</label>
													<div class="col-sm-8">
														<input type="text" class="form-control" name="company_phone" value="<?php echo $company_details ? $company_details[0]->phone: '' ?>" data-validation="required">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-sm-4">Mobile Number</label>
													<div class="col-sm-8">
														<input type="text" class="form-control" name="company_mobile" value="<?php echo $company_details ? $company_details[0]->mobile: '' ?>" data-validation="required">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-sm-4">Email</label>
													<div class="col-sm-8">
														<input type="email" class="form-control" name="company_email" value="<?php echo $company_details ? $company_details[0]->email: '' ?>" data-validation="required">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-sm-4">Company Logo</label>
													<div class="col-sm-8">
														<input type="file" name="company_logo">
													</div>
												</div>
												<div class="form-group" style="margin-top: 80px;">
													<div class="col-sm-offset-8 col-sm-4 text-right">
														<button type="submit" class="btn btn-primary">Update Details</button>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</div>
</section>
</div>




