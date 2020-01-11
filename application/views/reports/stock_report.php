<div class="content-wrapper">
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-body">
						<form action="<?php echo base_url(); ?>reports/reports/stock_report" method="post">
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Product Category</label>
										<select class="form-control" name="category" data-validation="required">
											<option selected disabled hidden>Select</option>
											<?php
											foreach ($categories as $category) { ?>
												<option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<button class="btn btn-success">Generate Report</button>
								</div>
							</div>
						</form>

						<h3 style="margin-top: 50px;" class="text-center"><u><?php if($title) echo $title; ?></u></h3>

						<div class="row" style="margin-top: 50px;">
							<div class="col-md-12">
								<table class="table table-bordered table-striped table-responsive">
									<thead>
									<tr class="bg-black-gradient">
										<th>Code</th>
										<th>Name</th>
										<th>Category</th>
<!--										<th>Type</th>-->
										<th class="text-right">Price</th>
										<th class="text-right">Quantity</th>
										<th>UoM</th>
										<th>Minimum Qty</th>
										<th>Maximum Qty</th>
									</tr>
									</thead>
									<tbody>
									<?php if($products) { ?>
										<?php foreach ($products as $product) { ?>
											<tr>
												<td><?php echo $product->code; ?></td>
												<td><?php echo $product->name; ?></td>
												<td><?php echo $product->category; ?></td>
<!--												<td>--><?php //echo $product->type; ?><!--</td>-->
												<td class="text-right"><?php echo $product->price; ?></td>
												<td class="text-right"><?php echo $product->quantity; ?></td>
												<td><?php echo $product->uom; ?></td>
												<td><?php echo $product->minimum_qty; ?></td>
												<td><?php echo $product->maximum_qty; ?></td>
											</tr>
										<?php } } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
	</section>
</div>




