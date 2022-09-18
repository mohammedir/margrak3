@extends("_manageLayout")
@section("body")
    <div class="col-sm-10 col-xs-12">
        <section class="manage-content">
            <p class="manage-head-p">الاعضاء :</p>
            <div class="row">
                <div class="row" style="margin: 20px 0px;display:inline-block;">
                    <span style="float:right;">نوع العضوية :</span>
                    <div class="col-md-4" style="margin: 0px 5px;">
                        <select style="padding: 5px;border: 1px solid #ccc;border-radius: 5px;">
                            <option>فعال</option>
                            <option>غير فعال</option>
                        </select>
                    </div>
                </div>
                <div class="row" style="margin: 20px 0px;display:inline-block;">
                    <span style="float:right;">الحالة  :</span>
                    <div class="col-md-4" style="margin: 0px 5px;">
                        <select style="padding: 5px;border: 1px solid #ccc;border-radius: 5px;">
                            <option>فعال</option>
                            <option>غير فعال</option>
                        </select>
                    </div>
                </div>
                <button class="btn btn-primary" style="   position: absolute;top: 22%;"><a href="" style="color:#fff;">عرض</a>
                </button>
            </div>
            <table class="table">
                <thead class="thead-default">
                <tr>
                    <th>الاسم</th>
                    <th>الحالة</th>
                    <th>نوع العضوية</th>
                    <th>رقم الجوال</th>
                    <th>البريد الالكتروني</th>
                    <th>خيارات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $u)
                    <tr>
                        <th>{{$u->s_first_name ." " .$u->s_last_name}}</th>
                        <th>{{$u->b_enabled == 1 ? "فعال" : "غير فعال"}}</th>
                        <th>{{$u->getRole->s_name_ar}}</th>
                        <th>{{$u->s_mobile_number}}</th>
                        <th>{{$u->s_email}}</th>
                        <th>
                            <a title="تعديل" href="{{url("/")}}/editUser/{{$u->pk_i_id}}"><i class="fa fa-user"
                                                                                             aria-hidden="true"></i></a>
                            @if($u->b_enabled == 1)
                                <a class="Confirm" title="حظر" href="{{url("/")}}/block/{{$u->pk_i_id}}/0"><i class="fa fa-ban"
                                                                                              aria-hidden="true"></i></a>
                            @else
                                <a class="Confirm" title="إلغاء الحظر" href="{{url("/")}}/block/{{$u->pk_i_id}}/1"><i class="fa fa-ban"
                                                                                                      aria-hidden="true"></i></a>
                            @endif
                            <a  class="Confirm" title="حذف" href="{{url("/")}}/deleteUser/{{$u->pk_i_id}}"><i class="fa fa-trash-o"
                                                                                             aria-hidden="true"></i></a>
                        </th>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </section>
    </div>
@endsection