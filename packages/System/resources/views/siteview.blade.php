@extends("_manageLayout")
@section("body")
    <form method="post" action="" id="site_form" enctype="multipart/form-data">
    {{csrf_field()}}

        <?php
        $website_title = \App\Helper\Helper::getSystemRecord("website_title");
        $WEBSITE_COLOR = \App\Helper\Helper::getSystemRecord("WEBSITE_COLOR");
        $website_logo = \App\Helper\Helper::getSystemRecord("website_logo");

        ?>
        <div class="col-sm-10 col-xs-12">
            <section class="manage-content">
                <p class="manage-head-p">{{$title}}</p>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label">{{$website_title->s_name_ar }}</label>
                        <div class="inputGroupContainer">
                            <div class="input-group">
                                <input value="{{$website_title->s_value  }}" name="website_title" id="website_title"
                                       placeholder="عنوان القسم"
                                       class="form-control" type="text">
                                <div id="website_title_validate" style="color:red"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="hue-demo">{{$WEBSITE_COLOR->s_name_ar }}</label>
                    <div class="row">
                        <div class="col-md-2 the-color">
                            <input value="{{$WEBSITE_COLOR->s_value  }}" type="text" id="WEBSITE_COLOR"
                                   name="WEBSITE_COLOR"
                                   class="form-control demo" data-control="hue">
                            <div id="WEBSITE_COLOR_validate" style="color:red"></div>
                        </div>
                    </div>
                </div>


                <div class="row pic-choose">
                    <label class="control-label">{{$website_logo->s_name_ar }}</label>
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
                        <input type="file" accept="image/png, image/jpeg, image/gif" name="site_img" id="site_img"/>
                        <!-- rename it -->
                    </div>

                </span>
                                <input value="{{$website_logo-> s_value }}" type="text"
                                       class="form-control image-preview-filename" disabled="disabled">
                                <!-- don't give a name === doesn't send on POST/GET -->
                            </div><!-- /input-group image-preview [TO HERE]-->
                        </div>
                    </div>
                    @if($website_logo-> s_value  != "")
                        <div>
                            <img id src="{{url("/")}}/uploads/{{$website_logo-> s_value }}" style="max-width: 50px;
                        display: inline-block;position: relative;top: -40%;" alt="">
                        </div>
                    @endif
                    <div style="color:red" id="cat_img_error" class="font-red bold hidden">حقل مطلوب</div>
                </div>
                </div>


                <input type="submit" value="حفظ" class="btn btn-success">
            </section>
        </div>
    </form>
    <script type="text/javascript">
        $(function () {
            $("#site_form").validate({
                // Specify validation rules
                rules: {
                    website_title: "required",
                    WEBSITE_COLOR: "required",
                },
                // Specify validation error messages
                messages: {
                    website_title: "حقل مطلوب",
                    WEBSITE_COLOR: "حقل مطلوب",
                },
                errorPlacement: function (error, element) {
                    var name = $(element).attr("name");
                    error.appendTo($("#" + name + "_validate"));
                },
                submitHandler: function (form) {
                    form.submit();
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
                            console.log(hex);
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