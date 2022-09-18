@if($user_flag)

    @if($department)
        <form method="post" action="" id="addSubjectForm">
            {{csrf_field()}}
            <a href="{{url("/")}}/deleteDepartment/{{$department->pk_i_id}}" class="btn btn-danger Confirm ">حذف القسم</a>

            <a style="background-color: {{$WEBSITE_COLOR->s_value}}" id="add_subject" class="btn btn-primary">إضافة
                موضوع</a>
            <br>
            <div id="add_subject_div" class="hidden">
                <div style="margin-top: 10px" class="row ">
                    <div class="col-md-3">
                        <label for="">الوصف</label>
                        <input type="text" class="form-control" id="subject_title" name="subject_title">
                        <div style="color: red" id="subject_title_validate"></div>
                    </div>
                    <div class="col-md-3">
                        <label for="">الصنف</label>
                        <input type="text" class="form-control" id="subject_category" name="subject_category">
                        <div style="color: red" id="subject_category_validate"></div>
                    </div>
                    <div class="col-md-3">
                        <label for="">السعر</label>
                        <input type="text" class="form-control" id="subject_price" name="subject_price">
                        <div style="color: red" id="subject_price_validate"></div>
                    </div>
                    <div class="col-md-3">
                        <label for="">لون النص</label>
                        <input type="text" id="subject_color" name="subject_color" class="form-control demo"
                               data-control="hue" value="{{$WEBSITE_COLOR->s_value}}">
                        <div style="color: red" id="subject_color_validate"></div>
                    </div>
                </div>
                <br>
                <div id="div_add_request">
                </div>
                <div class="row">
                    <div class="gallery" style="background-color: #e0e0e0;"></div>
                    <div class="text-center" style="position: relative">
                        <input type="file"
                               style="z-index: 2;opacity: 0;position: absolute;width: 100%;height:60px;"
                               id="files" name="files[]" multiple="">
                        <a style="background-color: {{$WEBSITE_COLOR->s_value}}" class="btn btn-primary">اضغط هنا
                            لإضافة صور الموضوع</a>
                        <div style="color: red" id="files_validate"></div>
                    </div>
                </div>
                <br>
                <div class="text-center">
                    <input style="background-color: green;font-size: 14pt" type="submit"
                           class="btn btn-success" value="اعتمد الاعلان">
                </div>
                <hr style="border-color: darkgrey;">
            </div>
        </form>
        <script>
            $(function () {
                $("#addSubjectForm").validate({
                    rules: {
                        subject_title: {
                            required: true,
                        },
                        subject_category: {
                            required: true,
                        },
                        subject_price: {
                            required: true,
                            number: true,
                            min: 0,
                        },
                        subject_color: {
                            required: true,
                        },
                    },
                    errorPlacement: function (error, element) {
                        var name = $(element).attr("name");
                        error.appendTo($("#" + name + "_validate"));
                    },
                    messages: {
                        subject_title: {
                            required: "حقل مطلوب",
                        },
                        subject_category: {
                            required: "حقل مطلوب",
                        },
                        subject_price: {
                            required: "حقل مطلوب",
                            number: "يجب أن يكون قيمة عددية",
                            min: "يجب أن يكون أكبر او يساوي صفر",
                        },
                        subject_color: {
                            required: "حقل مطلوب",
                        },
                    }, submitHandler: function (form) {
                        $('#load_l1').removeClass('hidden');
                        $('#load1').modal('show');
                        $.ajax({
                            method: "POST",
                            url: '{{url("/")}}/mtger/{{$record->pk_i_id}}/{{$department_id}}/addSubject',
                            dataType: 'json',
                            data: {
                                subject_title: $("#subject_title").val(),
                                subject_category: $("#subject_category").val(),
                                subject_price: $("#subject_price").val(),
                                subject_color: $("#subject_color").val(),
                                '_token': '{{csrf_token()}}'
                            },
                            success: function (data, textStatus, jqXHR) {
                                var id = data[0].id;
                                if (data[0].status == 1) {
                                    $.ajax({
                                        method: "POST",
                                        url: '{{url("/")}}/requestAdd1Image',
                                        dataType: 'json',
                                        data: {
                                            "pics": pics, "id": id
                                        },
                                        success: function (data, textStatus, jqXHR) {
                                            window.location.href = "{{url("/")}}/mtger/{{$record->pk_i_id}}?department={{$department_id}}";
                                        }, error: function (jqXHR, textStatus, errorThrown) {
                                        }
                                    });
                                } else {
                                    window.location.href = "{{url("/")}}/mtger/{{$record->pk_i_id}}?department={{$department_id}}";
                                }
                            }
                            ,
                            error: function (jqXHR, textStatus, errorThrown) {
                            }
                        });

                    }
                });
            });
        </script>
    @endif
@endif
