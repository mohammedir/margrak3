@extends("_outLayout")
@section("body")
    <div class="container">
        <form id="contact_form" class="form-horizontal" action="" method="post">
            <legend>{{$title}}</legend>
            <input type="hidden" value="1" name="i_type">
            <div class="form-group">
                <label class="col-md-4 control-label">الاسم</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input name="s_name_ar" id="s_name_ar" placeholder="الاسم" class="form-control" type="text">
                        <div style="color:red" id="s_name_ar_validate"></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">البريد الالكتروني</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                        <input name="s_email" id="s_email" placeholder="البريد الالكتروني" class="form-control"
                               type="text">
                        <div style="color:red" id="s_email_validate"></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">رقم الهاتف</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                        <input name="s_mobile" id="s_mobile" placeholder="رقم الهاتف" class="form-control" type="text">
                        <div style="color:red" id="s_mobile_validate"></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">العنوان</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                        <input name="s_title" id="s_title" placeholder="العنوان" class="form-control" type="text">
                        <div style="color:red" id="s_title_validate"></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">نص الرسالة</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                        <textarea class="form-control" name="s_desc" id="s_desc" placeholder="نص الرسالة"></textarea>
                        <div style="color:red" id="s_desc_validate"></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label"></label>
                <div class="col-md-4">
                    <input value="أرسل" type="submit" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
    <script>
        $(function () {
            $('#contact_form').validate({
                rules: {
                    s_desc: {
                        required: true,
                    },
                    s_title: {
                        required: true,
                    },
                    s_mobile: {
                        required: true,
                    },
                    s_name_ar: {
                        required: true,
                    },
                    s_email: {
                        required: true,
                        email: true,
                    },
                }
                ,
                errorPlacement: function (error, element) {
                    var name = $(element).attr("id");
                    error.appendTo($("#" + name + "_validate"));
                },
                messages: {
                    s_desc: {
                        required: "حقل مطلوب",
                    },
                    s_title: {
                        required: "حقل مطلوب",
                    },
                    s_mobile: {
                        required: "حقل مطلوب",
                    },
                    s_name_ar: {
                        required: "حقل مطلوب",
                    },
                    s_email: {
                        required: "حقل مطلوب",
                        email: "يجب أني يكون بريد إلكتروني صحيح",
                    },
                }, submitHandler: function (form) {
                    form.submit();
                }
            });
        });
    </script>
@endsection