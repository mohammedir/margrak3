<table class="table table-hover">
    <thead>
    <tr>
        <th>الإسم</th>
        <th>الإيميل</th>
        <th>رقم الهاتف</th>
        <th>الشكوى</th>
        <th>خيارات</th>
    </tr>
    </thead>
    <tbody>
    @foreach($contacts as $c)
        @if($c->i_type == 3)
            <tr>
                <td>{{$c->s_name_ar}}</td>
                <td>{{$c->s_email}}</td>
                <td>{{$c->s_mobile}}</td>
                <td>{{$c->s_desc}}</td>
                <td><a href="{{url("/")}}/delMsg/{{$c->pk_i_id}}" class="Confirm"><i class="fa fa-trash"></i></a></td>
            </tr>
        @endif
    @endforeach
    </tbody>
</table>