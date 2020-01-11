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
                <div class="box box-default box-solid collapsed-box">
                    <div class="box-header ">
                        <h3 class="box-title">
                            Compose New Message
                        </h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
							</button>
						</div>
                    </div>
                    <div class="box-body pad">
                        <form action="<?php echo base_url(); ?>email/email/send" method="post">
                            <div class="form-group">
                                <input name="receiver" class="form-control" placeholder="To:" data-validation="email">
                            </div>
                            <div class="form-group">
                                <input name="subject" class="form-control" placeholder="Subject:" data-validation="required">
                            </div>
                            <textarea name="body" class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                    </div>

                    <div class="box-footer">
                        <div class="pull-right">
                            <button type="reset" class="btn btn-default">Discard</button>
                            <button type="submit" class="btn btn-success">Send Email</button>
                        </div>
						</form>
                    </div>
                </div>
            </div>

			<div class="col-xs-12">
				<div class="box">
					<div class="box-header ">
						<h3 class="box-title">
							Outgoing Mail box
						</h3>
					</div>
					<div class="box-body">
						<table class="table table-striped table-bordered table-responsive data_tables display pageResize">
							<tr>
								<th>Receiver</th>
								<th>Subject</th>
								<th width="50%">Body</th>
								<th>Date</th>
								<th class="text-center">Status</th>
							</tr>
							<?php foreach ($emails as $email) { ?>
								<tr>
									<td><?php echo $email->receiver; ?></td>
									<td><?php echo $email->subject; ?></td>
									<td style="text-overflow: ellipsis; "><?php echo strip_tags($email->body); ?></td>
									<td><?php echo $email->date; ?></td>
									<td class="text-center"><span class="label label-success"> Received </span></td>
								</tr>
							<?php } ?>
						</table>
					</div>
				</div>
			</div>
        </div>
    </section>
</div>

