@extends("_outLayout")
@section("body")
    @if(session('msg'))
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session('msg') }}
        </div>
    @endif
    @if(session('error_msg'))
        <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{session('error_msg')}}
        </div>
    @endif
    <div class="row">
        <div class="col-md-6 col-md-offset-2">
            <div class="right-comment-b">
                <p class="top-pa text-center"><a>{{$title}}</a></p>
                <div class="bottom-pa">
                    <div class="row" style="text-align: center">
                        <div class="col-md-offset-1 col-md-10">
                            <form id="reset_form" action="" method="post" class="login-form">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="form-group">
                                        <input id="email" autocomplete="off" placeholder="الإيميل" type="text"
                                               name="email"
                                               class="form-control placeholder-no-fix">
                                        <div style="color: red" id="email_validate"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div>
                                        <div style="float: right">
                                            <input type="submit" value="إرسال" class="btn btn-primary ">

                                        </div>
                                        <div style="float: left">
                                            <a href="{{url("/")}}/login" class="btn btn-success">تسجيل الدخول </a>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $('#reset_form').validate({
                rules: {
                    email: "required"
                },
                messages: {
                    email: "حقل مطلوب"
                },
                errorPlacement: function (error, element) {
                    var name = $(element).attr("name");
                    error.appendTo($("#" + name + "_validate"));
                }
                ,
                submitHandler: function (form) {
                    form.submit();
                }
            })
            ;
        });
    </script>
@endsection