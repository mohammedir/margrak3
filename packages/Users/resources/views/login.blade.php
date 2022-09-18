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
        <div class="col-md-6 col-md-offset-3">
            <div class="right-comment-b">
                <p class="top-pa text-center"><a>تسجيل الدخول</a></p>
                <div class="bottom-pa">
                    <div class="row" style="text-align: center">
                        <div class="col-md-offset-1 col-md-10">
                            <form action="{{url("/")}}/login" method="post" class="login-form">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="form-group">
                                        <input id="email" autocomplete="off" placeholder="يرجى إدخال إسم العضو أو رقم الجوال أو الإيميل" type="text"
                                               name="email"
                                               class="form-control placeholder-no-fix">
                                        @if($errors->has('email'))
                                            <strong class="font-red">{{ $errors->first('email') }}</strong>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <input id="password" autocomplete="off" placeholder="كلمة المرور"
                                               type="password"
                                               name="password"
                                               class="form-control placeholder-no-fix">
                                        @if($errors->has('password'))
                                            <strong class="font-red">{{ $errors->first('password') }}</strong>
                                        @endif
                                    </div>
                                    <div>
                                        <div style="float: right">
                                            <input type="submit" value="تسجيل الدخول" class="btn btn-primary ">

                                        </div>
                                    </div>
                                    <div class="row">
                                        <a href="{{url("/")}}/resetPassword">نسيت كلمة المرور؟</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection