<div style="border-left: 1px solid darkgrey" class="col-md-2">
    @if($user_flag)

            <p>
                <a id="add_department_btn" class="btn btn-primary"
                   style="width:100%;background-color: {{$WEBSITE_COLOR->s_value}}">إضافة
                    قسم</a>
            </p>
            <hr style="background-color: darkgrey">

    @endif
    <?php $loop_index = 0; ?>
    @foreach($record->getChilds as $w)
        <p>
            <a href="{{url("/")}}/mtger/{{$record->pk_i_id}}?department={{$w->pk_i_id}}" class="btn btn-primary"
               style="width:100%;
               @if($w->pk_i_id == $department_id)
                       background-color: red
               @else
                       background-color: {{$WEBSITE_COLOR->s_value}}
               @endif
                       ">{{$w->s_name_ar}}</a>
        </p>
        <?php $loop_index++; ?>
    @endforeach
</div>