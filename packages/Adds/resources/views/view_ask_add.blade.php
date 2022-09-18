<form action="{{url("/")}}/adds/saveASK_VIEW_Filterss" method="post">
    {{csrf_field()}}
        <div class="row">
            <div class="market-single-line row">
                <div class="manage-content-title row">
                    <span><a>حالة الإعلان</a></span>
                </div>
                <div class="row market-single-show">
                    <div class="manage-types">
                        <div class="types-show">
                            @foreach($VIEW_ASK_ADS as $p)
                                <input {{$p->b_is_filter == 1 ? "checked" : ""}} type="checkbox"
                                       id="select_all_{{$p->pk_i_id}}"
                                       name="view_ask_{{$p->pk_i_id}}"
                                       value="Agree"><span><a>{{$p->s_name_ar}}</a></span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <br>
    <div class="row" style="margin-bottom:20px;">
        <input class="btn btn-success" type="submit" value="حفظ">
    </div>
</form>
