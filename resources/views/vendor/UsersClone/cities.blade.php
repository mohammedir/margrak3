@extends("_manageLayout")
@section("body")
    <div class="col-sm-10 col-xs-12">
        <section class="manage-content">
            <p class="manage-head-p">الدول والمدن :</p>
            <div class="pull-right">
                <a id="add_company_btn" class="btn btn-primary"><i class="fa fa-plus"></i> مدينة جديدة</a>
                <a id="add_country_btn" class="btn btn-primary"><i class="fa fa-plus"></i> دولة جديدة</a>
                <a id="edit_country_btn" class="btn btn-primary"><i class="fa fa-plus"></i> تعديل دولة</a>
            </div>
            <?php
            $WEBSITE_COLOR = \App\Helper\Helper::getSystemRecord("WEBSITE_COLOR");
            ?>
            <div class="row">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>الدولة</th>
                        <th>المدينة</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; ?>
                    @foreach($table_data as $t)
                        <tr>
                            <td>{{$i++}}</td>
                            <td style="color: {{$t->getParent->s_color}};">{{$t->getParent->s_name_ar }}</td>
                            <td style="color: {{ $t->s_color }}">{{$t->s_name_ar }}</td>
                            <td>
                                <div class="dropdown scroll">
                                    <button class="btn btn-default dropdown-toggle" type="button"
                                            id="dropdownMenu2" data-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false">خيارات <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu"
                                        aria-labelledby="dropdownMenu2">
                                        <li>
                                            <a id="edit_company_btn">تعديل</a>
                                            <input type="hidden" value="{{$t->s_name_ar}}" id="s_name_ar">
                                            <input type="hidden" value="{{$t->pk_i_id}}" id="constant_id_u">
                                            <input type="hidden" value="{{$t->i_parent_id}}" id="parent_id_u">
                                            <input type="hidden" value="{{$t->s_color}}" id="color_u">
                                        </li>
                                        <li>
                                            <a href="{{url("/")}}/cities/delete/{{$t->pk_i_id}}"
                                               class="Confirm">حذف</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </section>

    </div>
    <div id="add_company" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" style="width: 60%;" role="document">
            <form id="add_company_form" action="{{url("/")}}/cities/add" method="post">
                {{csrf_field()}}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="gridModalLabel">مدينة جديدة</h4>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid bd-example-row">
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label for="s_name_ar_add">المدينة</label><span
                                            class="required"
                                            aria-required="true"> * </span>
                                    <input type="text" class="form-control" name="s_name_ar_add" id="s_name_ar_add">
                                    <div id="s_name_ar_add_validate" style="color:red;"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label for="i_country_id_add">الدولة</label><span class="required"
                                                                                      aria-required="true"> * </span>
                                    <select class="form-control asset select2" name="i_country_id_add"
                                            id="i_country_id_add">
                                        <option selected disabled value="">إختر الدولة من القائمة</option>
                                        @foreach($countries as $c)
                                            <option value="{{$c->pk_i_id}}">{{$c->s_name_ar}}</option>
                                        @endforeach
                                    </select>

                                    <div id="i_country_id_add_validate" style="color:red;"></div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label for="add_color">اللون</label><span class="required"
                                                                              aria-required="true"> * </span>
                                    <input type="text" id="add_color" name="add_color" class="form-control demo"
                                           data-control="hue" value="{{$WEBSITE_COLOR->s_value}}">
                                    <div id="add_color_validate" style="color:red;"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">إغلاق</button>
                        <input type="submit" class="btn btn-primary" value="إضافة">
                        <i id="spin_md" class="fa fa-spinner fa-spin fa-2x hidden " aria-hidden="true"></i>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="add_country" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" style="width: 60%;" role="document">
            <form id="add_country_form" action="{{url("/")}}/cities/addCountry" method="post">
                {{csrf_field()}}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="gridModalLabel">دولة جديدة</h4>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid bd-example-row">
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label for="s_name_ar_add_c">الدولة</label><span
                                            class="required"
                                            aria-required="true"> * </span>
                                    <input type="text" class="form-control" name="s_name_ar_add_c" id="s_name_ar_add_c">
                                    <div id="s_name_ar_add_c_validate" style="color:red;"></div>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label for="add_color1">اللون</label><span class="required"
                                                                               aria-required="true"> * </span>
                                    <input type="text" id="add_color1" name="add_color1" class="form-control demo"
                                           data-control="hue" value="{{$WEBSITE_COLOR->s_value}}">
                                    <div id="add_color1_validate" style="color:red;"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">إغلاق</button>
                        <input type="submit" class="btn btn-primary" value="إضافة">
                        <i id="spin_md" class="fa fa-spinner fa-spin fa-2x hidden " aria-hidden="true"></i>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="edit_country" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" style="width: 60%;" role="document">
            <form id="edit_country_form" action="{{url("/")}}/cities/editCountry" method="post">
                {{csrf_field()}}
                <input type="hidden" id="religin_id" name="religin_id" value="">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="gridModalLabel">تعديل الدولة</h4>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid bd-example-row">
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label for="country_id_c">الدولة</label><span class="required"
                                                                                  aria-required="true"> * </span>
                                    <select class="form-control asset select2" name="country_id_c"
                                            id="country_id_c">
                                        <option selected disabled value="">إختار الدولة من القائمة</option>
                                        @foreach($countries as $c)
                                            <option value="{{$c->pk_i_id}}">{{$c->s_name_ar}}</option>
                                        @endforeach
                                    </select>

                                    <div id="country_id_c_validate" style="color:red;"></div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label for="s_name_ar_edit_c">الدولة</label><span
                                            class="required"
                                            aria-required="true"> * </span>
                                    <input type="text" class="form-control" name="s_name_ar_edit_c"
                                           id="s_name_ar_edit_c">
                                    <div id="s_name_ar_edit_c_validate" style="color:red;"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label for="add_color2">اللون</label><span class="required"
                                                                               aria-required="true"> * </span>
                                    <input type="text" id="add_color2" name="add_color2" class="form-control demo"
                                           data-control="hue" value="{{$WEBSITE_COLOR->s_value}}">
                                    <div id="add_color2_validate" style="color:red;"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">إغلاق</button>
                        <input type="submit" class="btn btn-primary" value="تعديل">
                        <i id="spin_md" class="fa fa-spinner fa-spin fa-2x hidden " aria-hidden="true"></i>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="edit_company" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" style="width: 60%;" role="document">
            <form id="edit_company_form" action="{{url("/")}}/cities/edit" method="post">
                {{csrf_field()}}
                <input type="hidden" id="religin_id1" name="religin_id1" value="">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="gridModalLabel">تعديل مدينة</h4>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid bd-example-row">
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label for="s_name_ar_edit">المدينة</label><span
                                            class="required"
                                            aria-required="true"> * </span>
                                    <input type="text" class="form-control" name="s_name_ar_edit" id="s_name_ar_edit">
                                    <div id="s_name_ar_edit_validate" style="color:red;"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label for="i_country_id_edit">الدولة</label><span class="required"
                                                                                       aria-required="true"> * </span>
                                    <select class="form-control asset select2" name="i_country_id_edit"
                                            id="i_country_id_edit">
                                        <option selected disabled value="">إختار الدولة من القائمة</option>
                                        @foreach($countries as $c)
                                            <option value="{{$c->pk_i_id}}">{{$c->s_name_ar}}</option>
                                        @endforeach
                                    </select>

                                    <div id="i_country_id_edit_validate" style="color:red;"></div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label for="add_color3">اللون</label><span class="required"
                                                                               aria-required="true"> * </span>
                                    <input type="text" id="add_color3" name="add_color3" class="form-control demo"
                                           data-control="hue" value="{{$WEBSITE_COLOR->s_value}}">
                                    <div id="add_color3_validate" style="color:red;"></div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">إغلاق</button>
                        <input type="submit" class="btn btn-primary" value="تعديل">
                        <i id="spin_md" class="fa fa-spinner fa-spin fa-2x hidden " aria-hidden="true"></i>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(function () {
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

            $('body').on('click', '#edit_company_btn', function () {
                var constant_id_u = $(this).siblings("#constant_id_u").val();
                $("#religin_id1").val(constant_id_u);

                var s_name_ar = $(this).siblings("#s_name_ar").val();
                var i_country_id_edit = $(this).siblings("#parent_id_u").val();
                var color = $(this).siblings("#color_u").val();

                $("#add_color3").val(color);
                $("#s_name_ar_edit").val(s_name_ar);
                $("#i_country_id_edit").val(i_country_id_edit);

                $('#edit_company').modal('show');

            });
            $('#edit_company_form').validate({
                rules: {
                    s_name_ar_edit: "required",
                    i_country_id_edit: "required",
                    add_color3: "required",
                },
                errorPlacement: function (error, element) {
                    var name = $(element).attr("name");
                    error.appendTo($("#" + name + "_validate"));
                },
                messages: {
                    add_color3: "حقل مطلوب",
                    s_name_ar_edit: "حقل مطلوب",
                    i_country_id_edit: "حقل مطلوب",
                }, submitHandler: function (form) {
                    form.submit();
                }
            });
            $('#edit_country_form').validate({
                rules: {
                    s_name_ar_edit_c: "required",
                    country_id_c: "required",
                    add_color2: "required",
                },
                errorPlacement: function (error, element) {
                    var name = $(element).attr("name");
                    error.appendTo($("#" + name + "_validate"));
                },
                messages: {
                    s_name_ar_edit_c: "حقل مطلوب",
                    country_id_c: "حقل مطلوب",
                    add_color2: "حقل مطلوب",
                }, submitHandler: function (form) {
                    form.submit();
                }
            });

            $('body').on('click', '#add_company_btn', function () {
                $('#add_company').modal('show');
            });
            $('body').on('click', '#add_country_btn', function () {
                $('#add_country').modal('show');
            });
            $('body').on('click', '#edit_country_btn', function () {

                $('#edit_country').modal('show');
            });
            $('body').on('change', '#country_id_c', function () {
                var country_id_c = $(this).val();
                @foreach($countries as $c)
                if (country_id_c == "{{$c->pk_i_id}}") {
                    $("#s_name_ar_edit_c").val("{{$c->s_name_ar}}");
                    $("#add_color2").val("{{$c->s_color}}");
                }
                @endforeach
            });
            $('#add_company_form').validate({
                rules: {
                    s_name_ar_add: "required",
                    i_country_id_add: "required",
                    add_color: "required",
                },
                errorPlacement: function (error, element) {
                    var name = $(element).attr("name");
                    error.appendTo($("#" + name + "_validate"));
                },
                messages: {
                    s_name_ar_add: "حقل مطلوب",
                    i_country_id_add: "حقل مطلوب",
                    add_color: "حقل مطلوب",
                }, submitHandler: function (form) {
                    form.submit();
                }
            });
            $('#add_country_form').validate({
                rules: {
                    s_name_ar_add_c: "required",
                    add_color1: "required",
                },
                errorPlacement: function (error, element) {
                    var name = $(element).attr("name");
                    error.appendTo($("#" + name + "_validate"));
                },
                messages: {
                    s_name_ar_add_c: "حقل مطلوب",
                    add_color1: "حقل مطلوب",
                }, submitHandler: function (form) {
                    form.submit();
                }
            });
        });

    </script>
@endsection