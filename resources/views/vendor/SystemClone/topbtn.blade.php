<div class="col-sm-10 hide-show">
    <span>اظهار / اخفاء : </span>
    <div class="single-check">
        <?php
        $SHOW_HIDE_SOUQ_BTN = \App\Helper\helper::getSystemRecord("SHOW_HIDE_SOUQ_BTN");
        $SHOW_HIDE_NEWST_BTN = \App\Helper\helper::getSystemRecord("SHOW_HIDE_NEWST_BTN");
        ?>

        <input class="myCheckBox"
               {{$SHOW_HIDE_SOUQ_BTN-> s_value == 1 ? "checked" : ""}}
               type="checkbox" name="Accept" value="{{$SHOW_HIDE_SOUQ_BTN-> pk_i_id }}"><span>{{$SHOW_HIDE_SOUQ_BTN->s_name_ar }}</span>
        <input class="myCheckBox"
               {{$SHOW_HIDE_NEWST_BTN-> s_value == 1 ? "checked" : ""}}
               type="checkbox" name="Accept" value="{{$SHOW_HIDE_NEWST_BTN-> pk_i_id }}"><span>{{$SHOW_HIDE_NEWST_BTN->s_name_ar }}</span>
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