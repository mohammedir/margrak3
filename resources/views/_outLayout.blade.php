<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{$title}}</title>
    <meta name="description" content="An interactive getting started guide for Brackets2.">
    <link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/droidarabickufi.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/droidarabickufi.css">
    <link rel="stylesheet" href="{{url("/")}}/assets/css/bootstrap-arabic.min.css">

    <link rel="stylesheet" href="{{url("/")}}/assets/css/font-awesome.min.css">
    <link rel="icon" href="https://www.templatemonster.com/favicon.ico">
    <link rel="stylesheet" type="text/css" media="all" href="{{url("/")}}/assets/css/jquery.minicolors.css">
    <link rel="stylesheet" href="{{url("/")}}/assets/main.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
          type="text/css"/>

    <style>
        <?php
               $WEBSITE_COLOR = \App\Helper\Helper::getSystemRecord("WEBSITE_COLOR");
               ?>

               @if($WEBSITE_COLOR->s_value != "")
             .navbar-default {
            background-color: {{$WEBSITE_COLOR->s_value}};
        }

        .dropdown-menu li {
            border-bottom: 1px solid {{$WEBSITE_COLOR->s_value}};
        }

        .dropdown-menu > li > a {
            background: #fff;
            color: {{$WEBSITE_COLOR->s_value}};
        }

        .name-info {
            border-bottom: 4px solid {{$WEBSITE_COLOR->s_value}};
        }

        .navbar-default .navbar-nav > .open > a, .navbar-default .navbar-nav > .open > a:focus, .navbar-default .navbar-nav > .open > a:hover {
            color: {{$WEBSITE_COLOR->s_value}};
        }

        a.dropdown-toggle:hover, a.dropdown-toggle:focus {
            color: {{$WEBSITE_COLOR->s_value}};
        }

        .left-content-title {
            background: {{$WEBSITE_COLOR->s_value}};
        }

        .product-title p {
            background: {{$WEBSITE_COLOR->s_value}};
        }

        .navbar-default .navbar-nav > li > a:focus, .navbar-default .navbar-nav > li > a:hover,
        .nav .open > a, .nav .open > a:focus, .nav .open > a:hover {
            background-color: #fff;
            color: {{$WEBSITE_COLOR->s_value}};
        }

        a.dropdown-toggle:hover i,
        a.dropdown-toggle:hover span,
        a.dropdown-toggle:focus i,
        a.dropdown-toggle:focus span {
            color: {{$WEBSITE_COLOR->s_value}}                        !important;
        }

        .navbar-default .navbar-nav > li > a:focus, .navbar-default .navbar-nav > li > a:hover,
        .nav .open > a, .nav .open > a:focus, .nav .open > a:hover {
            background-color: #fff;
            color: {{$WEBSITE_COLOR->s_value}} ;
        }

        .dropdown-menu > li > a:focus, .dropdown-menu > li > a:hover {
            color: {{$WEBSITE_COLOR->s_value}} ;
        }

        .sp-color {
            color: {{$WEBSITE_COLOR->s_value}}                        !important;
        }

        #move_to_souq_btn {
            background-color: {{$WEBSITE_COLOR->s_value}}                        !important;
        }

        #search_btn {
            background-color: {{$WEBSITE_COLOR->s_value}}                        !important;
        }

        @else
                #move_to_souq_btn {
            background-color: #1371c8 !important;
        }

        #search_btn {
            background-color: #1371c8 !important;
        }

        .sp-color {
            color: #1371c8 !important;
        }

        .dropdown-menu > li > a:focus, .dropdown-menu > li > a:hover {
            color: #1371c8;
        }

        .dropdown-menu li {
            border-bottom: 1px solid #1371c8;
        }

        .dropdown-menu > li > a {
            background: #fff;
            /*color: #1371c8;*/
        }

        a.dropdown-toggle:hover i,
        a.dropdown-toggle:hover span,
        a.dropdown-toggle:focus i,
        a.dropdown-toggle:focus span {
            color: #1371c8 !important;
        }

        a.dropdown-toggle:hover, a.dropdown-toggle:focus {
            color: #1371c8;
        }

        .navbar-default .navbar-nav > .open > a, .navbar-default .navbar-nav > .open > a:focus, .navbar-default .navbar-nav > .open > a:hover {
            color: #1371c8;
        }

        .product-title p {
            background: #1471c8;
        }

        .navbar-default {
            background-color: #1371c8;
        }

        .left-content-title {
            background: #1a78c2;
        }

        .name-info {
            border-bottom: 4px solid #1371c8;
        }

        @endif


        html, body {
            height: 100%;
        }

        ::-webkit-input-placeholder { /* Chrome/Opera/Safari */
            color: #bababa;
        }

        ::-moz-placeholder { /* Firefox 19+ */
            color: #bababa;
        }

        :-ms-input-placeholder { /* IE 10+ */
            color: #bababa;
        }

        :-moz-placeholder { /* Firefox 18- */
            color: #bababa;
        }

        fieldset, label {
            margin: 0;
            padding: 0;
        }

        h1 {
            font-size: 1.5em;
            margin: 10px;
        }

        /****** Style Star Rating Widget *****/

        .rating {
            direction: ltr !important;
            border: none;
            float: left;
        }

        .rating > input {
            display: none;
        }

        .rating > label:before {
            margin: 3px;
            font-size: 1.25em;
            font-family: FontAwesome;
            display: inline-block;
            content: "\f005";
        }

        .rating > .half:before {
            content: "\f089";
            position: absolute;
        }

        .rating > label {
            color: #ddd;
            float: right;
        }

        /***** CSS Magic to Highlight Stars on Hover *****/

        .rating > input:checked ~ label {
            color: #FFD700;
        }

        /* hover previous stars in list */

        .rating > input:checked, /* hover current star when changing rating */
        .rating > input:checked {
            color: #FFED85;
        }

    </style>
    <style>

        .marquee1 {
            width: 100% !important;
            overflow: hidden !important;
            direction: ltr !important;
        }

        .marquee2 {
            width: 100% !important;
            overflow: hidden !important;
            direction: ltr !important;
        }

        .marquee:hover {
            animation-play-state: paused !important
        }

        @import url(https://fonts.googleapis.com/earlyaccess/droidarabickufi.css);
        * {
            font-family: 'Droid Arabic Kufi', sans-serif;
        }
    </style>


</head>
<body>

@if(session('s_msg'))
    <div class="alert alert-success alert-dismissible text-center"
         style="top:0; position: absolute;width: 100%;z-index: 1;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ session('s_msg') }}
    </div>
@endif
@if(session('e_msg'))
    <div class="alert alert-danger alert-dismissible text-center"
         style=" top:0;position: absolute;width: 100%;z-index: 1;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ session('e_msg') }}
    </div>
@endif
<header>
    <div class="logo">
        <?php
        $website_logo = \App\Helper\Helper::getSystemRecord("website_logo");
        ?>

        @if($website_logo->s_value != "")
            <a title="مرحبا بك في متجرك " id="logo_pic" style="cursor: pointer !important;"
               href="{{url("/")}}/newest"><img style="cursor: pointer !important;"
                                               height="100px"
                                               src="{{url("/")}}/uploads/{{$website_logo->s_value}}"
                                               alt=""></a>
        @endif
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#logo_pic").on("contextmenu", function (e) {
                return false;
            });
        });
    </script>

    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        @if(Auth::user())
                            <a href="#" class="dropdown-toggle normal-men" data-toggle="dropdown" role="button"
                               aria-haspopup="true" aria-expanded="false">

                                <i class="fa fa-user"></i>
                                @if( \App\Helper\Helper::getNotificationsCount1(Auth::user()->pk_i_id,1) != 0)
                                    <span class="num"> {{ \App\Helper\Helper::getNotificationsCount1(Auth::user()->pk_i_id,1) }} </span>
                                @endif
                                <i class="fa fa-envelope"></i>
                                <span>{{Auth::user()->s_username}}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{url("/")}}/v_messages">
                                        @if( \App\Helper\Helper::getNotificationsCount1(Auth::user()->pk_i_id,1) != 0)

                                            <span
                                                    class="num"> {{ \App\Helper\Helper::getNotificationsCount1(Auth::user()->pk_i_id,1) }} </span>
                                        @endif

                                        <i
                                                class="fa fa-envelope"></i> لديك
                                        {{ \App\Helper\Helper::getNotificationsCount1(Auth::user()->pk_i_id,1) }} رسالة
                                        خاصة </a>
                                </li>
                                <li>
                                    <a href="{{url("/")}}/my-adds/">إعلاناتي </a>
                                </li>
                                @if(Auth::user()->fk_i_role_id == 96)
                                    <li>
                                        <a href="{{url("/")}}/categories">لوحة التحكم</a>
                                    </li>
                                @endif
                                <li>
                                    <a href="{{url("/")}}/editAccount">بيانات الحساب </a>
                                </li>
                                <li>
                                    <a href="{{url("/")}}/logout">تسجيل خروج </a>
                                </li>

                            </ul>
                        @else
                            <a href="{{url("/")}}/login" class="dropdown-toggle normal-men" role="button"
                            >
                                <i class="fa fa-sign-in"></i>
                                <span>تسجيل دخول </span>
                            </a>
                        @endif

                    </li>
                </ul>

                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle normal-men" data-toggle="dropdown" role="button"
                           aria-haspopup="true" aria-expanded="false">
                            @if(Auth::user())
                                @if( \App\Helper\Helper::getNotificationsCount(Auth::user()->pk_i_id,0) != 0)

                                    <span class="num">

                                    {{ \App\Helper\Helper::getNotificationsCount(Auth::user()->pk_i_id,0) }}

                            </span>
                                @endif
                            @endif
                            <i class="fa fa-bell"></i>
                            <span>التنبيهات</span>
                        </a>
                        @if(Auth::user())
                            <ul class="dropdown-menu">
                                <?php
                                $messages = \App\Helper\Helper::getNotifications(Auth::user()->pk_i_id, 0);
                                ?>
                                @foreach($messages as $m)
                                    <li>
                                        <a href="{{url("/")}}/readNotification/{{$m->t_notification_id}}">
                                            <i class="fa fa-bell"></i>
                                            <span class="sp-color">{{$m->s_url_msg}}</span>
                                        </a>
                                    </li>
                                @endforeach
                                <li>
                                    <a href="{{url("/")}}/view_notification">
                                        <i class="fa fa-bell"></i>
                                        <span class="sp-color">عرض الكل</span>
                                    </a>
                                </li>
                            </ul>
                        @endif
                    </li>
                </ul>
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle normal-men" data-toggle="dropdown" role="button"
                           aria-haspopup="true" aria-expanded="false">
                            @if(Auth::user())
                                @if( \App\Helper\Helper::getNotificationsCount(Auth::user()->pk_i_id,2) != 0)
                                    <span class="num">

                                    {{ \App\Helper\Helper::getNotificationsCount(Auth::user()->pk_i_id,2) }}

                            </span>
                                @endif
                            @endif
                            <i class="fa fa-heart"></i>
                            <span>المفضلة</span>
                        </a>
                        @if(Auth::user())
                            <ul class="dropdown-menu">
                                <?php
                                $messages = \App\Helper\Helper::getNotifications(Auth::user()->pk_i_id, 2);
                                ?>
                                @foreach($messages as $m)
                                    <li>
                                        <a href="{{url("/")}}/{{$m->s_url}}">
                                            <i class="fa fa-heart"></i>
                                            <span class="sp-color">{{$m->s_url_msg}}</span>
                                        </a>
                                    </li>
                                @endforeach
                                <li>
                                    <a href="{{url("/")}}/view_favorites">
                                        <i class="fa fa-bell"></i>
                                        <span class="sp-color">عرض الكل</span>
                                    </a>
                                </li>
                            </ul>
                        @endif
                    </li>
                </ul>
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle normal-men" data-toggle="dropdown" role="button"
                           aria-haspopup="true" aria-expanded="false">
                            @if(Auth::user())
                                @if( \App\Helper\Helper::getNotificationsCount(Auth::user()->pk_i_id,3) != 0)

                                    <span class="num-orange">

                                    {{ \App\Helper\Helper::getNotificationsCount(Auth::user()->pk_i_id,3) }}

                            </span>
                                @endif
                            @endif
                            <i class="fa fa-forumbee"></i>
                            <span>المتابعة</span>
                        </a>
                        @if(Auth::user())
                            <ul class="dropdown-menu">
                                <?php
                                $messages = \App\Helper\Helper::getNotifications(Auth::user()->pk_i_id, 3);
                                ?>
                                @foreach($messages as $m)
                                    <li>
                                        <a href="{{url("/")}}/{{$m->s_url}}">
                                            <i class="fa fa-forumbee"></i>
                                            <span class="sp-color">{{$m->s_url_msg}}</span>
                                        </a>
                                    </li>
                                @endforeach
                                <li>
                                    <a href="{{url("/")}}/view_follows">
                                        <i class="fa fa-bell"></i>
                                        <span class="sp-color">عرض الكل</span>
                                    </a>
                                </li>

                            </ul>
                        @endif
                    </li>
                </ul>
                {{--<ul class="nav navbar-nav">--}}
                {{--<li class="dropdown">--}}
                {{--<a href="#" class="dropdown-toggle normal-men" data-toggle="dropdown" role="button"--}}
                {{--aria-haspopup="true" aria-expanded="false">--}}
                {{--<span>{{Auth::user()->s_username}}</span>--}}
                {{--</a>--}}
                {{--<ul class="dropdown-menu">--}}
                {{--@if(Auth::user()->fk_i_role_id == 96)--}}
                {{--<li>--}}
                {{--<a href="#">--}}
                {{--<span class="sp-color"> <a--}}
                {{--href="{{url("/")}}/categories">لوحة التحكم</a></span>--}}
                {{--</a>--}}
                {{--</li>--}}
                {{--@endif--}}
                {{--<li>--}}
                {{--<a href="#">--}}
                {{--<span class="sp-color"> <a href="{{url("/")}}/logout">تسجيل الخروج</a></span>--}}
                {{--</a>--}}
                {{--</li>--}}
                {{--</ul>--}}
                {{--</li>--}}
                {{--</ul>--}}
            </div><!-- /.navbar-collapse -->

        </div><!-- /.container -->
    </nav>

    <div class="header-buttons text-center">
        <div class="container">
            <div class="right-btn">
                @if(session("user_id"))
                    <a href="{{url("/")}}/requestAdd" class="btn btn-success">أضف إعلانك</a>
                @else
                    <a href="{{url("/")}}/register" class="btn btn-success">حساب جديد </a>
                @endif
            </div>
            <div class="push-left">
            </div>
            <div class="row">
                <div class="hovermenu ttmenu dark-style menu-color-gradient">
                    <div class="navbar navbar-default new-nav" role="navigation">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                    data-target="#bs-example-navbar-collapse-2" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-2">
                            <ul class="nav navbar-nav">
                                <?php
                                $SHOW_HIDE_SOUQ_BTN = \App\Helper\Helper::getSystemRecord("SHOW_HIDE_SOUQ_BTN");
                                $primCategory = \App\Helper\Helper::getParentForTppBtn("b_show_in_souq_menu");
                                ?>
                                @if($SHOW_HIDE_SOUQ_BTN->s_value == 1)
                                    <li class="dropdown ttmenu-full"><a href="{{url("/")}}/market"

                                                                        class="dropdown-toggle mega-men">السوق</a>
                                        <ul class="dropdown-menu">
                                            <li style="z-index: 100000">
                                                <div class="ttmenu-content">
                                                    <div class="row">
                                            <?php
                                            $cols = 0;
                                            $rows = 0;

                                            foreach($primCategory as $p){
                                            if ($cols >= 5) {
                                                break;
                                            }
                                            ?>

                                            @if($rows == 0 || $rows == 16)
                                                @if($cols !=0)
                                        </ul>
                        </div><!-- end box -->
                    </div><!-- end col -->
                    @endif
                    <div class="col-md-3">
                        <div class="box">
                            <ul>
                                <?php
                                $cols++;
                                ?>
                                @endif
                                <?php
                                $rows++;
                                ?>

                                <li><p>{{$p->s_name_ar}}</p></li>
                                @foreach ($p->getChilds as $c1)
                                    <?php
                                    foreach ($c1->getChilds as $c2){
                                    ?>
                                    @if($c2->b_show_in_souq_menu == 1)
                                        <?php
                                        $rows++;
                                        ?>
                                        @if($rows == 16 && $cols < 4)
                                            <?php
                                            $cols++;
                                            $rows = 1;
                                            ?>
                            </ul>
                        </div><!-- end box -->
                    </div><!-- end col -->
                    <div class="col-md-3">
                        <div class="box">
                            <ul>
                                @endif
                                <li>
                                    <a href="{{url("/")}}/newest?cat={{$c2->pk_i_id}}">{{$c2->s_name_ar}}
                                    </a></li>
                                <?php
                                if ($cols >= 5) {
                                    break;
                                }
                                ?>
                                @endif
                                <?php
                                }
                                ?>
                                @endforeach
                                <?php } ?>
                            </ul>
                        </div><!-- end box -->
                    </div><!-- end col -->

                </div><!-- end row -->
            </div><!-- end ttmenu-content -->
            </li>
            </ul>
            </li><!-- end mega menu -->
            @endif
            <?php
            $SHOW_HIDE_NEWST_BTN = \App\Helper\Helper::getSystemRecord("SHOW_HIDE_NEWST_BTN");
            $primCategory = \App\Helper\Helper::getParentForTppBtn("b_show_in_newest_menu");
            ?>
            @if($SHOW_HIDE_NEWST_BTN->s_value == 1)
                <li class="dropdown ttmenu-full"><a href="{{url("/")}}/newest"
                                                    class="dropdown-toggle mega-men">الاحدث</a>
                    <ul class="dropdown-menu">
                        <li style="z-index: 100000">
                            <div class="ttmenu-content">
                                <div class="row">
                        <?php
                        $cols = 0;
                        $rows = 0;

                        foreach($primCategory as $p){
                        if ($cols >= 5) {
                            break;
                        }
                        ?>
                        @if($rows == 0 || $rows == 16)
                            @if($cols !=0)
                    </ul>
        </div><!-- end box -->
    </div><!-- end col -->
    @endif
    <div class="col-md-3">
        <div class="box">
            <ul>
                <?php
                $cols++;
                ?>
                @endif
                <?php
                $rows++;
                ?>

                <li><p>{{$p->s_name_ar}}</p></li>
                @foreach ($p->getChilds as $c1)
                    <?php
                    foreach ($c1->getChilds as $c2){
                    ?>
                    @if($c2->b_show_in_newest_menu == 1)
                        <?php
                        $rows++;
                        ?>
                        @if($rows == 16 && $cols < 4)
                            <?php
                            $cols++;
                            $rows = 1;
                            ?>
            </ul>
        </div><!-- end box -->
    </div><!-- end col -->
    <div class="col-md-3">
        <div class="box">
            <ul>
                @endif
                <li>
                    <a href="{{url("/")}}/newest?cat={{$c2->pk_i_id}}">{{$c2->s_name_ar}}
                    </a></li>
                <?php
                if ($cols >= 5) {
                    break;
                }
                ?>
                @endif
                <?php
                }
                ?>
                @endforeach
                <?php } ?>
            </ul>
        </div><!-- end box -->
    </div><!-- end col -->

    </div><!-- end row -->
    </div><!-- end ttmenu-content -->
    </li>
    </ul>
    </li><!-- end mega menu -->
    @endif
    </ul><!-- end nav navbar-nav -->

    </div><!--/.nav-collapse -->
    </div><!-- end navbar navbar-default clearfix -->
    </div><!-- end menu 1 -->
    </div>
    </div>
    </div>
    <?php
    $NEW_REQUEST_BAR = \App\Helper\Helper::getSystemRecord("NEW_REQUEST_BAR");
    $NEW_REQUEST_BAR1 = \App\Helper\Helper::getSystemRecord("NEW_REQUEST_BAR_For_Souq");
    $announcement = \App\Helper\Helper::getLastAnnouncement();
    ?>
    @if($announcement)
        <div class="bottom-head">
            <div class="title" style="text-align: center;">
                <p>{{$announcement->s_title}}</p>
            </div>
        </div>
    @endif

    <?php
    $NEW_ADS_BAR = \App\Helper\Helper::getSystemRecord("NEW_ADS_BAR");
    $NEW_ADS_BAR1 = \App\Helper\Helper::getSystemRecord("NEW_ADS_BAR_For_Souq");
    $NEW_REQUEST_ary = \App\Helper\Helper::get_NEW_REQUEST_ary();
    $NEW_Offer_ary = \App\Helper\Helper::get_NEW_Offer_ary();

    ?>
    @if($title == "الأحدث")
        @if($NEW_ADS_BAR->s_value == 1)
            <div class="bottom-head">
                <div class="title">
                    <p>أحدث إعلانات العرض</p>
                </div>

                <div class="marquee1">
                    @foreach($NEW_Offer_ary as $c)
                        <a style="color:#767676 !important;"
                           href="{{url("/")}}/newest/show/{{$c->pk_i_id}}/{{str_replace(" ","-",trim($c->s_title_ar))}}">
                            <?php
                            $z = 0;
                            foreach ($c->getPicsData as $p) {
                            ?>
                            <div style="height:85px;width: 170px;background-color: #fcfcfc;display: inline-block;text-align: center">
                                <img style="cursor: pointer !important;" height="80px"
                                     src="{{url("/")}}/uploads/{{$p->s_value}}">
                            </div>
                            <?php
                            $z++;
                            break;
                            }
                            ?>
                        </a>

                    @endforeach
                </div>

            </div>
        @endif
        @if($NEW_REQUEST_BAR->s_value == 1)
            <div class="bottom-head" style="border-bottom: 1px solid #999999;padding-bottom: 10px">
                <div class="title">
                    <p>أحدث إعلانات الطلب</p>
                </div>
                <div class="marquee2">
                    @foreach($NEW_REQUEST_ary as $c)
                        <a href="{{url("/")}}/accountDetails/{{$c->getTheNameOfCreator->pk_i_id}}"
                           target="_blank"
                           style="font-weight: bold ;:bold;color: #1270ca !important;">{{$c->getTheNameOfCreator->s_username}}
                            : </a><span> <a style="color:#767676 !important;"
                                            href="{{url("/")}}/newest/show/{{$c->pk_i_id}}/{{str_replace(" ","-",trim($c->s_title_ar))}}">{{$c->s_title_ar}}</a> </span>
                        <i class="fa fa-circle move-text"
                           aria-hidden="true"></i>
                    @endforeach
                </div>
            </div>
        @endif


    @endif
    @if($title == "السوق")
        @if($NEW_ADS_BAR1->s_value == 1)
            <div class="bottom-head">
                <div class="title">
                    <p>أحدث إعلانات العرض</p>
                </div>

                <div class="marquee1">
                    @foreach($NEW_Offer_ary as $c)
                        <a style="color:#767676 !important;"
                           href="{{url("/")}}/newest/show/{{$c->pk_i_id}}/{{str_replace(" ","-",trim($c->s_title_ar))}}">
                            <?php
                            $z = 0;
                            foreach ($c->getPicsData as $p) {
                            ?>
                            <div style="height:85px;width: 170px;background-color: #fcfcfc;display: inline-block;text-align: center">
                                <img style="cursor: pointer !important;" height="80px"
                                     src="{{url("/")}}/uploads/{{$p->s_value}}">
                            </div>
                            <?php
                            $z++;
                            break;
                            }
                            ?>
                        </a>

                    @endforeach
                </div>

            </div>
        @endif
        @if($NEW_REQUEST_BAR1->s_value == 1)
            <div class="bottom-head" style="border-bottom: 1px solid #999999;padding-bottom: 10px">
                <div class="title">
                    <p>أحدث إعلانات الطلب</p>
                </div>
                <div class="marquee2">
                    @foreach($NEW_REQUEST_ary as $c)

                        <div style="float: right;display: inline">
                            <div style="display: inline">
                                <a style="color:#767676 !important;"
                                   href="{{url("/")}}/newest/show/{{$c->pk_i_id}}/{{str_replace(" ","-",trim($c->s_title_ar))}}">{{$c->s_title_ar}}</a>

                            </div>
                            <div style="display: inline">
                                <a href="{{url("/")}}/accountDetails/{{$c->getTheNameOfCreator->pk_i_id}}"
                                   target="_blank"
                                   style="font-weight: bold ;:bold;color: #1270ca !important;">{{$c->getTheNameOfCreator->s_username}}
                                </a>

                            </div>
                            <i class="fa fa-circle move-text"
                               aria-hidden="true"></i>

                        </div>
                    @endforeach
                </div>
            </div>
        @endif


    @endif
