@extends("_outLayout")
@section("body")
    <div class="container">
        <div class="row">
            @foreach($coins as $c)
                <div class="right-comment-b">
                    <p class="top-pa text-center"><a>{{$c->s_title}}</a></p>
                    <div class="bottom-pa">
                        <?= $c->s_desc ?>
                    </div>
                </div>
            @endforeach
            <div class="row coins text-center">
                <div class="col-md-4"></div>
                <div class="right-comment-b col-md-4">
                    <p class="top-pa-blue text-center"><a>حاسبة العمولة</a></p>
                    <div class="bottom-pa">
                        <p>ادخل القيمة في الخانة وسيتم اظهارالعمولة مباشرة</p>
                        <input id="calc">
                        <a id="calc_a" class="btn btn-default">
                            إحسب
                        </a>
                        <?php
                        $CALCULATOR_COMMISSION_RATE = \App\Helper\Helper::getSystemRecord("CALCULATOR_COMMISSION_RATE");
                        ?>
                        <p>عمولة الموقع = <span class="blue-sp" id="calc_span"></span>
                        </p>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>

            <div class="right-comment-b">
                <p class="top-pa-green text-center"><a>طرق دفع العمولة</a></p>
                <div class="mid-pa text-center">
                    <h2>الطريقة الأولى</h2>
                    <p>عن طريق التحويل البنكي لحسابات الموقع في البنوك المحلية</p>
                </div>
                <div class="mid-pa text-center">
                    <p>اختر البنك الذي تراه مناسب لك</p>
                    <span>اذا لم تجد البنك المناسب لك تستطيع التحويل على احد هذه البنوك</span>
                    @foreach($banks as $b)
                        <div class="row coins text-center">
                            <div class="col-md-4"></div>
                            <div class="right-comment-b col-md-4">
                                <p class="top-pa text-center"><a class="black">{{$b->s_title}}</a></p>
                                <div class="bottom-par">
                                    <?= $b->s_desc ?>
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                    @endforeach
                </div>
                <div class="bottom-pa green text-center">
                    <h2>الطريقة الثانية</h2>
                    <p>الدفع عن طريق <span>سداد</span> قريباً</p>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            var CALCULATOR_COMMISSION_RATE = "{{$CALCULATOR_COMMISSION_RATE->s_value }}";
            $("#calc_a").click(function () {
                var calc = $("#calc").val();
                var value = (parseInt(calc) * parseInt(CALCULATOR_COMMISSION_RATE)) / 100;
                $("#calc_span").text(value + " ريال");
            });
        });
    </script>
@endsection