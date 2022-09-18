<div class="col-sm-10 hide-show">
    <div class="hide-show">
        <span>اظهار / اخفاء : </span>
    </div>
    <div class="single-check">
        <?php
        $AD_SPACE_BAR = \App\Helper\Helper::getSystemRecord("AD_SPACE_BAR");
        $ADS_SPACE_BAR_COUNT = \App\Helper\Helper::getSystemRecord("ADS_SPACE_BAR_COUNT");
        ?>

        <input class="myCheckBox"
               {{$AD_SPACE_BAR-> s_value == 1 ? "checked" : ""}}
               type="checkbox" name="Accept"
               value="{{$AD_SPACE_BAR-> pk_i_id }}"><span>{{$AD_SPACE_BAR-> s_name_ar }}</span>
    </div>
    <div class="row">
        <span>{{$AD_SPACE_BAR-> s_name_ar }}</span>
        <select name="ADS_SPACE_BAR_COUNT" id="ADS_SPACE_BAR_COUNT" style="border: 1px solid #ccc;border-radius: 5px;padding: 5px;min-width: 70px;">
            <option {{$ADS_SPACE_BAR_COUNT->s_value == "5"  ? "selected" : ""}} value="5">5</option>
            <option {{$ADS_SPACE_BAR_COUNT->s_value == "10"  ? "selected" : ""}} val10ue="5">10</option>
            <option {{$ADS_SPACE_BAR_COUNT->s_value == "15"  ? "selected" : ""}} value="15">15</option>
            <option {{$ADS_SPACE_BAR_COUNT->s_value == "20"  ? "selected" : ""}} value="20">20</option>
            <option {{$ADS_SPACE_BAR_COUNT->s_value == "25"  ? "selected" : ""}} value="25">25</option>
            <option {{$ADS_SPACE_BAR_COUNT->s_value == "30"  ? "selected" : ""}} value="30">30</option>
            <option {{$ADS_SPACE_BAR_COUNT->s_value == "35"  ? "selected" : ""}} value="35">35</option>
            <option {{$ADS_SPACE_BAR_COUNT->s_value == "40"  ? "selected" : ""}} value="40">40</option>
            <option {{$ADS_SPACE_BAR_COUNT->s_value == "45"  ? "selected" : ""}} value="45">45</option>
            <option {{$ADS_SPACE_BAR_COUNT->s_value == "50"  ? "selected" : ""}} value="50">50</option>
        </select>
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
    $(function () {
        $('#ADS_SPACE_BAR_COUNT').change(function () {
            var id = "{{$ADS_SPACE_BAR_COUNT->pk_i_id}}";
            var value = $(this).val();
            $.ajax({
                method: "POST",
                url: '{{url("/")}}/system/change1',
                dataType: 'json',
                data: {
                    id: id,
                    value: value,
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