</header>
<?php
$AD_SPACE_BAR = \App\Helper\Helper::getSystemRecord("AD_SPACE_BAR");
$ADS_SPACE_BAR_COUNT = \App\Helper\Helper::getSystemRecord("ADS_SPACE_BAR_COUNT");
$SpaceArea = \App\Helper\Helper::getSpaceArea(5);
?>
@if($title != 'طلب إعلان' && $title != 'تعديل الإعلان')
    <section class="ads-area" style="margin-top: 30px">
        <div class="container">
            <div class="row">
                @foreach($SpaceArea as $s)
                    <div class="single-ad col-md-2 ">
                        <p><a style="cursor: pointer !important;" href="{{url("/")}}/addurl/{{$s->pk_i_id}}"
                              target="_blank">
                                @if($s->s_pic != "")
                                    <img style="cursor: pointer !important;" width="150px"
                                         src="{{url("/")}}/uploads/{{$s->s_pic}}" alt=""><br>
                                @else
                                    {{$s->s_title}}
                                @endif
                            </a>
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endif

<?php
$SHOW_HIDE_SIDEBAR = \App\Helper\Helper::getSystemRecord("SHOW_HIDE_SIDEBAR");
$SHOW_HIDE_SIDEBAR_ADD_ADS_BTN = \App\Helper\Helper::getSystemRecord("SHOW_HIDE_SIDEBAR_ADD_ADS_BTN");
$SHOW_HIDE_SIDEBAR_GOTO_SOUQ_BTN = \App\Helper\Helper::getSystemRecord("SHOW_HIDE_SIDEBAR_GOTO_SOUQ_BTN");
$primCategory = \App\Helper\Helper::getParentForTppBtn("b_in_sidebar");
?>

