@extends("_manageLayout")
@section("body")
    <div class="col-sm-10 col-xs-12">
        <section class="manage-content">
            <div class="row">
                <div class="manage-content">
                    <div class="manage-content-show">
                        <div class="manage-title">
                            <div class="row">
                                @include("System::filterAdds")
                            </div>
                            <div class="row">
                                <div class="btn-show">
                                    <div class="single-check">
                                        <a id="country_add_btn" class="btn btn-success">الدول و المدن</a>
                                    </div>
                                    <div class="single-check">
                                        <a id="adds_adds_btn" class="btn btn-success">الاعلانات</a>
                                    </div>
                                    <div class="single-check">
                                        <a id="model_add_btn" class="btn btn-success">الموديل</a>
                                    </div>
                                    <div class="single-check">
                                        <a id="view_ask_add_btn" class="btn btn-success">عرض وطلب</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="country_add_div">@include("Adds::country_add")</div>
                        <div id="adds_adds_div" class="hidden">@include("Adds::adds_adds")</div>
                        <div id="model_add_div" class="hidden">@include("Adds::model_add")</div>
                        <div id="view_ask_add_div" class="hidden">@include("Adds::view_ask_add")</div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        $(function () {
            $("#country_add_btn").click(function () {
                $("#country_add_div").removeClass("hidden");
                $("#model_add_div").addClass("hidden");
                $("#adds_adds_div").addClass("hidden");
                $("#view_ask_add_div").addClass("hidden");
            });
            $("#model_add_btn").click(function () {
                $("#model_add_div").removeClass("hidden");
                $("#country_add_div").addClass("hidden");
                $("#adds_adds_div").addClass("hidden");
                $("#view_ask_add_div").addClass("hidden");

            });
            $("#adds_adds_btn").click(function () {
                $("#adds_adds_div").removeClass("hidden");
                $("#model_add_div").addClass("hidden");
                $("#country_add_div").addClass("hidden");
                $("#view_ask_add_div").addClass("hidden");

            });
            $("#view_ask_add_btn").click(function () {
                $("#view_ask_add_div").removeClass("hidden");
                $("#model_add_div").addClass("hidden");
                $("#adds_adds_div").addClass("hidden");
                $("#country_add_div").addClass("hidden");

            });
        });
    </script>
@endsection
