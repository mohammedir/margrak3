@foreach($comments as $c)
    <div class="right-comment-b">
        <p class="top-p">
            <a href="{{url("/")}}/accountDetails/{{$c->fk_i_by_user_id}}">{{$c->getEvaluationUser->s_username}}</a><br>
            <?php $data = (\App\Helper\Helper::getEvaluationData1($user_details->pk_i_id, $c->fk_i_by_user_id)); ?>
            @if($data->s_value == "نعم")
                <span>ينصح بالتعامل مع {{$user_details->s_username}}  </span>
            @else
                <span class="bad-comment">لا ينصح بالتعامل مع {{$user_details->s_username}}</span>
            @endif
        </p>
        <p class="bottom-p">{{$c->s_value}}</p>
    </div>
@endforeach
<div id="more_adds_div{{$index+1}}"></div>
