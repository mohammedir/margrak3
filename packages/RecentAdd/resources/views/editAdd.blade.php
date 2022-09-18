@extends("_outLayout")
@section("body")
    <form action="" method="post" id="requestAddForm" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="container">
            <div class="row">
                <div class="register-box">
                    <div class="top-ad">
                        <div class="row first-row">
                            <div class="col-md-8">
                                <p>اكتب موضوع اعلانك بشكل واضح ومناسب للجميع:</p>
                                <input value="{{$record_data->s_title_ar}}" id="s_title_ar" name="s_title_ar"
                                       placeholder="مثال: ايفون بلس اسود مستعمل شهر واحد">
                                <div style="color: red" id="s_title_ar_validate"></div>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                        <div class="row second-row">
                            <div class="col-md-8">
                                <select name="i_type" class="form-control">
                                    <option {{$record_data->i_type == 2 ? "selected" : ""}} value="2">طلب</option>
                                    <option {{$record_data->i_type == 1 ? "selected" : ""}} value="1">عرض</option>
                                </select>
                                <p>اختر عرض <span> إذا كان لديك خدمة تقدمها أو سلعة تريد بيعها أو تأجيرها</span></p>
                                <p>اختر طلب <span>إذا كنت تطلب من الاعضاء سلفة أو خدمة ما</span></p>
                            </div>
                            <div class="col-md-4">
                                <select name="i_contact_method" class="form-control">
                                    <option {{$record_data->i_contact_method == 0 ? "selected" : ""}} value="0">عبر الموقع</option>
                                    <option {{$record_data->i_contact_method == 1 ? "selected" : ""}} value="1">{{Auth::user()->s_mobile_number}}</option>
                                    <option {{$record_data->i_contact_method == 2 ? "selected" : ""}} value="2">{{Auth::user()->s_email}}</option>
                                </select>
                                <p>اختر الطريقة المناسبة للتواصل معك</p>
                            </div>
                        </div>
                    </div>
                    <div class="mid-ad">
                        <div class="row">
                            <div class="col-md-4">
                                <select id="i_fk_category_id1" name="i_fk_category_id1" class="form-control">
                                    <option disabled selected>القسم المخصص لاعلانك</option>
                                    @foreach($primCategory as $p)
                                        <option
                                                @if($main)
                                                {{$main->pk_i_id == $p->pk_i_id ? "selected" : ""}}
                                                @endif
                                                value="{{$p->pk_i_id}}">{{$p->s_name_ar}}</option>
                                    @endforeach
                                </select>
                                <p>يتم اختيار القسم المناسب تلقائياً عند اختيارك عنوان للاعلان، ولكن تأكد فعلاً من صحة
                                    القسم
                                    يدوياً غذا لاحظت أنه غير صحيح أو لم يتعرف على نوع سلعتك</p>
                                <div style="color: red" id="i_fk_category_id1_validate"></div>
                            </div>

                        </div>
                        <div class="mid-ad">

                            <div class="row">
                                <div class="col-md-4">
                                    <select id="main_cat" name="main_cat" class="form-control">

                                    </select>
                                    <div style="color: red" id="main_cat_validate"></div>
                                </div>
                            </div>

                        </div>
                        <div class="mid-ad">

                            <div class="row">
                                <div class="col-md-4">
                                    <select id="i_fk_category_id" name="i_fk_category_id" class="form-control">

                                    </select>
                                    <div style="color: red" id="i_fk_category_id_validate"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="div_add_request">
                    </div>
                    <div class="mid-ad">
                        <div class="container">
                            <p id="para">{{$record_data->i_type == 2 ? "قم بكتابة تفاصيل طلبك بشكل كامل وواضح :" : "قم بكتابة تفاصيل سلعتك أو الخدمة التي تقدمها بشكل كام وواضح:"}}</p>
                            <textarea name="s_details">{{$record_data->s_details}}</textarea>
                            <div style="color: red" id="s_details_validate"></div>
                            <div class="gallery" style="background-color: #e0e0e0;">
                                <?php
