<table class="table table-hover">
    <thead>
    <tr>
        <th>صاحب الرد</th>
        <th>مقدم الإبلاغ</th>
        <th>الرد</th>
        <th>خيارات</th>
    </tr>
    </thead>
    <tbody>
    @foreach($CommentsComplains as $c)
        <tr>
            <td>{{$c->getCommentsDetails->getCommentsUser->s_username}}</td>
            <td>{{$c->getCommentsUser->s_username}}</td>
            <td>{{$c->getCommentsDetails->s_comment}}</td>
            <td>
                <a href="{{url("/")}}/newest/show/{{$c->getCommentsDetails->getAddsDetails->pk_i_id}}/{{str_replace(" ","-",trim($c->getCommentsDetails->getAddsDetails->s_title_ar))}}"
                   class="btn" style="background-color: green;color: white">الموضوع</a>

                <a class=" Confirm btn btn-primary" href="{{url("/")}}/ruturn_comment/{{$c->fk_i_ads_comments_id}}">إعادة
                    التعليق</a>
                <a class=" Confirm btn btn-danger" href="{{url("/")}}/deleteComment/{{$c->fk_i_ads_comments_id}}">حذف
                    التعليق</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>