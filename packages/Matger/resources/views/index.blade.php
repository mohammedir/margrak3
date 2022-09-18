@extends("_outLayout")
@section("body")
    <?php
    $WEBSITE_COLOR = \App\Helper\Helper::getSystemRecord("WEBSITE_COLOR");
    ?>
    <div class="row" style="display: flex">
        @include("Matger::departments")
        @include("Matger::subjects")

    </div>
    <div id="add_department_div" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" style="width: 30%;" role="document">
            <form id="add_department_form" action="{{url("/")}}/mtger/{{$record->pk_i_id}}/addDepartment" method="post">
                {{csrf_field()}}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="gridModalLabel">إضافة قسم</h4>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid bd-example-row">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="s_name_ar_add">القسم</label><span style="color: red"> * </span>
                                    <input type="text" class="form-control" name="s_name_ar_add"
                                           id="s_name_ar_add">
                                    <div id="s_name_ar_add_validate" style="color: red"></div>
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
    <script>
        $(function () {
            $('body').on('click', '#add_subject', function () {
                $('#add_subject_div').removeClass('hidden');
            });
            $('body').on('click', '#add_department_btn', function () {
                $('#add_department_div').modal('show');
            });
            $('#add_department_form').validate({
                rules: {
                    s_name_ar_add: "required",
                },
                errorPlacement: function (error, element) {
                    var name = $(element).attr("name");
                    error.appendTo($("#" + name + "_validate"));
                },
                messages: {
                    s_name_ar_add: "حقل مطلوب",
                }, submitHandler: function (form) {
                    form.submit();
                }
            });
        });
        var image_count = 1;
        var pics = [];
        $(function () {
            // Multiple images preview in browser
            var imagesPreview = function (input, placeToInsertImagePreview) {
                if (input.files) {
                    var filesAmount = input.files.length;
//                    image_count = 1;
//                    pics = [];
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
                                "<a class='btn btn-default' style='color: #1372c6;padding-left:9px;padding-right:9px'>معاينة</a>" +
                                "<a id='' style='color: #1372c6;padding-left:22px;padding-right:8px' class='prive_pic btn btn-default'><i" +
                                "style='color: #1372c6;' class='fa fa-arrow-right'></i></a>" +
                                "<a id='' style='color: #1372c6;padding-left:20px;padding-right:8px' class='next_pic btn btn-default'><i" +
                                "style='color: #1372c6;' class='fa fa-arrow-left'></i></a>" +
                                "<a id='" + image_count + "' style='padding-left:16px' class='btn btn-default delete_pic'><i style='color: red'" +
                                "class='fa fa-times '></i></a>" +
                                "</div>" +
                                "</div>";

                            $(placeToInsertImagePreview).append(text);
                            pics[(image_count - 1)] = {
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
                            pics[m_index - 1]['is_delete'] = 1;
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
        });

    </script>
@endsection