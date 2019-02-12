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
						<div class="input-group mr-3">
						<?php echo form_dropdown('category_id', $categories, '', array('class' => 'form-control select2','style'=>'width:200px')); ?>
						</div>
						<a href="<?php echo site_url('product/main_form'); ?>" role="button" class="btn btn-dark btn-create" data-toggle="modal" data-target="#ajaxLargeModal"><?php echo line(''); ?>เพิ่มวัสดุ</a>
					</form>

				</div>				
			</div>

			<div class="card-body">
				<div class="table-responsive">
					<table id="tablelist" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th><?php line('prd_code'); ?></th>
								<th><?php line('prd_name'); ?></th>
								<th><?php line('cat_name'); ?></th>
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
