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
							Product Categories
						</h3>
					</div>
					<div class="box-body">
						<table class="table table-bordered table-striped data_tables">
							<thead>
							<tr>
								<th>Code</th>
								<th>Name</th>
								<th>Create Date</th>
								<th class="text-center"></th>
							</tr>
							</thead>
							<tbody id="category_table">
							<?php
							foreach ($categories as $category) { ?>
								<tr>
									<td><?php echo $category->code; ?></td>
									<td><?php echo $category->name; ?></td>
									<td><?php echo $category->create_date; ?></td>
									<td class="text-center">
										<button class="btn btn-primary btn-xs" id="update_category" data-id="<?php echo $category->id; ?>">Update</button>
										<button class="btn btn-danger btn-xs" id="delete_category" data-id="<?php echo $category->id; ?>">Delete</button>
									</td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<!--category create form-->
			<div class="col-xs-4">
				<div class="box">
					<form role="form" action="<?php echo base_url(); ?>/products/categories/create_category" method="post">
						<div class="box-body">
							<div class="form-group">
								<div class="form-group">
									<label>Category Code</label>
									<input type="text" class="form-control" name="code" data-validation="required"/>
								</div>
								<div class="form-group">
									<label>Category Name</label>
									<input type="text" class="form-control" name="name" data-validation="required"/>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="reset" class="btn btn-default">Clear</button>
							<button type="submit" class="btn btn-success">Save</button>
						</div>
					</form>
				</div>
			</div>
			<!--end category create form-->

			<!--category edit modal-->
			<div class="modal fade" tabindex="-1" role="dialog" id="update_category_modal">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Update Category</h4>
						</div>
						<div class="modal-body">
							<form role="form" action="<?php echo base_url('products/categories/update_category') ?>" method="post">
								<div class="box-body">
									<div class="form-group">
										<div class="form-group">
											<label>Category Code</label>
											<input type="text" class="form-control" value="" name="code" id="update_category_code" data-validation="required"/>
											<input type="hidden" value="" name="id" id="update_category_id"/>
										</div>
										<div class="form-group">
											<label>Category Name</label>
											<input type="text" class="form-control" value="" name="name" id="update_category_name" data-validation="required"/>
										</div>
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
			<!--end category edit modal-->

			<!--category delete modal-->
			<div class="modal fade" tabindex="-1" role="dialog" id="delete_category_modal">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title text-danger">Warning</h4>
						</div>
						<div class="modal-body">
							Are you sure want to delete this category ?
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal"> No </button>
							<form action="<?php echo base_url('products/categories/delete_category') ?>" method="post" style="display: inline;">
								<input type="hidden" value="" name="id" id="delete_category_id"/>
								<button type="submit" class="btn btn-danger"> Yes </button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!--end category delete modal-->
		</div>
	</section>
</div>

<script>
	$(document).ready(function() {
		$('#category_table').on('click', '#update_category', function() {
			var id = $(this).attr('data-id');
			$.ajax({
				type: 'post',
				url: base_url + 'products/categories/get_single_item',
				async: false,
				dataType: 'json',
				data: {id: id},
				success: function (response) {
					$('#update_category_id').val(response[0]['id']);
					$('#update_category_code').val(response[0]['code']);
					$('#update_category_name').val(response[0]['name']);
					$('#update_category_modal').modal('show');
				},
			});
		})

		$('#category_table').on('click', '#delete_category', function() {
			var id = $(this).attr('data-id');
			$.ajax({
				type: 'post',
				url: base_url + 'products/categories/get_single_item',
				async: false,
				dataType: 'json',
				data: {id: id},
				success: function (response) {
					$('#delete_category_id').val(response[0]['id']);
					$('#delete_category_modal').modal('show');
				},
			});
		})
	});
</script>




