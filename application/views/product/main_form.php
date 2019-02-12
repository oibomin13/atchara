<div id="app">
	<form role="form" id="modalForm">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">
				<span v-if="item.id == 0"><?php echo line(''); ?>เพิ่มวัสดุ</span>
				<span v-else><?php echo line('edit'); ?> : {{ item.name }}</span>				
			</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<form>
				<?php echo form_hidden('id', $id); ?>
				<input type="text" v-model="fixedCheck" style="display:none;">
				<div class="form-row">
					<div class="form-group col-sm-6">
						<label for="name">
						<span class="text-secondary"><?php line('prd_name'); ?>*</span>
						</label>
						<?php echo form_input(array('name' => 'name', 'v-model'=>'item.name', 'class' => 'form-control', 'autocomplete' => 'off')); ?>
					</div>
					<div class="form-group col-sm-6">
						<label for="code">
						<span class="text-secondary"><?php line('prd_code'); ?>*</span>
						</label>
						<?php echo form_input(array('name' => 'code', 'v-model'=>'item.code', 'class' => 'form-control', 'autocomplete' => 'off')); ?>
					</div>
				</div>

				<div class="form-row">
					<!-- <div class="form-group col-sm-6">
						<label for="model">
							<?php line('prd_model'); ?>
						</label>
						<?php echo form_input(array('name' => 'model', 'v-model'=>'item.model', 'class' => 'form-control', 'autocomplete' => 'off')); ?>
					</div> -->
					<div class="form-group col-sm-6">
						<label for="category">
						<span class="text-secondary"><?php line('menu_category'); ?>*</span>
						</label>						
						<v-select :options="categorys" v-model="item.category" placeholder="เลือกรายการ"></v-select>
					</div>
					<div class="form-group col-sm-6">
						<label for="quantity">
							<?php line('prd_quantity'); ?>
						</label>
						<?php echo form_number(array('name' => 'quantity', 'v-model'=>'item.quantity', 'class' => 'form-control', 'autocomplete' => 'off')); ?>
					</div>
				</div>
				
				<div class="form-row">
					<!-- <div class="form-group col-sm-6">
						<label for="price">
							<?php line('prd_price'); ?>
						</label>
						<?php echo form_number(array('name' => 'price', 'v-model'=>'item.price', 'class' => 'form-control', 'autocomplete' => 'off')); ?>
					</div> -->
					<!-- <div class="form-group col-sm-6">
						<label for="find">
							<?php line('prd_fine'); ?>
						</label>
						<?php echo form_number(array('name' => 'fine', 'v-model'=>'item.fine', 'class' => 'form-control', 'autocomplete' => 'off')); ?>
					</div> -->
				</div>

				<div class="form-row">
				
					<div class="form-group col-sm-6">
						<label for="unit">
							<span class="text-secondary"><?php line('unit'); ?>*</span>
						</label>						
						<v-select :options="units" v-model="item.unit" placeholder="เลือกรายการ"></v-select>
					</div>
				</div>

				<div class="form-row">
					<div class="form-group col-sm-12">
						<label>
							<input type="checkbox" name="is_return">							
							<?php line('prd_is_return'); ?>
						</label>						
					</div>					
				</div>				

				<div class="form-row">
					<div class="form-group col-sm-12">
						<label>
							<input type="checkbox" name="is_serial_number">
							<?php line('prd_is_serial_number'); ?>
						</label>
					</div>					
				</div>


				<div class="form-row" v-if="item.is_serial_number">
					<div class="form-group col-sm-6">						
						<?php echo form_input(array('v-model'=>'serialNumber', 'v-on:keyup.enter'=>'handleSerials()', 'class' => 'form-control', 'autocomplete' => 'off')); ?>
					</div>
					<div class="form-group col-sm-6">
						<button type="button" v-on:click.prevent="handleSerials()" class="btn btn-warning">
							<?php line('add'); ?> <?php line('prd_serial_number'); ?>
						</button>
					</div>
				</div>

				<div class="form-row" v-if="item.is_serial_number">
					<div class="form-group col-sm-12">
						<table class="table table-bordered table-sm">
							<thead>
								<tr>
									<th>ลำดับที่</th>
									<th><?php echo line('prd_serial_number'); ?></th>
									<th><?php echo line('prd_quantity'); ?></th>
									<th><?php echo line('action'); ?></th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="(serial, index) in serials" class="table-light">
									<td>{{ index+1 }}</td>
									<td>{{ serial.code }}</td>
									<td>
										<?php echo form_number(array('v-model'=>'serial.quantity', 'class' => 'form-control form-control-sm', 'style'=>'width:100px;', 'autocomplete' => 'off')); ?>
									</td>
									<td>
										<button v-on:click.prevent="removeSerial(index)" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></button>
									</td>
								</tr>
							</tbody>
						</table>
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
		serialNumber: '',
		serials: [],
		categorys: [],
		units: [],
		fixedCheck: '',
	},
	methods: {
		submitData: function(){			
			this.item.serials = this.serials;
			$('#modalForm').submit();
		},
		handleSerials: function(){
			if(this.serialNumber===''){
				return;
			}
			this.serials.push(
				{
				code : this.serialNumber,
				quantity: 1
				}
			);
			this.serialNumber = '';
		},
		removeSerial: function(i){
			this.serials.splice(i, 1);
		}
	},
	created: function () {
		/* get data */
		axios.get(gUrl + 'api/products/' + this.item.id, {
			headers: {'api-key': gApiKey}
		}).then(
				response => {
					if (response.status === 200) {
						if(this.item.id != 0){
							console.log(response.data);
							this.item = response.data;
							this.serials = response.data.serials;														
						}
						//console.log(response.data);
						// this.item.is_active = (response.data.is_active == 1) ? true : false;
						this.item.is_return = (response.data.is_return == 1) ? true : false;
						this.item.is_serial_number = (response.data.is_serial_number == 1) ? true : false;
						console.log(this.item.is_return);
					}
				}
			);

		/* category data */
		axios.get(gUrl + 'api/categories/', {
			headers: {'api-key': gApiKey}
		}).then(
				response => {
					if (response.status === 200) {
						if(response.data.length > 0){							
								var reCategorys = response.data.map(obj => {
								var rObj = {};							
								rObj = {value: obj.id, label: obj.name}
								return rObj;
							});

							this.categorys = reCategorys;
						}
					}
				}
		);

		/* unit data */
		axios.get(gUrl + 'api/units/', {
			headers: {'api-key': gApiKey}
		}).then(
				response => {
					if (response.status === 200) {
						if(response.data.length > 0){							
								var reUnits = response.data.map(obj => {
								var rObj = {};							
								rObj = {value: obj.id, label: obj.name}
								return rObj;
							});

							this.units = reUnits;
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
		var checkIntervalActive = setInterval(function(){
			if(app.item.is_active || app.item.is_active == false){	
				if(app.item.is_active === true || app.item.id == 0){
					$('input[name=status]').iCheck('check');
				}
				clearInterval(checkIntervalActive);
			}
			if(app.item.is_return || app.item.is_return == false){	
				if(app.item.is_return === true || app.item.id == 0){
					$('input[name=is_return]').iCheck('check');
				}
				clearInterval(checkIntervalActive);
			}
		},100);		
		// // check return
		// var checkIntervalActive = setInterval(function(){
		// 	//console.log(app.item.is_return);
		// 	if(app.item.is_return || app.item.is_return == false){	
		// 		if(app.item.is_return === true || app.item.id == 0){
		// 			$('input[name=is_return]').iCheck('check');
		// 		}
		// 		clearInterval(checkIntervalActive);
		// 	}
		// },100);

		// check serial
		var checkIntervalSerial = setInterval(function(){
			if(app.item.is_serial_number || app.item.is_serial_number == false){
				if(app.item.is_serial_number === true){
					$('input[name=is_serial_number]').iCheck('check');
				}
				clearInterval(checkIntervalSerial);
			}
		},100);

		/* status event handle */
		$('input[name=is_return]').on('ifChecked', function (e) {
			app.item.is_return = true;
			// app.fixedCheck = 1;
		});
		$('input[name=is_return]').on('ifUnchecked', function (e) {
			app.item.is_return = false;
			// app.fixedCheck = 0;
		});

		// $('input[name=status]').on('ifChecked', function (e) {
		// 	app.item.is_active = true;
		// 	// app.fixedCheck = 1;
		// });
		// $('input[name=status]').on('ifUnchecked', function (e) {
		// 	app.item.is_active = false;
		// 	// app.fixedCheck = 0;
		// });

		// $('input[name=is_return]').on('ifChecked', function (e) {
		// 	app.item.is_return = true;
			
			
		// });
		// $('input[name=is_return]').on('ifUnchecked', function (e) {
		// 	app.item.is_return = false;			
		// 	app.fixedCheck = 0;
		// });

		/* serial no event handle */
		$('input[name=is_serial_number]').on('ifChecked', function (e) {
			app.item.is_serial_number = true;
			app.item.quantity = 0;
			app.serials = (app.item.id != 0) ? app.serials : [];
			app.serialNumber = '';
			app.fixedCheck = 1;
		});
		$('input[name=is_serial_number]').on('ifUnchecked', function (e) {
			app.item.is_serial_number = false;
			app.serials = (app.item.id != 0) ? app.serials : [];
			app.fixedCheck = 0;
		});

		/* END init iCheck */
	}
});

</script>