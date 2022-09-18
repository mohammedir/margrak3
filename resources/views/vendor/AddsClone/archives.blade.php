@extends("_manageLayout")
@section("body")
    <div class="col-sm-10 col-xs-12">
        <section class="manage-content">
            <div class="row">
                <div class="manage-content">
                    <div class="manage-content-show">
                        <div class="manage-title">
                            <p class="manage-head-p">الارشيف  :</p>
                            <div class="row">
                            </div>

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
                                        <th>تم الحذف من قبل</th>
                                        <th>ملاحظات الحذف</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($user_ads as $c)
                                        <tr>
                                            <td>{{$c->s_title_ar}}</td>
                                            <td>{{$c->i_type == 1 ? "عرض" : "طلب"}}</td>

                                            <td>
                                                {{$c->getCategoryName->s_name_ar}}
                                            </td>
                                            <td>{{$c->i_view_count}}</td>
                                            <td>{{$c->i_is_featured == 1 ? "مميز" : "غير مميز"}}</td>
                                            <td>
                                                {{$c->getTheNameOfCreator->s_username}}
                                            </td>
                                            <td>
                                                {{$c->getTheNameOfDeletor->s_username}}
                                            </td>
                                            <td>
                                                <?= $c->s_delete_notes ?>
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

@endsection
