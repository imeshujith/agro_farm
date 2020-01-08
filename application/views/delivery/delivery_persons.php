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
								<th>Status</th>
                                <th></th>
							</tr>
							</thead>
							<tbody id="dp_table">
							<?php foreach ($persons as $person) { ?>
								<tr>
									<td><?php echo $person->name; ?></td>
									<td><?php echo $person->nic; ?></td>
									<td><?php echo $person->contact; ?></td>
									<td></td>
									<td>
                                        <button class="btn btn-primary btn-sm" data-id="<?php echo $person->id; ?>" id="update_dp">Update</button>
                                        <?php if($person->active == true) { ?>
                                            <a class="btn btn-danger btn-sm"  href="<?php echo base_url(); ?>delivery/DeliveryPersons/inactive_person">Inactive</a>
                                        <?php } ?>
                                        <?php if($person->active == false) { ?>
                                            <a class="btn btn-success btn-sm" href="<?php echo base_url(); ?>delivery/DeliveryPersons/active_person">Active</a>
                                        <?php } ?>
                                    </td>
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

            <!--uom edit modal-->
            <div class="modal fade" tabindex="-1" role="dialog" id="update_delivery_person_modal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Update Delivery Person</h4>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo base_url(); ?>delivery/DeliveryPersons/update_delivery_person" method="post" role="form">
                                <div class="form-group">

                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="update_dp_name" id="update_dp_name" data-validation="required"/>
                                        <input type="hidden" class="form-control" name="update_dp_id"/>
                                    </div>

                                    <div class="form-group">
                                        <label>NIC Number</label>
                                        <input type="text" class="form-control" name="update_dp_nic" id="update_dp_nic" pattern="[0-9]{9}[x|X|v|V]|[0-9]{11}[x|X|v|V]" title="Contain 10 or 12 character" required/>
                                    </div>

                                    <div class="form-group">
                                        <label>Contact Number</label>
                                        <input type="tel" class="form-control" name="update_dp_contact" id="update_dp_contact" pattern="[0-9]{9,10}" title="Contain only 9 or 10 digits" required/>
                                    </div>

                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"> Cancel </button>
                            <button type="submit" class="btn btn-primary"> Update </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--end uom edit modal-->
		</div>
	</section>
</div>

<script>
    $(document).ready(function() {
        $('#dp_table').on('click', '#update_dp', function() {
            var id = $(this).attr('data-id');
            $.ajax({
                type: 'post',
                url: base_url + 'delivery/DeliveryPersons/person',
                async: false,
                dataType: 'json',
                data: {id: id},
                success: function (response) {
                    $('#update_dp_id').val(response[0]['id']);
                    $('#update_dp_name').val(response[0]['name']);
                    $('#update_dp_nic').val(response[0]['nic']);
                    $('#update_dp_contact').val(response[0]['contact']));
                    $('#update_delivery_person_modal').modal('show');
                },
            });
        });
    });
</script>



