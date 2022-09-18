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
                        <input name="username" id="username" placeholder="اكتب اسم المستخدم الذي تريد">
                        <div style="color:red" id="username_validate"></div>
                    </div>
                    <div class="register-line">
                        <p>البريد الالكتروني</p>
                        <input name="email" id="email" placeholder="example@email.com">
                        <div style="color:red" id="email_validate"></div>

                    </div>
                    <div class="register-line">
                        <p>اعد كتابة البريد الالكتروني</p>
                        <input name="email_confirm" id="email_confirm" placeholder="example@email.com">
                        <div style="color:red" id="email_confirm_validate"></div>
                    </div>
                    <div class="register-line">
                        <p>كلمة السر
                            <span>نرجو منك كتابة كلمة سر قوية تحتوي على حروف كبيرة وحروف صغيرة وأرقام ورموز</span></p>
                        <input id="password" name="password" type="password" placeholder="اكتب كلمة السر">
                        <div style="color:red" id="password_validate"></div>
                    </div>
                    <div class="register-line">
                        <p>اعد كتابة كلمة السر</p>
                        <input id="password_confirm" name="password_confirm" type="password"
                               placeholder="اكتب كلمة السر مرة اخرى">
                        <div style="color:red" id="password_confirm_validate"></div>
                    </div>
                    <div class="register-line">
                        <p>الدولة</p>
                        <select name="country_id" id="country_id" class="form-control">
                            <option selected disabled="">اختر الدولة من القائمة</option>
                            @foreach($Countries as $c)
                                @if(count($c->getChilds) >0)
                                    <option value="{{$c->pk_i_id}}">{{$c->s_name_ar}}</option>
                                @endif
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
                    <div class="check">
                        <input type="checkbox" name="accept" id="accept" value="Agree"> اقر بالموافقة والالتزام بـ <a
                                href="{{url("/")}}/rulespage" target="_blank">قوانين واحكام وشروط الموقع</a><br>
                        <div style="color:red" id="accept_validate"></div>
                    </div>
                </div>
            </div>
            <div class="bottom-register">
                <a id="next" class="btn btn-default">التالي</a>
            </div>
        </div>
    </div>
</div>
