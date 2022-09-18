<table class="table">
    <thead class="thead-default">
    <tr>
        <th>الاسم</th>
        <th>نوع العضوية</th>
        <th>رقم الجوال</th>
        <th>البريد الالكتروني</th>
        <th>عدد مرات الحظر</th>
        <th>تاريخ فك الحظر</th>
        <th>خيارات</th>
    </tr>
    </thead>
    <tbody>
    @foreach($user_auto as $u)
        <tr>
            <th>{{$u->s_first_name ." " .$u->s_last_name}}</th>
            <th>{{$u->getRole->s_name_ar}}</th>
            <th>{{$u->s_mobile_number}}</th>
            <th>{{$u->s_email}}</th>
            <th>{{$u->i_block_count}}</th>
            <th>{{$u->dt_block_to_date}}</th>
            <th>
                <a title="تعديل" href="{{url("/")}}/editUser/{{$u->pk_i_id}}"><i class="fa fa-user"
                                                                                 aria-hidden="true"></i></a>
                <a class="Confirm" title="إلغاء الحظر" href="{{url("/")}}/block/{{$u->pk_i_id}}/1"><i
                            class="fa fa-ban"
                            aria-hidden="true"></i></a>
            </th>
        </tr>
    @endforeach
    </tbody>
</table>