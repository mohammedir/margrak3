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
                                    <i class="fa fa-envelope"></i><span>
                                         <a class="send_msg">رسالة خاصة</a>
                                        <input type="hidden" id="sender_id" value="{{ session("user_id") }}">
                                        <input type="hidden" id="reciver_id" value="{{$user_details->pk_i_id}}">

                            </span><br>
                                    <i class="fa fa-bell"></i><span>تابع إعلاناته</span>
                                @endif                            </div>
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
                                <p>تاريخ التسجيل :
                                    <span>{{date("d/m/Y", strtotime($user_details->dt_created_date))}}</span>
                                </p>
                                <p>المشاركات : <span>{{count($user_details->getCountOfComments)}}</span></p>
                            </div>
                            <div class="col-md-7 product-information">
                                <div class="person-rate">
                                </div>
                            </div>
                        </div>
                        <div class="left-content">
                            <div class="left-content-show container">
                                @foreach($evaluations as $e)
                                    @if($e->i_type == 1)
                                        @if($e->pk_i_id != 3)
                                            <div class="radio-btn">
                                                <p>{{$e->s_name_ar}}</p>
                                                <label class="radio-inline"><input type="radio"
                                                                                   name="evaluation_{{$e->pk_i_id}}"
                                                                                   value="نعم">نعم</label>
                                                <label class="radio-inline"><input type="radio"
                                                                                   name="evaluation_{{$e->pk_i_id}}"
                                                                                   value="لا">لا</label>
                                                <div style="color:red" id="evaluation_{{$e->pk_i_id}}_validate"></div>
                                            </div>
                                        @else
                                            <div class="radio-btn row">
                                                <p>{{$e->s_name_ar}}</p>
                                                <div class="rating ">
                                                <span><input type="radio" name="evaluation_{{$e->pk_i_id}}" id="str5"
                                                             value="5"><label for="str5">5</label></span>
                                                    <span><input type="radio" name="evaluation_{{$e->pk_i_id}}"
                                                                 id="str4"
                                                                 value="4"><label for="str4">4</label></span>
                                                    <span><input type="radio" name="evaluation_{{$e->pk_i_id}}"
                                                                 id="str3"
                                                                 value="3"><label for="str3">3</label></span>
                                                    <span><input type="radio" name="evaluation_{{$e->pk_i_id}}"
                                                                 id="str2"
                                                                 value="2"><label for="str2">2</label></span>
                                                    <span><input type="radio" name="evaluation_{{$e->pk_i_id}}"
                                                                 id="str1"
                                                                 value="1"><label for="str1">1</label></span>
                                                </div>
                                            </div>
                                            <div style="color:red" id="evaluation_{{$e->pk_i_id}}_validate"></div>
                                        @endif
                                    @elseif($e->i_type == 2)
                                        <div class="date-select">
                                            <p>{{$e->s_name_ar}}</p>
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
                                            <p>{{$e->s_name_ar}}</p>
                                            <textarea name="" id="" cols="100" rows="5"></textarea>
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
                                <input type="submit" value="أرسل التقييم" class="btn btn-success">
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
    <script type="text/javascript">
        $(document).ready(function () {
            // Check Radio-box
            $(".rating input:radio").attr("checked", false);

            $('.rating input').click(function () {
                $(".rating span").removeClass('checked');
                $(this).parent().addClass('checked');
            });

            $('input:radio').change(
                function () {
                    var userRating = this.value;
                });
        });
    </script>
@endsection