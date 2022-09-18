@extends("_manageLayout")
@section("body")
    <form action="" method="post" id="template_form">
        {{csrf_field()}}
        <div class="col-sm-10 col-xs-12">
            <section class="manage-content">
                <p class="manage-head-p">قالب جديد :</p>
                <div class="row" style="margin: 20px 0px;">
                    <span style="float:right;">اسم القالب  : </span>
                    <div class="col-md-2" style="position: relative;top: -7px;">
                        <input value="{{$record->s_name_ar}}" name="template_name" id="template_name"
                               placeholder="اسم القالب" class="form-control"
                               type="text">
                        <div id="template_name_validate" style="color:red"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p id="cat_error" style="color:red"></p>
                    </div>
                </div>
                <div class="row" style="margin: 20px 0px;">
                    <span style="float:right;">القسم الأساسي :</span>
                    <div class="col-md-2" style="position: relative;top: -7px;">
                        <select name="fk_i_category_id" id="fk_i_category_id"
                                style="padding: 5px;border: 1px solid #ccc;border-radius: 5px;">
                            <option disabled selected>اختار من القائمة</option>
                            @foreach($primCategory as $p)
                                <option {{$p->fk_i_template_id == $record->pk_i_id ? "selected":""}} value="{{$p->pk_i_id}}">{{$p->s_name_ar}}</option>
                            @endforeach
                        </select>
                        <div id="fk_i_category_id_validate" style="color:red"></div>
                    </div>
                </div>
                <div class="row">
                    <span>الحالة :</span>
                    <select name="template_status" id="template_status"
                            style="padding: 5px;border: 1px solid #ccc;border-radius: 5px;">
                        <option value="1" selected>فعال</option>
                        <option {{$record->b_enable == 0 ? "selected" : ""}} value="0">غير فعال</option>
                    </select>
                </div>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal"
                        style="float:left;"><a style="color:#fff;"> + حقل جديد</a></button>
                <table class="table">
                    <thead class="thead-default">
                    <tr>
                        <th>اسم الحقل</th>
                        <th>نوع الحقل</th>
                        <th>خيارات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($fields as  $f)
                        <tr>
                            <th>
                                <div style="display:inline-block; margin-left:5px;">

                                    <input
                                        <?php  $ADS_FILTERS = \App\Helper\helper::checkIfContainField($record->pk_i_id, $f->pk_i_id); ?>
                                        {{$ADS_FILTERS ? "checked" : ""}} type="checkbox" name="f_{{$f->pk_i_id}}"><span
                                            style="margin-right:5px;">{{$f->s_name_ar}}</span>
                                </div>
                            </th>
                            <th>
                                @if($f->i_type == 1)
                                    نص
                                @elseif($f->i_type == 2)
                                    قائمة
                                @else
                                    خريطة
                                @endif
                            </th>
                            <th>
                                <input type="hidden" value="{{$f->s_name_ar}}" id="up_s_name_ar">
                                <input type="hidden" value="{{$f->pk_i_id}}" id="up_id">
                                <input type="hidden" value="{{$f->i_type}}" id="up_type">
                                <a id="editFieldModalBtn" class="btn btn-primary">تعديل</a>
                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <input type="submit" class="btn btn-success" value="حفظ">
                <a href="{{url("/")}}/templates" class="btn btn-danger">الغاء</a>
            </section>
        </div>
    </form>
    @include("Template::addFieldOptionScript")
    @include("Template::editFieldOptionScript")
    <script>
        $(function () {
            $('#fk_i_category_id').change(function () {
                $("#cat_error").html("");
                var id = $(this).val();
                $.ajax({
                    method: "POST",
                    url: '{{url("/")}}/checkIfCategoryIsTempalted',
                    dataType: 'json',
                    data: {
                        id: id,
                        '_token': '{{csrf_token()}}'
                    },
                    success: function (data, textStatus, jqXHR) {
                        if (data.status) {
                            if (data.check) {
                                if (data.template.pk_i_id != "{{$record->pk_i_id}}") {
                                    $("#cat_error").html("ملاحظة/ هذا القسم ينتمي إلى قالب آخر وهو: " + "<a href='{{url("/")}}/editTemplate/" +
                                        data.template.pk_i_id + "'>" +
                                        data.template.s_name_ar + "</a> وبعد الحفظ سيتم إستبدال القالب الخاص بهذا القسم");
                                }
                            }
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                    }
                });
            });
            $('#template_form').validate({
                rules: {
                    template_name: "required",
                },
                errorPlacement: function (error, element) {
                    var name = $(element).attr("name");
                    error.appendTo($("#" + name + "_validate"));
                },
                messages: {
                    template_name: "حقل مطلوب",
                }, submitHandler: function (form) {
                    form.submit();
                }
            });
        });
    </script>
@endsection
