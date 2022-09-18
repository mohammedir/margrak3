@extends("_manageLayout")
@section("body")
    <div class="col-sm-10 col-xs-12">
        <section class="manage-content">
            <div class="row">
                <div class="manage-content">
                    <div class="manage-content-show">
                        <div class="manage-title">
                            <p class="manage-head-p">اعلانات الاعضاء :</p>
                            <form action="{{url("/")}}/saveAddsNo" method="post">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-md-3">
                                        <?php
                                        $adds_no = \App\Helper\Helper::getSystemRecord("adds_no");
                                        ?>
                                        <label for="">{{$adds_no->s_name_ar}}</label>
                                        <input required name="adds_no" type="number" min="0"
                                               value="{{$adds_no->s_value}}" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="submit" value="حفظ" class="btn btn-primary" style="margin-top:9%">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <br>
                        <div class="row">
                            <table class="table">
                                <thead class="thead-default">
                                <tr>
                                    <th>الاعلان</th>
                                    <th>النوع</th>
                                    <th>القسم</th>
                                    <th>عدد الزيارات</th>
                                    <th>مميز</th>
                                    <th>بواسطة</th>
                                    <th>خيارات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($user_ads as $c)
                                    <tr>
                                        <td><a style="
                                            @if($c->i_type == 1)
                                                    color:#019679;
                                            @else
                                                    color:#337ab7;
                                            @endif

                                                    "
                                               href="{{url("/")}}/newest/show/{{$c->pk_i_id}}/{{str_replace(" ","-",trim($c->s_title_ar))}}">{{$c->s_title_ar}}</a></td>
                                        <td>{{$c->i_type == 1 ? "عرض" : "طلب"}}</td>

                                        <td>
                                            @if($c->i_is_featured == 0)
                                                {{$c->getCategoryName->s_name_ar}}
                                            @else
                                                <a style="cursor:pointer;" class="view_category">عرض</a>
                                                <input type="hidden" value="{{$c->pk_i_id}}" id="pk_i_id">
                                            @endif
                                        </td>
                                        <td>{{$c->i_view_count}}</td>
                                        <td>{{$c->i_is_featured == 1 ? "مميز" : "غير مميز"}}</td>
                                        <td>

                                            {{$c->getTheNameOfCreator->s_username}}

                                        </td>
                                        <td>
                                            <a class="btn btn-primary"
                                               href="{{url("/")}}/edit_user_ads/{{$c->pk_i_id}}">تعديل</a>
                                            <a class="btn btn-danger Confirm1"
                                               href="{{url("/")}}/delete_adds_area/{{$c->pk_i_id}}">حذف</a>
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
    <form action="" method="post">
        {{csrf_field()}}
        <div id="Confirm1" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-l" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">رسالة تأكيد</h4>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <label for="">ملاحظات</label>
                            <textarea class="form-control" name="notes" id="notes" cols="30" rows="10"></textarea>
                            <input type="hidden" id="d_pk_i_id" name="d_pk_i_id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">إلغاء</button>
                        <input type="submit" class="btn btn-danger" value="حذف">
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </form>
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
        $(document).on("click", ".Confirm1", function () {
            var o_pk_i_id = $(this).siblings("#o_pk_i_id").val();
            $("#d_pk_i_id").val(o_pk_i_id);
            $("#Confirm1").modal("show");
            $("#Confirm1 .btn-danger").attr("href", $(this).attr("href"));
            return false;
        });
    </script>
    <script>
        $(function () {
            $(".view_category").click(function () {
                var pk_i_id = $(this).siblings("#pk_i_id").val();
                $("#AreaModal").modal("show");
                $.ajax({
                    method: "POST",
                    url: '{{url("/")}}/getUserAddsModalBody',
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
