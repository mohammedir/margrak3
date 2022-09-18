@extends("_outLayout")
@section("body")
    <section class="recent-ads">
        <div class="container">
            <div class="row">
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
                                {{--<i class="fa fa-bell"></i><span>تابع إعلاناته</span>--}}
                            @endif
                        </div>
                        <div class="col-md-3 rate-box">
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
                                <span>{{$user_details->getCountry->s_name_ar . " - ". $user_details->getCity->s_name_ar}}</span>
                            </p>
                            <p>الإعلانات : <span>{{count($user_details->getCountOfAdds)}}</span></p>
                            <p>تاريخ التسجيل : <span>{{date("d/m/Y", strtotime($user_details->dt_created_date))}}</span>
                            </p>
                            <p>المشاركات : <span>{{count($user_details->getCountOfComments)}}</span></p>
                        </div>
                        <div class="col-md-6 product-information">


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
                    ?>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="right-comment">
                                    <div class="total-comment">
                                        <div class="row">
                                            <div class="right-side col-sm-8">
                                                <a>عدد {{$yes}} شخص ينصحون بالتعامل معه</a><br>
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-danger" role="progressbar"
                                                         aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"
                                                         style="width:
                                                         @if($yes !=0 || $no !=0)
                                                         {{($yes/($yes+$no))*100}}%
                                                         @else
                                                                 0%
                                                         @endif
                                                                 ">
                                                    </div>
                                                </div><!--progress-->
                                                <a>عدد {{$no}} أشخاص لا ينصحون بالتعامل معه</a><br>
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-danger bad-rate"
                                                         role="progressbar" aria-valuenow="5" aria-valuemin="0"
                                                         aria-valuemax="100"
                                                         style="width:                                                         @if($yes !=0 || $no !=0)
                                                         {{($no/($yes+$no))*100}}%
                                                         @else
                                                                 0%
                                                         @endif

                                                                 ">
                                                    </div>
                                                </div><!--progress-->
                                            </div>
                                            <div class="left-side col-sm-4 text-center">
                                                <div class="left-rate-box">
                                                    <p>مجموع التقييمات من 5</p>
                                                    <span>
                                                        @if($yes !=0 || $no !=0)
                                                            {{(($yes/($yes+$no))*100)/20}}
                                                        @else
                                                            0
                                                        @endif

                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @foreach($comments as $c)
                                    <div class="right-comment-b">
                                        <p class="top-p">
                                            <a href="{{url("/")}}/accountDetails/{{$c->fk_i_by_user_id}}">{{$c->getEvaluationUser->s_username}}</a><br>
                                            <?php $data = (\App\Helper\Helper::getEvaluationData1($user_details->pk_i_id, $c->fk_i_by_user_id)); ?>
                                            @if($data->s_value == "نعم")
                                                <span>ينصح بالتعامل مع {{$user_details->s_username}}  </span>
                                            @else
                                                <span class="bad-comment">لا ينصح بالتعامل مع {{$user_details->s_username}}</span>
                                            @endif
                                        </p>
                                        <p class="bottom-p">{{$c->s_value}}</p>
                                    </div>
                                @endforeach
                                <div id="more_comments_div0"></div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-default more" id="view_more_comments">إضغط هنا لمشاهدة المزيد
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(function () {
            var index = 0;
                    @if(count($comments) > 0)
            var date = "{{$comments->last()->dt_created_date}}";
                    @endif
            var id = "{{$user_details->pk_i_id}}";
            $("#view_more_comments").click(function () {
                $.ajax({
                    method: "POST",
                    url: '{{url("/")}}/CommentsBody',
                    dataType: 'json',
                    data: {
                        id: id,
                        date: date,
                        index: index,
                        '_token': '{{csrf_token()}}'
                    },
                    success: function (data, textStatus, jqXHR) {
                        if (data.status) {
                            $("#more_comments_div" + index).html(data.view);
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