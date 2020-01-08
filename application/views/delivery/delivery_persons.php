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
			<div class="col-xs-8">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">
							Delivery Persons
						</h3>
					</div>
					<div class="box-body">
						<table class="table table-bordered table-striped data_tables">
							<thead>
							<tr>
								<th>Name</th>
								<th>NIC Number</th>
								<th>Mobile Number</th>
							</tr>
							</thead>
							<tbody>
							<?php foreach ($persons as $person) { ?>
								<tr>
									<td><?php echo $person->name; ?></td>
									<td><?php echo $person->nic; ?></td>
									<td><?php echo $person->contact; ?></td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<!--delivery person create form-->
			<div class="col-xs-4">
				<div class="box">
					<div class="box-body">
						<form action="<?php echo base_url(); ?>delivery/DeliveryPersons/create_person" method="post" role="form">
							<div class="box-body">
								<div class="form-group">

									<div class="form-group">
										<label>Name</label>
										<input type="text" class="form-control" name="name" data-validation="required"/>
									</div>

									<div class="form-group">
										<label>NIC Number</label>
										<input type="text" class="form-control" name="nic" pattern="[0-9]{9}[x|X|v|V]|[0-9]{11}[x|X|v|V]" title="Contain 10 or 12 character" required/>
									</div>

									<div class="form-group">
										<label>Contact Number</label>
										<input type="tel" class="form-control" name="contact" pattern="[0-9]{9,10}" title="Contain only 9 or 10 digits" required/>
									</div>

								</div>
							</div>
							<div class="modal-footer">
								<button type="reset" class="btn btn-default" id="button_close">Clear</button>
								<button type="submit" class="btn btn-success" id="button_save">Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!--delivery person create form-->
		</div>
	</section>
</div>




