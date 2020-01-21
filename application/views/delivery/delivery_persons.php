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
								<th class="text-center">Status</th>
                                <th class="text-center"></th>
							</tr>
							</thead>
							<tbody id="dp_table">
							<?php foreach ($persons as $person) { ?>
								<tr>
									<td><?php echo $person->name; ?></td>
									<td><?php echo $person->nic; ?></td>
									<td><?php echo $person->contact; ?></td>
									<td class="text-center">
                                        <?php if($person->active == true) { ?>
                                            <a href="<?php echo base_url(); ?>delivery/DeliveryPersons/inactive_person?id=<?php echo $person->id; ?>"><span class="label label-success">Active</span></a>
                                        <?php } else { ?>
                                            <a href="<?php echo base_url(); ?>delivery/DeliveryPersons/active_person?id=<?php echo $person->id; ?>"><span class="label label-danger">Inactive</span></a>
                                        <?php } ?>
                                    </td>
									<td class="text-center">
                                        <button class="btn btn-primary btn-xs" data-id="<?php echo $person->id; ?>" id="update_dp">Update</button>
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
                                <div class="alert alert-danger" id="nic_duplicate" style="display: none;">
                                    <strong>Warning!</strong> The entered NIC number already exist in the system
                                </div>
								<div class="form-group">
									<div class="form-group">
										<label>Name</label>
										<input type="text" class="form-control" name="name" data-validation="required"/>
									</div>

									<div class="form-group">
										<label>NIC Number</label>
										<input type="text" class="form-control" name="nic" pattern="[0-9]{9}[x|X|v|V]|[0-9]{11}[x|X|v|V]" title="Contain 10 or 12 character" required id="nic"/>
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
                            <div class="alert alert-danger"  id="nic_duplicate_alert" style="display: none;">
                                <strong>Warning!</strong> The entered NIC number already exist in the system
                            </div>
                            <form action="<?php echo base_url(); ?>delivery/DeliveryPersons/update_person" method="post" role="form" id="update_person_form">
                                <div class="form-group">

                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="update_dp_name" id="update_dp_name" data-validation="required"/>
                                        <input type="hidden" class="form-control" name="id" id="update_dp_id"/>
                                    </div>

                                    <div class="form-group">
                                        <label>NIC Number</label>
                                        <input type="hidden" class="form-control" id="fixed_nic"/>
                                        <input type="text" class="form-control" name="update_dp_nic" id="update_dp_nic" pattern="[0-9]{9}[x|X|v|V]|[0-9]{11}[x|X|v|V]" title="Contain 10 or 12 character" required/>
                                    </div>

                                    <div class="form-group">
                                        <label>Contact Number</label>
                                        <input type="tel" class="form-control" name="update_dp_contact" id="update_dp_contact" pattern="[0-9]{9,10}" title="Contain only 9 or 10 digits" required/>
                                    </div>

                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal" id="button_cancel"> Cancel </button>
                            <button type="submit" class="btn btn-success" id="button_update"> Update </button>
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
            $('#nic_duplicate_alert').hide();
            var id = $(this).attr('data-id');
            $.ajax({
                type: 'post',
                url: base_url + 'delivery/DeliveryPersons/get_single_item',
                async: false,
                dataType: 'json',
                data: {id: id},
                success: function (response) {
                    $('#update_dp_id').val(response[0]['id']);
                    $('#update_dp_name').val(response[0]['name']);
                    $('#update_dp_nic').val(response[0]['nic']);
                    $('#fixed_nic').val(response[0]['nic']);
                    $('#update_dp_contact').val(response[0]['contact']);
                    $('#update_delivery_person_modal').modal('show');
                },
            });

            var fixed_nic = $('#fixed_nic').val();
            $('#update_dp_nic').focusout(function() {
                var new_nic = $('#update_dp_nic').val()
                console.log(new_nic);
                console.log(fixed_nic);
                if(fixed_nic != new_nic) {
                    var nic = $("#update_dp_nic").val();
                    $.ajax({
                        type: 'post',
                        url: base_url + 'delivery/DeliveryPersons/check_duplicate_nic',
                        async: false,
                        dataType: 'json',
                        data: {nic: nic},
                        success: function (response) {
                            if(response == true) {
                                $('#nic_duplicate_alert').show();
                                $("#button_update").attr("disabled", true);
                            }
                            else {
                                $('#nic_duplicate_alert').hide();
                                $('#button_update').removeAttr("disabled");
                            }
                        },
                    });
                }
                else {
                    $('#nic_duplicate_alert').hide();
                    $('#button_update').removeAttr("disabled");
                }
            });
        });

        $('#nic').focusout(function () {
            var nic = $("#nic").val();
            $.ajax({
                type: 'post',
                url: base_url + 'delivery/DeliveryPersons/check_duplicate_nic',
                async: false,
                dataType: 'json',
                data: {nic: nic},
                success: function (response) {
                    if(response == true) {
                        $('#nic_duplicate').show();
                        $("#button_save").attr("disabled", true);
                    }
                    else {
                        $('#nic_duplicate').hide();
                        $('#button_save').removeAttr("disabled");
                    }
                },
            });
        });
    });
</script>



