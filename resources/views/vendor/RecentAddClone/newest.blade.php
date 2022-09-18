@extends("_outLayout")
@section("body")

    <div class="left-content-title text-center row">
        <div class="col-xs-9">
            <p>احدث المواضيع</p>
        </div>
        <div class="col-md-3 hidden-sm hidden-xs">
            <p>بيانات الاعلان</p>
        </div>
    </div>
    <div class="left-content-show">
        <div id="newest_div">
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
                            <a href="{{url("/")}}/newest/show/{{$c->pk_i_id}}" class="btn blue-btn">عرض</a>
                        </div>
                    </div>
                    <div class="col-md-3 details">
                        <p>كاتب الإعلان: <span>{{$c->getTheNameOfCreator->s_username}}</span></p>
                        <p>إنشاء الإعلان: <span>{{(new \Carbon\Carbon($c->dt_created_date))->diffForHumans()}}</span>
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
        <div class="text-center">
            <button class="btn btn-default more">إضغط هنا لمشاهدة المزيد</button>
        </div>
    </div>
    <script>
        $(function () {
            $("#city_select"), change(function () {
                var city_select = $("#city_select").val();
                var ads_select = $("#ads_select").val();
                var view_select = $("#view_select").val();
                var model_select = $("#model_select").val();
                var text_select = $("#text_select").val();
                $.ajax({
                    method: "POST",
                    url: '{{url("/")}}/change_select',
                    dataType: 'json',
                    data: {
                        city_select: city_select,
                        ads_select: ads_select,
                        view_select: view_select,
                        model_select: model_select,
                        text_select: text_select,
                        '_token': '{{csrf_token()}}'
                    },
                    success: function (data, textStatus, jqXHR) {
                        if (data.status) {
                            $("#newest_div").html(data.view);
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                    }
                });
            });
            $("#ads_select"), change(function () {
                $.ajax({
                    method: "POST",
                    url: '{{url("/")}}/ads_select',
                    dataType: 'json',
                    data: {
                        id: id,
                        checked: checked,
                        '_token': '{{csrf_token()}}'
                    },
                    success: function (data, textStatus, jqXHR) {
                        if (data.status) {

                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                    }
                });
                $("#newest_div").html();
            });
            $("#view_select"), change(function () {
                $.ajax({
                    method: "POST",
                    url: '{{url("/")}}/system/change',
                    dataType: 'json',
                    data: {
                        id: id,
                        checked: checked,
                        '_token': '{{csrf_token()}}'
                    },
                    success: function (data, textStatus, jqXHR) {
                        if (data.status) {

                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                    }
                });
                $("#newest_div").html();
            });
            $("#model_select"), change(function () {
                $.ajax({
                    method: "POST",
                    url: '{{url("/")}}/system/change',
                    dataType: 'json',
                    data: {
                        id: id,
                        checked: checked,
                        '_token': '{{csrf_token()}}'
                    },
                    success: function (data, textStatus, jqXHR) {
                        if (data.status) {

                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                    }
                });
                $("#newest_div").html();
            });
        });
    </script>
@endsection