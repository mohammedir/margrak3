<form action="{{url("/")}}/adds/saveModel_Filterss" method="post">

    <div class="row">
        <div class="market-single-line row">
            <div class="manage-content-title row">
                <span><a>الموديل</a></span>
            </div>
            <div class="row market-single-show">
                <div class="manage-types">
                    <div class="types-show">
                        @foreach($Models as $p)
                            <input {{$p->b_is_filter == 1 ? "checked" : ""}} type="checkbox"
                                   id="select_all_{{$p->pk_i_id}}"
                                   name="model_{{$p->pk_i_id}}"
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
