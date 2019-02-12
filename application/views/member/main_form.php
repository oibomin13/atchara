<div id="app">
	<form role="form" id="modalForm">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">
				<span v-if="item.id == 0"><?php echo line(''); ?>เพิ่มสมาชิก</span>
				<span v-else><?php echo line('edit'); ?> : {{ item.name }}</span>				
			</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<form>				
				<?php echo form_hidden('id', $id); ?>

				<div class="form-row">
					<div class="form-group col-sm-6">
						<label for="name">
						<span class="text-secondary"><?php line('mem_name'); ?>*</span>
						</label>
						<!-- <?php print_r($user); ?> -->
						<v-select :options="users" v-model="item.user" placeholder="เลือกรายการ"></v-select>
						<!-- <v-select :options="membertype" v-model="item.membertype" placeholder="เลือกรายการ"></v-select>	 -->
						<!-- <?php echo form_input(array('name' => 'name', 'v-model' => 'item.name', 'class' => 'form-control', 'autocomplete' => 'off')); ?> -->
					</div>
					<div class="form-group col-sm-6">
						<label for="code">
						<span class="text-secondary"><?php line('mem_code'); ?>*</span>
						</label>
						<?php echo form_input(array('name' => 'code', 'v-model' => 'item.code', 'class' => 'form-control', 'autocomplete' => 'off')); ?>
					</div>
				</div>				
				
				<div class="form-row">
					<div class="form-group col-sm-6">
						<label for="idcard">เลขบัตรประจำตัวประชาชน
							<?php line('mem_idcard'); ?>
						</label>
						<?php echo form_input(array('name' => 'idcard', 'v-model' => 'item.idcard', 'class' => 'form-control', 'autocomplete' => 'off')); ?>
					</div>
					<div class="form-group col-sm-6">
						<label for="tel">
							<?php line('mem_tel'); ?>
						</label>
						<?php echo form_input(array('name' => 'tel', 'v-model' => 'item.tel', 'class' => 'form-control', 'autocomplete' => 'off')); ?>
					</div>
				</div>

				<div class="form-row">
					<div class="form-group col-sm-6">
						<label for="idcard">
							<?php line('mem_email'); ?>
						</label>
						<?php echo form_input(array('name' => 'email', 'v-model' => 'item.email', 'class' => 'form-control', 'autocomplete' => 'off')); ?>
					</div>
					<div class="form-group col-sm-6">
						<label for="department">
							<span class="text-secondary"><?php line('menu_department'); ?>*</span>
						</label>						
						<v-select :options="departments" v-model="item.department" placeholder="เลือกรายการ"></v-select>
					</div>
				</div>

				<div class="form-row">
					<div class="form-group col-sm-6">
						<label for="membertype">
							<span class="text-secondary"><?php line('menu_membertype'); ?>*</span>
						</label>						
						<v-select :options="membertypes" v-model="item.membertype" placeholder="เลือกรายการ"></v-select>					
					</div>
				</div>

				<div class="form-row">
					<div class="form-group col-sm-12">
						<label for="address">
							<?php line('mem_address'); ?>
						</label>
						<?php echo form_textarea(array('name' => 'address', 'v-model' => 'item.address', 'class' => 'form-control', 'rows' => 3)); ?>						
					</div>
				</div>		
			</form>
		</div>
		<div class="modal-footer">
			<!-- <div class="mr-auto">
					<label>
						<input type="checkbox" name="status">
						<?php line('status'); ?>
					</label>
			</div> -->
			<div>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">
					<?php line('close'); ?>
				</button>
				<button type="button" v-on:click.prevent="submitData()" class="btn btn-primary btn-save">
					<?php line('save'); ?>
				</button>			
			</div>
		</div>
	</form>
</div>

<script type="text/javascript">
Vue.component('v-select', VueSelect.VueSelect);
var app = new Vue({
	el: '#app',
	data: {		
		item: { id: $('input[name=id]').val() },
		departments: [],
		membertypes: [],
		users: [],
	},
	methods: {
		submitData: function(){			
			$('#modalForm').submit();
		}
	},
	created: function () {
		/* get data */
		axios.get(gUrl + 'api/members/' + this.item.id, {
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

		/* department data */
		axios.get(gUrl + 'api/departments/', {
			headers: {'api-key': gApiKey}
		}).then(
				response => {
					if (response.status === 200) {
						if(response.data.length > 0){							
								var reDepartments = response.data.map(obj => {
								var rObj = {};							
								rObj = {value: obj.id, label: obj.name}
								return rObj;
							});

							this.departments = reDepartments;
						}
					}
				}
		);

		/* membertype data */
		axios.get(gUrl + 'api/membertypes/', {
			headers: {'api-key': gApiKey}
		}).then(
				response => {
					if (response.status === 200) {
						if(response.data.length > 0){							
								var reMembertypes = response.data.map(obj => {
								var rObj = {};							
								rObj = {value: obj.id, label: obj.name}
								return rObj;
							});

							this.membertypes = reMembertypes;
						}
					}
				}
		);

		/* user data */
		axios.get(gUrl + 'api/users/', {
			headers: {'api-key': gApiKey}
		}).then(
				response => {
					if (response.status === 200) {
						if(response.data.length > 0){							
								var reUser = response.data.map(obj => {
								var rObj = {};							
								rObj = {value: obj.id, label: obj.fullname}
								console.log(rObj);
								return rObj;
							});

							this.users = reUser;
						}
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

		// check active
		// var checkIntervalActive = setInterval(function(){
		// 	if(app.item.is_active || app.item.is_active == false){	
		// 		if(app.item.is_active === true || app.item.id == 0){
		// 			$('input[name=status]').iCheck('check');
		// 		}
		// 		clearInterval(checkIntervalActive);
		// 	}
		// },100);

		// /* status event handle */
		// $('input[name=status]').on('ifChecked', function (e) {
		// 	app.item.is_active = true;
		// });
		// $('input[name=status]').on('ifUnchecked', function (e) {
		// 	app.item.is_active = false;
		// });

		/* END init iCheck */
	}
});

</script>