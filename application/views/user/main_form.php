<div id="app" class="<?php echo ($id==get_user_id()) ? 'edit-profile' : ''; ?>">
	<form role="form" id="modalForm">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">
				<span v-if="item.id == 0"><?php echo line(''); ?>เพิ่มผู้ใช้งาน</span>
				<span v-else><?php echo line('edit'); ?> : {{ item.username }}</span>				
			</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<form>
				<?php echo form_hidden('id', $id); ?>
				<div class="form-group">
					<label for="username">
						<span class="text-secondary"><?php line('usr_username'); ?>*</span>
					</label>
					<?php echo form_input(array('name' => 'username', 'v-model'=>'item.username', 'class' => 'form-control', 'autocomplete' => 'off')); ?>
				</div>
				<div class="form-group">
					<label for="password">
						<span class="text-secondary" v-if="item.id == 0"><?php line('usr_password'); ?>*</span>
						<span v-else><?php line('usr_password'); ?></span>
					</label>
					<?php echo form_password(array('name' => 'password', 'id'=>'password', 'v-model'=>'item.password', 'class' => 'form-control', 'autocomplete' => 'off')); ?>
				</div>
				<div class="form-group">
					<label for="confpassword">
						<span class="text-secondary" v-if="item.id == 0"><?php line('usr_conf_password'); ?>*</span>
						<span v-else><?php line('usr_conf_password'); ?></span>
					</label>
					<?php echo form_password(array('name' => 'confpassword', 'class' => 'form-control', 'autocomplete' => 'off')); ?>
				</div>
				<div class="form-group">
					<label for="fullname">
						<span class="text-secondary"><?php line('usr_fullname'); ?>*</span>
					</label>
					<?php echo form_input(array('name' => 'fullname', 'v-model'=>'item.fullname', 'class' => 'form-control', 'autocomplete' => 'off')); ?>
				</div>
<?php  if (get_usertype()=='ADMIN') {
 ?>
				<div class="form-group">
					<label for="usertype">
						<span class="text-secondary"><?php line('usr_usertype'); ?>*</span>
					</label>
					<?php echo form_dropdown('usertype', $usertypes, '', array('v-model'=>'item.usertype', 'class'=>'form-control')); ?>
				</div>
<?php } ?>
				<!-- <div class="form-group">
					<label>
						<input type="checkbox" readonly="readonly" disabled >
						<?php line('status'); ?>
					</label>
				</div> -->
			</form>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">
				<?php line('close'); ?>
			</button>
			<button type="button" v-on:click.prevent="submitData()" class="btn btn-primary btn-save">
				<?php line('save'); ?>
			</button>
		</div>
	</form>
</div>

<script type="text/javascript">
var app = new Vue({
	el: '#app',
	data: {
		item: { id: $('input[name=id]').val(), usertype:'' }
	},
	methods: {
		submitData: function(){
			$('#modalForm').submit();
		}
	},
	created: function () {
		/* get data */
		axios.get(gUrl + 'api/users/' + this.item.id, {
			headers: {'api-key': gApiKey}
		}).then(
				response => {
					if (response.status === 200) {						
						if(this.item.id != 0){
							this.item = response.data;
						}
						// this.item.is_active = (response.data.is_active == 1) ? true : false;
					}
				}
			);
	},
	mounted: function () {
		/* init iCheck */
		$('input').iCheck({
			checkboxClass: 'icheckbox_flat',
			radioClass: 'iradio_flat'
		});	

		// var checkInterval = setInterval(function(){
		// 	if(app.item.is_active || app.item.is_active == false){				
		// 		if(app.item.is_active === true || app.item.id == 0){
		// 			$('input').iCheck('check');
		// 		}
		// 		clearInterval(checkInterval);
		// 	}
		// },100);

		// $('input').on('ifChecked', function (e) {
		// 	app.item.is_active = true;
		// });
		// $('input').on('ifUnchecked', function (e) {
		// 	app.item.is_active = false;
		// });
		/* END init iCheck */
	}
});

</script>