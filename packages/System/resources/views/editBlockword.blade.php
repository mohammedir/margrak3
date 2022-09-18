@extends("_manageLayout")
@section("body")
    <form id="word_form" action="" method="post">
        {{csrf_field()}}
        <div class="col-sm-10 col-xs-12">
            <section class="manage-content">
                <p class="manage-head-p">{{$title}}</p>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label">الكلمة</label>
                        <div class="inputGroupContainer">
                            <div class="input-group">
                                <input value="{{$record->s_name_ar}}" id="word" name="word" placeholder="الكلمة" class="form-control" type="text">
                                <div style="color:red" id="title_validate"></div>
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
                                    <option {{$record->b_enabled == 0 ? "selected" : ""}} value="0">غير فعال</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" value="حفظ" class="btn btn-success">
                <a href="{{url("/")}}/blockword" class="btn btn-danger">الغاء</a>
            </section>
        </div>
    </form>
    <script>
        $(function () {
            $('#word_form').validate({
                rules: {
                    word: {required: true},
                },
                errorPlacement: function (error, element) {
                    var name = $(element).attr("name");
                    error.appendTo($("#" + name + "_validate"));
                },
                messages: {
                    word: {required: "حقل مطلوب"},
                }, submitHandler: function (form) {
                    form.submit();
                }
            });
        });
    </script>

@endsection
