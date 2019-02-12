<!-- start center content -->
<div class="row">
	<div class="col-xl-12">
		<div class="row">

			<div class="col-xs-12 container">
				<div class="card mb-3">
					<div class="card-header">
						<h3>
							<i class="fa fa-envelope-o"></i> <?php line('dsh_last_borrow_product'); ?></h3>						
					</div>

					<div class="card-body">
						<div class="table-responsive">
							<table id="tablelist" class="table table-bordered table-hover">
								<thead>
									<tr>										
										<th><?php line('prd_code'); ?></th>
										<th><?php line('prd_name'); ?></th>
										<th><?php line('prd_serial_number'); ?></th>
										<th><?php line('bod_borrow_quantity'); ?></th>
										<th><?php line('bod_return_quantity'); ?></th>
										<th><?php line('bow_return_status'); ?></th>
										<th><?php line('trans_date'); ?></th>
									</tr>
								</thead>
								<tbody>
									
								</tbody>
							</table>
						</div>
					</div>
					<div class="card-footer small text-muted"><?php echo get_line('updated') .' ' . date('d/m/Y H:i'); ?></div>
				</div>
				<!-- end card-->
			</div>

		</div>
	</div>
</div>
<!-- END center content -->
