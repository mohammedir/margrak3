<form action="{{url("/")}}/adds/saveCountriesFilterss" method="post">
    @foreach($Countries as $p)
        <div class="row">
            <div class="market-single-line row">
                <div class="manage-content-title row">
                    <input {{-- {{$p->b_is_tag == 1 ? "checked" : ""}} --}}type="checkbox"
                           id="select_all_{{$p->pk_i_id}}"
                           name="cant_{{$p->pk_i_id}}"
                           value="Agree"><span><a>{{$p->s_name_ar}}</a></span>
                </div>
                    <div class="row market-single-show">
                        <div class="manage-types">
                            <div class="types-show">
                                @foreach($p->getChilds as $c1)
                                    <input {{$c1->b_is_filter == 1 ? "checked" : ""}} type="checkbox"
                                           name="cant_{{$c1->pk_i_id}}"
                                           class="my_e_check_{{$p->pk_i_id}}"
                                           value="Agree">
                                    <a>
                                                        <span>
                                                            @if($c1->s_pic != "")
                                                                <img src="{{url("/")}}/uploads/{{$c1->s_pic}}">
                                                            @endif
                                                        </span> {{$c1->s_name_ar}}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    @endforeach
    <br>
    <div class="row" style="margin-bottom:20px;">
        <input class="btn btn-success" type="submit" value="حفظ">
    </div>
</form>
<script>
    $(function () {
                @foreach($Countries as $p)
        var select_all_{{$p->pk_i_id}} = document.getElementById("select_all_{{$p->pk_i_id}}");
        var checkboxes_{{$p->pk_i_id}} = document.getElementsByClassName("my_e_check_{{$p->pk_i_id}}");

        select_all_{{$p->pk_i_id}}.addEventListener("change", function (e) {
            for (i = 0; i < checkboxes_{{$p->pk_i_id}}.length; i++) {
                checkboxes_{{$p->pk_i_id}}[i].checked = select_all_{{$p->pk_i_id}}.checked;
            }
        });
        for (var i = 0; i < checkboxes_{{$p->pk_i_id}}.length; i++) {
            checkboxes_{{$p->pk_i_id}}[i].addEventListener('change', function (e) { //".checkbox" change
                if (this.checked == false) {
                    select_all_{{$p->pk_i_id}}.checked = false;
                }
                if (document.querySelectorAll('.check_bg:checked').length == checkboxes_{{$p->pk_i_id}}.length) {
                    select_all_{{$p->pk_i_id}}.checked = true;
                }
            });
        }
        @endforeach
    });
</script>