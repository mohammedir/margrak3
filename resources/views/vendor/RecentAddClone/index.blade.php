@extends("_manageLayout")
@section("body")
    <form action="" method="post">
        <div class="col-sm-10 col-xs-12">
            <section class="manage-content">
                <div class="row">
                    <div class="manage-content">
                        <div class="manage-content-show">
                            <div class="manage-title">
                                <div class="row">

                                    @include("System::system")


                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group manage-form" style="margin-top:20px;">
                                    <label class="col-md-2 control-label">عدد الاعلانات بالصفحة</label>
                                    <div class="col-md-1 inputGroupContainer">
                                        <div class="input-group">
                                            <select class="manage-select">
                                                <option>5</option>
                                                <option>10</option>
                                                <option>15</option>
                                                <option>20</option>
                                                <option>25</option>
                                                <option>30</option>
                                                <option>35</option>
                                                <option>40</option>
                                                <option>45</option>
                                                <option>50</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="form-group manage-form">
                                    <label class=" control-label"> اضافة وازالة التاجات وذلك عن طريق تحديد او ازالة
                                        الاقسام</label>
                                </div>
                            </div>
                            <br>
                            @foreach($primCategory as $p)
                                <div class="row">
                                    <div class="market-single-line row">
                                        <div class="manage-content-title row">
                                            <input {{-- {{$p->b_is_tag == 1 ? "checked" : ""}} --}}type="checkbox"
                                                   id="select_all_{{$p->pk_i_id}}"
                                                   name="cat_{{$p->pk_i_id}}"
                                                   value="Agree"><span><a>{{$p->s_name_ar}}</a></span>
                                        </div>

                                        @foreach($p->getChilds as $c1)
                                            <div class="row market-single-show">
                                                <div class="manage-types">
                                                    <a>{{$c1->s_name_ar}} <span>جميع أنواع {{$c1->s_name_ar}}</span></a>
                                                    <br>
                                                    <div class="types-show">
                                                        @foreach($c1->getChilds as $c2)
                                                            <input {{$c2->b_is_tag == 1 ? "checked" : ""}} type="checkbox"
                                                                   name="cat_{{$c2->pk_i_id}}"
                                                                   class="my_e_check_{{$p->pk_i_id}}"
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
                                    @endforeach
                                </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row" style="margin-bottom:20px;">
                    <input class="btn btn-success" type="submit" value="حفظ">
                </div>
            </section>
        </div>
    </form>
    <script>
        $(function () {
                    @foreach($primCategory as $p)
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
@endsection
