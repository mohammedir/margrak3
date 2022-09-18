@extends("_manageLayout")
@section("body")
    <form id="FAQ_form" action="" method="post">
        {{csrf_field()}}
        <div class="col-sm-10 col-xs-12">
            <section class="manage-content">
                <p class="manage-head-p">{{$title}}</p>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label">السؤال</label>
                        <div class="inputGroupContainer">
                            <div class="input-group">
                                <input id="title" name="title" placeholder="السؤال" class="form-control" type="text">
                                <div style="color:red" id="title_validate"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label">الإجابة</label>
                        <div class="inputGroupContainer">
                            <div class="input-group">
                                <textarea class="new-width" name="desc" id="desc" placeholder="الإجابة"
                                          class="form-control" type="text"></textarea>
                                <div style="color:red" id="desc_validate"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label">الحالة</label>
                        <div class="selectContainer">
                            <div class="input-group">
                                <select name="status" class="form-control selectpicker">
                                    <option selected value="1">فعال</option>
                                    <option value="0">غير فعال</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" value="حفظ" class="btn btn-success">
                <a href="{{url("/")}}/FAQ" class="btn btn-danger">الغاء</a>
            </section>
        </div>
    </form>
    <script>
        $(function () {
            $('#FAQ_form').validate({
                rules: {
                    title: {required: true},
                    desc: {required: true},
                },
                errorPlacement: function (error, element) {
                    var name = $(element).attr("name");
                    error.appendTo($("#" + name + "_validate"));
                },
                messages: {
                    desc: {required: "حقل مطلوب"},
                    title: {required: "حقل مطلوب"},
                }, submitHandler: function (form) {
                    form.submit();
                }
            });
        });
    </script>

@endsection