@if(isset($newest_flag))
    <div class="row">
        <div class="search-bar bordered text-center">
            <div class="row">
                <div class="col-md-3 col-xs-3"></div>
                <div class="col-sm-4 col-xs-12 top">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button class="btn adv_ser" type="button" id="search_btn">بحث</button>
                        </span>
                        <input id="text_select" name="text_select" type="text" class="form-control"
                               placeholder="أكتب نص البحث هنا مثال : هايلكس 2017">
                    </div>
                    <hr>
                </div>
                <div class="col-sm-1 col-xs-12 extra-buttons">
                    <a style="margin-right: 20px" class="adv_ser">بحث متقدم</a>
                </div>
            </div>
        </div>
        <div class="select-area text-center">
            <div class="row">
                <?php
                $COUNTRIES_ADDS = \App\Helper\Helper::getSystemRecord("COUNTRIES_ADDS");
                $Countries = \App\Helper\Helper::getFieldOptions(2);
                ?>
                @if($COUNTRIES_ADDS->s_value == 1)
                    <select id="city_select" class="form-control">
                        <option value="">كل المدن</option>
                        @foreach($Countries as $c)
                            @if(count($c->getChildsb_is_filter) > 0)
                                <optgroup style="color: {{$c->s_color}}" label="{{$c->s_name_ar}}">
                                    @foreach($c->getChildsb_is_filter as $c1)
                                        @if($c1->b_is_filter)
                                            <option style="color: {{$c1->s_color}}"
                                                    value="{{$c1->pk_i_id}}">{{$c1->s_name_ar}}</option>
                                        @endif
                                    @endforeach
                                </optgroup>
                            @endif
                        @endforeach
                    </select>
                @endif
                <?php
                $ADDS_ADDS = \App\Helper\Helper::getSystemRecord("ADDS_ADDS");
                $primCategory = \App\Helper\Helper::getParentForTppBtn("b_is_filter");
                ?>
                @if($ADDS_ADDS->s_value == 1)
                    <select id="ads_select" class="form-control">
                        <option value="">جميع الإعلانات</option>
                        @foreach($primCategory as $c)
                            @if(count($c->getChilds) > 0)
                                <?php
                                $flag = false;
                                foreach ($c->getChilds as $c1) {
                                    foreach ($c1->getChilds as $c2) {
                                        if ($c2->b_is_filter) {
                                            $flag = true;
                                        }
                                    }
                                }
                                ?>
                                @if($flag)
                                    <optgroup label="{{$c->s_name_ar}}">
                                        @foreach($c->getChilds as $c1)
                                            @foreach($c1->getChilds as $c2)
                                                @if($c2->b_is_filter)
                                                    <option style="color:{{$c2->s_color}}"
                                                            @if(isset($cat))
                                                            @if($cat == $c2->pk_i_id)
                                                            selected
                                                            @endif
                                                            @endif
                                                            value="{{$c2->pk_i_id}}">{{$c2->s_name_ar}}</option>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </optgroup>

                                @endif
                            @endif
                        @endforeach
                    </select>
                @endif
                <?php
                $VIEW_ASK_ADDS = \App\Helper\Helper::getSystemRecord("VIEW_ASK_ADDS");
                $VIEW_ASK_ADDS_ary = \App\Helper\Helper::getFieldOptions(4);
                ?>
                @if($VIEW_ASK_ADDS->s_value == 1)
                    <select id="view_select" class="form-control">
                        <option value="">العرض و الطلب</option>
                        @foreach($VIEW_ASK_ADDS_ary as $v)

                            <option style="color:
                            @if($v->pk_i_id == 12)
                                    #337ab7
                            @else
                                    #009879
                            @endif" value="{{$v->pk_i_id}}">{{$v->s_name_ar}}</option>
                        @endforeach
                    </select>
                @endif
                <?php
                $MODEL_ADDS = \App\Helper\Helper::getSystemRecord("MODEL_ADDS");
                $MODEL_ADDS_ary = \App\Helper\Helper::getFieldOptions(1);
                ?>
                @if($MODEL_ADDS->s_value == 1)
                    <select id="model_select" class="form-control">
                        <option value="">الموديل</option>
                        @foreach($MODEL_ADDS_ary as $v)
                            <option value="{{$v->pk_i_id}}">{{$v->s_name_ar}}</option>
                        @endforeach
                    </select>
                @endif
            </div>
        </div>
    </div>
