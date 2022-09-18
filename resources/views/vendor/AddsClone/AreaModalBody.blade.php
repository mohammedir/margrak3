<?php
$ary = json_decode($record->i_fk_category_id);
?>
@if(is_array( json_decode($record->i_fk_category_id)))
    @foreach($primCategory as $p)
        <?php
        $primeFlag = false;
        if (isset($ary[0])) {
            foreach ($ary as $a) {
                if (in_array($p->pk_i_id, $a)) {
                    $primeFlag = true;
                }
            }
        }
        ?>
        @if($primeFlag)
            <div class="row">
                <div class="market-single-line row">
                    <div class="manage-content-title row">
                        <span><a>{{$p->s_name_ar}}</a></span>
                    </div>
                    @foreach($p->getChilds as $c1)
                        <?php
                        $mainFlag = false;
                        if (isset($ary[0])) {
                            foreach ($ary as $a) {
                                if (in_array($c1->pk_i_id, $a)) {
                                    $mainFlag = true;
                                }
                            }
                        }
                        ?>
                        @if($mainFlag)
                            <div class="row market-single-show">
                                <div class="manage-types">
                                    {{$c1->s_name_ar}} <span>جميع أنواع {{$c1->s_name_ar}}</span>
                                    <br>
                                    <div class="types-show">
                                        @foreach($c1->getChilds as $c2)
                                            <?php
                                            $subFlag = false;
                                            if (isset($ary[0])) {
                                                foreach ($ary as $a) {
                                                    if (in_array($c2->pk_i_id, $a)) {
                                                        $subFlag = true;
                                                    }
                                                }
                                            }
                                            ?>
                                            @if($subFlag)
                                                <a>
                                                        <span>
                                                            @if($c2->s_pic != "")
                                                                <img src="{{url("/")}}/uploads/{{$c2->s_pic}}">
                                                            @endif
                                                        </span> {{$c2->s_name_ar}}
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
    @endforeach
@else
    @foreach($primCategory as $p)
        <div class="row">
            <div class="market-single-line row">
                <div class="manage-content-title row">
                    <span><a>{{$p->s_name_ar}}</a></span>
                </div>
                @foreach($p->getChilds as $c1)

                    <div class="row market-single-show">
                        <div class="manage-types">
                            {{$c1->s_name_ar}} <span>جميع أنواع {{$c1->s_name_ar}}</span>
                            <br>
                            <div class="types-show">
                                @foreach($c1->getChilds as $c2)

                                    <a>
                                                        <span>
                                                            @if($c2->s_pic != "")
                                                                <img src="{{url("/")}}/uploads/{{$c2->s_pic}}">
                                                            @endif
                                                        </span> {{$c2->s_name_ar}}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
@endif