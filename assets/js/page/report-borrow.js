$(document).ready(function () {
	var searchData = {};
	var table = $('#tablelist').DataTable({
		pageLength: 10,
		serverSide: true,
		processing: true,
		ajax: {
			url: gUrl + gClass + '/get_borrow_datatables',
			data: function(d){
				return $.extend(d, searchData);
			}
		},
		'columns': [
			{
                data: 'member_code'
			},
			{
				data: 'member_name'
			},
			{
                data: 'borrow_date',
                render: function(data, type, row){
                    return moment(data).format('DD/MM/YYYY');
                }
			},
			{
                data: "schedule_date",
                render: function(data, type, row) {
                  return moment(moment(data).format("DD/MM/YYYY"),"DD/MM/YYYY",true).isValid() ? moment(data).format("DD/MM/YYYY"):"รอการยืนยัน" ;
                }
            },
			// {
   //              data: 'return_date',
   //              render: function(data, type, row){
   //                  return data ? moment(data).format('DD/MM/YYYY') : '-';
   //              }
   //          },
            {
                data: 'product_code'
            },
            {
                data: 'product_name'
            },
            {
                data: 'serial_code',
                render: function(data, type, row){
                    return data ? data : '-';
                }
            },
			{
				data: 'borrow_quantity'
            },
            {
                data: 'return_quantity'
            },
			{
				data: 'detail_status',
				render: function(data, type, row){
                    var result;
                    if(data == 1){
                        result = '<span class="badge badge-pill badge-primary">อนุมัติ</span>';
                    } else if(data == 2) {
                        result = '<span class="badge badge-pill badge-success">คืนแล้ว</span>';
                    } else {
                        result = '<span class="badge badge-pill badge-danger">รออนุมัติ</span>';
                    }

                    return result;
                }
			}
		]
	});

	// serach category
	$('body').on('change', 'select[name=category_id]', function(e){
		searchData.category_id = $('select[name=category_id]').val();
		table.ajax.reload();
	});

	// init select2
	$('.select2').select2();
});