@endif
@if($SHOW_HIDE_SIDEBAR->s_value == 1)
    <section class="content">
        <div class="row">
            @yield("body")
        </div>
        </div>
        </div>
    </section>
@endif
<footer class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-6">
        <div class="icon-line">
            <a href="{{url("/")}}/coinspage">
                <img src="{{url("/")}}/assets/img/Star%20Filled_48px.png">
                <p>احسب عمولة الموقع</p>
            </a>
        </div>
        <div class="icon-line">
            <a href="{{url("/")}}/blacklistpage">
                <img src="{{url("/")}}/assets/img/Star%20Filled_48px.png">
                <p>القائمة السوداء</p>
            </a>
        </div>
        <div class="icon-line">
            <a href="{{url("/")}}/faqpage">
                <img src="{{url("/")}}/assets/img/Star%20Filled_48px.png">
                <p>الأسئلة الشائعة</p>
            </a>
        </div>
        <div class="icon-line">
            <a href="{{url("/")}}/rulespage">
                <img src="{{url("/")}}/assets/img/Star%20Filled_48px.png">
                <p>القوانين</p>
            </a>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="icon-line">
            <a href="{{url("/")}}/contact?type=1">
                <img src="{{url("/")}}/assets/img/Star%20Filled_48px.png">
                <p>إرسال إستفسار</p>
            </a>
        </div>
        <div class="icon-line">
            <a href="{{url("/")}}/contact?type=2">
                <img src="{{url("/")}}/assets/img/Star%20Filled_48px.png">
                <p>إرسال إقتراح</p>
            </a>
        </div>
        <div class="icon-line">
            <a href="{{url("/")}}/contact?type=3">
                <img src="{{url("/")}}/assets/img/Star%20Filled_48px.png">
                <p>إرسال شكوى</p>
            </a>
        </div>
    </div>
