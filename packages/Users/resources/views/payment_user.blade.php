<table class="table">
    <thead class="thead-default">
    <tr>
        <th>الاعلان</th>
        <th>النوع</th>
        <th>عدد الزيارات</th>
        <th>مميز</th>
        <th>بواسطة</th>
        <th>القيمة</th>
        <th>فترة الدفع</th>
        <th>صاحب الحساب البنكي</th>
        <th>رقم الجوال</th>
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
            <td>{{$c->i_view_count}}</td>
            <td>{{$c->i_is_featured == 1 ? "مميز" : "غير مميز"}}</td>
            <td>

                {{$c->getTheNameOfCreator->s_username}}

            </td>
            <td>{{$c->ads_value}}</td>
            <td>{{$c->getDurationText->s_name_ar}}</td>
            <td>{{$c->s_fullname}}</td>
            <td>{{$c->s_mobile}}</td>
        </tr>
    @endforeach
    </tbody>
</table>