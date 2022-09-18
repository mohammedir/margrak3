@extends("_manageLayout")
@section("body")
    <div class="col-sm-10 col-xs-12">
        <section class="manage-content">
            <div class="row">
                <div class="manage-content">
                    <div class="manage-content-show">
                        <div class="manage-title">
                            <p class="manage-head-p">قوالب اضافة اعلان :</p>
                            <div class="row">
                                <a href="{{url("/")}}/addTemplate" class="btn btn-primary pull-right">إضافة قالب</a>
                            </div>

                            <div class="row">
                                <table class="table">
                                    <thead class="thead-default">
                                    <tr>
                                        <th>اسم القالب</th>
                                        <th>التصنيف</th>
                                        <th>خيارات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($templates as $c)
                                        <tr>
                                            <td>{{$c->s_name_ar}}</td>
                                            <td>
                                                <a style="cursor:pointer;" class="view_category">عرض</a>
                                                <input type="hidden" value="{{$c->pk_i_id}}" id="pk_i_id">
                                            </td>
                                            <td>
                                                <a class="btn btn-primary"
                                                   href="{{url("/")}}/editTemplate/{{$c->pk_i_id}}">تعديل</a>
                                                <a class="btn btn-danger Confirm1"
                                                   href="{{url("/")}}/deleteTemplate/{{$c->pk_i_id}}">حذف</a>
                                                <input type="hidden" value="{{$c->pk_i_id}}" id="o_pk_i_id">
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="modal fade" id="AreaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">الأقسام التي يظهر بها الاعلان</h4>
                </div>
                <div class="modal-body">
                    <div class="types-show" id="div_body_modal">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">اغلاق</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $(".view_category").click(function () {
                var pk_i_id = $(this).siblings("#pk_i_id").val();
                $("#AreaModal").modal("show");
                $.ajax({
                    method: "POST",
                    url: '{{url("/")}}/getTemplateModalBody',
                    dataType: 'json',
                    data: {
                        id: pk_i_id,
                        '_token': '{{csrf_token()}}'
                    },
                    success: function (data, textStatus, jqXHR) {
                        if (data.status) {
                            $("#div_body_modal").html(data.view1);
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                    }
                });
            });
        });
    </script>

@endsection