</footer>
<form id="msg_form" action="{{url("/")}}/send_msg" method="post">
    {{csrf_field()}}
    <div id="message_modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-l" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">إرسال رسالة</h4>
                </div>
                <div class="modal-body">
                    <p>يرجى إدخال نص الرسالة</p>
                    <textarea class="form-control" style="width: 100%;" id="msg" name="msg" cols="10"
                              rows="10"></textarea>
                    <div id="msg_validate" style="color:red"></div>
                    <input type="hidden" id="sender" name="sender">
                    <input type="hidden" id="reciver" name="reciver">
                </div>
                <div class="modal-footer">
                    @if(Auth::user())
                        <button type="button" class="btn btn-default" data-dismiss="modal">إلغاء</button>
                        <input type="submit" class="btn btn-primary" value="إرسال">
                    @else
                        <p style="color:red">لإرسال رسالة يرجى <a href="{{url("/")}}/login">تسجيل الدخول</a>
                    @endif
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</form>
<form id="msg_form1" action="{{url("/")}}/send_msg1" method="post">
    {{csrf_field()}}
    <input type="hidden" name="subject_id_msg" id="subject_id_msg_mtger">
    <input type="hidden" name="department_id_msg" id="department_id_msg_mtger">
    <input type="hidden" name="mtger_id_msg" id="mtger_id_msg_mtger">
    <div id="message_modal_mtger" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-l" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">إرسال رسالة</h4>
                </div>
                <div class="modal-body">
                    @if(Auth::user())
                        <input type="hidden" name="flag_auth" value="true">
                    @else
                        <input type="hidden" name="flag_auth" value="false">
                        <p>الإسم</p>
                        <input type="text" class="form-control" name="username_msg_mtger">
                        <p>رقم الجوال</p>
                        <input type="text" class="form-control" name="mobile_msg_mtger">
                    @endif
                    <p>يرجى إدخال نص الرسالة</p>
                    <textarea class="form-control" style="width: 100%;" id="msg" name="msg" cols="10"
                              rows="10"></textarea>
                    <div id="msg_validate" style="color:red"></div>
                    <input type="hidden" id="reciver_mtger" name="reciver">
                    <input type="hidden" id="sender_mtger" name="sender">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">إلغاء</button>
                    <input type="submit" class="btn btn-primary" value="إرسال">
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</form>
<div id="Confirm" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">رسالة تأكيد</h4>
            </div>
            <div class="modal-body">
                <p>هل أنت متأكد ؟</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">إلغاء</button>
                <a class="btn btn-danger">نعم متأكد</a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="load_l1" class="hidden">
    <div id="load1" class="modal  fade" style="width: 300px;
                 display: block;
                 position: fixed;
                 top: 30%;
                 left: 32%;">
        <div class="modal-dialog ">
            <div class="modal-content" style="background-color: rgba(0,0,0,0);border: none;
                         box-shadow: none;">

                <div class="modal-body" style="height: 300px;">
                    <i class="fa fa-refresh fa-spin fa-5x fa-fw" style=" font-size: 6em;"></i>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>
