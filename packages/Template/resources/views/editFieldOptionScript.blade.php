<form action="" method="post" id="fields_form_edit_edit">
    {{csrf_field()}}
    <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">تعديل بيانات الحقل</h4>
                </div>
                <div class="modal-body">
                    <div class="row" style="margin: 20px 0px;">
                        <span style="float:right;">اسم الحقل  : </span>
                        <div class="col-md-4" style="position: relative;top: -7px;">
                            <input name="field_name_edit_edit" id="field_name_edit" placeholder="اسم الحقل"
                                   class="form-control"
                                   type="text">
                            <input type="hidden" id="pk_i_id_edit" name="pk_i_id_edit">
                            <div id="field_name_edit_validate" style="color:red"></div>
                        </div>
                    </div>
                    <div class="row">
                        <span>نوع الحقل : </span>
                        <select id="field_type_edit" name="field_type_edit"
                                style="padding: 5px;border: 1px solid #ccc;border-radius: 5px;">
                            <option value="text"> نص</option>
                            <option value="list"> قائمة</option>
                            <option value="map">خريطة</option>
                        </select>
                    </div>
                    <div id="options_edit_div" class="hidden">
                        <div class="row" style="margin: 20px 0px;">
                            <span style="float:right;position: relative;bottom: -5px;">اضافة خيار للحقل   : </span>
                            <div class="col-md-4">
                                <input id="option_name_edit" name="option_name_edit" placeholder="اضافة"
                                       class="form-control"
                                       type="text">
                            </div>
                            <a id="addOptionForField_edit" class="btn btn-success">اضافة</a>
                        </div>
                        <p style="color:green" id="saveOptionInfo_edit"></p>
                        <p style="color:red" id="error_edit"></p>
                        <table class="table">
                            <thead class="thead-default">
                            <tr>
                                <th>الخيار</th>
                                <th>اعدادات</th>
                            </tr>
                            </thead>
                            <tbody id="options_table_body_edit">

                            </tbody>
                        </table>
                    </div>
                    <br>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">اغلاق</button>
                    <input class="btn btn-success" type="submit" value="حفظ">
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    var list_items_options_edit = [];
    var m_index_options_edit = 0;
    $(function () {
        $('body').on('click', '#editFieldModalBtn', function (e) {
            var s_name_ar = $(this).siblings("#up_s_name_ar").val();
            $("#field_name_edit").val(s_name_ar);
            var pk_i_id = $(this).siblings("#up_id").val();
            $("#pk_i_id_edit").val(pk_i_id);
            var type = $(this).siblings("#up_type").val();
            if (type == 1) {
                $("#field_type_edit").val("text");
            } else if (type == 2) {
                $("#field_type_edit").val("list");
            } else {
                $("#field_type_edit").val("map");
            }

            if (type == 2) {
                m_index_options_edit = 0;
                $('#options_table_body_edit').empty();
                $.ajax({
                    method: "POST",
                    url: '{{url("/")}}/getFieldsOptions',
                    dataType: 'json',
                    data: {
                        id: pk_i_id,
                        '_token': '{{csrf_token()}}'
                    },
                    success: function (data, textStatus, jqXHR) {
                        if (data.status) {
                            for (var i = 0; i < data.options.length; i++) {
                                list_items_options_edit[i] = {
                                    'option': data.options[m_index_options_edit].s_name_ar,
                                    'is_delete': 0
                                };

                                $('#options_table_body_edit').append(('<tr id ="' + i + '" class="file_data">' +
                                '<td>' + data.options[i].s_name_ar + '</td>' +
                                '<td><a href=""  class="delete_option_edit btn  btn-danger btn-xs" id="' + i + '">حذف</a></td>' +
                                '</tr>'));
                                m_index_options_edit++;
                            }
                            $("#options_edit_div").removeClass("hidden");
                        }
                        else {
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                    }
                });
            }
            $('#myModal1').modal('show');

        });
        $('body').on('change', '#field_type_edit', function (e) {
            var field_type_edit = $(this).val();
            if (field_type_edit == "list") {
                $("#error_edit").text("");
                $("#saveOptionInfo_edit").text("");

                $("#options_edit_div").removeClass("hidden");
            } else {
                $("#options_edit_div").addClass("hidden");
            }
        });
        $('body').on('click', '#addOptionForField_edit', function (e) {
            $("#error_edit").text("");
            $("#saveOptionInfo_edit").text("");
            e.preventDefault();
            var option = $('#option_name_edit').val();
            if (option == "") {
                $("#error_edit").text("يرجى إدخال الحقل");
            } else {
                list_items_options_edit[m_index_options_edit] = {
                    'option': option,
                    'is_delete': 0
                };
                $('#options_table_body_edit').append(('<tr id ="' + m_index_options_edit + '" class="file_data">' +
                '<td>' + option + '</td>' +
                '<td><a href=""  class="delete_option_edit btn  btn-danger btn-xs" id="' + m_index_options_edit + '">حذف</a></td>' +
                '</tr>'));
                m_index_options_edit++;
                $("#error_edit").text("");
                $("#saveOptionInfo_edit").text("تمت الإضافة بنجاح");
                $('#option_name_edit').val("");
            }
        });
        $('body').on('click', '.delete_option_edit', function (e) {
            e.preventDefault();
            var a_index = $(this).attr('id');
            var this1 = $(this);
            bootbox.dialog({
                message: "هل أنت متأكد من الحذف ؟",
                title: "رسالة تأكيد",
                buttons: {
                    danger: {
                        label: "نعم",
                        className: "btn-danger",
                        callback: function () {
                            list_items_options_edit[a_index]['is_delete'] = 1;
                            this1.parent().parent().remove();
                            $("#error_edit").text("");
                            $("#saveOptionInfo_edit").text("تمت عملية الحذف بنجاح");
                        }
                    },
                    main: {
                        label: "لا",
                        className: "btn btn-default",
                        callback: function () {
                        }
                    }
                }
            });
        });
    });
</script>
<script>
    $(function () {
        $('#fields_form_edit_edit').validate({
            rules: {
                field_name_edit: "required",
            },
            errorPlacement: function (error, element) {
                var name = $(element).attr("name");
                error.appendTo($("#" + name + "_validate"));
            },
            messages: {
                field_name_edit: "حقل مطلوب",
            }, submitHandler: function (form) {
                $("#error_edit").text("");
                $("#saveOptionInfo_edit").text("");
                var field_type_edit = $('#field_type_edit').val();
                var flag = false;
                if (field_type_edit == "list") {
                    for (var i = 0; i < list_items_options_edit.length; i++) {
                        if (list_items_options_edit[i].is_delete == 0) {
                            flag = true;
                        }
                    }
                } else {
                    flag = true;
                }
                if (flag) {
                    var field_name_edit = $("#field_name_edit").val();
                    var pk_edit = $("#pk_i_id_edit").val();
                    $.ajax({
                        method: "POST",
                        url: '{{url("/")}}/editFieldForTemplate/' + pk_edit,
                        dataType: 'json',
                        data: {
                            id: "ad",
                            field_name_edit: field_name_edit,
                            field_type_edit: field_type_edit,
                            list_items: list_items_options_edit,
                            '_token': '{{csrf_token()}}'
                        },
                        success: function (data, textStatus, jqXHR) {
                            if (data.status) {
                                window.location.href = "{{url("/")}}/addTemplate";
                            }
                            else {
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                        }
                    });
                } else {
                    $("#error_edit").text("يرجى إضافة خيارات للقائمة قبل الحفظ");
                }
            }
        });
    });
</script>