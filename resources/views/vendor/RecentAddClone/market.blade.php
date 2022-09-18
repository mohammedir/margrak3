@extends("_outLayout")
@section("body")
    <section class="market-content">
        <div class="row">
            <div class="market-content">
                <div class="market-content-show">
                    @foreach($primCategory as $p)
                        <?php
                        $WEBSITE_COLOR = \App\Helper\Helper::getSystemRecord("WEBSITE_COLOR");
                        ?>
                        <div class="market-single-line row">
                            <div class="market-content-title text-center row"
                                 style="background-color: {{$p->s_tape_color}};" }}>
                                <div class="text-center " style="padding: 9px">
                                    <span><a href="{{url("/")}}/newest?prim={{$p->pk_i_id}}"
                                             style="font-size: 13pt;color: {{$p->s_color}}">{{$p->s_name_ar}}</a></span>
                                </div>
                            </div>
                            @foreach($p->getChilds as $c1)
                                <div style="display: flex" class="row market-single-show">
                                    <div class="col-sm-2 market-img">
                                        @if($c1->s_pic != "")
                                            <img style="margin: 0 auto" src="{{url("/")}}/uploads/{{$c1->s_pic}}">
                                        @endif
                                    </div>
                                    <div class="col-sm-10 market-types">
                                        <a href="{{url("/")}}/newest?main={{$c1->pk_i_id}}"
                                           style="font-size: 14pt">{{$c1->s_name_ar}} <span style="font-size: 12pt">جميع أنواع {{$c1->s_name_ar}}
                                                     </span> </a> <br>
                                        <div class="row types-show">

                                            @foreach($c1->getChilds as $c2)
                                                <div style="float: right">
                                                    <a style="padding: 3px;"
                                                       href="{{url("/")}}/newest?cat={{$c2->pk_i_id}}"><span>@if($c2->s_pic != "")
                                                                <img style=" margin-top: 9px !important;"
                                                                     src="{{url("/")}}/uploads/{{$c2->s_pic}}">@endif</span>{{$c2->s_name_ar}}
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
