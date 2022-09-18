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
                                <input id="s_title_ar" name="s_title_ar"
                                       placeholder="مثال: ايفون بلس اسود مستعمل شهر واحد">
                                <div style="color: red" id="s_title_ar_validate"></div>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                        <div class="row second-row">
                            <div class="col-md-8">
                                <select name="i_type" class="form-control">
                                    <option value="2">طلب</option>
                                    <option value="1">عرض</option>
                                </select>
                                <p>اختر عرض <span> إذا كان لديك خدمة تقدمها أو سلعة تريد بيعها أو تأجيرها</span></p>
                                <p>اختر طلب <span>إذا كنت تطلب من الاعضاء سلفة أو خدمة ما</span></p>
                            </div>
                            <div class="col-md-4">
                                <select name="i_contact_method" class="form-control">
                                    <option value="1">رقم الجوال</option>
                                    <option value="2">الإيميل</option>
                                </select>
                                <p>اختر الطريقة المناسبة للتواصل معك</p>
                            </div>
                        </div>
                    </div>
                    <div class="mid-ad">
                        <div class="row">
                            <div class="col-md-4">
                                <select id="i_fk_category_id" name="i_fk_category_id" class="form-control">
                                    <option disabled selected>القسم المخصص لاعلانك</option>
                                    @foreach($primCategory as $p)
                                        <option value="{{$p->pk_i_id}}">{{$p->s_name_ar}}</option>
                                    @endforeach
                                </select>
                                <p>يتم اختيار القسم المناسب تلقائياً عند اختيارك عنوان للاعلان، ولكن تأكد فعلاً من صحة
                                    القسم
                                    يدوياً غذا لاحظت أنه غير صحيح أو لم يتعرف على نوع سلعتك</p>
                                <div style="color: red" id="i_fk_category_id_validate"></div>
                            </div>
                        </div>
                    </div>
                    <div id="div_add_request">
                    </div>
                    <div class="mid-ad">
                        <div class="container">
                            <p>قم بكتابة تفاصيل السلعة أو الخدمة التي تقدمها بشكل كامل وواضح :</p>
                            <textarea name="s_details"></textarea>
                            <div style="color: red" id="s_details_validate"></div>
                            <div class="text-center">
                                <p>صور الإعلان :</p>
                                <input  type="file" id="files" name="files[]" multiple="">
                                <div style="color: red" id="files_validate"></div>
                            </div>
                        </div>
                    </div>
                    <div class="bottom-ad">
                        <div class="container">
                            <input type="checkbox" name="accept1" id="accept1" value="Agree">أتعهد وأقسم بالله العظيم
                            أنني سأدفع
                            العمولة
                            المستحقة للموقع والتي هي 1% فقط من قيمة بيع السلعة أو تأجيرها ( التأجير تؤخذ قيمة أول تأجير
                            فقط
                            لمرة واحدة )، وأن العمولة مستحقة <br> للموقع مني أنا صاحب الإعلان خلال مدة لا تزيد عن 15 يوم
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
                            <input type="submit" class="btn btn-success" value="اعتمد الاعلان">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
    <script>
        $(function () {
            $("#i_fk_category_id").change(function () {
                var category = $("#i_fk_category_id").val();
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
                    form.submit();
                }
            });
        });
    </script>
@endsection