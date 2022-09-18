@extends("_manageLayout")
@section("body")
    <div class="col-sm-10 col-xs-12">
        <section class="manage-content">
            <p class="manage-head-p">العمولة :</p>
            @include("System::coins")
            <a href="{{url("/")}}/addCoins" class="btn btn-success" style="float:left;"> + اضافة بطاقة</a>
            <table class="table">
                <thead class="thead-default">
                <tr>
                    <th>العنوان</th>
                    <th>الحالة</th>
                    <th>ادارة</th>
                </tr>
                </thead>
                <tbody>
                @foreach($coins as $c)
                    <tr>
                        <td>{{$c->s_title}}</td>
                        <td>{{$c->b_enabled == 1 ? "فعال" : "غير فعال"}}</td>
                        <td>
                            <a class="btn btn-primary" href="{{url("/")}}/editCoins/{{$c->pk_i_id}}">تعديل</a>
                            <a class="btn btn-danger Confirm" href="{{url("/")}}/deleteCoins/{{$c->pk_i_id}}">حذف</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <form action="" method="post" id="CALCULATOR_COMMISSION_RATE_FORM">
                {{csrf_field()}}
                <div class="row" style="margin: 20px 0px;">
                    <span style="float:right;">نسبة العمولة : </span>
                    <div class="col-md-2" style="position: relative;top: -7px;">
                        <?php
                        $CALCULATOR_COMMISSION_RATE = \App\Helper\Helper::getSystemRecord("CALCULATOR_COMMISSION_RATE");
                        ?>
                        <input value="{{$CALCULATOR_COMMISSION_RATE->s_value}}" style="margin: 0px 10%;"
                               name="CALCULATOR_COMMISSION_RATE"
                               id="CALCULATOR_COMMISSION_RATE" placeholder="نسبة العمولة" class="form-control"
                               type="text">
                        <div style="color:red" id="CALCULATOR_COMMISSION_RATE_validate"></div>
                    </div>
                    <div class="col-md-2" style="position: relative;top: -7px;">
                        <button class="btn btn-success">حفظ</button>
                    </div>
                </div>
            </form>
            <p style="font-size: 18px;font-weight: bold;margin-top: 80px;">حسابات البنوك : </p>
            <a class="btn btn-success" style="float:left;" href="{{url("/")}}/addBanks" style="color:#fff"> +
                اضافة حساب بنكي</a>
            <table class="table">
                <thead class="thead-default">
                <tr>
                    <th>العنوان</th>
                    <th>الحالة</th>
                    <th>ادارة</th>
                </tr>
                </thead>
                <tbody>
                <tbody>
                @foreach($banks as $c)
                    <tr>
                        <td>{{$c->s_title}}</td>
                        <td>{{$c->b_enabled == 1 ? "فعال" : "غير فعال"}}</td>
                        <td>
                            <a class="btn btn-primary" href="{{url("/")}}/editCoins/{{$c->pk_i_id}}">تعديل</a>
                            <a class="btn btn-danger Confirm" href="{{url("/")}}/deleteCoins/{{$c->pk_i_id}}">حذف</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </section>
    </div>
    <script>
        $(function () {
            $('#CALCULATOR_COMMISSION_RATE_FORM').validate({
                rules: {
                    CALCULATOR_COMMISSION_RATE: {required: true, number: true},
                },
                errorPlacement: function (error, element) {
                    var name = $(element).attr("name");
                    error.appendTo($("#" + name + "_validate"));
                },
                messages: {
                    CALCULATOR_COMMISSION_RATE: {required: "حقل مطلوب", number: "قيمة عددية"},
                }, submitHandler: function (form) {
                    form.submit();
                }
            });
        });
    </script>
@endsection
