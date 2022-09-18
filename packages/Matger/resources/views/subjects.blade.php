<div class="col-md-10">

    @include("Matger::AddSubject")
    <br>
    <style>
        .container1 {
            position: relative;
            width: 100%;
        }

        .image {
            opacity: 1;
            display: block;
            width: 100%;
            height: auto;
            transition: .5s ease;
            backface-visibility: hidden;
        }

        .middle {
            transition: .5s ease;
            opacity: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%)
        }

        .container1:hover .image {
            opacity: 0.3;
            background-color: {{$WEBSITE_COLOR->s_value}};

        }

        .container1:hover .middle {
            opacity: 1;
        }

        .image-text {
            background-color: {{$WEBSITE_COLOR->s_value}};
            color: white;
            font-size: 16px;
            padding: 16px 32px;
            border-radius: 10px;
        }

        .image-text:hover {
            color: white;
            text-decoration: none;
        }
    </style>
    @if($subject)
        <div id="subject_show_div" class="">
            <div class="row" style="display: flex">
                <div class="col-md-4" style="border-left: 1px solid gray">
                    <br>
                    <p style="font-weight: bold">الوصف: <span
                                style="color: {{$subject->s_subject_color}};">{{$subject->s_title_ar}}</span></p><br>
                    <p style="font-weight: bold">الصنف: {{$subject->s_details}}</p><br>
                    <p style="font-weight: bold">السعر: {{$subject->s_price}} ريال</p><br>
                </div>
                <div class="col-md-4" style="border-left: 1px solid gray">
                    <!-- fotorama.css & fotorama.js. -->
                    <link href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
                    <!-- 3 KB -->
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>
                    <!-- 16 KB -->
                    <div class="fotorama"
                         data-nav="thumbs">
                        <?php
                        foreach ($subject->getPicsData as $p) {
                        ?>
                        <a href="#"><img src="{{url("/")}}/uploads/{{$p->s_value}}"></a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="col-md-4 rate-box">
                    <div class="rate-star">
                        <p>التقييم :</p>
                        <?php
                        $yes = 0;
                        $no = 0;
                        foreach (\App\Helper\Helper::getEvaluationDataForSubject($subject->pk_i_id, 3) as $eval_data) {
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
                    <p>عدد التقييمات :
                        <span>{{\App\Helper\Helper::getEvaluationDataForSubject($subject->pk_i_id)}}</span>
                    </p>
                    @if(session("user_id"))
                        <span><a href="{{url("/")}}/evaluationSubject/{{$subject->pk_i_id}}">ضع تقييمك للموضوع </a></span>
                        <i><img width="15px" src="{{url("/")}}/assets/img/like.png"></i>
                        <i style="position:relative; top:8px;">
                            <img width="15px" src="{{url("/")}}/assets/img/dislike.png"></i>
                    @else
                        <span>  <a style="color:red">لتقييم المستخدم يرجى <a href="{{url("/")}}/login">تسجيل
                                            الدخول</a>
                                    </span>
                    @endif
                    <br>
                    <br>

                    <div class="row">
                        @if(session("user_id"))
                            @if(! \App\Helper\Helper::checkReact(2,$subject->pk_i_id,Auth::user()->pk_i_id ))
                                <a style="background-color: {{$WEBSITE_COLOR->s_value}}" class="btn btn-primary"
                                   id="fav"><i class="fa fa-heart"></i> اضافة
                                    للمفضلة</a>
                            @else
                                <a style="background-color: {{$WEBSITE_COLOR->s_value}}" class="btn btn-primary"
                                   id="un_fav"><i class="fa fa-heart"></i> إلغاء
                                    من المفضلة</a>
                            @endif
                        @endif
                        <input type="hidden" value="{{$subject->pk_i_id}}" id="sub_id_up">
                        <br>
                        <br>
                        @if($subject->fk_i_by_user_id != session("user_id"))
                            <i class="fa fa-envelope"></i>
                            <span>
                                <a class="send_msg_mtger">رسالة خاصة</a>
                                @if(Auth::user())
                                    <input type="hidden" id="sender_id" value="{{ session("user_id") }}">
                                @else
                                    <input type="hidden" id="sender_id" value="35">
                                @endif
                                <input type="hidden" id="reciver_id" value="{{$subject->fk_i_by_user_id}}">
                                <input type="hidden" id="department" value="{{$department_id}}">
                                <input type="hidden" id="subject" value="{{$subject->pk_i_id}}">
                                <input type="hidden" id="mtger" value="{{$record->pk_i_id}}">
                            </span>

                            {{--<i class="fa fa-bell"></i><span>تابع إعلاناته</span>--}}
                        @endif
                    </div>
                </div>
            </div>
            <hr style="border-color: gray">
        </div>
    @endif
    <div class="col-md-12">
        @if($department)
            @foreach($department->getSubjects as $s)
                <div class="col-md-3"
                     style="min-height: 254px;max-height: 254px;border:1px solid #b0afaf;padding: 10px;float: right;background-color: #dfdfdf">
                    <a id="view_subject">
                        <div class="container1">
                            <?php
                            foreach ($s->getPicsData as $p) {
                            ?>
                            <img class="image" style="border-radius: 10px;height: 160px" width="100%"
                                 src="{{url("/")}}/uploads/{{$p->s_value}}" alt="">
                            <?php
                            break;
                            }
                            ?>

                            <div class="middle">
                                <a href="{{url("/")}}/mtger/{{$record->pk_i_id}}?department={{$department_id}}&subject={{$s->pk_i_id}}"
                                   class="image-text">عرض</a>
                            </div>
                        </div>
                    </a>
                    <br>
                    <div style="margin-bottom: 0px">
                        <span style="font-size: 9pt;color:{{$s->s_subject_color}}">{{$s->s_title_ar}}</span><br>
                        <span style="line-height: 30px;float: right;font-size: 9pt">
                        @if($user_flag)
                                <a style="color: red" class="Confirm" href="{{url("/")}}/deleteSubject/{{$s->pk_i_id}}">حذف</a>
                            @endif
                        </span>
                        <span style="line-height: 30px;color: blue;float: left;font-size: 9pt">{{$s->s_price}}
                            ريال</span>
                    </div>
                </div>
            @endforeach
        @endif
        @foreach($subjects as $s)
            <div class="col-md-3"
                 style="min-height: 254px;max-height: 254px;border:1px solid #b0afaf;padding: 10px;float: right;background-color: #dfdfdf">
                <a id="view_subject">
                    <div class="container1">
                        <?php
                        foreach ($s->getPicsData as $p) {
                        ?>
                        <img class="image" style="border-radius: 10px;height: 160px" width="100%"
                             src="{{url("/")}}/uploads/{{$p->s_value}}" alt="">
                        <?php
                        break;
                        }
                        ?>

                        <div class="middle">
                            <a href="{{url("/")}}/mtger/{{$record->pk_i_id}}?department={{$s->i_fk_category_id}}&subject={{$s->pk_i_id}}"
                               class="image-text">عرض</a>
                        </div>
                    </div>
                </a>
                <br>
                <div style="margin-bottom: 0px">
                    <span style="font-size: 9pt;color:{{$s->s_subject_color}}">{{$s->s_title_ar}}</span><br>
                    <span style="line-height: 30px;float: right;font-size: 9pt">
                        @if($user_flag)
                            <a style="color: red" class="Confirm"
                               href="{{url("/")}}/deleteSubject/{{$s->pk_i_id}}">حذف</a>
                        @endif
                        </span>
                    <span style="line-height: 30px;color: blue;float: left;font-size: 9pt">{{$s->s_price}}
                        ريال</span>
                </div>
            </div>
        @endforeach
    </div>
</div>
@if($user_flag)
    <form action="{{url("/")}}/AddsReactForSubject/{{$record->pk_i_id}}/{{$department_id}}/{{Auth::user()->pk_i_id}}"
          method="post"
          id="follow_form">
        {{csrf_field()}}
        <input type="hidden" id="i_type_value" name="i_type_value">
        <input type="hidden" id="sub_id" name="sub_id">
    </form>
@endif

<script>
    $(function () {
        $('#fav').click(function () {
            $("#sub_id").val($("#sub_id_up").val());
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
        $('#un_fav').click(function () {
            $("#sub_id").val($("#sub_id_up").val());
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
        $('body').on('click', '#subject_show_btn', function () {
            $("#title_span").html($(this).siblings("#subject_title_up").val());
            $("#price_span").html($(this).siblings("#price_up").val());
            $("#price_span").html($(this).siblings("#price_up").val());
            $("#cat_span").html($(this).siblings("#s_details_up").val());
            $("#title_span").css("color", $(this).siblings("#subject_color_up").val());
            $('#subject_show_div').removeClass('hidden');
        });
    });
</script>