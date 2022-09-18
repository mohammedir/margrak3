@extends("_outLayout")
@section("body")
    <section class="recent-ads">
        <div class="row">
            <div class="col-sm-9">
                <div class="ad-information">
                    <div class="name-info row">
                        <div class="col-md-3 name-contact text-center">
                            <p>
                                <a href="{{url("/")}}/accountDetails/{{$user_details->pk_i_id}}">{{$user_details->s_first_name . " " . $user_details->s_last_name}}</a>
                            </p>
                            <img src="{{url("/")}}/uploads/{{$user_details->s_pic}}"><br>
                            @if($user_details->pk_i_id != session("user_id"))
                                <i class="fa fa-envelope"></i>
                                <span>
                                <a class="send_msg">رسالة خاصة</a>
                                <input type="hidden" id="sender_id" value="{{ session("user_id") }}">
                                <input type="hidden" id="reciver_id" value="{{$user_details->pk_i_id}}">
                            </span>

                                <br>
                                <i class="fa fa-bell"></i><span>تابع إعلاناته</span>
                            @endif
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
                            <p>عدد التقييمات : <span>132</span></p>
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
                                <p>انشاء الاعلان
                                    : {{(new \Carbon\Carbon($record->dt_created_date))->diffForHumans()}}</p>
                                <p>رقم الاعلان : {{$record->pk_i_id}}</p>
                                @if($record->b_enable == 1 )
                                    <p>حالة الإعلان: فعال </p>
                                @else
                                    <p style="color:red">حالة الإعلان: منتهي </p>
                                @endif
                            </div>

                            <div class="person-rate">
                                @if($user_details->pk_i_id != session("user_id"))
                                    <span><a href="{{url("/")}}/evaluation/{{$user_details->pk_i_id}}">ضع تقييمك لـ {{$user_details->s_first_name . " " . $user_details->s_last_name}}</a></span>
                                    <i><img width="15px" src="{{url("/")}}/assets/img/like.png"></i>
                                    <i style="position:relative; top:8px;">
                                        <img width="15px" src="{{url("/")}}/assets/img/dislike.png"></i>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="subject">
                        <p><?= $record->s_details?></p>
                        <div class="subject-img text-center">
                            @foreach($record->getPicsData as $p)
                                <img src="{{url("/")}}/uploads/{{$p->s_value}}"><br>
                            @endforeach
                        </div>
                        <div class="person-contact">
                            <p>
                                <button class="btn btn-success">وسيلة التواصل
                                    : {{$record->i_contact_method == 1 ? $user_details->s_mobile_number : $user_details->s_email}}</button>
                            </p>
                            @if(session("user_id"))
                                @if(session("user_id") == $user_details->pk_i_id)

                                    <div class="hidden-ad">أخي المعلن : <br>
                                        في حال أتممت (العرض/الطلب) <a
                                                href="{{url("/")}}/finishAdds/{{$record->pk_i_id}}">اضغط هنا</a>
                                    </div>
                                @endif
                            @endif
                        </div>
                        @if(session("user_id"))
                            @if(session("user_id") == $user_details->pk_i_id)
                                <ul>
                                    <li><a>نقل </a><span>|</span></li>
                                    <li><a>تعديل </a><span>|</span></li>
                                    <li><a>اغلاق الاعلان </a><span>|</span></li>
                                    <li><a>حذف الاعلان </a><span>|</span></li>
                                </ul>
                            @endif
                        @endif

                    </div>
                    @if(session("user_id"))
                        <form action="{{url("/")}}/AddsReact/{{$record->pk_i_id}}/{{Auth::user()->pk_i_id}}"
                              method="post"
                              id="follow_form">
                            {{csrf_field()}}
                            <input type="hidden" id="i_type_value" name="i_type_value">
                            <div class="social-icons">

                                <ul>
                                    @if(! \App\Helper\helper::checkReact(2,$record->pk_i_id,Auth::user()->pk_i_id ))
                                        <li><a class="btn btn-default" id="fav"><i class="fa fa-heart"></i> اضافة
                                                للمفضلة</a></li>
                                    @else
                                        <li><a class="btn btn-default" id="un_fav"><i class="fa fa-heart"></i> إلغاء
                                                من المفضلة</a></li>
                                    @endif
                                    @if(! \App\Helper\helper::checkReact(1,$record->pk_i_id,Auth::user()->pk_i_id ))
                                        <li><a class="btn btn-default" id="fol"><i class="fa fa-forumbee"></i> متابعة
                                                الإعلان</a></li>
                                    @else
                                        <li><a class="btn btn-default" id="un_fol"><i class="fa fa-forumbee"></i> إلفاء
                                                متابعة الإعلان</a></li>
                                    @endif

                                </ul>
                            </div>
                        </form>
                    @else
                        <p style="color:red">لمتابعة الإعلان يرجى <a href="{{url("/")}}/login">تسجيل الدخول</a>
                        </p>
                    @endif
                </div>
                @foreach($comments as $c)
                    <div class="comments">
                        <div class="row">
                            <div class="col-md-4 comment-contact">
                                <div class="text-center">
                                    <p class="contact-name">
                                        <a href="{{url("/")}}/accountDetails/{{$c->getCommentsUser->pk_i_id}}">
                                            {{$c->getCommentsUser->s_username}}
                                        </a>
                                    </p>
                                    @if($c->getCommentsUser->pk_i_id != session("user_id"))
                                        <i
                                                class="fa fa-envelope"></i>
                                        <span>

                                        <a class="send_msg">رسالة خاصة</a>
                                        <input type="hidden" id="sender_id" value="{{ session("user_id") }}">
                                        <input type="hidden" id="reciver_id" value="{{$c->getCommentsUser->pk_i_id}}">
                                    </span>

                                    @endif
                                </div>
                                <div class="comment-box">
                                    <p>مكان الإقامة :
                                        <span>{{$c->getCommentsUser->getCountry->s_name_ar . " - ". $c->getCommentsUser->getCity->s_name_ar}}</span>
                                    </p>
                                    <p>الإعلانات : <span>{{count($c->getCommentsUser->getCountOfAdds)}}</span></p>
                                    <p>تاريخ التسجيل :
                                        <span>{{date("d/m/Y", strtotime($c->getCommentsUser->dt_created_date))}}</span>
                                    </p>
                                    <p>المشاركات : <span>{{count($c->getCommentsUser->getCountOfComments)}}</span></p>
                                </div>
                            </div>
                            <div class="col-md-8 replay-information">
                                <div class="comment-title">
                                    <p>{{(new \Carbon\Carbon($c->dt_created_date))->diffForHumans()}}<a>ابلغ عن
                                            تعليق مخالف</a></p>
                                </div>
                                <div class="comment-date">
                                    <p>{{$c->s_comment}} <span></span></p>
                                </div>
                                <div class="comment-replay">
                                    {{--<p><a href="">الرد على سلطان التميمي</a></p>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <form action="/insertComment/{{$record->pk_i_id}}" method="post" id="comment_form">
                    {{csrf_field()}}
                    <div class="send-message">
                        <p><span>تنبيه : </span>نرجو الالتزام بالقوانين حتى لا تتعرض عضويتك للحظر</p>
                        <textarea id="comment" name="comment" method class="form-control" placeholder="اكتب رسالتك هنا"
                                  rows="11"
                                  data-error="Write your message" required></textarea>
                        <div id="comment_validate" style="color:red"></div>

                        @if(session("user_id"))
                            <input class="btn btn-default" type="submit" value="إرسال الرد">
                        @else
                            <p style="color:red">لإرسال رد يجب عليك <a href="{{url("/")}}/login">تسجيل الدخول</a></p>
                        @endif
                    </div>
                    <p class="black-use">استخدم <a href="{{url("/")}}/blacklistpage">القائمة السوداء</a> قبل أي عملية
                        تحويل وننصح بالتعامل المباشر مع
                        المعلن
                    </p>
                </form>
            </div>
            <div class="col-sm-3 ad-photoes hidden-xs">
                <div class="left-product-box">
                    <p>سوناتا 2012 ابيض لؤلؤي</p>
                    <div class="row">
                        <div class="col-xs-5 single-photo"><img src="{{url("/")}}/assets/img/BMW-2-series.jpg"></div>
                        <div class="col-xs-5 single-photo"><img src="{{url("/")}}/assets/img/BMW-2-series.jpg"></div>
                    </div>
                </div>
                <div class="left-product-box">
                    <p>سوناتا 2012 ابيض لؤلؤي</p>
                    <div class="row">
                        <div class="col-xs-5 single-photo"><img src="{{url("/")}}/assets/img/BMW-2-series.jpg"></div>
                        <div class="col-xs-5 single-photo"><img src="{{url("/")}}/assets/img/BMW-2-series.jpg"></div>
                    </div>
                </div>
                <div class="left-product-box">
                    <p>سوناتا 2012 ابيض لؤلؤي</p>
                    <div class="row">
                        <div class="col-xs-5 single-photo"><img src="{{url("/")}}/assets/img/BMW-2-series.jpg"></div>
                        <div class="col-xs-5 single-photo"><img src="{{url("/")}}/assets/img/BMW-2-series.jpg"></div>
                    </div>
                </div>
                <div class="left-product-box">
                    <p>سوناتا 2012 ابيض لؤلؤي</p>
                    <div class="row">
                        <div class="col-xs-5 single-photo"><img src="{{url("/")}}/assets/img/BMW-2-series.jpg"></div>
                        <div class="col-xs-5 single-photo"><img src="{{url("/")}}/assets/img/BMW-2-series.jpg"></div>
                    </div>
                </div>
                <div class="left-product-box">
                    <p>سوناتا 2012 ابيض لؤلؤي</p>
                    <div class="row">
                        <div class="col-xs-5 single-photo"><img src="{{url("/")}}/assets/img/BMW-2-series.jpg"></div>
                        <div class="col-xs-5 single-photo"><img src="{{url("/")}}/assets/img/BMW-2-series.jpg"></div>
                    </div>
                </div>
                <div class="left-product-box">
                    <p>سوناتا 2012 ابيض لؤلؤي</p>
                    <div class="row">
                        <div class="col-xs-5 single-photo"><img src="{{url("/")}}/assets/img/BMW-2-series.jpg"></div>
                        <div class="col-xs-5 single-photo"><img src="{{url("/")}}/assets/img/BMW-2-series.jpg"></div>
                    </div>
                </div>
                <div class="left-product-box">
                    <p>سوناتا 2012 ابيض لؤلؤي</p>
                    <div class="row">
                        <div class="col-xs-5 single-photo"><img src="{{url("/")}}/assets/img/BMW-2-series.jpg"></div>
                        <div class="col-xs-5 single-photo"><img src="{{url("/")}}/assets/img/BMW-2-series.jpg"></div>
                    </div>
                </div>
                <div class="left-product-box">
                    <p>سوناتا 2012 ابيض لؤلؤي</p>
                    <div class="row">
                        <div class="col-xs-5 single-photo"><img src="{{url("/")}}/assets/img/BMW-2-series.jpg"></div>
                        <div class="col-xs-5 single-photo"><img src="{{url("/")}}/assets/img/BMW-2-series.jpg"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(function () {

            $('#fav').click(function () {
                $("#i_type_value").val(1);
                bootbox.dialog({
                    message: "هل أنت متأكد من تفضيل الإعلان ؟",
                    title: "رسالة تأكيد",
                    buttons: {
                        danger: {
                            label: "نعم",
                            className: "btn-primary",
                            callback: function () {
                                $('#follow_form').submit();
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
            $('#fol').click(function () {
                $("#i_type_value").val(2);
                bootbox.dialog({
                    message: "هل أنت متأكد من متابعة الإعلان ؟",
                    title: "رسالة تأكيد",
                    buttons: {
                        danger: {
                            label: "نعم",
                            className: "btn-primary",
                            callback: function () {
                                $('#follow_form').submit();
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
            $('#un_fav').click(function () {
                $("#i_type_value").val(3);
                bootbox.dialog({
                    message: "هل أنت متأكد من إلغاء التفضيل؟",
                    title: "رسالة تأكيد",
                    buttons: {
                        danger: {
                            label: "نعم",
                            className: "btn-primary",
                            callback: function () {
                                $('#follow_form').submit();
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
            $('#un_fol').click(function () {
                $("#i_type_value").val(4);
                bootbox.dialog({
                    message: "هل أنت متأكد من إلغاء المتابعة ؟",
                    title: "رسالة تأكيد",
                    buttons: {
                        danger: {
                            label: "نعم",
                            className: "btn-primary",
                            callback: function () {
                                $('#follow_form').submit();
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
            $('#register_form').validate({
                rules: {
                    comment: {
                        required: true,
                    },
                },
                errorPlacement: function (error, element) {
                    var name = $(element).attr("name");
                    error.appendTo($("#" + name + "_validate"));
                },
                messages: {
                    comment: {
                        required: "حقل مطلوب",
                    },

                }, submitHandler: function (form) {
                    form.submit();
                }
            });
            $('#follow_form').validate({
                rules: {},
                errorPlacement: function (error, element) {
                    var name = $(element).attr("name");
                    error.appendTo($("#" + name + "_validate"));
                },
                messages: {}, submitHandler: function (form) {
                    form.submit();
                }
            });
        });
    </script>
@endsection