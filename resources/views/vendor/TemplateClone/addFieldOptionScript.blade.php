<form action="" method="post" id="fields_form">
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">حقل جديد</h4>
                </div>
                <div class="modal-body">
                    <div class="row" style="margin: 20px 0px;">
                        <span style="float:right;">اسم الحقل  : </span>
                        <div class="col-md-4" style="position: relative;top: -7px;">
                            <input name="field_name" id="field_name" placeholder="اسم الحقل" class="form-control"
                                   type="text">
                            <div id="field_name_validate" style="color:red"></div>
                        </div>
                    </div>
                    <div class="row">
                        <span>نوع الحقل : </span>
                        <select id="field_type" name="field_type"
                                style="padding: 5px;border: 1px solid #ccc;border-radius: 5px;">
                            <option value="text"> نص</option>
                            <option value="list"> قائمة</option>
                            <option value="map">خريطة</option>
                        </select>
                    </div>
                    <div id="options_div" class="hidden">
                        <div class="row" style="margin: 20px 0px;">
                            <span style="float:right;position: relative;bottom: -5px;">اضافة خيار للحقل   : </span>
                            <div class="col-md-4">
                                <input id="option_name" name="option_name" placeholder="اضافة" class="form-control" type="text">
                            </div>
                            <a id="addOptionForField" class="btn btn-success">اضافة</a>
                        </div>
                        <p style="color:green" id="saveOptionInfo"></p>
                        <p style="color:red" id="error"></p>
                        <table class="table">
                            <thead class="thead-default">
                            <tr>
                                <th>الخيار</th>
                                <th>اعدادات</th>
                            </tr>
                            </thead>
                            <tbody id="options_table_body">

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
    var list_items_options = [];
    var m_index_options = 0;
    $(function () {
        $('body').on('change', '#field_type', function (e) {
            var field_type = $(this).val();
            if (field_type == "list") {
                $("#error").text("");
                $("#saveOptionInfo").text("");

                $("#options_div").removeClass("hidden");
            } else {
                $("#options_div").addClass("hidden");
            }
        });
        $('body').on('click', '#addOptionForField', function (e) {
            $("#error").text("");
            $("#saveOptionInfo").text("");
            e.preventDefault();
            var option = $('#option_name').val();
            if (option == "") {
                $("#error").text("يرجى إدخال الحقل");
            } else {
                list_items_options[m_index_options] = {
                    'option': option,
                    'is_delete': 0
                };
                $('#options_table_body').append(('<tr id ="' + m_index_options + '" class="file_data">' +
                '<td>' + option + '</td>' +
                '<td><a href=""  class="delete_option btn  btn-danger btn-xs" id="' + m_index_options + '">حذف</a></td>' +
                '</tr>'));
                m_index_options++;
                $("#error").text("");
                $("#saveOptionInfo").text("تمت الإضافة بنجاح");
                $('#option_name').val("");
            }
        });
        $('body').on('click', '.delete_option', function (e) {
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
                            list_items_options[a_index]['is_delete'] = 1;
                            this1.parent().parent().remove();
                            $("#error").text("");
                            $("#saveOptionInfo").text("تمت عملية الحذف بنجاح");
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
        $('#fields_form').validate({
            rules: {
                field_name: "required",
            },
            errorPlacement: function (error, element) {
                var name = $(element).attr("name");
                error.appendTo($("#" + name + "_validate"));
            },
            messages: {
                field_name: "حقل مطلوب",
            }, submitHandler: function (form) {
                $("#error").text("");
                $("#saveOptionInfo").text("");
                var field_type = $('#field_type').val();
                var flag = false;
                if (field_type == "list") {
                    for (var i = 0; i < list_items_options.length; i++) {
                        if (list_items_options[i].is_delete == 0) {
                            flag = true;
                        }
                    }
                } else {
                    flag = true;
                }
                if (flag) {
                    var field_name = $("#field_name").val();
                    $.ajax({
                        method: "POST",
                        url: '{{url("/")}}/addFieldForTemplate',
                        dataType: 'json',
                        data: {
                            id: "ad",
                            field_name: field_name,
                            field_type: field_type,
                            list_items: list_items_options,
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
                    $("#error").text("يرجى إضافة خيارات للقائمة قبل الحفظ");
                }
            }
        });
    });
</script>