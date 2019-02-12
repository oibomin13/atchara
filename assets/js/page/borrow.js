$(document).ready(function() {
  var table = $("#tablelist").DataTable({
    pageLength: 10,
    serverSide: true,
    processing: true,
    ajax: {
      url: gUrl + gClass + "/get_datatables"
    },
    columns: [
      {
        data: "member_code",
        render: function(data, type, row) {
          return data;
           //(
          //   '<a href="' +
          //   gUrl +
          //   gClass +
          //   "/main_form/" +
          //   row["id"] +
          //   '" data-id="' +
          //   row["id"] +
          //   '" data-toggle="modal" data-target="#ajaxLargeModal" class="btn-edit">' +
          //   data +
          //   "</a> "
          // );
        }
      },
      {
        data: "member_name"
      },
      {
        data: "borrow_date",
        render: function(data, type, row) {
          return moment(data).format("DD/MM/YYYY");
        }
      },
      {
        data: "schedule_date",
        render: function(data, type, row) {
          return moment(moment(data).format("DD/MM/YYYY"),"DD/MM/YYYY",true).isValid() ? moment(data).format("DD/MM/YYYY"):"รอการยืนยัน" ;
        }
      },
      {
        data: "return_status",
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
      },
      {
        data: "id",
        render: function(data, type, row) {
          var return_status = row["return_status"];
          
          var btnEdit = '<a href="' + gUrl + gClass + '/main_form/' + row['id'] + '" data-id="' +row["id"] +'" data-name="edit" role="button" class="btn btn-outline-primary btn-sm btn-edit" data-toggle="modal" data-target="#ajaxLargeModal"><i class="fa fa-edit"></i> ' + gEdit + '</a> ';
          var btnApprove = '<a href="' + gUrl + gClass + '/main_form/' + row['id'] + '" data-id="' +row["id"] +'" data-name="approve"  role="button" class="btn btn-outline-success btn-sm btn-approve" data-toggle="modal" data-target="#ajaxLargeModal"><i class="fa fa-check-square"></i> ' + gApprove + '</a> ';
          var btnDelete =
            '<a href="#" data-href="' +
            gUrl +
            "api/borrows/" +
            data +
            '" data-id="' +
            data +            
            '" role="button" class="btn btn-outline-danger btn-sm btn-delete"><i class="fa fa-trash"></i> ' +
            gDelete +
            "</a>";
          if (return_status == 0){
            var utype = document.getElementsByName("utype");
            console.log(utype[0].value);
            if (utype[0].value=="ADMIN") {
              return btnEdit + btnApprove;
            }else{
              return btnEdit;
            }            
          }else if(return_status== 1) {
            return "";
          }else{
            return btnDelete;
          }

          
        },
        orderable: false
      }
    ]
  });

  $("#ajaxLargeModal").on("shown.bs.modal", function(e) {
    console.log(e.relatedTarget.getAttribute('data-name'));
    $("#modalForm").validate({
      submitHandler: function(form) {
        if (!app.item.member) {
          showBox("กรุณาเลือกสมาชิก", "warning");
          return false;
        }
        if (app.item.products.length === 0) {
          showBox("กรุณาเลือกรายการสินค้า", "warning");
          return false;
        }
console.log(app.item);
        axios
          .post(gUrl + "api/borrows", app.item, {
            headers: { "api-key": gApiKey }
          })
          .then(function(response) {
            if (response.status === 200) {
              showBox("บันทึกข้อมูลสำเร็จ", "success");
              table.ajax.reload();
            } else {
              showBox("Status not 200", "error");
            }
            $("#ajaxLargeModal").modal("hide");
          })
          .catch(function(error) {
            console.log(error.response);
            var text = "";
            for (var i = 0; i < error.response.data.products.length; i++) {
              text +=
                error.response.data.products[i].label +
                "(คงเหลือ " +
                error.response.data.products[i].remain +
                ")<br/>";
            }
            text =
              '<span class="text-danger text-left" style="font-size:14px;">' +
              text +
              "</span>";
            showBox(error.response.data.message, "error", text);
          });
        return false;
      },
      rules: {
        borrow_date: {
          required: true
        },
        schedule_date: {
          required: true
        }
        // ,
        // return_date: {
        //   required: function() {
        //     return $("input[name=id]").val() != 0 ? true : false;
        //   }
        // }
      },
      messages: {},
      errorElement: "span",
      errorPlacement: function(error, element) {
        error.addClass("error-block");
        if (element.prop("type") === "checkbox") {
          error.insertAfter(element.parent("label"));
        } else if (element.parent(".input-group").length) {
          error.insertAfter(element.parent()); /* radio checkbox? */
        } else if (element.hasClass("select2")) {
          error.insertAfter(element.next("span")); /* select2 */
        } else {
          error.insertAfter(element);
        }
      },
      highlight: function(element, errorClass, validClass) {
        $(element)
          .parents(".form-group")
          .addClass("has-error")
          .removeClass("has-success");
      },
      unhighlight: function(element, errorClass, validClass) {
        $(element)
          .parents(".form-group")
          .addClass("has-success")
          .removeClass("has-error");
      }
    });
  });

  /* Delete button */
  $("body").on("click", ".btn-delete", function(e) {
    e.preventDefault();
    var deleteLink = $(this).attr("data-href");
    var id = $(this).attr("data-id");
    var callback = function() {
      setTimeout(function() {
        axios
          .delete(deleteLink, {
            headers: { "api-key": gApiKey }
          })
          .then(function(response) {
            showBox("ลบข้อมูลสำเร็จ", "success");
            table.ajax.reload();
          })
          .catch(function(error) {
            showBox(error.response.data.message, "error");
          });
      }, 100);
    };

    confirmBox("ลบข้อมูล", callback);
  });
});
