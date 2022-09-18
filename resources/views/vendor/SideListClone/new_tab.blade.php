<form action="{{url("/")}}/saveNewTab" method="post">
@foreach($primCategory as $p)
        <div class="row">
            <div class="market-single-line row">
                <div class="manage-content-title row">
                    <input {{-- {{$p->b_is_tag == 1 ? "checked" : ""}} --}}type="checkbox"
                           id="select_all_new_{{$p->pk_i_id}}"
                           name="cat_new_{{$p->pk_i_id}}"
                           value="Agree"><span><a>{{$p->s_name_ar}}</a></span>
                </div>
                @foreach($p->getChilds as $c1)
                    <div class="row market-single-show">
                        <div class="manage-types">
                            <a>{{$c1->s_name_ar}} <span>جميع أنواع {{$c1->s_name_ar}}</span></a>
                            <br>
                            <div class="types-show">
                                @foreach($c1->getChilds as $c2)
                                    <input {{$c2->b_show_in_newest_menu == 1 ? "checked" : ""}} type="checkbox"
                                           name="cat_new_{{$c2->pk_i_id}}"
                                           class="my_e_check__new{{$p->pk_i_id}}"
                                           value="Agree">
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
    <br>
    <div class="row" style="margin-bottom:20px;">
        <input class="btn btn-success" type="submit" value="حفظ">
    </div>
</form>
<script>
    $(function () {
                @foreach($primCategory as $p)
        var select_all_{{$p->pk_i_id}} = document.getElementById("select_all_new_{{$p->pk_i_id}}");
        var checkboxes_{{$p->pk_i_id}} = document.getElementsByClassName("my_e_check__new{{$p->pk_i_id}}");

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
