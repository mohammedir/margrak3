@extends("_manageLayout")
@section("body")
    <div class="col-sm-10 col-xs-12">
        <section class="manage-content">
            <p class="manage-head-p">{{$title}} :</p>
            <a href="{{url("/")}}/addRules" class="btn btn-success" style="float:left;"> + اضافة قانون</a>
            <table class="table">
                <thead class="thead-default">
                <tr>
                    <th>العنوان</th>
                    <th>الحالة</th>
                    <th>ادارة</th>
                </tr>
                </thead>
                <tbody>
                @foreach($rules as $c)
                    <tr>
                        <td>{{$c->s_title}}</td>
                        <td>{{$c->b_enabled == 1 ? "فعال" : "غير فعال"}}</td>
                        <td>
                            <a class="btn btn-primary" href="{{url("/")}}/editRules/{{$c->pk_i_id}}">تعديل</a>
                            <a class="btn btn-danger Confirm" href="{{url("/")}}/deleteRules/{{$c->pk_i_id}}">حذف</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </section>
    </div>
@endsection
