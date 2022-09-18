@extends("_outLayout")
@section("body")
    <div class="container">
        <div class="row">
            <div class="right-comment-b">
                <p class="top-pa text-center">تنبيهات اليوم</p>
                <div class="bottom-p">
                    @foreach($Notification as $n)
                        @if(date("Y-m-d") == (new DateTime($n->dt_created_date))->format("Y-m-d"))
                            <p><a href="{{url("/")}}/{{$n->s_url}}">{{$n->s_url_msg}}</a> {{(new \Carbon\Carbon($n->dt_created_date))->diffForHumans()}} </p>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="right-comment-b">
                <p class="top-pa text-center">تنبيهات سابقة</p>
                <div class="bottom-p">
                    @foreach($Notification as $n)
                        @if(date("Y-m-d") != (new DateTime($n->dt_created_date))->format("Y-m-d"))
                            <p><a href="{{url("/")}}/{{$n->s_url}}">{{$n->s_url_msg}}</a> {{(new \Carbon\Carbon($n->dt_created_date))->diffForHumans()}} </p>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection