@extends("_outLayout")
@section("body")
    <section class="recent-ads">
        <div class="container">
            <div class="row">
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
                            @if($user_details->pk_i_id != session("user_id"))
                                <i class="fa fa-envelope"></i>
                                <span>
                                <a class="send_msg">رسالة خاصة</a>
                                <input type="hidden" id="sender_id" value="{{ session("user_id") }}">
                                <input type="hidden" id="reciver_id" value="{{$user_details->pk_i_id}}">
                            </span>

                                <br>
                                {{--<i class="fa fa-bell"></i><span>تابع إعلاناته</span>--}}
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
                            <p>مكان الإقامة :
                                <span style="color:{{$user_details->getCountry->s_color}}">{{$user_details->getCountry->s_name_ar}}</span> - <span style="color:{{$user_details->getCity->s_color}}">{{ $user_details->getCity->s_name_ar}}</span>
                            </p>
                            <p>الإعلانات : <span>{{count($user_details->getCountOfAdds)}}</span></p>
                            <p>تاريخ التسجيل : <span>{{date("d/m/Y", strtotime($user_details->dt_created_date))}}</span>
                            </p>
                            <p>المشاركات : <span>{{count($user_details->getCountOfComments)}}</span></p>
                        </div>
                        <div class="col-md-5 product-information">


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

                    <div class="left-content">
                        <div class="left-content-show">
                            <?php $y = 0; ?>
                            @foreach($user_ads as $c)
                                <div class="single-line {{$y %2 != 0 ? "color" : ""}} row">
                                    <?php $y++; ?>
                                    <div class="col-md-9 col-xs-9 col-sm-9">
                                        <p><a style="font-weight: bold;font-size: 16pt;
                                            @if($c->i_type == 1)
                                                    color:#019679;
                                            @else
                                                    color:#337ab7;
                                            @endif
                                                    "
                                              href="{{url("/")}}/newest/show/{{$c->pk_i_id}}/{{str_replace(" ","-",trim($c->s_title_ar))}}">{{$c->s_title_ar}}</a>
                                        </p>
                                        <?php
                                        $i = 0;
                                        foreach($c->getPicsData as $p){
                                        if ($i == 4) {
                                            break;
                                        }
                                        $i++;
                                        ?>
                                        <img src="{{url("/")}}/uploads/{{$p->s_value}}">
                                        <?php } ?>
                                        @if(count($c->getPicsData) > 4)
                                            <a href="{{url("/")}}/newest/show/{{$c->pk_i_id}}/{{str_replace(" ","-",trim($c->s_title_ar))}}"
                                               class="else">المزيد</a>
                                        @endif
                                        <div class="left-btn">
                                            {{--<button class="btn brown-btn">مثبت</button>--}}
                                            @if($c->i_is_featured == 1)
                                                <a class="btn brown-btn"
                                                   style="cursor: default !important;">مثبت</a>
                                            @endif
                                            @if($c->i_type == 1)

                                                <a class="btn blue-btn" style="cursor: default !important;">
                                                    عرض
                                                </a>
                                            @else
                                                <a class="btn btn-primary" style="cursor: default !important;">
                                                    طلب
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-xs-3 col-sm-3 details">
                                        <p>كاتب الإعلان:
                                            <span style="color:
                                            @if($c->getTheNameOfCreator->fk_i_role_id == 95)
                                                    #04ad67;
                                            @elseif($c->getTheNameOfCreator->fk_i_role_id == 96)
                                                    red;
                                            @elseif($c->getTheNameOfCreator->fk_i_role_id == 92)
                                                    #1271c7;
                                            @endif
                                                    ">{{$c->getTheNameOfCreator->s_username}}</span>
                                        </p>
                                        <p>إنشاء الإعلان:
                                            <span>{{(new \Carbon\Carbon($c->dt_created_date))->diffForHumans()}}</span>
                                        </p>
                                        <p>الموقع:
                                            @if(isset($c->city_field->fieldOption->s_name_ar))

                                                <span style="color:{{$c->getTheNameOfCreator->getCountry->s_color}}">{{$c->city_field->fieldOption->s_name_ar}}</span>
                                            @endif
                                        </p>
                                        <?php
                                        $lastComment = \App\Helper\Helper::getLastComment($c->pk_i_id);
                                        ?>
                                        @if($lastComment)
                                            <p>آخر مشاركة:
                                                <span>{{$lastComment->getCommentsUser->s_username}}</span>
                                            </p>
                                        @else
                                            <p>آخر مشاركة:
                                                <span>-</span>
                                            </p>

                                        @endif
                                        <p>الردود: <span>{{count($c->getComments)}}</span></p>
                                    </div>
                                </div>
                            @endforeach
                            <div id="more_adds_div0"></div>
                            <div class="text-center">
                                <button class="btn btn-default more" id="more_adds">إضغط هنا لمشاهدة المزيد</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(function () {
            var index = 0;
            var date = "{{$user_ads}}";
            $("#more_adds").click(function () {
                $.ajax({
                    method: "POST",
                    url: '{{url("/")}}/change_select_for_user',
                    dataType: 'json',
                    data: {
                        id: '{{$user_details->pk_i_id}}',
                        index: index,
                        date: date,
                        '_token': '{{csrf_token()}}'
                    },
                    success: function (data, textStatus, jqXHR) {
                        if (data.status) {
                            $("#more_adds_div" + index).html(data.view);
                            date = data.date;
                            index++;
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                    }
                });
            });
        });
    </script>
@endsection
