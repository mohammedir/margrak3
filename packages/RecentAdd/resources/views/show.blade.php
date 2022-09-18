@extends("_outLayout")
@section("body")
    <style>
        blockquote {
            margin: 15px;
            padding: .75em .5em .75em 1em;
            background: #fff;
            box-shadow: 0 0 6px rgba(0, 0, 0, 0.5);
            font-size: 1em;
        }
    </style>
    <section class="recent-ads">
        <div class="row">
            <div class="col-sm-9">
                <div class="ad-information">
                    <div class="name-info row">
                        <div class="col-md-3 name-contact text-center">
                            <p>
                                <a style="color:
                                @if($user_details->fk_i_role_id == 95)
                                        #04ad67;
                                @elseif($user_details->fk_i_role_id == 96)
                                        red;
                                @elseif($user_details->fk_i_role_id == 92)
                                        #1271c7;
                                @endif
                                        "
                                   href="{{url("/")}}/accountDetails/{{$user_details->pk_i_id}}">{{$user_details->s_username}}</a>
                            </p>
                            <img src="{{url("/")}}/uploads/{{$user_details->s_pic}}"><br>
                            @if(session("user_id"))
                                @if($user_details->pk_i_id != session("user_id"))
                                    <i class="fa fa-envelope"></i>
                                    <span>
                                <a class="send_msg">رسالة خاصة</a>
                                <input type="hidden" id="sender_id" value="{{ session("user_id") }}">
                                <input type="hidden" id="reciver_id" value="{{$user_details->pk_i_id}}">
                            </span>

                                    <br>
                                    <form action="{{url("/")}}/AddsReact/{{$record->pk_i_id}}/{{Auth::user()->pk_i_id}}"
                                          method="post"
                                          id="follow_form1">
                                        {{csrf_field()}}
                                        <input type="hidden" id="i_type_value1" name="i_type_value">

                                        @if(session("user_id"))
                                            @if(session("user_id") != $user_details->pk_i_id)

                                                <span>
                                                @if(! \App\Helper\Helper::checkReact(1,$record->pk_i_id,Auth::user()->pk_i_id ))
                                                        <a class="" id="fol1"><i style="color: #333;"
                                                                                 class="fa fa-bell"></i>
                                                        متابعة
                                                        الإعلان</a>
                                                    @else
                                                        <a class="" id="un_fol1"><i style="color: #333;"
                                                                                    class="fa fa-bell"></i>
                                                        إلغاء
                                                        متابعة الإعلان</a>
                                                    @endif
                                            </span>
                                            @endif
                                        @endif
                                    </form>
                                @endif
                            @endif
                        </div>
                        <div class="col-md-4 rate-box">
                            <div class="rate-star">
                                <p>التقييم :</p>
                                <?php
                                $yes = 0;
                                $no = 0;
                                foreach (\App\Helper\Helper::getEvaluationData($user_details->pk_i_id, 3) as $eval_data) {
                                    if ($eval_data->s_value == "نعم") {
                                        $yes++;
                                    } else {
                                        $no++;
                                    }
                                }
                                $total = 0;
                                if ($yes != 0 || $no != 0) {
                                    $total = (($yes / ($yes + $no)) * 100) / 20;
                                }
                                ?>
                                <div class="rating-item">
                                    <fieldset class="rating">
                                        <input disabled {{$total >= 5  ? "checked" : ""}} type="radio" id="star5"
                                               name="rating"
                                               value="5"/>
                                        <label class="full" for="star5" title="Awesome - 5 stars"></label>
                                        <input disabled {{($total > 4 && $total <5)  ? "checked" : ""}} type="radio"
                                               id="star4half" name="rating" value="4 and a half"/>

                                        <label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                        <input disabled {{($total == 4)  ? "checked" : ""}} type="radio"
                                               id="star4" name="rating" value="4"/>

                                        <label class="full" for="star4" title="Pretty good - 4 stars"></label>
                                        <input disabled {{($total > 3 && $total <4)  ? "checked" : ""}} type="radio"
                                               id="star3half" name="rating" value="3 and a half"/>

                                        <label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                        <input disabled {{($total ==3)  ? "checked" : ""}} type="radio" id="star3"
                                               name="rating" value="3"/>

                                        <label class="full" for="star3" title="Meh - 3 stars"></label>
                                        <input disabled {{($total > 2 && $total <3)  ? "checked" : ""}} type="radio"
                                               id="star2half" name="rating" value="2 and a half"/>

                                        <label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                        <input disabled {{($total == 2)  ? "checked" : ""}} type="radio" id="star2"
                                               name="rating" value="2"/>

                                        <label class="full" for="star2" title="Kinda bad - 2 stars"></label>
                                        <input disabled {{($total > 1 && $total <2)  ? "checked" : ""}} type="radio"
                                               id="star1half" name="rating" value="1 and a half"/>

                                        <label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                        <input disabled {{($total == 1)  ? "checked" : ""}} type="radio"
                                               id="star1" name="rating" value="1"/>

                                        <label class="full" for="star1" title="Sucks big time - 1 star"></label>
                                        <input disabled type="radio" {{($total < 1)  ? "checked" : ""}} id="starhalf"
                                               name="rating" value="half"/>

                                        <label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                                    </fieldset>
                                </div>
                            </div>
                            <p><a href="{{url("/")}}/comments/{{$user_details->pk_i_id}}">عدد التقييمات :
                                    <span>{{\App\Helper\Helper::getEvaluationData($user_details->pk_i_id)}}</span></a>
                            </p>
                            <p>الموقع :

                                @if(isset($record->city_field->fieldOption->s_name_ar))

                                    <span style="color:{{$record->getTheNameOfCreator->getCountry->s_color}}">{{$record->city_field->fieldOption->s_name_ar}}</span>
                                @endif

                            </p>
                            <p><a style="color:
                                @if($user_details->fk_i_role_id == 95)
                                        #04ad67;
                                @elseif($user_details->fk_i_role_id == 96)
                                        red;
                                @elseif($user_details->fk_i_role_id == 92)
                                        #1271c7;
                                @endif
                                        "
                                  href="{{url("/")}}/accountDetails/{{$user_details->pk_i_id}}">الإعلانات :
                                    <span>{{count($user_details->getCountOfAdds)}}</span></a></p>
                            <p>تاريخ التسجيل : <span>{{date("d/m/Y", strtotime($user_details->dt_created_date))}}</span>
                            </p>
                            <p>المشاركات : <span>{{count($user_details->getCountOfComments)}}</span></p>
                        </div>
                        <div class="col-md-5 product-information">
                            <div class="product-title">
                                <p>{{$record->s_title_ar}}</p>
                            </div>
                            <div class="ad-date">
                                <p>انشاء الاعلان
                                    : {{(new \Carbon\Carbon($record->dt_created_date))->diffForHumans()}}</p>
                                <p>رقم الاعلان : {{$record->pk_i_id}}</p>
                                @if($record->b_enable == 1 )
                                    <p>حالة الإعلان: فعال </p>
                                @elseif($record->b_enable == 0)
                                    <p style="color:red">حالة الإعلان: مغلق </p>
                                @else
                                    <p style="color:red">حالة الإعلان: منتهي </p>
                                @endif
                            </div>

                            <div class="person-rate">
                                @if(session("user_id"))
                                    @if($user_details->pk_i_id != session("user_id"))
                                        <span><a href="{{url("/")}}/evaluation/{{$user_details->pk_i_id}}">ضع تقييمك لـ {{$user_details->s_first_name . " " . $user_details->s_last_name}}</a></span>
                                        <i><img width="15px" src="{{url("/")}}/assets/img/like.png"></i>
                                        <i style="position:relative; top:8px;">
                                            <img width="15px" src="{{url("/")}}/assets/img/dislike.png"></i>
                                    @endif
                                @else
                                    <span>  <a style="color:red">لتقييم المستخدم يرجى <a href="{{url("/")}}/login">تسجيل
                                            الدخول</a>
                                    </span>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="subject">
                        <p><?= $record->s_details?></p>
                        <div class="subject-img text-center">
                            @foreach($record->getPicsData as $p)
                                <img style="margin: 5px" src="{{url("/")}}/uploads/{{$p->s_value}}"><br>
                            @endforeach
                        </div>
                        <div class="">
                            <p class="person-contact">
                                <button class="btn btn-success">وسيلة التواصل:
                                    @if($record->i_contact_method == 1)
                                        {{$user_details->s_mobile_number}}
                                    @elseif($record->i_contact_method == 2)
                                        {{$user_details->s_email}}
                                    @else
                                        عبر الموقع
                                    @endif
                                </button>
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
                            @if(Auth::user()->fk_i_role_id == 95 ||Auth::user()->fk_i_role_id == 96 || session("user_id") == $user_details->pk_i_id)
                                <ul>
                                    <li><a href="{{url("/")}}/editAdd/{{$record->pk_i_id}}">تعديل </a>
                                        <span>|</span></li>
                                    @if($record->b_enable == 1)
                                        <li><a class="Confirm1"
                                               href="{{url("/")}}/delete_adds_area/{{$record->pk_i_id}}/0">اغلاق
                                                الاعلان </a><input type="hidden" value="{{$record->pk_i_id}}"
                                                                   id="o_pk_i_id">
                                            <span>|</span></li>
                                    @endif
                                    @if(session("user_id") != $user_details->pk_i_id)
                                        <li><a href="{{url("/")}}/block/{{$user_details->pk_i_id}}/0">حظر
                                                المعلن</a><span>|</span></li>
                                    @endif
                                </ul>
                            @endif
                        @endif

                    </div>
                    @if(session("user_id"))
                        @if(session("user_id") != $user_details->pk_i_id)

                            <form action="{{url("/")}}/AddsReact/{{$record->pk_i_id}}/{{Auth::user()->pk_i_id}}"
                                  method="post"
                                  id="follow_form">
                                {{csrf_field()}}
                                <input type="hidden" id="i_type_value" name="i_type_value">
                                <div class="social-icons">

                                    <ul>
                                        @if(! \App\Helper\Helper::checkReact(2,$record->pk_i_id,Auth::user()->pk_i_id ))
                                            <li><a class="" id="fav"><i class="fa fa-heart"></i> اضافة
                                                    للمفضلة</a></li>
                                        @else
                                            <li><a class="" id="un_fav"><i class="fa fa-heart"></i> إلغاء
                                                    من المفضلة</a></li>
                                        @endif
                                        <li>
                                            <a href='whatsapp://send?text={{url("/")}}/newest/show/{{$record->pk_i_id}}/{{str_replace(" ","-",trim($record->s_title_ar))}}'>واتساب</a><i
                                                    class="fa fa-whatsapp"></i></li>
                                        <li><a class="twitter-share-button" href="https://twitter.com/share"
                                               data-size="large"
                                               data-text="{{$record->s_title_ar}}"
                                               data-url="{{url("/")}}/newest/show/{{$record->pk_i_id}}/{{str_replace(" ","-",trim($record->s_title_ar))}}"
                                               data-hashtags=""
                                               data-via=""
                                               data-related="twitterapi,twitter">تويتر</a><i class="fa fa-twitter"></i>
                                        </li>

                                    </ul>
                                </div>
                            </form>
                        @else
                            <div class="social-icons">

                                <ul>
                                    <li>
                                        <a href='whatsapp://send?text={{url("/")}}/newest/show/{{$record->pk_i_id}}/{{str_replace(" ","-",trim($record->s_title_ar))}}'>واتساب</a><i
                                                class="fa fa-whatsapp"></i></li>
                                    <li><a href="https://twitter.com/share"
                                           data-size="large"
                                           data-text="{{$record->s_title_ar}}"
                                           data-url="{{url("/")}}/newest/show/{{$record->pk_i_id}}/{{str_replace(" ","-",trim($record->s_title_ar))}}"
                                           data-hashtags=""
                                           data-via=""
                                           data-related="twitterapi,twitter">تويتر</a><i class="fa fa-twitter"></i></li>

                                </ul>
                            </div>

                        @endif
                    @else
                        <div class="social-icons">

                            <ul>
                                <li>
                                    <a href='whatsapp://send?text={{url("/")}}/newest/show/{{$record->pk_i_id}}/{{str_replace(" ","-",trim($record->s_title_ar))}}'>واتساب</a><i
                                            class="fa fa-whatsapp"></i></li>
                                <li><a href="https://twitter.com/share"
                                       data-size="large"
                                       data-text="{{$record->s_title_ar}}"
                                       data-url="{{url("/")}}/newest/show/{{$record->pk_i_id}}/{{str_replace(" ","-",trim($record->s_title_ar))}}"
                                       data-hashtags=""
                                       data-via=""
                                       data-related="twitterapi,twitter">تويتر</a><i class="fa fa-twitter"></i></li>

                            </ul>
                        </div>
                    @endif
                </div>
                @foreach($comments as $c)
                    <div class="comments">
                        <div class="row">
                            <div class="col-md-4 comment-contact">
                                <div class="text-center">
                                    <p class="contact-name">
                                        <a style="color:
                                        @if($c->getCommentsUser->fk_i_role_id == 95)
                                                #04ad67;
                                        @elseif($c->getCommentsUser->fk_i_role_id == 96)
                                                red;
                                        @elseif($c->getCommentsUser->fk_i_role_id == 92)
                                                #1271c7;
                                        @endif
                                                " href="{{url("/")}}/accountDetails/{{$c->getCommentsUser->pk_i_id}}">
                                            {{$c->getCommentsUser->s_username}}
                                        </a>
                                    </p>
                                    @if($c->getCommentsUser->pk_i_id != session("user_id"))
                                        <i class="fa fa-envelope"></i>
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
                                    <p>{{(new \Carbon\Carbon($c->dt_created_date))->diffForHumans()}}
                                        @if(session("user_id") )
                                            @if(session("user_id") == $user_details->pk_i_id || Auth::user()->fk_i_role_id == 95 ||Auth::user()->fk_i_role_id == 96)
                                                <a class="Confirm"
                                                   href="{{url("")}}/commentComplain/{{$c->pk_i_id}}">ابلغ
                                                    عن
                                                    تعليق مخالف</a>

                                            @endif
                                        @endif

                                    </p>
                                </div>
                                <div class="comment-date">

                                    <p>{!! $c->s_comment !!} <span></span></p>
                                </div>
                                <div class="comment-replay">
                                    {{--<p><a href="">الرد على سلطان التميمي</a></p>--}}
                                </div>
                            </div>
                            <div style="margin-bottom: 5px;margin-left:  5px;float: left">
                                <a style="margin-bottom: 5px" class="quote"> إقتباس</a>
                                <input type="hidden" id="user_comment_owner"
                                       value="{{$c->getCommentsUser->s_username}}">
                                <input type="hidden" id="user_comment_owner_id_up"
                                       value="{{$c->getCommentsUser->pk_i_id}}">
                                <input type="hidden" id="user_comment" value="{{$c->s_comment}}">

                            </div>
                        </div>
                    </div>
                @endforeach
                <form action="{{url("/")}}/insertComment/{{$record->pk_i_id}}" method="post" id="comment_form">
                    {{csrf_field()}}
                    <div class="send-message">
                        <p><span>تنبيه : </span>نرجو عدم الرد بغير ردود لائقة و نرجو الالتزام بالقوانين حتى لا تتعرض
                            عضويتك للحظر</p>
                        <textarea id="comment" name="comment" method class="form-control" placeholder="اكتب ردك هنا "
                                  rows="11"
                                  data-error="Write your message" required></textarea>
                        <div id="comment_validate" style="color:red"></div>

                        @if(session("user_id"))
                            <input style="color: #1372c6;border-color: #1372c6 " class="btn btn-default" type="submit"
                                   value="إرسـال >>">
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
                @foreach($user_ads as $c)
                    <div class="left-product-box">
                        <p>
                            <a href="{{url("/")}}/newest/show/{{$c->pk_i_id}}/{{str_replace(" ","-",trim($c->s_title_ar))}}">{{$c->s_title_ar}}</a>
                        </p>
                        <div class="row">
                            <?php
                            $i = 0;
                            foreach($c->getPicsData as $p){

                            if ($i == 2) {
                                break;
                            }
                            $i++;
                            ?>
                            <div class="col-xs-5 single-photo"><img src="{{url("/")}}/uploads/{{$p->s_value}}"></div>
                            <?php } ?>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <form action="" method="post">
        {{csrf_field()}}
        <div id="Confirm1" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-l" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">رسالة تأكيد</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="send-message">
                                <label for="">ملاحظات</label>
                                <textarea class="form-control" name="notes" id="notes" cols="30" rows="10"></textarea>
                                <input type="hidden" id="d_pk_i_id" name="d_pk_i_id">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">إلغاء</button>
                        <input type="submit" class="btn btn-danger" value="إغلاق">
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </form>
    <form action="{{url("/")}}/quoteUser/{{$record->pk_i_id}}" method="post">
        {{csrf_field()}}
        <div id="quoteUserModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-l" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">إقتباس</h4>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <p><span style="color: red">تنبيه : </span>نرجو عدم الرد بغير ردود لائقة و نرجو الالتزام
                                بالقوانين حتى لا تتعرض
                                عضويتك للحظر</p>
                            <textarea id="qouts_comment" name="qouts_comment" method class="form-control"
                                      placeholder="اكتب ردك هنا "
                                      rows="11"
                                      data-error="Write your message" required></textarea>
                            <input type="hidden" id="hidden_text" name="hidden_text">
                            <input type="hidden" id="user_comment_owner_id" name="user_comment_owner_id">

                        </div>
                    </div>
                    <div class="modal-footer">
                        @if(session("user_id"))
                            <input style="color: #1372c6;border-color: #1372c6 " class="btn btn-default"
                                   type="submit"
                                   value="إرسـال >>">
                        @else
                            <p style="color:red">لإرسال رد يجب عليك <a href="{{url("/")}}/login">تسجيل الدخول</a>
                            </p>
                        @endif
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </form>
    <script>
        $(document).on("click", ".Confirm1", function () {
            var o_pk_i_id = $(this).siblings("#o_pk_i_id").val();
            $("#d_pk_i_id").val(o_pk_i_id);
            $("#Confirm1").modal("show");
            $("#Confirm1 .btn-danger").attr("href", $(this).attr("href"));
            return false;
        });
    </script>

    <script>
        $(function () {

            $('.quote').click(function () {
                var user_comment_owner_id = $(this).siblings("#user_comment_owner_id_up").val();
                var user_comment_owner = $(this).siblings("#user_comment_owner").val();
                var user_comment = $(this).siblings("#user_comment").val();
                $("#hidden_text").val("<blockquote>رد على " + user_comment_owner + " <br>" + user_comment + "</blockquote>");
                $("#user_comment_owner_id").val(user_comment_owner_id);

                $("#quoteUserModal").modal("show");
            });
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
            $('#fol1').click(function () {
                // $("#i_type_value").val(2);
                $("#i_type_value1").val(2);
                bootbox.dialog({
                    message: "هل أنت متأكد من متابعة الإعلان ؟",
                    title: "رسالة تأكيد",
                    buttons: {
                        danger: {
                            label: "نعم",
                            className: "btn-primary",
                            callback: function () {
                                $('#follow_form1').submit();
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
            $('#un_fol1').click(function () {
                $("#i_type_value1").val(4);
                bootbox.dialog({
                    message: "هل أنت متأكد من إلغاء المتابعة ؟",
                    title: "رسالة تأكيد",
                    buttons: {
                        danger: {
                            label: "نعم",
                            className: "btn-primary",
                            callback: function () {
                                $('#follow_form1').submit();
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
            $('#follow_form1').validate({
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