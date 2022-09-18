@extends("_outLayout")
@section("body")
    <?php
    $mtgers = \App\Helper\Helper::getFromConstant12("MATAGER", 127);
    $SHOW_HIDE_SIDEBAR = \App\Helper\Helper::getSystemRecord("SHOW_HIDE_SIDEBAR_CATEGORY_PAGE");
    $SHOW_HIDE_SIDEBAR_NEWST_PAGE = \App\Helper\Helper::getSystemRecord("SHOW_HIDE_SIDEBAR_NEWST_PAGE");
    $SHOW_HIDE_SIDEBAR_ADD_ADS_BTN = \App\Helper\Helper::getSystemRecord("SHOW_HIDE_SIDEBAR_ADD_ADS_BTN");
    $SHOW_HIDE_SIDEBAR_GOTO_SOUQ_BTN = \App\Helper\Helper::getSystemRecord("SHOW_HIDE_SIDEBAR_GOTO_SOUQ_BTN");
    $primCategory = \App\Helper\Helper::getParentForTppBtn("b_in_sidebar");
    ?>
    <div class="row">
        <div class="right-content col-md-2">
            @if($SHOW_HIDE_SIDEBAR->s_value == 1)
                @if($SHOW_HIDE_SIDEBAR_NEWST_PAGE->s_value == 1)
                    <div class="content-btn text-center">
                        @if($SHOW_HIDE_SIDEBAR_ADD_ADS_BTN->s_value == 1)
                            <a href="{{url("/")}}/requestAdd" class="content-btn-1 btn btn-success">اضف إعلانك</a>
                        @endif
                        @if($SHOW_HIDE_SIDEBAR_GOTO_SOUQ_BTN->s_value == 1)
                            <a href="{{url("/")}}/market" class="content-btn-1 btn btn-primary " id="move_to_souq_btn"> السوق</a>
                        @endif
                        @foreach($mtgers as $m)
                            <a style="background-color: {{$m->s_extra_1}} !important;"
                               href="{{url("/")}}/mtger/{{$m->pk_i_id}}"
                               class="content-btn-1 btn btn-primary " id="move_to_souq_btn">{{$m->s_name_ar}}</a>
                        @endforeach
                    </div>
                    <?php
                    $primCategory = \App\Helper\Helper::getParentForTppBtn("b_in_sidebar");
                    ?>
                    <br>
                    <div class="products text-center">
                        <?php $counter = 0;?>
                        @foreach($primCategory as $c)
                            @if(count($c->getChildsForSide)>0)
                                <div class="products-box1">
                                    <div class="product-title">
                                        <p class="side_bar" data-toggle="collapse" aria-expanded="false"
                                           aria-controls="name_{{$counter}}"
                                           href="#name_{{$counter}}"
                                           style="text-align:right !important;background-color: #eeeeee!important;color: #545454!important;">
                                            {{--<i class="fa fa-plus icon"></i>--}}
                                            {{$c->s_name_ar}}</p>
                                    </div>
                                    <div
                                            {{--id="name_{{$counter}}" class="collapse"--}}
                                    >
                                        <div class="product-pic">
                                            <div class="product-pic-line row">
                                                @foreach($c->getChildsForSide as $c1)
                                                    @foreach($c1->getChildsForSide as $c2)
                                                        <div class="single-product col-xs-3">
                                                            <a style="cursor: pointer!important;" href="{{url("/")}}/newest?cat={{$c2->pk_i_id}}">
                                                                @if($c2->s_sidebar_pic != "")
                                                                    <img style="cursor: pointer!important;" src="{{url("/")}}/uploads/{{$c2->s_sidebar_pic}}"
                                                                         width="100%" height="100%">
                                                                @elseif($c2->s_pic != "")
                                                                    <img style="cursor: pointer!important;" src="{{url("/")}}/uploads/{{$c2->s_pic}}"
                                                                         width="100%" height="100%">
                                                                @else
                                                                    {{$c2->s_name_ar}}
                                                                @endif
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <?php $counter++;?>
                        @endforeach
                    </div>
                @endif
            @endif
        </div>
        <div class="left-content col-md-10">
            @if(isset($tags_ary))
                <div class="row">
                    <div id="tags_div" style="background-color: white !important;" class="">

                        @foreach($tags_ary as $c2)
                            <div style="float: right;margin-top:0px !important;" class="types-show">
                                <a style="padding-left: 3px !important;padding-right: 3px !important;margin-left: 5px"
                                   href="{{url("/")}}/newest?cat={{$c2->fk_i_ads_user_id}}&tag_text={{$c2->key_word}}">{{$c2->key_word}}</a>
                            </div>

                        @endforeach
                    </div>
                </div>
                <div class="left-content-title text-center row">
                    <div class="col-xs-9">
                        <p>احدث المواضيع</p>
                    </div>
                    <div class="col-md-3 hidden-sm hidden-xs">
                        <p>بيانات الاعلان</p>
                    </div>
                </div>

            @else
                <div class="row">
                    <div id="tags_div" style="background-color: white !important;" class="">

                    </div>
                </div>

                <div class="left-content-title text-center row">
                    <div class="col-xs-9">
                        <p>احدث المواضيع</p>
                    </div>
                    <div class="col-md-3 hidden-sm hidden-xs">
                        <p>بيانات الاعلان</p>
                    </div>
                </div>
            @endif
            <div class="left-content-show">
                <div id="newest_div" style="    border-top: solid 1px #dcdcdc;">
                    <?php $y = 0; ?>
                    @foreach($user_ads as $c)
                        <div class="single-line {{$y %2 != 0 ? "color" : ""}} row">
                            <?php $y++; ?>
                            <div class="col-md-9 col-xs-9 col-sm-9">
                                <p>
                                    <a style="font-weight: bold;font-size: 16pt;
                                    @if($c->i_type == 1)
                                            color:#019679;
                                    @else
                                            color:#337ab7;
                                    @endif
                                            "
                                       href="{{url("/")}}/newest/show/{{$c->pk_i_id}}/{{str_replace(" ","-",trim($c->s_title_ar))}}">{{$c->s_title_ar}}</a>
                                </p>
                                <?php
                                $i = 0;
                                foreach($c->getPicsData as $p){

                                if ($i == 4) {
                                    break;
                                }
                                $i++;
                                ?>

                                <img src="{{url("/")}}/uploads/{{$p->s_value}}">
                                <?php } ?>
                                @if(count($c->getPicsData) > 4)
                                    <a href="{{url("/")}}/newest/show/{{$c->pk_i_id}}/{{str_replace(" ","-",trim($c->s_title_ar))}}"
                                       class="else">المزيد</a>
                                @endif
                                <div class="left-btn">
                                    @if($c->i_is_featured == 1)
                                        <a class="btn brown-btn" style="cursor: default !important;">مثبت</a>
                                    @endif
                                    @if($c->i_type == 1)

                                        <a class="btn blue-btn" style="cursor: default !important;">
                                            عرض
                                        </a>
                                    @else
                                        <a class="btn btn-primary" style="cursor: default !important;">
                                            طلب
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-3 col-sm-3 details">
                                <p>كاتب الإعلان: <span style="color:
                                    @if($c->getTheNameOfCreator->fk_i_role_id == 95)
                                            #04ad67;
                                    @elseif($c->getTheNameOfCreator->fk_i_role_id == 96)
                                            red;
                                    @elseif($c->getTheNameOfCreator->fk_i_role_id == 92)
                                            #1271c7;
                                    @endif
                                            ">{{$c->getTheNameOfCreator->s_username}}</span></p>
                                <p>إنشاء الإعلان:
                                    <span>{{(new \Carbon\Carbon($c->dt_created_date))->diffForHumans()}}</span>
                                </p>
                                <p>الموقع:
                                    @if(isset($c->city_field->fieldOption->s_name_ar))

                                        <span style="color:{{$c->getTheNameOfCreator->getCountry->s_color}}">{{$c->city_field->fieldOption->s_name_ar}}</span>
                                    @endif
                                </p>
                                <?php
                                $lastComment = \App\Helper\Helper::getLastComment($c->pk_i_id);
                                ?>
                                @if($lastComment)
                                    <p>آخر مشاركة:
                                        <span style="color:
                                        @if($lastComment->getCommentsUser->fk_i_role_id == 95)
                                                #04ad67;
                                        @elseif($lastComment->getCommentsUser->fk_i_role_id == 96)
                                                red;
                                        @elseif($lastComment->getCommentsUser->fk_i_role_id == 92)
                                                #1271c7;
                                        @endif
                                                ">{{$lastComment->getCommentsUser->s_username}}</span>
                                    </p>
                                @else
                                    <p>آخر مشاركة:
                                        <span>-</span>
                                    </p>
                                @endif
                                <p>الردود: <span>{{count($c->getComments)}}</span></p>
                            </div>
                        </div>
                    @endforeach
                    <div id="more_adds_div0"></div>
                </div>
                <div class="text-center">
                    <button class="btn btn-default more" id="more_adds">إضغط هنا لمشاهدة المزيد</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            var index = 0;
                    @if(count($user_ads)>0)
            var date = "{{$user_ads->last()->dt_created_date}}";
            @endif
            $("#more_adds").click(function () {
                var cat = "{{$cat}}";
                var main = "{{$main}}";
                var prim = "{{$prim}}";
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
                        cat: cat,
                        main: main,
                        prim: prim,
                        city_select: city_select,
                        ads_select: ads_select,
                        view_select: view_select,
                        model_select: model_select,
                        text_select: text_select,
                        index: index,
                        date: date,
                        '_token': '{{csrf_token()}}'
                    },
                    success: function (data, textStatus, jqXHR) {
                        if (data.status) {
                            $("#more_adds_div" + index).html(data.view);
                            date = data.date;
                            index++;
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                    }
                });
            });
            $("#city_select").change(function () {
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
                        index: index,
                        '_token': '{{csrf_token()}}'
                    },
                    success: function (data, textStatus, jqXHR) {
                        if (data.status) {
                            $("#newest_div").html(data.view);
                            index = 0;
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                    }
                });
            });
            $("#ads_select").change(function () {
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
                        index: index,
                        '_token': '{{csrf_token()}}'
                    },
                    success: function (data, textStatus, jqXHR) {
                        if (data.status) {
                            $("#newest_div").html(data.view);
                            $("#tags_div").html(data.view1);
                            index = 0;
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                    }
                });
            });
            $("#view_select").change(function () {
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
                        index: index,
                        '_token': '{{csrf_token()}}'
                    },
                    success: function (data, textStatus, jqXHR) {
                        if (data.status) {
                            $("#newest_div").html(data.view);
                            index = 0;
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                    }
                });
            });
            $("#model_select").change(function () {
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
                        index: index,
                        '_token': '{{csrf_token()}}'
                    },
                    success: function (data, textStatus, jqXHR) {
                        if (data.status) {
                            $("#newest_div").html(data.view);
                            index = 0;
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                    }
                });
            });
            $(".adv_ser").click(function () {
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
                        index: index,
                        '_token': '{{csrf_token()}}'
                    },
                    success: function (data, textStatus, jqXHR) {
                        if (data.status) {
                            $("#newest_div").html(data.view);
                            index = 0;
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                    }
                });
            });
        });
        $('p.side_bar').click(function () {
            $icon = $(this).find('.icon');
            console.clear()
            console.log($icon.parent())
            if ($icon.length > 0) {
                if ($icon.hasClass('fa-plus')) {
                    $icon.removeClass('fa fa-plus icon')
                    $icon.addClass('fa fa-minus icon')
                } else {
                    $icon.removeClass('fa fa-minus icon')

                    $icon.addClass('fa fa-plus icon')
                }
            }

        });
    </script>
@endsection