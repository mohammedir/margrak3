<div class="container">
    <div class="row">
        <div class="register-box">
            <div class="top-register">
                <p class="green">تعبئة هذه الخانات ( اختياري ) تستطيع أن تقوم بتعبئة هذه البيانات حسب الاختيار، والافضل
                    ان تقوم بتعبئتها كلها لزيادة امان حسابك في حال تمت سرقته</p>
            </div>
            <div class="mid-register">
                <div class="container">
                    <div class="row pic-choose">
                        <label class="control-label">الصورة الشخصية</label>
                        <div class="form-group">
                            <div class="col-xs-12 col-md-4" style="padding-right:0px;">
                                <!-- image-preview-filename input [CUT FROM HERE]-->
                                <div class="input-group image-preview">
                                <span class="input-group-btn">
                                    <!-- image-preview-clear button -->
                                    <button type="button" class="btn btn-default image-preview-clear"
                                            style="display:none;">
                                        <span class="glyphicon glyphicon-remove"></span> إزالة
                                    </button>
                                    <!-- image-preview-input -->
                                    <div class="btn btn-default image-preview-input">
                                        <span class="glyphicon glyphicon-folder-open"></span>
                                        <span class="image-preview-input-title">اختيار</span>
                                        <input type="file" accept="image/png, image/jpeg, image/gif" name="pic"
                                               id="pic"/>

                                        <!-- rename it -->
                                    </div>

                                </span>
                                    <input type="text" class="form-control image-preview-filename" disabled="disabled">
                                    <!-- don't give a name === doesn't send on POST/GET -->
                                </div><!-- /input-group image-preview [TO HERE]-->
                            </div>
                            @if($user_details->s_pic != "")
                                <div>
                                    <img id src="{{url("/")}}/uploads/{{$user_details->s_pic}}" style="max-width: 50px;
                        display: inline-block;position: relative;top: -40%;" alt="">
                                </div>
                            @endif
                        </div>

                        <br>
                        <div style="color:red" id="cat_img_error" class="font-red bold hidden">حقل مطلوب</div>
                    </div>
                    <div class="register-line">
                        <div class="row">
                            <div class="col-md-4">
                                <p>الاسم الاول</p>
                                <input value="{{$user_details->s_first_name}}" name="f_name"
                                       placeholder="اكتب الاسم الاول">
                            </div>
                            <div class="col-md-4">
                                <p>الاسم الاخير</p>
                                <input value="{{$user_details->s_last_name}}" name="l_name"
                                       placeholder="اكتب الاسم الاخير">
                            </div>
                        </div>
                    </div>
                    <div class="register-line">
                        <p>رقم الجوال <span>ضع مفتاح الدولة ثم رقم الجوال بدون الصفر</span></p>
                        <span>* لن يظهر رقمك لاحد غير ادارة الموقع لتسهيل الاجراءات ولزيادة امان الحساب</span><br><br>
                        <input value="{{$user_details->s_mobile_number}}" name="mobile"
                               placeholder="مثال : 955661234567">
                    </div>
                </div>
            </div>
            <div class="bottom-register">
                <a id="previous" class="btn btn-default">السابق</a>
                <input type="submit" class="btn btn-primary" value="تم">
            </div>
        </div>
    </div>
</div>