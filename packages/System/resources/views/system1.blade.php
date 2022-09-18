<div class="col-sm-10 hide-show">
    <span>اظهار / اخفاء : </span>
    <div class="single-check">
        <?php
        $NEW_ADS_BAR = \App\Helper\Helper::getSystemRecord("NEW_ADS_BAR_For_Souq");
        $NEW_REQUEST_BAR = \App\Helper\Helper::getSystemRecord("NEW_REQUEST_BAR_For_Souq");
        $AD_SPACE_BAR = \App\Helper\Helper::getSystemRecord("AD_SPACE_BAR");
        $SEARCH_BAR = \App\Helper\Helper::getSystemRecord("SEARCH_BAR");
        $ADS_FILTERS = \App\Helper\Helper::getSystemRecord("ADS_FILTERS");

        ?>

        <input class="myCheckBox"
               {{$NEW_ADS_BAR->s_value == 1 ? "checked" : ""}}
               type="checkbox" name="Accept"
               value="{{$NEW_ADS_BAR->pk_i_id }}"><span>{{$NEW_ADS_BAR->s_name_ar }}</span>
    </div>
    <div class="single-check">
        <input class="myCheckBox"
               {{$NEW_REQUEST_BAR->s_value == 1 ? "checked" : ""}}
               type="checkbox" name="Accept"
               value="{{$NEW_REQUEST_BAR->pk_i_id }}"><span>{{$NEW_REQUEST_BAR->s_name_ar }}</span>
    </div>
    <div class="single-check">
        <input class="myCheckBox"
               {{$AD_SPACE_BAR->s_value == 1 ? "checked" : ""}}
               type="checkbox" name="Accept"
               value="{{$AD_SPACE_BAR->pk_i_id }}"><span>{{$AD_SPACE_BAR->s_name_ar }}</span>
    </div>
    <div class="single-check">
        <input class="myCheckBox"
               {{$SEARCH_BAR->s_value == 1 ? "checked" : ""}}
               type="checkbox" name="Accept" value="{{$SEARCH_BAR->pk_i_id }}"><span>{{$SEARCH_BAR->s_name_ar }}</span>
    </div>
    <div class="single-check">
        <input class="myCheckBox"
               {{$ADS_FILTERS->s_value == 1 ? "checked" : ""}}
               type="checkbox" name="Accept"
               value="{{$ADS_FILTERS->pk_i_id }}"><span>{{$ADS_FILTERS->s_name_ar }}</span>
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