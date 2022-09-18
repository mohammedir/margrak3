<div class="container">
    <div class="row">
        <div class="register-box">
            <div class="top-register">
                <p>تعبئة هذه الخانات ( اجباري ) لانها بيانات اساسية للتسجيل</p>
            </div>
            <div class="mid-register">
                <div class="container">
                    <div class="register-line">
                        <p>اسم المستخدم</p>
                        <input value="{{$user_details->s_username}}" name="username" id="username"
                               placeholder="اكتب اسم المستخدم الذي تريد">
                        <div style="color:red" id="username_validate"></div>
                    </div>
                    <div class="register-line">
                        <p>البريد الالكتروني</p>
                        <input value="{{$user_details->s_email}}" name="email" id="email"
                               placeholder="example@email.com">
                        <div style="color:red" id="email_validate"></div>

                    </div>
                    <div class="register-line">
                        <p>اعد كتابة البريد الالكتروني</p>
                        <input value="{{$user_details->s_email}}" name="email_confirm" id="email_confirm"
                               placeholder="example@email.com">
                        <div style="color:red" id="email_confirm_validate"></div>
                    </div>
                    <div class="register-line">
                        <p>الدولة</p>
                        <select name="country_id" id="country_id" class="form-control">
                            <option selected disabled="">اختر الدولة من القائمة</option>
                            @foreach($Countries as $c)
                                <option {{$user_details->i_country_id == $c->pk_i_id ? "selected" : ""}} value="{{$c->pk_i_id}}">{{$c->s_name_ar}}</option>
                            @endforeach
                        </select>
                        <div style="color:red" id="country_id_validate"></div>
                    </div>
                    <div class="register-line">
                        <p>المدينة</p>
                        <select id="city_id" name="city_id" class="form-control">
                        </select>
                        <div style="color:red" id="city_id_validate"></div>
                    </div>
                </div>
            </div>
            <div class="bottom-register">
                <a id="next" class="btn btn-default">التالي</a>
            </div>
        </div>
    </div>
</div>
