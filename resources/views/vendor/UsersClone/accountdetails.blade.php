@extends("_outLayout")
@section("body")
    <section class="recent-ads">
        <div class="container">
            <div class="row">
                <div class="ad-information">
                    <div class="name-info row">
                        <div class="col-md-2 name-contact text-center">
                            <p><a>{{$user_details->s_username}}</a></p>
                            <img src="{{url("/")}}/uploads/{{$user_details->s_pic}}"><br>
                            @if($user_details->pk_i_id != session("user_id"))
                                <i class="fa fa-envelope"></i><span>
                                         <a class="send_msg">رسالة خاصة</a>
                                        <input type="hidden" id="sender_id" value="{{ session("user_id") }}">
                                        <input type="hidden" id="reciver_id" value="{{$user_details->pk_i_id}}">

                            </span><br>
                                <i class="fa fa-bell"></i><span>تابع إعلاناته</span>
                            @endif
                        </div>
                        <div class="col-md-3 rate-box">
                            <div class="rate-star">i
                                <p>التقييم :</p>
                                <?php
                                $total = 0;
                                foreach (\App\Helper\helper::getEvaluationData(3) as $eval_data) {
                                    $total += (int) $eval_data->s_value;
                                }
                                ?>
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
                            <p>عدد التقييمات : <span>{{\App\Helper\helper::getEvaluationData()}}</span></p>
                            <p>مكان الإقامة :
                                <span>{{$user_details->getCountry->s_name_ar . " - ". $user_details->getCity->s_name_ar}}</span>
                            </p>
                            <p>الإعلانات : <span>{{count($user_details->getCountOfAdds)}}</span></p>
                            <p>تاريخ التسجيل : <span>{{date("d/m/Y", strtotime($user_details->dt_created_date))}}</span>
                            </p>
                            <p>المشاركات : <span>{{count($user_details->getCountOfComments)}}</span></p>
                        </div>
                        <div class="col-md-7 product-information">
                            <div class="person-rate">
                                @if($user_details->pk_i_id != session("user_id"))
                                    <span><a href="{{url("/")}}/evaluation/{{$user_details->pk_i_id}}">ضع تقييمك لـ {{$user_details->s_username}}</a></span>
                                    <i><img width="15px" src="{{url("/")}}/assets/img/like.png"></i>
                                    <i style="position:relative; top:8px;">
                                        <img width="15px" src="{{url("/")}}/assets/img/dislike.png"></i>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="left-content">
                        <div class="left-content-show">
                            @foreach($user_ads as $c)

                                <div class="single-line row">
                                    <div class="col-md-9">
                                        <p>{{$c->s_title_ar}}</p>
                                        @foreach($c->getPicsData as $p)
                                            <img src="{{url("/")}}/uploads/{{$p->s_value}}">
                                        @endforeach
                                        <a href="{{url("/")}}/newest/show/{{$c->pk_i_id}}" class="else">المزيد</a>
                                        <div class="left-btn">
                                            {{--<button class="btn brown-btn">مثبت</button>--}}
                                            <a href="{{url("/")}}/newest/show/{{$c->pk_i_id}}"
                                               class="btn blue-btn">عرض</a>
                                        </div>
                                    </div>
                                    <div class="col-md-3 details">
                                        <p>كاتب الإعلان:
                                            <span>{{$c->getTheNameOfCreator->s_username}}</span>
                                        </p>
                                        <p>إنشاء الإعلان:
                                            <span>{{(new \Carbon\Carbon($c->dt_created_date))->diffForHumans()}}</span>
                                        </p>
                                        <p>موقع المعلن:
                                            <span>{{$c->getTheNameOfCreator->getCountry->s_name_ar . " - ". $c->getTheNameOfCreator->getCity->s_name_ar}}</span>
                                        </p>
                                        <?php
                                        $lastComment = \App\Helper\helper::getLastComment($c->pk_i_id);
                                        ?>
                                        @if($lastComment)
                                            <p>آخر مشاركة:
                                                <span>{{$lastComment->getCommentsUser->s_username}}</span>
                                            </p>
                                        @endif
                                        <p>الردود: <span>{{count($c->getComments)}}</span></p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection