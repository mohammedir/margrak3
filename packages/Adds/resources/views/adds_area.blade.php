@extends("_manageLayout")
@section("body")
    <div class="col-sm-10 col-xs-12">
        <section class="manage-content">
            <div class="row">
                <div class="manage-content">
                    <div class="manage-content-show">
                        <div class="manage-title">

                            <div class="row">
                                @include("System::adds_area")
                            </div>
                            <a class="btn btn-success" style="float:left;color:#fff;" href="{{url("/")}}/add_adds_area">
                                + اعلان جديد</a>
                            <div class="row">
                                <table class="table">
                                    <thead class="thead-default">
                                    <tr>
                                        <th>الاعلان</th>
                                        <th>الصورة</th>
                                        <th>الأقسام</th>
                                        <th>عدد النقرات</th>
                                        <th>الحالة</th>
                                        <th>خيارات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($adds_area as $c)
                                        <tr>
                                            <td>{{$c->s_title}}</td>
                                            <td>
                                                @if($c->s_pic != "")
                                                    <img style="width:90px" src="{{url("/")}}/uploads/{{$c->s_pic}}">
                                                @else
                                                    لا توجد صورة
                                                @endif
                                            </td>
                                            <td>
                                                <a style="cursor:pointer;" class="view_category">عرض</a>
                                                <input type="hidden" value="{{$c->pk_i_id}}" id="pk_i_id">
                                            </td>
                                            <td>{{$c->i_clicks_count}}</td>
                                            <td>{{$c->b_enabled == 1 ? "فعال" : "غير فعال"}}</td>
                                            <td>
                                                <a class="btn btn-primary"
                                                   href="{{url("/")}}/edit_adds_area/{{$c->pk_i_id}}">تعديل</a>
                                                <a class="btn btn-danger Confirm"
                                                   href="{{url("/")}}/delete_adds_area/{{$c->pk_i_id}}">حذف</a>
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
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
                    url: '{{url("/")}}/getAreaModalBody',
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