//                                $i = 1;
                                ?>
                                @foreach($record_data->getPicsData as $p)
                                    {{--<div style='display: inline-block;padding: 15px'--}}
                                         {{--id='parent_imager_{{$i}}'>--}}
                                        {{--<div>--}}
                                            {{--<a id='position{{$i}}' class='btn btn-default'--}}
                                               {{--style='border-radius: 20px !important;'>{{$i}}</a>--}}
                                        {{--</div>--}}
                                        {{--<div>--}}
                                            {{--<img style='z-index: 1 !important;' height='180px' width='240'--}}
                                                 {{--src="{{url("/")}}/uploads/{{$p->s_value}}">--}}
                                        {{--</div>--}}
                                        {{--<div>--}}
                                            {{--<input type='hidden' id='oldidOfImg{{$i}}'--}}
                                                   {{--value='{{$i}}'>--}}
                                            {{--<input type='hidden' id='idOfImg' value='{{$i}}'>--}}
                                            {{--<a class='btn btn-default'--}}
                                               {{--style='color: #1372c6;padding-left:15px;padding-right:15px'>معاينة</a>--}}
                                            {{--<a id='' style='color: #1372c6;padding-left:19px;padding-right:15px'--}}
                                               {{--class='prive_pic btn btn-default'><i--}}
                                                        {{--style='color: #1372c6;' class='fa fa-arrow-right'></i></a>--}}
                                            {{--<a id='' style='color: #1372c6;padding-left:17px;padding-right:15px'--}}
                                               {{--class='next_pic btn btn-default'><i--}}
                                                        {{--style='color: #1372c6;' class='fa fa-arrow-left'></i></a>--}}
                                            {{--<a id='{{$i}}' style='padding-left:16px'--}}
                                               {{--class='btn btn-default delete_pic1'><i style='color: red'--}}
                                                                                      {{--class='fa fa-times '></i></a>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
<!--                                    --><?php //$i++; ?>
                                @endforeach
                            </div>
                            <div class="text-center">
                                <p>صور الإعلان :</p>
                                <div class="text-center" style="position: relative">
                                    <input type="file"
                                           style="z-index: 2;opacity: 0;position: absolute;width: 100%;height:60px;"
                                           id="files" name="files[]" multiple="">
                                    <a class="btn btn-primary">اضغط هنا لإضافة صور للاعلان</a>
                                    <div style="color: red" id="files_validate"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bottom-ad">
                        <div class="container">
                            <input type="checkbox" name="accept1" id="accept1" value="Agree">أتعهد وأقسم بالله العظيم
                            أنني سأدفع
                            العمولة المستحقة للموقع
                             <br> للموقع مني أنا صاحب الإعلان خلال مدة لا تزيد عن 15 يوم
                            من
                            استلام مبلغ السلعة كامل، ولا تبرأ العمولة مني لأني أنها على المعلن ليست على المشتري ولا تبرأ
                            مني
                            أنا المعلن حتى أدفعها <a>إلا إذا كان صاحب السلعة أعلن لنفس السلعة في الموقع</a> فهي تبرأ مني
                            -
                            صاحب الطلب - وتصبح على صاحب السلعة. <br>
                            <input type="checkbox" name="accept2" id="accept2" value="Agree">أتعهد وأقسم بالله العظيم
                            أنني جاد في
                            العرض
                            المقدم أعلاه وليس لدي نية لمعرفة التسعيرة فقط بدون جدية تصريف السلعة عبر الموقع .<br>
                            <input type="checkbox" name="accept3" id="accept3" value="Agree"> أقر وأقسم بالله العظيم أن
                            القسم المختار
                            للاعلان هو الصحيح وكافة البيانات أعلاه في الإعلان صحيحة والصور حقيقية للسلعة نفسها وحديثة
                            .<br>
                            <span>ستتم مراجعة الاعلان بعد ارساله وإذا ثبت أن البيانات المدخلة بها تحايل أو ما شابه فسيتحمل مسؤولية تبعات ذلك مثل ايقاف العضوية وغيرها</span>
                        </div>
                        <br>
                        <div style="color:red" id="accept_error"></div>
                        <div class="text-center">
                            @if(session("user_id"))
                                <input style="background-color: green;font-size: 14pt" type="submit" class="btn btn-success" value="اعتمد الاعلان">
                            @else
                                <a href="{{url("/")}}/login">يرجى تسجيل الدخول لإضافة إعلانك</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
        $(function () {

            var i_fk_category_id1 = $('#i_fk_category_id1').val();
            $("#main_cat").empty();
            $("#i_fk_category_id").empty();
            $.ajax({
                method: "POST",
                url: '{{url("/")}}/categories/getMainCategory',
                dataType: 'json',
                data: {id: i_fk_category_id1, '_token': '{{csrf_token()}}'},
                success: function (data, textStatus, jqXHR) {
                    if (data.status) {
                        $('#main_cat').append('<option disabled selected="">اختر القسم الرئيسي </option>');
                        for (var i = 0; i < data.main_cats.length; i++) {
                            $('#main_cat').append('<option value="' + data.main_cats[i].pk_i_id + '">' + data.main_cats[i].s_name_ar + '</option>');
                        }
                        $('#main_cat').val("{{$main1->i_parent_id}}");
                        var main_cat = $('#main_cat').val();
                        $("#i_fk_category_id").empty();
                        $.ajax({
                            method: "POST",
                            url: '{{url("/")}}/categories/getMainCategory',
                            dataType: 'json',
                            data: {id: main_cat, '_token': '{{csrf_token()}}'},
                            success: function (data, textStatus, jqXHR) {
                                if (data.status) {
                                    $('#i_fk_category_id').append('<option disabled selected="">اختر القسم الفرعي </option>');
                                    for (var i = 0; i < data.main_cats.length; i++) {
                                        $('#i_fk_category_id').append('<option value="' + data.main_cats[i].pk_i_id + '">' + data.main_cats[i].s_name_ar + '</option>');
                                    }
                                    $('#i_fk_category_id').val("{{$main1->pk_i_id}}")
                                }//end if
                                else {
                                }
                            },
                            error: function (jqXHR, textStatus, errorThrown) {

                            }
                        });

                    }//end if
                    else {
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {

                }
            });
            $("body").on('keyup', '#s_title_ar', function () {
                var s_title_ar = $('#s_title_ar').val();
                var flag = true;
                $.ajax({
                    method: "POST",
                    url: '{{url("/")}}/categories/exQuery',
                    dataType: 'json',
                    data: {s_title_ar: s_title_ar, '_token': '{{csrf_token()}}'},
                    success: function (data, textStatus, jqXHR) {
                        parent_id = data.parent_id;
                        sub_id = data.sub_id;
                        id = data.id;
                        if (data.status) {
                            $("#main_cat").empty();
                            $("#i_fk_category_id").empty();
                            $.ajax({
                                method: "POST",
                                url: '{{url("/")}}/categories/getMainCategory',
                                dataType: 'json',
                                data: {id: parent_id, '_token': '{{csrf_token()}}'},
                                success: function (data, textStatus, jqXHR) {
                                    if (data.status) {
                                        $('#main_cat').append('<option disabled selected="">اختر القسم الرئيسي </option>');
                                        for (var i = 0; i < data.main_cats.length; i++) {
                                            if (data.main_cats[i].i_parent_id != 0) {
                                                $('#main_cat').append('<option value="' + data.main_cats[i].pk_i_id + '">' + data.main_cats[i].s_name_ar + '</option>');
                                            } else {
                                                flag = false;
                                            }
                                        }
                                        $.ajax({
                                            method: "POST",
                                            url: '{{url("/")}}/categories/getMainCategory',
                                            dataType: 'json',
                                            data: {id: sub_id, '_token': '{{csrf_token()}}'},
                                            success: function (data, textStatus, jqXHR) {
                                                if (data.status) {
                                                    $('#i_fk_category_id').append('<option disabled selected="">اختر القسم الفرعي </option>');
                                                    if (flag) {

                                                        for (var i = 0; i < data.main_cats.length; i++) {
                                                            $('#i_fk_category_id').append('<option value="' + data.main_cats[i].pk_i_id + '">' + data.main_cats[i].s_name_ar + '</option>');
                                                        }
                                                    }
                                                    $("#main_cat").val(sub_id);
                                                    $("#i_fk_category_id").val(id);
                                                    $('#i_fk_category_id1').val(parent_id);
                                                    $.ajax({
                                                        method: "POST",
                                                        url: '{{url("/")}}/change_category',
                                                        dataType: 'json',
                                                        data: {
                                                            category: parent_id,
                                                            '_token': '{{csrf_token()}}'
                                                        },
                                                        success: function (data, textStatus, jqXHR) {
                                                            if (data.status) {
                                                                $("#div_add_request").html(data.view1);
                                                            }
                                                        },
                                                        error: function (jqXHR, textStatus, errorThrown) {
                                                        }
                                                    });
                                                }
                                            },
                                            error: function (jqXHR, textStatus, errorThrown) {

                                            }
                                        });
                                    }
                                },
                                error: function (jqXHR, textStatus, errorThrown) {

                                }
                            });
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {

                    }
                });
            });
            $("body").on('change', '#i_fk_category_id1', function () {
                var i_fk_category_id1 = $('#i_fk_category_id1').val();
                $("#main_cat").empty();
                $("#i_fk_category_id").empty();
                $.ajax({
                    method: "POST",
                    url: '{{url("/")}}/categories/getMainCategory',
                    dataType: 'json',
                    data: {id: i_fk_category_id1, '_token': '{{csrf_token()}}'},
                    success: function (data, textStatus, jqXHR) {
                        if (data.status) {
                            $('#main_cat').append('<option disabled selected="">اختر القسم الرئيسي </option>');
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
            $("body").on('change', '#main_cat', function () {
                var main_cat = $('#main_cat').val();
                $("#i_fk_category_id").empty();
                $.ajax({
                    method: "POST",
                    url: '{{url("/")}}/categories/getMainCategory',
                    dataType: 'json',
                    data: {id: main_cat, '_token': '{{csrf_token()}}'},
                    success: function (data, textStatus, jqXHR) {
                        if (data.status) {
                            $('#i_fk_category_id').append('<option disabled selected="">اختر القسم الفرعي </option>');
                            for (var i = 0; i < data.main_cats.length; i++) {
                                $('#i_fk_category_id').append('<option value="' + data.main_cats[i].pk_i_id + '">' + data.main_cats[i].s_name_ar + '</option>');
                            }
                        }//end if
                        else {
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {

                    }
                });
            });
            $("#i_type").change(function () {
                if ($("#i_type").val() == 1) {
                    $("#para").text("قم بكتابة تفاصيل سلعتك أو الخدمة التي تقدمها بشكل كام وواضح:");
                } else {
                    $("#para").text("قم بكتابة تفاصيل طلبك بشكل كامل وواضح :");
                }

            });
            var category = $("#i_fk_category_id1").val();
            $.ajax({
                method: "POST",
                url: '{{url("/")}}/change_category',
                dataType: 'json',
                data: {
                    category: category,
                    '_token': '{{csrf_token()}}'
                },
                success: function (data, textStatus, jqXHR) {
                    if (data.status) {
                        $("#div_add_request").html(data.view1);
                        @foreach($answers as $a)
                            $("#s_answer" + "{{$a->fk_i_field_id}}").val("{{$a->s_answer}}");
                        @endforeach
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                }
            });

            $("#i_fk_category_id1").change(function () {
                var category = $("#i_fk_category_id1").val();
                $.ajax({
                    method: "POST",
                    url: '{{url("/")}}/change_category',
                    dataType: 'json',
                    data: {
                        category: category,
                        '_token': '{{csrf_token()}}'
                    },
                    success: function (data, textStatus, jqXHR) {
                        if (data.status) {
                            $("#div_add_request").html(data.view1);
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                    }
                });
            });
            $("#requestAddForm").validate({
                rules: {
                    main_cat: {
                        required: true,
                    },
                    i_fk_category_id1: {
                        required: true,
                    },
                    accept1: {
                        required: true,
                    },
                    accept2: {
                        required: true,
                    },
                    accept3: {
                        required: true,
                    },
                    s_title_ar: {
                        required: true,
                    },
                    i_fk_category_id: {
                        required: true,
                    },
                },
                errorPlacement: function (error, element) {
                    var name = $(element).attr("name");
                    if (name != "accept1" && name != "accept2" && name != "accept3") {
                        error.appendTo($("#" + name + "_validate"));
                    } else {
                        $("#accept_error").text(" يرجى الموافقة على جميع البنود قبل الإعتماد");
                    }
                },
                messages: {
                    main_cat: {
                        required: "حقل مطلوب",
                    },
                    i_fk_category_id1: {
                        required: "حقل مطلوب",
                    },
                    accept1: {
                        required: "حقل مطلوب",
                    },
                    accept2: {
                        required: "حقل مطلوب",
                    },
                    accept3: {
                        required: "حقل مطلوب",
                    },
                    s_title_ar: {
                        required: "حقل مطلوب",
                    },
                    i_fk_category_id: {
                        required: "حقل مطلوب",
                    },

                }, submitHandler: function (form) {
                    $('#load_l1').removeClass('hidden');
                    $('#load1').modal('show');

                    $.ajax({
                        method: "POST",
                        url: '{{url("/")}}/editAdd1/{{$record_data->pk_i_id}}',
                        dataType: 'json',
                        data: $('#requestAddForm').serialize(),
                        success: function (data, textStatus, jqXHR) {
                            var id = data.id;
                            $.ajax({
                                method: "POST",
                                url: '{{url("/")}}/requestAdd1Image',
                                dataType: 'json',
                                data: {
                                    "pics": pics, "id": id,"edit":1
                                },
                                success: function (data, textStatus, jqXHR) {

                                    window.location.href = "{{url("/")}}/newest/show/" + id;
                                }

                                ,
                                error: function (jqXHR, textStatus, errorThrown) {
                                }
                            })
                            ;
                        }

                        ,
                        error: function (jqXHR, textStatus, errorThrown) {
                        }
                    });
                }
            });
        });
        var image_count = 1;
        var pics_origin = [];
        var pics = [];
        $(function () {
            @foreach($record_data->getPicsData as $p)
            var text = "<div style='display: inline-block;padding: 15px' id='parent_imager_" + image_count + "'>" +
                    "<div>" +
                    "<a id='position" + image_count + "' class='btn btn-default' style='border-radius: 20px !important;'>" + image_count + "</a>" +
                    "</div>" +
                    "<div>" +
                    " <img style='z-index: 1 !important;' height='180px' width='250'" +
                    "src='{{url("/")}}/uploads/{{$p->s_value}}'>" +
                    "</div>" +
                    "<div>" +
                    "<input type='hidden' id='oldidOfImg" + image_count + "' value='" + image_count + "'> " +
                    "<input type='hidden' id='idOfImg' value='" + image_count + "'> " +
                    "<a class='btn btn-default' style='color: #1372c6;padding-left:21px;padding-right:18px'>معاينة</a>" +
                    "<a id='' style='color: #1372c6;padding-left:22px;padding-right:18px' class='prive_pic btn btn-default'><i" +
                    "style='color: #1372c6;' class='fa fa-arrow-right'></i></a>" +
                    "<a id='' style='color: #1372c6;padding-left:20px;padding-right:18px' class='next_pic btn btn-default'><i" +
                    "style='color: #1372c6;' class='fa fa-arrow-left'></i></a>" +
                    "<a id='" + (image_count) + "' style='padding-left:16px' class='btn btn-default delete_pic'><i style='color: red'" +
                    "class='fa fa-times '></i></a>" +
                    "</div>" +
                    "</div>";

            $("div.gallery").append(text);
            pics_origin[(image_count - 1)] = {
                'name': "{{$p->s_value}}",
                'is_delete': 0,
                'order': image_count,
            };
            pics[(image_count - 1)] = {
                'name': "{{$p->s_value}}",
                'is_delete': 0,
                'order': image_count,
            };
            image_count++;

            @endforeach
        });
        $(function () {
            // Multiple images preview in browser
            var imagesPreview = function (input, placeToInsertImagePreview) {
                if (input.files) {
                    var filesAmount = input.files.length;

//                    image_count = {{count($record_data->getPicsData)+1}};
//                    pics = pics_origin;
//                    $(placeToInsertImagePreview).html("");
                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();
                        reader.onload = function (event) {
//                            $($.parseHTML('<img style="margin: 10px" height="150px">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                            var text = "<div style='display: inline-block;padding: 15px' id='parent_imager_" + image_count + "'>" +
                                "<div>" +
                                "<a id='position" + image_count + "' class='btn btn-default' style='border-radius: 20px !important;'>" + image_count + "</a>" +
                                "</div>" +
                                "<div>" +
                                " <img style='z-index: 1 !important;' height='180px' width='250'" +
                                "src='" + event.target.result + "'>" +
                                "</div>" +
                                "<div>" +
                                "<input type='hidden' id='oldidOfImg" + image_count + "' value='" + image_count + "'> " +
                                "<input type='hidden' id='idOfImg' value='" + image_count + "'> " +
                                "<a class='btn btn-default' style='color: #1372c6;padding-left:21px;padding-right:18px'>معاينة</a>" +
                                "<a id='' style='color: #1372c6;padding-left:22px;padding-right:18px' class='prive_pic btn btn-default'><i" +
                                "style='color: #1372c6;' class='fa fa-arrow-right'></i></a>" +
                                "<a id='' style='color: #1372c6;padding-left:20px;padding-right:18px' class='next_pic btn btn-default'><i" +
                                "style='color: #1372c6;' class='fa fa-arrow-left'></i></a>" +
                                "<a id='" + (image_count) + "' style='padding-left:16px' class='btn btn-default delete_pic'><i style='color: red'" +
                                "class='fa fa-times '></i></a>" +
                                "</div>" +
                                "</div>";

                            $(placeToInsertImagePreview).append(text);
                            pics[(image_count -1)] = {
                                'file': event.target.result,
                                'is_delete': 0,
                                'order': image_count,
                            };
                            image_count++;
                        }
                        reader.readAsDataURL(input.files[i]);

                    }
                }
            };
            $('#files').on('change', function () {
                imagesPreview(this, 'div.gallery');
            });
        });
        $('body').on('click', '.prive_pic', function (e) {
            var index_of_img = $(this).siblings("#idOfImg").val();
            var oldidOfImg = $("#oldidOfImg" + index_of_img).val();
            if (oldidOfImg != 1) {
                var other_image_index = 0;
                for (var i = 1; i < image_count; i++) {
                    if ($("#oldidOfImg" + i).val() == (parseInt(oldidOfImg) - 1)) {
                        other_image_index = i;
                        break;
                    }
                }
                $("#oldidOfImg" + index_of_img).val((parseInt(oldidOfImg) - 1));
                $("#position" + index_of_img).text((parseInt(oldidOfImg) - 1));
                pics[(index_of_img - 1)].order = (parseInt(oldidOfImg) - 1);
                $("#oldidOfImg" + other_image_index).val(oldidOfImg);
                $("#position" + other_image_index).text(oldidOfImg);
                pics[(other_image_index - 1)].order = parseInt(oldidOfImg);
                var current_parent_id = $("#oldidOfImg" + index_of_img).parent().parent().attr("id");
                var prev_parent_id = $("#oldidOfImg" + other_image_index).parent().parent().attr("id");
                var current_html = $("#" + current_parent_id).html();
                var prev_html = $("#" + prev_parent_id).html();
                $("#" + current_parent_id).html(prev_html);
                $("#" + prev_parent_id).html(current_html);
            }

        });
        $('body').on('click', '.next_pic', function (e) {
            var index_of_img = $(this).siblings("#idOfImg").val();
            var oldidOfImg = $("#oldidOfImg" + index_of_img).val();
            if (oldidOfImg != (parseInt(image_count) - 1)) {
                var other_image_index = 0;
                for (var i = 1; i < image_count; i++) {
                    if ($("#oldidOfImg" + i).val() == (parseInt(oldidOfImg) + 1)) {
                        other_image_index = i;
                        break;
                    }
                }
                $("#oldidOfImg" + index_of_img).val((parseInt(oldidOfImg) + 1));
                $("#position" + index_of_img).text((parseInt(oldidOfImg) + 1));
                pics[(index_of_img - 1)].order = (parseInt(oldidOfImg) + 1);
                $("#oldidOfImg" + other_image_index).val(oldidOfImg);
                $("#position" + other_image_index).text(oldidOfImg);
                pics[(other_image_index - 1)].order = parseInt(oldidOfImg);
                var current_parent_id = $("#oldidOfImg" + index_of_img).parent().parent().attr("id");
                var prev_parent_id = $("#oldidOfImg" + other_image_index).parent().parent().attr("id");
                var current_html = $("#" + current_parent_id).html();
                var prev_html = $("#" + prev_parent_id).html();
                $("#" + current_parent_id).html(prev_html);
                $("#" + prev_parent_id).html(current_html);
            }
        });
        $('body').on('click', '.delete_pic', function (e) {
            e.preventDefault();
            var m_index = $(this).attr('id');
            var this1 = $(this);
            bootbox.dialog({
                message: "هل أنت متأكد من الحذف؟",
                title: "رسالة تأكيد",
                buttons: {
                    danger: {
                        label: "بالتأكيد, نعم",
                        className: "btn-danger",
                        callback: function () {
                            pics[m_index-1]['is_delete'] = 1;
                            this1.parent().parent().remove();
                        }
                    },
                    main: {
                        label: "لا",
                        className: "btn btn-default",
                        callback: function () {

                        }
                    }
                }
            });

        });

    </script>
@endsection