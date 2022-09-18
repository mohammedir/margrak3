@foreach($user_ads as $c)

    <div class="single-line row">
        <div class="col-md-9">
            <p>{{$c->s_title_ar}}</p>
            @foreach($c->getPicsData as $p)
                <img src="{{url("/")}}/uploads/{{$p->s_value}}">
            @endforeach
            <a href="{{url("/")}}/newest/show/{{$c->pk_i_id}}" class="else">المزيد</a>
            <div class="left-btn">
                <button class="btn brown-btn">مثبت</button>
                <a href="{{url("/")}}/newest/show/{{$c->pk_i_id}}" class="btn blue-btn">عرض</a>

            </div>
        </div>
        <div class="col-md-3 details">
            <p>كاتب الإعلان: <span>{{$c->getTheNameOfCreator->s_username}}</span></p>
            <p>إنشاء الإعلان: <span>{{(new \Carbon\Carbon($c->dt_created_date))->diffForHumans()}}</span>
            </p>
            <p>موقع المعلن:
                <span>{{$c->getTheNameOfCreator->getCountry->s_name_ar . " - ". $c->getTheNameOfCreator->getCity->s_name_ar}}</span>
            </p>
            <?php
            $lastComment = \App\Helper\helper::getLastComment($c->pk_i_id);
            ?>
            @if($lastComment)
                <p>آخر مشاركة:
                    <span>{{$lastComment->getCommentsUser->s_username}}</span>
                </p>
            @endif
            <p>الردود: <span>13</span></p>
        </div>
    </div>
@endforeach
