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
                                <input id="category_name" name="category_name" placeholder="عنوان القسم"
                                       class="form-control" type="text">
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
                                <select id="category_type" name="category_type" class="form-control selectpicker">
                                    <option disabled selected>اختر القسم المطلوب</option>
                                    <option value="0">قسم اساسي</option>
                                    <option value="1">قسم رئيسي</option>
                                    <option value="2">قسم فرعي</option>
                                </select>
                                <div style="color:red" id="category_type_error" class="font-red bold hidden">حقل مطلوب
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="prim_cat_div" class="row hidden">
                    <div class="form-group">
                        <label class="control-label">القسم الأساسي</label>
                        <div class="selectContainer">
                            <div class="input-group">
                                <select id="prim_cat" name="prim_cat" class="form-control selectpicker">
                                    <option disabled selected>اختر القسم المطلوب</option>
                                    @foreach($prim_categories as $c)
                                        <option value="{{$c->pk_i_id}}">{{$c->s_name_ar}}</option>
                                    @endforeach
                                </select>
                                <div style="color:red" id="prim_cat_error" class="font-red bold hidden">حقل مطلوب</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="main_cat_div" class="row hidden">
                    <div class="form-group">
                        <label class="control-label">القسم الرئيسي</label>
                        <div class="selectContainer">
                            <div class="input-group">
                                <select id="main_cat" name="main_cat" class="form-control selectpicker">
                                    <option disabled selected="">اختر القسم المطلوب</option>
                                </select>
                                <div style="color:red" id="main_cat_error" class="font-red bold hidden">حقل مطلوب</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="key_word_div" class="row hidden">
                    <div class="form-group">
                        <label class="control-label">يرجى كتابة الكلمات الدلالية مفصولة بفاصلة. مثال: تويوتا,لزكس</label>
                        <div class="selectContainer">
                            <div class="input-group">
                                <textarea type="form-control" name="key_word" id="key_word"></textarea>
                                <div style="color:red" id="main_cat_error" class="font-red bold hidden">حقل مطلوب</div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $WEBSITE_COLOR = \App\Helper\Helper::getSystemRecord("WEBSITE_COLOR");
                ?>
                <div class="form-group">
                    <label for="cat_color">لون الشريط</label>
                    <div class="row">
                        <div class="col-md-2 the-color">
                            <input type="text" id="cat_color1" name="cat_color1" class="form-control demo"
                                   data-control="hue" value="{{$WEBSITE_COLOR->s_tape_color}}">
                            <div style="color:red" id="cat_color_error" class="font-red bold hidden">حقل مطلوب</div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cat_color">لون القسم</label>
                    <div class="row">
                        <div class="col-md-2 the-color">
                            <input type="text" id="cat_color" name="cat_color" class="form-control demo"
                                   data-control="hue" value="{{$WEBSITE_COLOR->s_value}}">
                            <div style="color:red" id="cat_color1_error" class="font-red bold hidden">حقل مطلوب</div>
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
                                <input type="text" class="form-control image-preview-filename" disabled="disabled">
                                <!-- don't give a name === doesn't send on POST/GET -->
                            </div><!-- /input-group image-preview [TO HERE]-->
                        </div>
                    </div>
                    <br>
                    <div style="color:red" id="cat_img_error" class="font-red bold hidden">حقل مطلوب</div>
                </div>


                <div class="row">
                    <div class="form-group">
                        <label class="control-label">الحالة</label>
                        <div class="selectContainer">
                            <div class="input-group">
                                <select id="cat_status" name="cat_status" class="form-control selectpicker">
                                    <option disabled selected>اختر الحالة</option>
                                    <option selected value="1">فعال</option>
                                    <option value="0">غير فعال</option>
                                </select>
                                <div style="color:red" id="cat_status_error" class="font-red bold hidden">حقل مطلوب
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label">اظهار  شريط المساحات الاعلانية داخل القسم
                            <input checked type="checkbox" name="b_has_ads_space">
                        </label>
                    </div>
                </div>

                <input value="حفظ" type="submit" class="btn btn-success">
                <a href="{{url("/")}}/categories" class="btn btn-danger">الغاء</a>
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
                    var cat_color1 = $("#cat_color1").val();
//                    var cat_img = $("#cat_img").val();
                    var cat_status = $("#cat_status").val();
                    var allflag = true;

                    if (category_name == "") {
                        allflag = false;
                        $("#category_name_error").removeClass("hidden");
                    }

                    if (category_type == null) {
                        allflag = false;
                        $("#category_type_error").removeClass("hidden");
                    } else {
                        if (category_type == 1) {
                            if (prim_cat == null) {
                                allflag = false;
                                $("#prim_cat_error").removeClass("hidden");
                            }
                        } else if (category_type == 2) {
                            if (prim_cat == null) {
                                allflag = false;
                                $("#prim_cat_error").removeClass("hidden");
                            }
                            if (main_cat == null) {
                                allflag = false;
                                $("#main_cat_error").removeClass("hidden");
                            }
                        }
                    }
                    if (cat_color == "") {
                        allflag = false;
                        $("#cat_color_error").removeClass("hidden");
                    }
                    if (cat_color == "") {
                        allflag = false;
                        $("#cat_color1_error").removeClass("hidden");
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
                $("#key_word_div").addClass("hidden");
                $("#prim_cat_div").addClass("hidden");
                var category_type = $('#category_type').val();
                if (category_type == 1) {
                    $("#prim_cat_div").removeClass("hidden");
                } else if (category_type == 2) {
                    $("#main_cat_div").removeClass("hidden");
                    $("#prim_cat_div").removeClass("hidden");
                    $("#key_word_div").removeClass("hidden");
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
