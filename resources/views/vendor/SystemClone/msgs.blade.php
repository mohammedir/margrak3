@extends("_outLayout")
@section("body")
    <div class="container">
        <div class="row">
            <div class="right-comment-b">
                <p class="top-pa-green text-center"><a>
                        @if(count($msgs) >0)
                            <a class="send_msg">إرسال رسالة إلى {{ $SenderDetails->s_first_name ." ". $SenderDetails->s_last_name }}</a>
                            <input type="hidden" id="sender_id" value="{{ session("user_id") }}">
                            <input type="hidden" id="reciver_id" value="{{$r_id}}">
                    </a>
                    @else
                        لا توجد رسائل
                    @endif
                </p>
                <div class="mid-pa text-center">
                    @foreach($msgs as $m)
                        <div class="row coins text-center">
                            <div class="col-md-4"></div>
                            <div class="right-comment-b col-md-4">
                                <p class="top-pa text-center"><a
                                            class="black">{{$m->getSenderDetails->s_first_name ." ". $m->getSenderDetails->s_last_name ." / " . (new \Carbon\Carbon($m->dt_created_date))->diffForHumans()}}</a>
                                </p>
                                <div class="bottom-par">
                                    <?= $m->s_msg ?>
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection