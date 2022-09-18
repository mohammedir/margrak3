@extends("_manageLayout")
@section("body")
    <div class="col-sm-10 col-xs-12">
        <section class="manage-content">
            <p class="manage-head-p">{{$title}}</p>
            <div class="row">
                <span>الرسائل:</span>
                <a class="btn btn-primary tabs_btn" id="questions">الإستفسارات</a>
                <a class="btn btn-primary tabs_btn" id="sugestion">الإقتراحات</a>
                <a class="btn btn-primary tabs_btn" id="complains">الشكاوي</a>
                <a class="btn btn-primary tabs_btn" id="others">أخرى</a>
            </div>
            <br>
            <div class="row">
                <span>الإشعارات:</span>
                <a class="btn btn-primary tabs_btn" id="reports">البلاغات</a>
                <a class="btn btn-primary tabs_btn" id="autoblock">تم حظرهم تلقائي</a>
                <a class="btn btn-primary tabs_btn" id="manualblock">تم حظرهم إداري</a>
                <a class="btn btn-primary tabs_btn" id="payment_user">مدفوعات العمولة</a>
            </div>
            <div class="div_questions divs hidden">
                @include("Users::questions")
            </div>
            <div class="div_sugestion divs hidden">
                @include("Users::sugestion")
            </div>
            <div class="div_complains divs hidden">
                @include("Users::complains")
            </div>
            <div class="div_others divs hidden">
                @include("Users::others")
            </div>
            <div class="div_reports divs hidden">
                @include("Users::reports")
            </div>
            <div class="div_autoblock divs hidden">
                @include("Users::autoblock")
            </div>
            <div class="div_manualblock divs hidden">
                @include("Users::manualblock")
            </div>
            <div class="div_payment_user divs hidden">
                @include("Users::payment_user")
            </div>
        </section>
    </div>
    <script>
        $(function () {
            $("body").on("click", ".tabs_btn", function () {
                $(".divs").each(function () {
                    $(this).addClass("hidden");
                });
                var id = $(this).attr("id");
                $(".div_" + id).removeClass("hidden");
            });
        });
    </script>
@endsection