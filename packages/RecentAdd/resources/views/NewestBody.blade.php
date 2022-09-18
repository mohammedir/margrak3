<?php $y = 0; ?>
@foreach($user_ads as $c)

    <div class="single-line {{$y %2 != 0 ? "color" : ""}} row">
        <?php $y++; ?>
        <div class="col-md-9 col-xs-9 col-sm-9">
            <p><a style="font-weight: bold;font-size: 16pt;
                @if($c->i_type == 1)
                        color:#019679;
                @else
                        color:#337ab7;
                @endif

"
                  href="{{url("/")}}/newest/show/{{$c->pk_i_id}}/{{str_replace(" ","-",trim($c->s_title_ar))}}">{{$c->s_title_ar}}</a>
            </p>
            <?php
            $i = 0;
            foreach($c->getPicsData as $p){

            if ($i == 4) {
                break;
            }
            $i++;
            ?>

            <img src="{{url("/")}}/uploads/{{$p->s_value}}">
            <?php } ?>
            @if(count($c->getPicsData) > 4)
                <a href="{{url("/")}}/newest/show/{{$c->pk_i_id}}/{{str_replace(" ","-",trim($c->s_title_ar))}}"
                   class="else">المزيد</a>
            @endif
            <div class="left-btn">
                @if($c->i_is_featured == 1)
                    <a class="btn brown-btn" style="cursor: default !important;">مثبت</a>
                @endif
                @if($c->i_type == 1)

                    <a class="btn blue-btn" style="cursor: default !important;">
                        عرض
                    </a>
                @else
                    <a class="btn btn-primary" style="cursor: default !important;">
                        طلب
                    </a>
                @endif

            </div>
        </div>
        <div class="col-md-3 col-xs-3  col-sm-3 details">
            <p>كاتب الإعلان: <span style="color:
                @if($c->getTheNameOfCreator->fk_i_role_id == 95)
                        #04ad67;
                @elseif($c->getTheNameOfCreator->fk_i_role_id == 96)
                        red;
                @elseif($c->getTheNameOfCreator->fk_i_role_id == 92)
                        #1271c7;
                @endif
                        ">{{$c->getTheNameOfCreator->s_username}}</span></p>
            <p>إنشاء الإعلان: <span>{{(new \Carbon\Carbon($c->dt_created_date))->diffForHumans()}}</span>
            </p>
            <p>الموقع:
                @if(isset($c->city_field->fieldOption->s_name_ar))

                    <span style="color:{{$c->getTheNameOfCreator->getCountry->s_color}}">{{$c->city_field->fieldOption->s_name_ar}}</span>
                @endif
            </p>
            <?php
            $lastComment = \App\Helper\Helper::getLastComment($c->pk_i_id);
            ?>
            @if($lastComment)
                <p>آخر مشاركة:
                    <span   style="color:
                    @if($lastComment->getCommentsUser->fk_i_role_id == 95)
                            #04ad67;
                    @elseif($lastComment->getCommentsUser->fk_i_role_id == 96)
                            red;
                    @elseif($lastComment->getCommentsUser->fk_i_role_id == 92)
                            #1271c7;
                    @endif
                            ">{{$lastComment->getCommentsUser->s_username}}</span>
                </p>
            @else
                <p>آخر مشاركة:
                    <span>-</span>
                </p>

            @endif
            <p>الردود: <span>{{count($c->getComments)}}</span></p>
        </div>
    </div>
@endforeach
<div id="more_adds_div{{$index+1}}"></div>
