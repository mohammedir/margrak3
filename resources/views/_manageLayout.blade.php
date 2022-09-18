<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{$title}}</title>
    <meta name="description" content="An interactive getting started guide for Brackets1.">
    <link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/droidarabickufi.css">
    <link rel="stylesheet" href="{{url("/")}}/assets/css/bootstrap-arabic.min.css">
    <link rel="stylesheet" href="{{url("/")}}/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{url("/")}}/assets/css/ion.rangeSlider.css">
    <link rel="icon" href="https://www.templatemonster.com/favicon.ico">
    <link rel="stylesheet" type="text/css" media="all" href="{{url("/")}}/assets/css/jquery.minicolors.css">
    <link rel="stylesheet" href="{{url("/")}}/assets/main.css">
    <script type="text/javascript" src="{{url("/")}}/assets/js/jquery-1.10.2.min.js"></script>
    @if($title != "إضافة قسم جديد" && $title != "تعديل بيانات القسم")
    <script src="{{url("/")}}/assets/js/textarea.js"></script>
    @endif
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
          type="text/css"/>

    <style>
        @import url(https://fonts.googleapis.com/earlyaccess/droidarabickufi.css);

        * {
            font-family: 'Droid Arabic Kufi', sans-serif;
        }
    </style>
</head>
<body>
@if(session('s_msg'))
    <div class="alert alert-success alert-dismissible text-center"
         style="top:0; position: absolute;width: 100%;z-index: 1;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ session('s_msg') }}
    </div>
@endif
@if(session('e_msg'))
    <div class="alert alert-danger alert-dismissible text-center"
         style="top:0; position: absolute;width: 100%;z-index: 1;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ session('e_msg') }}
    </div>
@endif

<head class="manage">
    <div class="manage-logo">
        <p>ادارة الموقع</p>
    </div>
</head>

<div class="row">
    <div style="float: left;margin-left: 20px;margin-bottom: 10px">
        <a href="{{url("/")}}/newest">الذهاب للموقع الخارجي</a>
    </div>
</div>

<div class="row">
    <div class="col-sm-2 c-panel">
        <div class="sidebar-nav">
            <div class="navbar navbar-default" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target=".sidebar-navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <span class="visible-xs navbar-brand"></span>
                </div>
                <div class="navbar-collapse collapse sidebar-navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="
                        @if($title == "الأقسام" ||$title == "إضافة قسم جديد"||$title == "تعديل بيانات القسم")
                                active
                        @endif
                                text-center"><a href="{{url("/")}}/categories">السوق</a></li>
                        <li class="
                        @if($title == "الأحدث")
                                active
                        @endif
                                text-center"><a href="{{url("/")}}/recents">الأحدث</a></li>
                        <li class="
                        @if($title == "مظهر الموقع")
                                active
                        @endif
                                text-center"><a href="{{url("/")}}/siteview">مظهر الموقع</a></li>
                        <li class="
                        @if($title == "الأشرطة")
                                active
                        @endif
                                text-center"><a href="{{url("/")}}/announcement">الأشرطة</a></li>
                        <li class="
                        @if($title == "قوالب اضافة اعلان" || $title == "اضافة قالب" || $title == "تعديل بيانات القالب")
                                active
                        @endif
                                text-center"><a href="{{url("/")}}/templates">قوالب اضافة اعلان</a></li>
                        <li class="
                        @if($title == "الشعار على الصور")
                                active
                        @endif
                                text-center"><a href="{{url("/")}}/watermark">الشعار على الصور</a></li>
                        <li class="
                        @if($title == "ازرار القائمة العلوية")
                                active
                        @endif
                                text-center"><a href="{{url("/")}}/topbtn">ازرار القائمة العلوية</a></li>
                        <li class="
                        @if($title == "فلتر الإعلانات")
                                active
                        @endif
                                text-center"><a href="{{url("/")}}/adds">فلتر الاعلانات</a></li>
                        <li class="
                        @if($title == "القائمة الجانبية")
                                active
                        @endif
                                text-center"><a href="{{url("/")}}/sidelist">القائمة الجانبية</a></li>
                        <li class="
                        @if($title == "صفحة العمولة"|| $title == "إضافة عمولة"|| $title == "تعديل بيانات العمولة"
                        || $title == "إضافة بنك"|| $title == "تعديل بيانات البنك")
                                active
                        @endif
                                text-center"><a href="{{url("/")}}/coins">صفحة العمولة</a></li>
                        <li class="
                        @if($title == "القوانين")
                                active
                        @endif
                                text-center"><a href="{{url("/")}}/rules">القوانين</a></li>
                        <li class="
                        @if($title == "كلمات محظورة")
                                active
                        @endif
                                text-center"><a href="{{url("/")}}/blockword">كلمات محظورة</a></li>
                        <li class="
                        @if($title == "إحصائيات الموقع")
                                active
                        @endif
                                text-center"><a href="{{url("/")}}/statistics">احصائية الموقع</a></li>
                        <li class="
                        @if($title == "المساحة الاعلانية" || $title == "إضافة مساحة اعلانية" || $title == "تعديل بيانات المساحة الاعلانية")
                                active
                        @endif
                                text-center"><a href="{{url("/")}}/adds_area">المساحة الاعلانية</a></li>
                        <li class="
                        @if($title == "اعلانات الاعضاء" || $title == "تعديل بيانات اعلان العضو")
                                active
                        @endif
                                text-center"><a href="{{url("/")}}/user_ads">اعلانات الاعضاء</a></li>
                        <li class="
                        @if($title == "الدول والمدن" )
                                active
                        @endif
                                text-center"><a href="{{url("/")}}/cities">الدول والمدن</a></li>
                        <li class="
                        @if($title == "الاعضاء" )
                                active
                        @endif
                                text-center"><a href="{{url("/")}}/users">الاعضاء</a></li>
                        <li class="
                        @if($title == "القائمة السوداء" || $title == "إضافة قائمة سوداء" || $title == "تعديل القائمة السوداء")
                                active
                        @endif
                                text-center"><a href="{{url("/")}}/blacklists">القائمة السوداء</a></li>
                        <li class="
                        @if($title == "الاسئلة الشائعة")
                                active
                        @endif
                                text-center"><a href="{{url("/")}}/FAQ">الاسئلة الشائعة</a></li>
                        <li class="
                        @if($title == "الارشيف")
                                active
                        @endif
                                text-center"><a href="{{url("/")}}/archives">الارشيف</a></li>
                        <li class="
                         @if($title == "الاشعارات والرسائل")
                                active
                        @endif
                                text-center"><a href="{{url("/")}}/manageMessages">الاشعارات والرسائل</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>
    </div>
    @yield("body")
</div>
<div id="Confirm" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">رسالة تأكيد</h4>
            </div>
            <div class="modal-body">
                <p>هل أنت متأكد ؟</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">إلغاء</button>
                <a class="btn btn-danger">نعم متأكد</a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript" src="{{url("/")}}/assets/js/bootstrap-arabic.min.js"></script>
<script type="text/javascript" src="{{url("/")}}/assets/main.js"></script>
<script type="text/javascript" src="{{url("/")}}/assets/js/jquery.minicolors.min.js"></script>
<script type="text/javascript" src="{{url("/")}}/assets/js/dropzone.js"></script>
<script type="text/javascript" src="{{url("/")}}/assets/js/ion.rangeSlider.min.js"></script>
<script src="{{url("/")}}/assets/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="{{url("/")}}/assets/js/textarea_key.js" type="text/javascript"></script>
<script src="{{url("/")}}/assets/js/bootbox.min.js" type="text/javascript"></script>
<script src="{{url("/")}}/assets/js/app.js" type="text/javascript"></script>
<script src="{{url("/")}}/assets/js/amchart.js" type="text/javascript"></script>
<form id="msg_form" action="{{url("/")}}/send_msg" method="post">
    {{csrf_field()}}
    <div id="message_modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-l" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">إرسال رسالة</h4>
                </div>
                <div class="modal-body">
                    <p>يرجى إدخال نص الرسالة</p>
                    <textarea style="width: 100%;" id="msg" name="msg" cols="10" rows="10"></textarea>
                    <div id="msg_validate" style="color:red"></div>
                    <input type="hidden" id="sender" name="sender">
                    <input type="hidden" id="reciver" name="reciver">
                </div>
                <div class="modal-footer">
                    @if(Auth::user())
                        <button type="button" class="btn btn-default" data-dismiss="modal">إلغاء</button>
                        <input type="submit" class="btn btn-primary" value="إرسال">
                    @else
                        <p style="color:red">لإرسال رسالة يرجى <a href="{{url("/")}}/login">تسجيل الدخول</a>
                    @endif
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</form>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=jymrfsru2wff5m7tl2uiwc44pn4szt0qokm7lumj89r6kut8"></script>
<script>
    $(document).on("click", ".Confirm", function () {
        $("#Confirm").modal("show");
        $("#Confirm .btn-danger").attr("href", $(this).attr("href"));
        return false;
    });
    $(document).on("ready", function () {
        $(".send_msg").click(function () {
            var sender = $(this).siblings("#sender_id").val();
            var reciver = $(this).siblings("#reciver_id").val();
            $("#sender").val(sender);
            $("#reciver").val(reciver);
            $("#message_modal").modal("show");
        });
        $('#msg_form').validate({
            rules: {
                msg: {
                    required: true,
                },
            },
            errorPlacement: function (error, element) {
                var name = $(element).attr("name");
                error.appendTo($("#" + name + "_validate"));
            },
            messages: {
                msg: {
                    required: "حقل مطلوب",
                },
            }, submitHandler: function (form) {
                form.submit();
            }
        });

        if ("{{$title}}" != "إضافة قسم جديد" && "{{$title}}" != "تعديل بيانات القسم") {
            tinymce.init({
                selector: 'textarea',
                height: 300,
                menubar: false,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table contextmenu paste code'
                ],
                toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                content_css: [
                    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                    '//www.tinymce.com/css/codepen.min.css']
            });
        }
    });

</script>

</body>
</html>
