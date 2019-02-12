<!-- start center content -->
<div class="row">
	<div class="col-xl-12">
		<div class="card mb-3">
			<div class="card-header">
				<h3 class="pull-left">
					<i class="fa fa-table"></i> <?php line('dt_listdata'); ?>
				</h3>
				<div class="pull-right">
					<?php if(get_usertype()==='ADMIN'): ?>
					<a href="<?php echo site_url('user/main_form'); ?>" role="button" class="btn btn-dark btn-create" data-toggle="modal" data-target="#ajaxModal"><?php echo line(''); ?>เพิ่มผู้ใช้งาน</a>
					<?php endif; ?>
				</div>				
			</div>

			<div class="card-body">
				<div class="table-responsive">
					<table id="tablelist" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th><?php line('usr_username'); ?></th>
								<th><?php line('usr_fullname'); ?></th>
								<th><?php line('usr_usertype'); ?></th>
								<!-- <th><?php line('status'); ?></th> -->
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
