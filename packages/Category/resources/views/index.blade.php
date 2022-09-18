@extends("_manageLayout")
@section("body")
    <div class="col-sm-10 col-xs-12">
        <section class="manage-content">
            <div class="row">
                <div class="manage-content">
                    <div class="manage-content-show">
                        <div class="manage-title">
                            <div class="row">
                                <div class="col-sm-2 add-button">
                                    <a href="{{url("/")}}/categories/add" class="btn btn-success">اضافة قسم جديد</a>
                                </div>
                                @include("System::system")
                            </div>
                        </div>
                        @foreach($primCategory as $p)
                            <div style="" class="market-single-line row">
                                <div class="market-content-title text-center row">
                                    <a href="{{url("/")}}/categories/edit/{{$p->pk_i_id}}" class="btn btn-success edit">تعديل</a>
                                    <div class="text-center sec-name">
                                        <span><a>{{$p->s_name_ar}}</a></span>
                                    </div>
                                </div>
                                @foreach($p->getChilds as $c1)
                                    <div style="display: flex" class="row market-single-show">
                                        <div class="col-sm-2 market-img">
                                            @if($c1->s_pic != "")
                                                <img src="{{url("/")}}/uploads/{{$c1->s_pic}}">
                                            @endif
                                        </div>
                                        <div class="col-sm-10 market-types">
                                            <a href="{{url("/")}}/categories/edit/{{$c1->pk_i_id}}">{{$c1->s_name_ar}}
                                                <span>جميع أنواع {{$c1->s_name_ar}}
                                                    <i class="glyphicon glyphicon-pencil"></i>     </span> </a> <br>
                                            <div class="types-show">
                                                @foreach($c1->getChilds as $c2)
                                                    <div style="float: right">
                                                        <a style="padding-right: 4px !important;padding-left: 4px !important;" href="{{url("/")}}/categories/edit/{{$c2->pk_i_id}}">
                                                        <span>
                                                            @if($c2->s_pic != "")
                                                                <img style=" margin-top: 9px !important;"
                                                                     src="{{url("/")}}/uploads/{{$c2->s_pic}}">
                                                            @endif
                                                        </span> {{$c2->s_name_ar}}
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
    </div>
@endsection
