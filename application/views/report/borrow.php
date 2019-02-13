<!-- start center content -->
<div class="row">
	<div class="col-xl-12">
		<div class="card mb-3">
			<div class="card-header">
				<h3 class="pull-left">
					<i class="fa fa-table"></i> <?php line('dt_listdata'); ?>
				</h3>
				<div class="pull-right">
					<form class="form-inline">
						<div class="input-group">
						<?php echo form_dropdown('category_id', $categories, '', array('class' => 'form-control select2','style'=>'width:200px')); ?>
						</div>
					</form>
				</div>				
			</div>

			<div class="card-body">
				<div class="table-responsive">
					<table id="tablelist" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th><?php line('bow_code'); ?></th>
								<th><?php line('bow_name'); ?></th>
                                <th><?php line('bow_borrow_date'); ?></th>
                                <th><?php line('bow_schedule_date'); ?></th>
                                <!-- <th><?php line('bod_return_date'); ?></th> -->
								<th><?php line('prd_code'); ?></th>
								<th><?php line('prd_name'); ?></th>
								<th><?php line('prd_serial_number'); ?></th>
                                <th><?php line('bod_borrow_quantity'); ?></th>
                                <th><?php line('bod_return_quantity'); ?></th>
								<th><?php line('bow_return_status'); ?></th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- end card-->
	</div>
</div>
<!-- END center content -->
