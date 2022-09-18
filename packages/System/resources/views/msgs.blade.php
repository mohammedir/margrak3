@extends("_outLayout")
@section("body")
    <div class="container">
        <div class="row">
            <div class="right-comment-b">
                <p class="top-pa-green text-center">
                    @if($SenderDetails->pk_i_id != 35)
                    <a>
                        @if(count($msgs) >0)
                            <a class="send_msg">إرسال رسالة إلى {{ $SenderDetails->s_username }}</a>
                            <input type="hidden" id="sender_id" value="{{ session("user_id") }}">
                            <input type="hidden" id="reciver_id" value="{{$r_id}}">
                    </a>
                    @else
                        لا توجد رسائل
                    @endif
                        @endif
                </p>
                <div class="mid-pa text-center">
                    @foreach($msgs as $m)
                        @if($m->is_deleted != Auth::user()->pk_i_id)
                            <div class="row coins text-center">
                                <div class="col-md-4"></div>
                                <div class="right-comment-b col-md-4">
                                    <p class="top-pa text-center"><a
                                                class="black">{{$m->getSenderDetails->s_username ." / " . (new \Carbon\Carbon($m->dt_created_date))->diffForHumans()}}</a>
                                    </p>
                                    <div class="bottom-par">
                                        <?= $m->s_msg ?>

                                    </div>
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection