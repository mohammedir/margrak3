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
    <div class="row" style="text-align: center">
        <div class="col-md-offset-4 col-md-4">
            <form action="{{url("/")}}/login" method="post" class="login-form">
                {{csrf_field()}}
                <h3 class="form-title font-green">تسجيل الدخول</h3>
                <div class="form-group">
                    <input id="email" autocomplete="off" placeholder="الإيميل" type="text" name="email"
                           class="form-control placeholder-no-fix">
                    @if($errors->has('email'))
                        <strong class="font-red">{{ $errors->first('email') }}</strong>
                    @endif
                </div>
                <div class="form-group">
                    <input id="password" autocomplete="off" placeholder="كلمة المرور" type="password" name="password"
                           class="form-control placeholder-no-fix">
                    @if($errors->has('password'))
                        <strong class="font-red">{{ $errors->first('password') }}</strong>
                    @endif
                </div>
                <div class="form-actions" style="text-align: center">
                    <input type="submit" value="تسجيل الدخول" class="btn green uppercase">
                </div>
            </form>
        </div>
    </div>
@endsection