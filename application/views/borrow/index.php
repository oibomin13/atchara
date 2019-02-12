<!-- start center content -->
<div class="row">
	<?php echo form_hidden('utype', get_usertype()); ?>
	<div class="col-xl-12">
		<div class="card mb-3">
			<div class="card-header">
				<h3 class="pull-left">
					<i class="fa fa-table"></i> <?php line('dt_listdata'); ?>
				</h3>
				<div class="pull-right">
					<a href="<?php echo site_url('borrow/main_form'); ?>" role="button" class="btn btn-dark btn-create" data-toggle="modal" data-target="#ajaxLargeModal"><?php echo line(''); ?>เพิ่มรายการเบิกจ่าย</a>
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
								<th><?php line('bow_return_status'); ?></th>
								<th><?php line('action'); ?></th>
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
