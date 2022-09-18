@extends("_manageLayout")
@section("body")
    <form id="add_category_form" action="" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="col-sm-10 col-xs-12">
            <section class="manage-content">
                <p class="manage-head-p">{{$title}}</p>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label">اسم القسم</label>
                        <div class="inputGroupContainer">
                            <div class="input-group">
                                <input value="{{$record_data->s_name_ar}}" id="category_name" name="category_name"
                                       placeholder="عنوان القسم" class="form-control" type="text">
                                <div style="color:red" id="category_name_error" class="font-red bold hidden">حقل مطلوب
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label">نوع القسم</label>
                        <div class="selectContainer">
                            <div class="input-group">
                                <?php
                                $cat_type = "قسم اساسي";
                                $parent_text = "";
                                if ($record_data->i_parent_id != 0) {
                                    if ($record_data->getParent->i_parent_id == 0) {
                                        $cat_type = "قسم رئيسي";
                                        $parent_text = "القسم الأساسي";
                                    } else {
                                        $cat_type = "قسم فرعي";
                                        $parent_text = "القسم الرئيسي";
                                    }
                                }
                                ?>
                                <input readonly value="{{$cat_type}}" class="form-control" type="text">
                                <div style="color:red" id="category_type_error" class="font-red bold hidden">حقل مطلوب
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if($record_data->i_parent_id != 0)
                    <div id="prim_cat_div" class="row ">
                        <div class="form-group">
                            <label class="control-label">{{$parent_text}}</label>
                            <div class="selectContainer">
                                <div class="input-group">
                                    <input readonly value="{{$record_data->getParent->s_name_ar}}" class="form-control"
                                           type="text">
                                    <div style="color:red" id="prim_cat_error" class="font-red bold hidden">حقل مطلوب
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="form-group">
                    <label for="cat_color">لون القسم</label>
                    <div class="row">
                        <div class="col-md-2 the-color">
                            <input value="{{$record_data->s_color}}" type="text" id="cat_color" name="cat_color"
                                   class="form-control demo"
                                   data-control="hue" value="#ff6161">
                            <div style="color:red" id="cat_color_error" class="font-red bold hidden">حقل مطلوب</div>
                        </div>
                    </div>
                </div>


                <div class="row pic-choose">
                    <label class="control-label">صورة القسم</label>
                    <div class="form-group">
                        <div class="col-xs-12 col-md-4" style="padding-right:0px;">
                            <!-- image-preview-filename input [CUT FROM HERE]-->
                            <div class="input-group image-preview">
                <span class="input-group-btn">
                    <!-- image-preview-clear button -->
                    <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                        <span class="glyphicon glyphicon-remove"></span> إزالة
                    </button>
                    <!-- image-preview-input -->
                    <div class="btn btn-default image-preview-input">
                        <span class="glyphicon glyphicon-folder-open"></span>
                        <span class="image-preview-input-title">اختيار</span>
                        <input type="file" accept="image/png, image/jpeg, image/gif" name="cat_img" id="cat_img"/>
                        <!-- rename it -->
                    </div>

                </span>
                                <input value="{{$record_data->s_pic}}" type="text"
                                       class="form-control image-preview-filename" disabled="disabled">
                                <!-- don't give a name === doesn't send on POST/GET -->
                            </div><!-- /input-group image-preview [TO HERE]-->
                        </div>
                    </div>
                    @if($record_data->s_pic != "")
                        <div>
                            <img id src="{{url("/")}}/uploads/{{$record_data->s_pic}}" style="max-width: 50px;
                        display: inline-block;position: relative;top: -40%;" alt="">
                        </div>
                    @endif
                    <div style="color:red" id="cat_img_error" class="font-red bold hidden">حقل مطلوب</div>
                </div>


                <div class="row">
                    <div class="form-group">
                        <label class="control-label">الحالة</label>
                        <div class="selectContainer">
                            <div class="input-group">
                                <select id="cat_status" name="cat_status" class="form-control selectpicker">
                                    <option disabled selected>اختر الحالة</option>
                                    <option {{$record_data->b_enable == 1 ? "selected" : ""}}  value="1">فعال</option>
                                    <option {{$record_data->b_enable == 0 ? "selected" : ""}} value="0">غير فعال
                                    </option>
                                </select>
                                <div style="color:red" id="cat_status_error" class="font-red bold hidden">حقل مطلوب
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <input value="حفظ" type="submit" class="btn btn-success">
                <a href="/categories" class="btn btn-danger">الغاء</a>
            </section>
        </div>
    </form>
    <script>
        $(function () {

            $('#add_category_form').validate({
                rules: {},
                errorPlacement: function (error, element) {
                    var name = $(element).attr("name");
                    error.appendTo($("#" + name + "_validate"));
                },
                messages: {}, submitHandler: function (form) {
                    $("#category_name_error").addClass("hidden");
                    $("#category_type_error").addClass("hidden");
                    $("#prim_cat_error").addClass("hidden");
                    $("#main_cat_error").addClass("hidden");
                    $("#cat_color_error").addClass("hidden");
//                    $("#cat_img_error").addClass("hidden");
                    $("#cat_status_error").addClass("hidden");
                    var category_name = $("#category_name").val();
                    var category_type = $("#category_type").val();
                    var prim_cat = $("#prim_cat").val();
                    var main_cat = $("#main_cat").val();
                    var cat_color = $("#cat_color").val();
//                    var cat_img = $("#cat_img").val();
                    var cat_status = $("#cat_status").val();
                    var allflag = true;

                    if (category_name == "") {
                        allflag = false;
                        $("#category_name_error").removeClass("hidden");
                    }
                    if (category_type == "") {
                        allflag = false;
                        $("#category_type_error").removeClass("hidden");
                    } else {
                        if (category_type == 1) {
                            if (prim_cat = "") {
                                allflag = false;
                                $("#prim_cat_error").removeClass("hidden");
                            }
                        } else if (category_type == 2) {
                            if (main_cat = "") {
                                allflag = false;
                                $("#main_cat_error").removeClass("hidden");
                            }
                        }
                    }
                    if (cat_color == "") {
                        allflag = false;
                        $("#cat_color_error").removeClass("hidden");
                    }
//                    if(cat_img == ""){
//                        allflag = false;
//                        $("#cat_img_error").removeClass("hidden");
//                    }
                    if (cat_status == "") {
                        allflag = false;
                        $("#cat_status_error").removeClass("hidden");
                    }

                    if (allflag) {
                        form.submit();
                    }
                }
            });
            $("body").on('change', '#prim_cat', function () {
                var prim_cat_id = $(this).val();
                $("#main_cat").empty();
                $.ajax({
                    method: "POST",
                    url: '{{url("/")}}/categories/getMainCategory',
                    dataType: 'json',
                    data: {id: prim_cat_id, '_token': '{{csrf_token()}}'},
                    success: function (data, textStatus, jqXHR) {
                        if (data.status) {
                            $('#main_cat').append('<option disabled selected="">اختر القسم المطلوب</option>');
                            for (var i = 0; i < data.main_cats.length; i++) {
                                $('#main_cat').append('<option value="' + data.main_cats[i].pk_i_id + '">' + data.main_cats[i].s_name_ar + '</option>');
                            }
                        }//end if
                        else {
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {

                    }
                });
            });
            $("body").on('change', '#category_type', function () {
                $("#main_cat_div").addClass("hidden");
                $("#prim_cat_div").addClass("hidden");
                var category_type = $('#category_type').val();
                if (category_type == 1) {
                    $("#prim_cat_div").removeClass("hidden");
                } else if (category_type == 2) {
                    $("#main_cat_div").removeClass("hidden");
                    $("#prim_cat_div").removeClass("hidden");
                }
            });
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
    </script>

@endsection
