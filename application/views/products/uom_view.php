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
							Unit of Measures
						</h3>
					</div>
					<div class="box-body">
						<table class="table table-bordered table-striped data_tables">
							<thead>
							<tr>
								<th>Name</th>
								<th>Standard Unit</th>
								<th>Create Date</th>
								<th class="text-center"></th>
							</tr>
							</thead>
							<tbody id="uom_table">
							<?php
							foreach ($uoms as $uom) { ?>
								<tr>
									<td><?php echo $uom->name; ?></td>
									<td><?php echo $uom->unit; ?></td>
									<td><?php echo $uom->create_date; ?></td>
									<td class="text-center">
										<button class="btn btn-primary btn-xs" id="update_uom" data-id="<?php echo $uom->id; ?>">Update</button>
                                        <?php if($this->session->userdata('type') != 'Sales Person') { ?><button class="btn btn-danger btn-xs" id="delete_uom" data-id="<?php echo $uom->id; ?>">Delete</button><?php } ?>
									</td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<!--uom create form-->
			<div class="col-xs-4">
				<div class="box">
					<div class="box-body">
						<form action="<?php echo base_url(); ?>products/uom/create_uom" method="post" role="form">
							<div class="box-body">
								<div class="form-group">
									<div class="form-group">
										<label>Standard Name</label>
										<input type="text" class="form-control" name="name" data-validation="required"/>
									</div>
									<div class="form-group">
										<label>Unit</label>
										<input type="text" class="form-control" name="unit" data-validation="required"/>
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
			<!--end uom create form-->

			<!--uom edit modal-->
			<div class="modal fade" tabindex="-1" role="dialog" id="update_uom_modal">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Update UoM</h4>
						</div>
						<div class="modal-body">
							<form action="<?php echo base_url(); ?>products/uom/update_uom" method="post" role="form">
								<div class="form-group">
									<div class="form-group">
										<label>Standard Name</label>
										<input type="text" class="form-control" name="name" id="update_uom_name" data-validation="required"/>
										<input type="hidden" class="form-control" name="id" id="update_uom_id"/>
									</div>
									<div class="form-group">
										<label>Unit</label>
										<input type="text" class="form-control" name="unit" id="update_uom_unit" data-validation="required"/>
									</div>
								</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal"> Cancel </button>
							<button type="submit" class="btn btn-success"> Update </button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!--end uom edit modal-->

			<!--uom delete modal-->
			<div class="modal fade" tabindex="-1" role="dialog" id="delete_uom_modal">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title text-danger">Warning</h4>
						</div>
						<div class="modal-body">
							Are you sure want to delete this unit of measure ?
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal"> No </button>
							<form action="<?php echo base_url('products/uom/delete_uom') ?>" method="post" style="display: inline;">
								<input type="hidden" value="" name="id" id="delete_uom_id"/>
								<button type="submit" class="btn btn-danger"> Yes </button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!--end uom delete modal-->
		</div>
	</section>
</div>

<script>
	$(document).ready(function() {
		$('#uom_table').on('click', '#update_uom', function() {
			var id = $(this).attr('data-id');
			$.ajax({
				type: 'post',
				url: base_url + 'products/uom/get_single_item',
				async: false,
				dataType: 'json',
				data: {id: id},
				success: function (response) {
					$('#update_uom_id').val(response[0]['id']);
					$('#update_uom_name').val(response[0]['name']);
					$('#update_uom_unit').val(response[0]['unit']);
					$('#update_uom_modal').modal('show');
				},
			});
		})

		$('#uom_table').on('click', '#delete_uom', function() {
			var id = $(this).attr('data-id');
			$.ajax({
				type: 'post',
				url: base_url + 'products/uom/get_single_item',
				async: false,
				dataType: 'json',
				data: {id: id},
				success: function (response) {
					$('#delete_uom_id').val(response[0]['id']);
					$('#delete_uom_modal').modal('show');
				},
			});
		})
	});
</script>


