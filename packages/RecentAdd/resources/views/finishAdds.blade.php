@extends("_outLayout")
@section("body")
    <form id="coins_form_val" action="" method="post">
        {{csrf_field()}}
        <div class="container">
            <div class="row">
                <div class="register-box ad-information">
                    <div class="name-info row">
                        <div class="col-md-3 name-contact text-center">
                            <p>
                                <a href="{{url("/")}}/accountDetails/{{$user_details->pk_i_id}}">{{$user_details->s_username}}</a>
                            </p>
                            <img src="{{url("/")}}/uploads/{{$user_details->s_pic}}"><br>
                        </div>
                        <div class="col-md-3 rate-box">
                            <div class="rate-star">
                                <p>التقييم :</p>
                                <div class="rating-item">
												<span>
                                                    <div class="rating-symbol">
                                                        <div class="rating-symbol-background ri ri-star"></div>
                                                        <div class="rating-symbol-foreground">
                                                        <span class="ri ri-star rating-rated"></span>
                                                        <span class="fa fa-star-o"></span>
                                                        </div>
                                                    </div>
                                                    <div class="rating-symbol">
                                                        <div class="rating-symbol-background ri ri-star"></div>
                                                        <div class="rating-symbol-foreground">
                                                        <span class="ri ri-star rating-rated"></span>
                                                        <span class="fa fa-star-o"></span>
                                                        </div>
                                                    </div>
                                                    <div class="rating-symbol">
                                                        <div class="rating-symbol-background ri ri-star"></div>
                                                        <div class="rating-symbol-foreground">
                                                        <span class="ri ri-star rating-rated"></span>
                                                        <span class="fa fa-star-o"></span>
                                                        </div>
                                                    </div>
                                                    <div class="rating-symbol">
                                                        <div class="rating-symbol-background ri ri-star"></div>
                                                        <div class="rating-symbol-foreground">
                                                        <span class="ri ri-star rating-rated"></span>
                                                        <span class="fa fa-star-o"></span>
                                                        </div>
                                                    </div>
                                                    <div class="rating-symbol">
                                                        <div class="rating-symbol-background ri ri-star"></div>
                                                        <div class="rating-symbol-foreground fore">
                                                        <span class="ri ri-star rating-rated"></span>
                                                        <span class="fa fa-star-o"></span>
                                                        </div>
                                                    </div>
                                                </span>
                                </div>
                            </div>
                            <p>عدد التقييمات: <span>132</span></p>
                            <p>مكان الإقامة :
                                <span>{{$user_details->getCountry->s_name_ar . " - ". $user_details->getCity->s_name_ar}}</span>
                            </p>
                            <p>الإعلانات : <span>{{count($user_details->getCountOfAdds)}}</span></p>
                            <p>تاريخ التسجيل : <span>{{date("d/m/Y", strtotime($user_details->dt_created_date))}}</span>
                            </p>
                            <p>المشاركات : <span>{{count($user_details->getCountOfComments)}}</span></p>
                        </div>
                        <div class="col-md-6 product-information">
                            <div class="product-title">
                                <p>{{$record->s_title_ar}}</p>
                            </div>
                            <div class="ad-date">
                                <p>تم انشاء الاعلان
                                    : {{(new \Carbon\Carbon($record->dt_created_date))->diffForHumans()}}</p>
                                <p>رقم الاعلان : {{$record->pk_i_id}}</p>
                                @if($record->b_enable == 1 )
                                    <p>حالة الإعلان: فعال </p>
                                @else
                                    <p style="color:red">حالة الإعلان: منتهي </p>
                                @endif

                            </div>
                            <div class="person-rate">
                            </div>
                        </div>
                    </div>
                    <div class="bottom-ad">
                        <div class="container">
                            <p class="attention">أخي العميل نشكر اختيارك موقع متجرك<br>
                                نرجو منك دفع عمولة الموقع إذا كنت قد أتممت ( العرض أو الطلب ) المذكور في اعلانكم <br>
                                ولمعرفة كافة المعلومات عن عمولة الموقع نرجو منك الدخول إلى <a
                                        href="{{url("/")}}/coinspage">عمولة
                                    الموقع</a></p>
                            <div class="row">
                                <div class="col-md-6">
                                    <hr style="margin: 0px;border-top: 2px solid #ccc">
                                </div>
                            </div>
                            <p style="margin-top:30px;">في حال قمت بدفع العمولة استكمل باقي الاجراءات هنا ليتم تأكيد
                                الدفع ...</p>
                            <p>ادخل قيمة ( العرض/الطلب ) الذي قمت بدفع عمولته :</p>
                            <input value="{{$record->ads_value}}" name="ads_value" id="ads_value" class="form-control" style="max-width:150px;display:inline-block;" type="text">
                            <select id="fk_i_currency" name="fk_i_currency" style="padding: 5px;border: 1px solid #ccc;border-radius: 5px;margin-right: 10px;margin-bottom: 20px;position: relative;top: 0px;">
                                @foreach($currency->getChilds as $c)
                                    <option {{$record->fk_i_paid_during == $c->pk_i_id ? "selected" : ""}} value="{{$c->pk_i_id}}">{{$c->s_name_ar}}</option>
                                @endforeach
                            </select>
                            <div style="color:red" id="ads_value_validate"></div>

                            <p style="margin-top:30px;">نرجو منك تحديد الفترة التي قمت بدفع العمولة فيها :</p>
                            <select id="fk_i_paid_during" name="fk_i_paid_during" style="padding: 5px;border: 1px solid #ccc;border-radius: 5px;margin-right: 10px;margin-bottom: 20px;position: relative;top: 0px;">
                                @foreach($CoinsTime->getChilds as $c)
                                    <option {{$record->fk_i_paid_during == $c->pk_i_id ? "selected" : ""}} value="{{$c->pk_i_id}}">{{$c->s_name_ar}}</option>
                                @endforeach
                            </select>

                            <p style="margin-top:30px;">ادخل الاسم الثلاثي لصاحب الحساب البنكي الذي تم دفع العمولة عن
                                طريقه :</p>
                            <input value="{{$record->s_fullname}}" id="s_fullname" name="s_fullname" class="form-control" style="max-width:250px;display:inline-block;" type="text">
                            <div style="color:red" id="s_fullname_validate"></div>
                            <p style="margin-top:30px;">اضف رقم الجوال ( اختياري ) :</p>
                            <input value="{{$record->s_mobile}}" name="s_mobile" id="s_mobile" class="form-control" style="max-width:250px;display:inline-block;" type="text">
                            <div style="color:red" id="s_mobile_validate"></div>
                            <div class="radio-btn">
                                <p>هل تريد انهاء الاعلان بإغلاقه واخفاء محتوياته أو تريده أن يبقى ؟</p>
                                <label class="radio-inline"><input type="radio" name="closedAdd" value="3">اغلاق الاعلان واخفاء
                                    محتوياته</label>
                                <label class="radio-inline"><input type="radio" name="closedAdd" value="1">لا تغلق الاعلان، ابقه
                                    كما هو</label>
                                <div style="color:red" id="closedAdd_validate"></div>

                            </div>
                            <div class="col-md-6">
                                <hr style="margin: 0px;border-top: 2px solid #ccc">
                            </div>
                            <div class="input-evaluate" style="margin-top: 50px;">
                                <input type="checkbox" name="accept_coins" value="Agree">أقر وأقسم بالله العظيم أن كل البيانات
                                السابقة صحيحة واتحمل المسؤولية الكلملة تجاهها<br>
                                <div style="color:red" id="accept_coins_validate"></div>
                                <br>
                                <p class="red">( سيتم مراجعة التقييم بعد إرساله، وإذا ثبت أن به تحايل فإنك تتحمل
                                    المسؤولية الكاملة )</p>
                            </div>
                            <button class="btn btn-success">اعتمد</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
        $(function () {
            $("#coins_form_val").validate({
                rules: {
                    closedAdd: {
                        required: true,
                    },
                    s_fullname: {
                        required: true,
                    },
                    s_mobile: {
                        required: true,
                        number: true,
                    },
                    ads_value: {
                        required: true,
                        number: true,
                    },
                    accept_coins: {
                        required: true,
                    },
                },
                errorPlacement: function (error, element) {
                    var name = $(element).attr("name");
                    error.appendTo($("#" + name + "_validate"));
                },
                messages: {
                    accept_coins: {
                        required: "يجب الموافقة",
                    },
                    closedAdd: {
                        required: "حقل مطلوب",
                    },
                    s_fullname: {
                        required: "حقل مطلوب",
                    },
                    s_mobile: {
                        required: "حقل مطلوب",
                        number: "يجب أن يكون قيمة عددية",
                    },
                    ads_value: {
                        required: "حقل مطلوب",
                        number: "يجب أن يكون قيمة عددية",
                    },

                }, submitHandler: function (form) {
                    form.submit();
                }
            });
        });
    </script>
@endsection