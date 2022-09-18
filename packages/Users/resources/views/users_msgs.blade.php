@extends("_manageLayout")
@section("body")
    <div class="row">
        <div class="right-comment-b">
            <p class="top-pa text-center"><a>جميع المحادثات</a></p>
            <div class="row" style="background-color: white">
                <a href="{{url("/")}}/users" class="btn btn-default " style="float:left">الرجوع للأعضاء</a>
                <br>
                <?php
                $messages = \App\Helper\Helper::getNotifications12($user_id, 1);
                ?>
                @foreach($messages as $m)
                    <a href="{{url("/")}}/{{$m->s_url}}/{{$user_id}}">
                        <i class="fa fa-user"></i>
                        <span class="sp-color">{{$m->getSenderDetails->s_username}}</span>
                        <span style="color: red">{{(new \Carbon\Carbon($m->dt_created_date))->diffForHumans()}}</span>
                    </a>
                    <br>
                    <br>
                @endforeach
            </div>
        </div>
    </div>
@endsection