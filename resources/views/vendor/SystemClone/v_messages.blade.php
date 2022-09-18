@extends("_outLayout")
@section("body")
    <div class="row">
        <div class="right-comment-b">
            <p class="top-pa text-center"><a>جميع الرسائل</a></p>
            <div class="bottom-pa">
                <div class="row">
                    <div class="col-md-offset-1 col-md-10">
                        <?php
                        $messages = \App\Helper\Helper::getNotifications12(Auth::user()->pk_i_id, 1);
                        ?>
                        @foreach($messages as $m)
                                <a href="{{url("/")}}/delete_msg/{{$m->getSenderDetails->pk_i_id}}" class="btn btn-danger Confirm">حذف
                                    المحادثة</a>
                                <a href="{{url("/")}}/{{$m->s_url}}">
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
        </div>
    </div>
@endsection