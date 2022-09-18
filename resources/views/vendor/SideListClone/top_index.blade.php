@extends("_manageLayout")
@section("body")
    <div class="col-sm-10 col-xs-12">
        <section class="manage-content">
            <div class="row">
                <div class="manage-content">
                    <div class="manage-content-show">
                        <div class="manage-title">

                            <div class="row">
                                @include("System::topbtn")
                            </div>
                        </div>
                        <div class="row">
                            <a class="btn btn-primary" id="souq_btn">السوق</a>
                            <a class="btn btn-default" id="new_btn">الأحدث</a>
                        </div>
                        <div id="souq_div">@include("SideList::souq_tab")</div>
                        <div class="hidden" id="new_div">@include("SideList::new_tab")</div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        $(function () {
            $("#souq_btn").click(function () {

                $("#souq_btn").removeClass("btn-default");
                $("#souq_btn").removeClass("btn-primary");
                $("#souq_btn").addClass("btn-primary");
                $("#new_btn").removeClass("btn-primary");
                $("#new_btn").addClass("btn-default");


                $("#souq_div").removeClass("hidden");
                $("#new_div").addClass("hidden");
            });
            $("#new_btn").click(function () {
                $("#souq_btn").removeClass("btn-primary");
                $("#souq_btn").addClass("btn-default");
                $("#new_btn").removeClass("btn-default");
                $("#new_btn").removeClass("btn-primary");
                $("#new_btn").addClass("btn-primary");

                $("#souq_div").addClass("hidden");
                $("#new_div").removeClass("hidden");
            });
        });
    </script>
@endsection
