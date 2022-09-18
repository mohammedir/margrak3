<div class="col-sm-10 hide-show">
    <span>اظهار / اخفاء : </span>
    <div class="single-check">
        <?php
        $COUNTRIES_ADDS = \App\Helper\Helper::getSystemRecord("COUNTRIES_ADDS");
        $ADDS_ADDS = \App\Helper\Helper::getSystemRecord("ADDS_ADDS");
        $MODEL_ADDS = \App\Helper\Helper::getSystemRecord("MODEL_ADDS");
        $VIEW_ASK_ADDS = \App\Helper\Helper::getSystemRecord("VIEW_ASK_ADDS");
        ?>

        <input class="myCheckBox"
               {{$COUNTRIES_ADDS-> s_value == 1 ? "checked" : ""}}
               type="checkbox" name="Accept" value="{{$COUNTRIES_ADDS-> pk_i_id }}"><span>{{$COUNTRIES_ADDS-> s_name_ar }}</span>
    </div>
    <div class="single-check">
        <input class="myCheckBox"
                {{$ADDS_ADDS-> s_value == 1 ? "checked" : ""}}
                type="checkbox" name="Accept"
                value="{{$ADDS_ADDS-> pk_i_id }}"><span>{{$ADDS_ADDS-> s_name_ar }}</span>
    </div>
    <div class="single-check">
        <input class="myCheckBox"
                {{$MODEL_ADDS-> s_value == 1 ? "checked" : ""}}
                type="checkbox" name="Accept"
                value="{{$MODEL_ADDS-> pk_i_id }}"><span>{{$MODEL_ADDS-> s_name_ar }}</span>
    </div>
    <div class="single-check">
        <input class="myCheckBox"
                {{$VIEW_ASK_ADDS-> s_value == 1 ? "checked" : ""}}
                type="checkbox" name="Accept" value="{{$VIEW_ASK_ADDS-> pk_i_id }}"><span>{{$VIEW_ASK_ADDS-> s_name_ar }}</span>
    </div>
</div>
<script>
    $(function () {
        $('.myCheckBox').change(function () {
            var id = $(this).val();
            var checked = 0;
            if (this.checked) {
                checked = 1;
            }
            $.ajax({
                method: "POST",
                url: '{{url("/")}}/system/change',
                dataType: 'json',
                data: {
                    id: id,
                    checked: checked,
                    '_token': '{{csrf_token()}}'
                },
                success: function (data, textStatus, jqXHR) {
                    if (data.status) {

                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                }
            });
        });
    });
</script>