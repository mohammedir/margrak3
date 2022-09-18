@extends("_manageLayout")
@section("body")
    <div class="col-sm-10 col-xs-12">
        <section class="manage-content">
            <div class="row">
                <div class="manage-content">
                    <div class="manage-content-show">
                        <div class="manage-title">
                            <div class="row">

                                @include("System::system1")


                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group manage-form" style="margin-top:20px;">
                                <label class="col-md-2 control-label">عدد الاعلانات بالصفحة</label>
                                <div class="col-md-1 inputGroupContainer">
                                    <div class="input-group">
                                        <select name="adds_num" class="manage-select">
                                            <option selected value="15">15</option>
                                            <option
                                                    {{$adds_num->s_value == "20" ? "selected" : ""}}
                                                    value="20">20
                                            </option>
                                            <option
                                                    {{$adds_num->s_value == "30" ? "selected" : ""}}
                                                    value="30">30
                                            </option>
                                            <option
                                                    {{$adds_num->s_value == "50" ? "selected" : ""}}
                                                    value="50">50
                                            </option>
                                            @for($i = 20; $i <= 50;$i+=20)
                                                <option
                                                        {{$adds_num->s_value == $i ? "selected" : ""}}
                                                        value="{{$i}}">{{$i}}</option>
                                            @endfor
                                            @for($i = 60; $i <= 100;$i+=10)
                                                <option
                                                        {{$adds_num->s_value == $i ? "selected" : ""}}
                                                        value="">{{$i}}</option>
                                            @endfor
                                            <option
                                                    {{$adds_num->s_value == "120" ? "selected" : ""}}
                                                    value="120">120
                                            </option>
                                            <option
                                                    {{$adds_num->s_value == "150" ? "selected" : ""}}
                                                    value="150">150
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <form action="{{url("/")}}/addMatger" method="post">
                            {{csrf_field()}}

                            <?php
                            $WEBSITE_COLOR = \App\Helper\Helper::getSystemRecord("WEBSITE_COLOR");
                            ?>
                            <input type="hidden" value="" name="matger_edit_id" id="matger_edit_id">
                            <div class="row">
                                <div class="col-md-6 form-group manage-form" style="">
                                    <label class="col-md-2 control-label">المتجر</label>
                                    <div class="col-md-1 inputGroupContainer">
                                        <div class="input-group">
                                            <input id="matger" type="text" name="matger" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group manage-form" style="">
                                    <label class="col-md-2 control-label">لون المتجر</label>
                                    <div class="col-md-1 inputGroupContainer">
                                        <div class="input-group">
                                            <input class="demo" type="text" id="mtger_color" name="mtger_color" required
                                                   value="{{$WEBSITE_COLOR->s_value}}">
                                            <input style="margin-top: 15px" type="submit" value="حفظ"
                                                   class="btn btn-primary">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <form action="" method="post">
                            {{csrf_field()}}

                            <?php
                            $matgers = \App\Helper\Helper::getFromConstant("MATAGER", 127);
                            $i = 1;
                            ?>
                            <div class="row">
                                <div class="col-md-5">
                                    <table style="color:#009879 !important;" class="table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>المتجر</th>
                                            <th>فعال؟</th>
                                            <th>خيارات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($matgers as $m)
                                            <tr style="color: {{$m->s_extra_1}}">
                                                <td>{{$i++}}</td>
                                                <td>{{$m->s_name_ar}}</td>
                                                <td><input value="{{$m->pk_i_id }}" class="myCheckBoxMatger"
                                                           type="checkbox" {{$m->b_enabled  == 1 ? "checked" : ""}} >
                                                </td>
                                                <td>
                                                    <a class="edit_mtger_btn btn btn-primary">تعديل</a>
                                                    <a href="{{url("/")}}/deleteMatger/{{$m->pk_i_id}}"
                                                       class="btn btn-danger Confirm">حذف</a>
                                                    <input type="hidden" id="mtger_id_up" value="{{$m->pk_i_id}}">
                                                    <input type="hidden" id="mtger_name_up" value="{{$m->s_name_ar}}">
                                                    <input type="hidden" id="color_up" value="{{$m->s_extra_1}}">
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <hr>

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
                                </div>
                        @endforeach

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
            $(".edit_mtger_btn").click(function () {
                var id = $(this).siblings("#mtger_id_up").val();
                var name = $(this).siblings("#mtger_name_up").val();
                var color = $(this).siblings("#color_up").val();
                $("#matger_edit_id").val(id);
                $("#matger").val(name);
                $("#mtger_color").val(color);
            });
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
            var colpick = $('.demo').each(function () {
                    $(this).minicolors({
                        control: $(this).attr('data-control') || 'hue',
                        inline: $(this).attr('data-inline') === 'true',
                        letterCase: 'lowercase',
                        opacity: false,
                        change: function (hex, opacity) {
                            if (!hex) return;
                            if (opacity) hex += ', ' + opacity;
                            try {
                            } catch (e) {
                            }
                            $(this).select();
                        },
                        theme: 'bootstrap'
                    });
                });

            var $inlinehex = $('#inlinecolorhex h3 small');
            $('#inlinecolors').minicolors({
                inline: true,
                theme: 'bootstrap',
                change: function (hex) {
                    if (!hex) return;
                    $inlinehex.html(hex);
                }
            });
        });
        $('.myCheckBoxMatger').change(function () {
            var id = $(this).val();
            var checked = 0;
            if (this.checked) {
                checked = 1;
            }
            $.ajax({
                method: "POST",
                url: '{{url("/")}}/constant_mtger/change',
                dataType: 'json',
                data: {
                    id: id,
                    checked: checked,
                    '_token': '{{csrf_token()}}'
                },
                success: function (data, textStatus, jqXHR) {
                    if (data.status) {

                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                }
            });
        });
    </script>
@endsection
