@foreach($tags_ary as $c2)
    <div style="float: right;margin-top:0px !important;" class="types-show">
        <a style="padding-left: 3px !important;padding-right: 3px !important;margin-left: 5px"
           href="{{url("/")}}/newest?cat={{$c2->fk_i_ads_user_id}}&tag_text={{$c2->key_word}}">{{$c2->key_word}}</a>
    </div>
@endforeach
@if(count($tags_ary) == 0)
    <span></span>
@endif