<script type="text/javascript" src="{{url("/")}}/assets/js/bootstrap-arabic.min.js"></script>
<script type="text/javascript" src="{{url("/")}}/assets/main.js"></script>
<script type="text/javascript" src="{{url("/")}}/assets/js/jquery.minicolors.min.js"></script>
<script type="text/javascript" src="{{url("/")}}/assets/js/dropzone.js"></script>
<script src="{{url("/")}}/assets/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="{{url("/")}}/assets/js/bootbox.min.js" type="text/javascript"></script>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=jymrfsru2wff5m7tl2uiwc44pn4szt0qokm7lumj89r6kut8"></script>

<script src="https://cdn.jsdelivr.net/jquery.marquee/1.3.1/jquery.marquee.min.js"></script>
<script>
    $(document).on("click", ".Confirm", function () {
        $("#Confirm").modal("show");
        $("#Confirm .btn-danger").attr("href", $(this).attr("href"));
        return false;
    });
</script>
<script>

    $(function () {
        $('.marquee1')
            .marquee({
                duration: 11000,
                gap: 300,
                delayBeforeStart: 0,
                direction: 'right',
                duplicated: true
            }).hover(function () {
            $(this).marquee('resume');
        }).mouseover(function () {
            $(this).marquee('pause');
        });
        $('.marquee2')
            .marquee({
                duration: 11000,
                gap: 300,
                delayBeforeStart: 0,
                direction: 'right',
                duplicated: true
            }).hover(function () {
            $(this).marquee('resume');
        }).mouseover(function () {
            $(this).marquee('pause');

        });


        $(".send_msg").click(function () {
            var sender = $(this).siblings("#sender_id").val();
            var reciver = $(this).siblings("#reciver_id").val();
            $("#sender").val(sender);
            $("#reciver").val(reciver);
            $("#message_modal").modal("show");
        });

        $(".send_msg_mtger").click(function () {
            var sender = $(this).siblings("#sender_id").val();
            var reciver = $(this).siblings("#reciver_id").val();
            $("#department_id_msg_mtger").val($(this).siblings("#department").val());
            $("#subject_id_msg_mtger").val($(this).siblings("#subject").val());
            $("#mtger_id_msg_mtger").val($(this).siblings("#mtger").val());
            $("#sender_mtger").val(sender);
            $("#reciver_mtger").val(reciver);
            $("#message_modal_mtger").modal("show");
        });
        $('#msg_form').validate({
            rules: {
                msg: {
                    required: true,
                },
            },
            errorPlacement: function (error, element) {
                var name = $(element).attr("name");
                error.appendTo($("#" + name + "_validate"));
            },
            messages: {
                msg: {
                    required: "حقل مطلوب",
                },
            }, submitHandler: function (form) {
                form.submit();
            }
        });
        $('#msg_form1').validate({
            rules: {
                msg: {
                    required: true,
                },
            },
            errorPlacement: function (error, element) {
                var name = $(element).attr("name");
                error.appendTo($("#" + name + "_validate"));
            },
            messages: {
                msg: {
                    required: "حقل مطلوب",
                },
            }, submitHandler: function (form) {
                form.submit();
            }
        });
    });
</script>
</body>
</html>
