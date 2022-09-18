@extends("_manageLayout")
@section("body")
    <form action="" method="post" enctype="multipart/form-data">
        <div class="col-sm-10 col-xs-12">
            <section class="manage-content">
                <p class="manage-head-p">الشعار على الصور :</p>

                <?php
                $LOGO_WATERMARK = \App\Helper\helper::getSystemRecord("LOGO_WATERMARK");
                $LOGO_WATERMARK_POSITION = \App\Helper\helper::getSystemRecord("LOGO_WATERMARK_POSITION");
                $LOGO_WATERMARK_TRANSPARENCY = \App\Helper\helper::getSystemRecord("LOGO_WATERMARK_TRANSPARENCY");
                ?>
                <div class="row pic-choose">
                    <label class="control-label">الشعار</label>
                    <div class="form-group">
                        <div class="col-xs-12 col-md-4" style="padding-right:0px;">
                            <!-- image-preview-filename input [CUT FROM HERE]-->
                            <div class="input-group ">
                                <span class="input-group-btn">
                                    <!-- image-preview-clear button -->
                                    <button type="button" class="btn btn-default image-preview-clear"
                                            style="display:none;">
                                        <span class="glyphicon glyphicon-remove"></span> إزالة
                                    </button>
                                    <!-- image-preview-input -->
                                    <div class="btn btn-default image-preview-input">
                                        <span class="image-preview-input-title">اختيار</span>
                                        <input type="file" accept="image/png, image/jpeg, image/gif"
                                               name="logo"/> <!-- rename it -->
                                    </div>
                                </span>
                                <input value="{{$LOGO_WATERMARK->s_value}}" type="text"
                                       class="form-control image-preview-filename" disabled="disabled">
                                <!-- don't give a name === doesn't send on POST/GET -->
                            </div><!-- /input-group image-preview [TO HERE]-->
                        </div>
                    </div>
                </div>

                <div class="row" style="margin: 20px 0px;">
                    <div class="col-md-4 text-center">
                        <input name="LOGO_WATERMARK_TRANSPARENCY"
                               value="{{$LOGO_WATERMARK_TRANSPARENCY->s_value == null ? "" : $LOGO_WATERMARK_TRANSPARENCY->s_value}}"
                               id='rng1'/>
                        <img src="{{url("/")}}/assets/img/2.jpeg" width='250'>
                        <img id="img1"
                             src="{{url("/")}}/{{$LOGO_WATERMARK->s_value == null ? "assets/img/logo-test.png" : "uploads/".$LOGO_WATERMARK->s_value }}"
                             class="gray-scale-img profileImage img-responsive"
                             style='opacity:{{$LOGO_WATERMARK_TRANSPARENCY->s_value == null ? ".54" : $LOGO_WATERMARK_TRANSPARENCY->s_value}}; position: absolute;top: 40%;right: 35%;width: 100px;'/>
                    </div>
                </div>


                <div class="row" style="margin-top:20px;">
                    <div class="form-group">
                        <label class="control-label">موقع الشعار</label>
                        <div class="selectContainer">
                            <div class="input-group">
                                <select name="LOGO_WATERMARK_POSITION" class="form-control selectpicker">
                                    <option disabled selected>اختر الموقع</option>
                                    <option {{$LOGO_WATERMARK_POSITION->s_value ==  "top_right" ? "selected" : ""}} value="top_right">
                                        أعلى يمين
                                    </option>
                                    <option {{$LOGO_WATERMARK_POSITION->s_value ==  "top_mid" ? "selected" : ""}} value="top_mid">
                                        أعلى وسط
                                    </option>
                                    <option {{$LOGO_WATERMARK_POSITION->s_value ==  "top_left" ? "selected" : ""}} value="top_left">
                                        أعلى يسار
                                    </option>
                                    <option {{$LOGO_WATERMARK_POSITION->s_value ==  "mid_right" ? "selected" : ""}} value="mid_right">
                                        وسط يمين
                                    </option>
                                    <option {{$LOGO_WATERMARK_POSITION->s_value ==  "mid_mid" ? "selected" : ""}} value="mid_mid">
                                        وسط وسط
                                    </option>
                                    <option {{$LOGO_WATERMARK_POSITION->s_value ==  "mid_left" ? "selected" : ""}} value="mid_left">
                                        وسط يسار
                                    </option>
                                    <option {{$LOGO_WATERMARK_POSITION->s_value ==  "bottom_right" ? "selected" : ""}} value="bottom_right">
                                        أسفل يمين
                                    </option>
                                    <option {{$LOGO_WATERMARK_POSITION->s_value ==  "bottom_mid" ? "selected" : ""}} value="bottom_mid">
                                        أسفل وسط
                                    </option>
                                    <option {{$LOGO_WATERMARK_POSITION->s_value ==  "bottom_left" ? "selected" : ""}} value="bottom_left">
                                        أسفل يسار
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>


                <button class="btn btn-success">حفظ</button>
                <button class="btn btn-danger">الغاء</button>
            </section>
        </div>
    </form>
    <script>
        $(function () {
            var rng = $("#rng1");
            rng.ionRangeSlider({
                type: "single",
                min: 0,
                max: 1.00,
                from: .54,
                step: .01,
                keyboard: true
            });
            rng.on("change", function () {
                var value = $(this).prop("value");
                $('#img1').css('opacity', value);
            });
        });
    </script>
@endsection