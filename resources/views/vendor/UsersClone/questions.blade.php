<table class="table table-hover" style="width: 100%">
    <thead>
    <tr>
        <th width="15%">الإسم</th>
        <th width="15%">الإيميل</th>
        <th width="15%">رقم الهاتف</th>
        <th width="60%">الإستفسار</th>
        <th width="5%">خيارات</th>
    </tr>
    </thead>
    <tbody>
    @foreach($contacts as $c)
        @if($c->i_type == 1)
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