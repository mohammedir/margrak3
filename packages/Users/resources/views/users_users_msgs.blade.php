@extends("_manageLayout")
@section("body")
    @if(count($msgs) >0)
    @else
        <p class="top-pa-green text-center">

            لا توجد رسائل
        </p>
    @endif
    <div class="right-comment-b">
        <p class="top-pa text-center"><a>الرسائل</a></p>
        <a href="{{url("/")}}/users_msgs/{{$user_id}}" class="btn btn-default " style="float:left">الرجوع للمحادثات </a>
        <div class="col-md-10">

            @foreach($msgs as $m)
                @if($m->is_deleted != $user_id)
                    <div class=" text-center">
                        <div class="row ">
                            <div class="col-md-3"></div>
                            <div class="right-comment-b col-md-4">
                                <p class="top-pa text-center"><a
                                            class="black">{{$m->getSenderDetails->s_username ." / " . (new \Carbon\Carbon($m->dt_created_date))->diffForHumans()}}</a>
                                </p>
                                <div class="bottom-par">
                                    <?= $m->s_msg ?>

                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

@endsection