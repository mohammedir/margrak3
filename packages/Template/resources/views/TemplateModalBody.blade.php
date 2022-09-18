@foreach($primCategory as $p)
    <div class="row">
        <div class="market-single-line row">
            <div class="manage-content-title row">
                <span>{{$p->s_name_ar}}</span>
            </div>
            @foreach($p->getChilds1 as $c1)
                    <div class="row market-single-show">
                        <div class="manage-types">
                            {{$c1->s_name_ar}} <span>جميع أنواع {{$c1->s_name_ar}}</span>
                            <br>
                            <div class="types-show">
                                @foreach($c1->getChilds1 as $c2)
                                        <a>
                                    <span>
                                        @if($c2->s_pic != "")
                                            <img src="{{url("/")}}/uploads/{{$c2->s_pic}}">
                                        @endif
                                    </span> {{$c2->s_name_ar}}
                                        </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
            @endforeach
        </div>
    </div>
@endforeach
