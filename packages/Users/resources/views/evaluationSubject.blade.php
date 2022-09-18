@extends("_outLayout")
@section("body")
    <?php
    $WEBSITE_COLOR = \App\Helper\Helper::getSystemRecord("WEBSITE_COLOR");
    ?>
    <form id="evaluation_form" action="" method="post">
        {{csrf_field()}}
        <section class="recent-ads">
            <div class="container">
                <div class="row">
                    <div class="ad-information">
                        <div class="name-info row">
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

                                </div>
                            </div>
                        </div>
                        <div class="left-content">
                            <div class="left-content-show container">
                                <div class="radio-btn">
                                    <p style="font-family: Arial;font-size: 14pt">هل تنصح بالتعامل مع هذا الموضوع؟</p>
                                    <label class="radio-inline"><input type="radio"
                                                                       name="evaluation"
                                                                       value="نعم">نعم</label>
                                    <label class="radio-inline"><input type="radio"
                                                                       name="evaluation"
                                                                       value="لا">لا</label>
                                    <div style="color:red" id="evaluation_validate"></div>
                                </div>
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
                    evaluation: {
                        required: true,
                    },
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
                    evaluation: {
                        required: "حقل مطلوب",
                    },
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