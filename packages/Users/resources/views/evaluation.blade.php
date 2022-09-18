@extends("_outLayout")
@section("body")
    <form id="evaluation_form" action="" method="post">
        {{csrf_field()}}
        <section class="recent-ads">
            <div class="container">
                <div class="row">
                    <div class="ad-information">
                        <div class="name-info row">
                            <div class="col-md-2 name-contact text-center">
                                <p><a>{{$user_details->s_username}}</a></p>
                                <img src="{{url("/")}}/uploads/{{$user_details->s_pic}}"><br>
                                @if($user_details->pk_i_id != session("user_id"))
                                    <i class="fa fa-envelope"></i>
                                    <span>
                                         <a class="send_msg">رسالة خاصة</a>
                                        <input type="hidden" id="sender_id" value="{{ session("user_id") }}">
                                        <input type="hidden" id="reciver_id" value="{{$user_details->pk_i_id}}">

                                    </span>
                                    <br>
                                    {{--<i class="fa fa-bell"></i>--}}
                                    {{--<span>--}}
                                    {{--<a >تابع إعـلاناتـه</a>--}}
                                    {{--</span>--}}
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
                                            <input disabled type="radio"
                                                   {{($total < 1)  ? "checked" : ""}} id="starhalf"
                                                   name="rating" value="half"/>

                                            <label class="half" for="starhalf"
                                                   title="Sucks big time - 0.5 stars"></label>
                                        </fieldset>
                                    </div>
                                </div>
                                <p><a href="{{url("/")}}/comments/{{$user_details->pk_i_id}}">عدد التقييمات :
                                        <span>{{\App\Helper\Helper::getEvaluationData($user_details->pk_i_id)}}</span></a>
                                </p>
                                <p>مكان الإقامة :
                                    <span style="color:{{$user_details->getCountry->s_color}}">{{$user_details->getCountry->s_name_ar}}</span>
                                    -
                                    <span style="color:{{$user_details->getCity->s_color}}">{{ $user_details->getCity->s_name_ar}}</span>
                                </p>
                                <p>الإعلانات : <span>{{count($user_details->getCountOfAdds)}}</span></p>
                                <p>تاريخ التسجيل :
                                    <span>{{date("d/m/Y", strtotime($user_details->dt_created_date))}}</span>
                                </p>
                                <p>المشاركات : <span>{{count($user_details->getCountOfComments)}}</span></p>
                            </div>
                            <div class="col-md-6 product-information">
                                <div class="person-rate">
                                </div>
                            </div>
                        </div>
                        <div class="left-content">
                            <div class="left-content-show container">
                                @foreach($evaluations as $e)
                                    @if($e->i_type == 1)
                                        <div class="radio-btn">
                                            <p style="font-family: Arial;font-size: 14pt">{{$e->s_name_ar}}</p>
                                            <label class="radio-inline"><input type="radio"
                                                                               name="evaluation_{{$e->pk_i_id}}"
                                                                               value="نعم">نعم</label>
                                            <label class="radio-inline"><input type="radio"
                                                                               name="evaluation_{{$e->pk_i_id}}"
                                                                               value="لا">لا</label>
                                            <div style="color:red" id="evaluation_{{$e->pk_i_id}}_validate"></div>
                                        </div>
                                    @elseif($e->i_type == 2)
                                        <div class="date-select">
                                            <p style="font-family: Arial;font-size: 14pt">{{$e->s_name_ar}}</p>
                                            <select name="evaluation_{{$e->pk_i_id}}" class="form-control">
                                                <option value="أقل من شهر">أقل من شهر</option>
                                                <option value="أقل من سنة">أقل من سنة</option>
                                                <option value="سنتين">سنتين</option>
                                                <option value="أكثر من ذلك">أكثر من ذلك</option>
                                            </select>
                                            <div style="color:red" id="evaluation_{{$e->pk_i_id}}_validate"></div>
                                        </div>
                                    @elseif($e->i_type == 3)
                                        <div class="input-evaluate row">
                                            <p style="font-family: Arial;font-size: 14pt">{{$e->s_name_ar}}</p>
                                            <textarea name="evaluation_{{$e->pk_i_id}}"
                                                      id="evaluation_{{$e->pk_i_id}}"
                                                      cols="100" rows="5"></textarea>
                                            <div style="color:red" id="evaluation_{{$e->pk_i_id}}_validate"></div>
                                        </div>
                                    @endif
                                @endforeach
                                <br>
                                <input type="checkbox" id="accept_cond" name="accept_cond" value="Agree">
                                أقر وأقسم بالله
                                العظيم أن كل
                                البيانات
                                السابقة صحيحة واتحمل المسؤولية الكلملة تجاهها<br>
                                <p class="red">( سيتم مراجعة التقييم بعد إرساله، وإذا ثبت أن به تحايل فإنك تتحمل
                                    المسؤولية الكاملة )</p>
                                <div style="color:red" id="accept_cond_validate"></div>
                                <br>
                                <input type="submit" value="أرسل التقييم" class="btn btn-success"
                                       style="background-color: #0ea153 !important; ">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </form>
    <script>
        $(function () {
            $('#evaluation_form').validate({
                rules: {
                    @foreach($evaluations as $e)
                    evaluation_{{$e->pk_i_id}}: {
                        required: true,
                    },
                    @endforeach
                    accept_cond: {
                        required: true,
                    },
                }
                ,
                errorPlacement: function (error, element) {
                    var name = $(element).attr("name");
                    error.appendTo($("#" + name + "_validate"));
                },
                messages: {
                    @foreach($evaluations as $e)
                    evaluation_{{$e->pk_i_id}}: {
                        required: "حقل مطلوب",
                    },
                    @endforeach
                    accept_cond: {
                        required: "يجب الموافقة قبل إرسال التقييم",
                    },
                }, submitHandler: function (form) {
                    form.submit();
                }
            });
        });
    </script>
@endsection