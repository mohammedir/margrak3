@extends("_outLayout")
@section("body")
    <div class="container">
        <form id="contact_form" class="form-horizontal" action="{{url("/")}}/contact_post" method="post">
            {{csrf_field()}}
            <legend>{{$title}}</legend>
            <div class="form-group">
                <label class="col-md-4 control-label">نوع الرسالة</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <select id="i_type" name="i_type" style="width: 100%" class="form-control">
                            <option disabled selected>يرجى إختيار نوع الرسالة</option>
                            <option {{$type == 1 ? "selected" : ""}} value="1">إستفسار</option>
                            <option {{$type == 2 ? "selected" : ""}} value="2">إقتراح</option>
                            <option {{$type == 3 ? "selected" : ""}} value="3">شكوى</option>
                            <option {{$type == 4 ? "selected" : ""}} value="4">أخرى</option>
                        </select>
                    </div>
                    <div style="color:red" id="i_type_validate"></div>

                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">الاسم</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input name="s_name_ar" id="s_name_ar" placeholder="الاسم" class="form-control" type="text">
                    </div>
                    <div style="color:red" id="s_name_ar_validate"></div>

                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">البريد الالكتروني</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                        <input name="s_email" id="s_email" placeholder="البريد الالكتروني" class="form-control"
                               type="text">
                    </div>
                    <div style="color:red" id="s_email_validate"></div>

                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">رقم الهاتف</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                        <input name="s_mobile" id="s_mobile" placeholder="رقم الهاتف" class="form-control" type="text">
                    </div>
                    <div style="color:red" id="s_mobile_validate"></div>

                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">العنوان</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                        <input name="s_title" id="s_title" placeholder="العنوان" class="form-control" type="text">
                    </div>
                    <div style="color:red" id="s_title_validate"></div>

                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">نص الرسالة</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                        <textarea class="form-control" name="s_desc" id="s_desc" placeholder="نص الرسالة"></textarea>
                    </div>
                    <div style="color:red" id="s_desc_validate"></div>

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
                    i_type: {
                        required: true,
                    },
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
                    i_type: {
                        required: "حقل مطلوب",
                    },
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