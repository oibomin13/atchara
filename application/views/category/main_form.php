<div id="app">
	<form role="form" id="modalForm">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">
				<span v-if="item.id == 0"><?php echo line(''); ?>เพิ่มประเภทวัสดุ</span>
				<span v-else><?php echo line('edit'); ?> : {{ item.name }}</span>				
			</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<form>
				<?php echo form_hidden('id', $id); ?>
				<div class="form-group">
					<label for="name">
						<span class="text-secondary"><?php line('cat_name'); ?>*</span>
					</label>
					<?php echo form_input(array('name' => 'name', 'v-model'=>'item.name', 'class' => 'form-control', 'autocomplete' => 'off')); ?>
				</div>
				<!-- <div class="form-group">
					<label>
						<input type="checkbox">
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
		item: { id: $('input[name=id]').val() }
	},
	methods: {
		submitData: function(){
			$('#modalForm').submit();
		}
	},
	created: function () {
		/* get data */
		axios.get(gUrl + 'api/categories/' + this.item.id, {
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