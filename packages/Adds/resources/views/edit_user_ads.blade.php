@extends("_manageLayout")
@section("body")
    <form id="banks_form" action="" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="col-sm-10 col-xs-12">
            <section class="manage-content">
                <p class="manage-head-p">{{$title}}</p>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label">العنوان</label>
                        <div class="inputGroupContainer">
                            <div class="input-group">
                                <input readonly value="{{$record->s_title_ar}}" id="title" name="title"
                                       placeholder="العنوان"
                                       class="form-control" type="text">
                                <div style="color:red" id="title_validate"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label">بواسطة</label>
                        <div class="inputGroupContainer">
                            <div class="input-group">
                                <input readonly value="{{$record->getTheNameOfCreator->s_username}}" id="title"
                                       name="title" placeholder="العنوان"
                                       class="form-control" type="text">
                                <div style="color:red" id="title_validate"></div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="form-group">
                        <label class="control-label">بإمكانك تثبيت الإعلان وتخصيصه في الأقسام المعينة عن طريق تحديد إحدى الخيارات التالية:</label>
                        <label for="selectAll">
                            <input
                                    @if($record->i_is_featured == 1)
                                    {{is_array( json_decode($record->s_is_featured_ary)) ? "" : "checked"}}
                                    @endif
                                    type="radio"
                                    name="category_id"
                                    id="selectAll"
                                    value="selectAll"> جميع الأقسام
                        </label>
                        <label for="special">
                            <input @if($record->i_is_featured == 1)
                                   {{is_array(json_decode($record->s_is_featured_ary)) ? "checked" : ""}}
                                   @endif
                                   type="radio"
                                   name="category_id"
                                   id="special" value="special">
                            قسم مخصص
                        </label>
                        @if($record->i_is_featured == 1)
                            <label for="old">
                                <input
                                       type="radio"
                                       name="category_id"
                                       id="old" value="old">
                                إرجاع الإعلان للوضع الطبيعي وإلغاء الميزة
                            </label>
                        @endif
                        <div style="color:red" id="category_id_validate"></div>
                    </div>
                </div>
                <br>
                <div id="category_div" class="{{is_array(json_decode($record->s_is_featured_ary) ) ? "" : "hidden"}}">
                    <?php
                    $ary = json_decode($record->s_is_featured_ary);
                    ?>
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
                                                    <?php
                                                    $checked = "";
                                                    if (isset($ary[0])) {
                                                        foreach ($ary as $a) {
                                                            if (in_array($c2->pk_i_id, $a)) {
                                                                $checked = "checked";
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                    <input {{ $checked}} type="checkbox"
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
                <br>
                <input type="submit" value="حفظ" class="btn btn-success">
                <a href="{{url("/")}}/user_ads" class="btn btn-danger">الغاء</a>
            </section>
        </div>
    </form>
    <script>
        $(function () {
            $('#selectAll').click(function () {
                $("#category_id_validate").text("");
                $("#category_div").addClass("hidden");
            });
            $('#special').click(function () {
                $("#category_id_validate").text("");
                $("#category_div").removeClass("hidden");
            });
            $('#banks_form').validate({
                rules: {
                    title: {required: true},
                    desc: {required: true},
                    url: {required: true},
                },
                errorPlacement: function (error, element) {
                    var name = $(element).attr("name");
                    error.appendTo($("#" + name + "_validate"));
                },
                messages: {
                    desc: {required: "حقل مطلوب"},
                    title: {required: "حقل مطلوب"},
                    url: {required: "حقل مطلوب"},
                }, submitHandler: function (form) {
                    $("#category_id_validate").text("");
                    if (!$('input[name=category_id]:checked').length <= 0) {
                        form.submit();
                    } else {
                        $("#category_id_validate").text("يرجى تحديد الأقسام");
                    }
                }
            });
        });
    </script>
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
