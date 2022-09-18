<div class="col-sm-10 hide-show">
    <span>اظهار / اخفاء : </span>
    <?php
    $SHOW_HIDE_SIDEBAR_CATEGORY_PAGE = \App\Helper\Helper::getSystemRecord("SHOW_HIDE_SIDEBAR_CATEGORY_PAGE");
    $SHOW_HIDE_SIDEBAR_ADD_ADS_BTN = \App\Helper\Helper::getSystemRecord("SHOW_HIDE_SIDEBAR_ADD_ADS_BTN");
    $SHOW_HIDE_SIDEBAR_GOTO_SOUQ_BTN = \App\Helper\Helper::getSystemRecord("SHOW_HIDE_SIDEBAR_GOTO_SOUQ_BTN");
    $SHOW_HIDE_SIDEBAR_NEWST_PAGE = \App\Helper\Helper::getSystemRecord("SHOW_HIDE_SIDEBAR_NEWST_PAGE");
    $SHOW_HIDE_SIDEBAR_SOUQ_PAGE = \App\Helper\Helper::getSystemRecord("SHOW_HIDE_SIDEBAR_SOUQ_PAGE");
    ?>
    <div class="manage-title">
        <div class="row">
            <div class="hide-show">
                <span>اظهار / اخفاء : </span>
                <div class="single-check">
                    <input class="myCheckBox"
                           {{$SHOW_HIDE_SIDEBAR_CATEGORY_PAGE-> s_value == 1 ? "checked" : ""}}
                           type="checkbox" name="Accept"
                           value="{{$SHOW_HIDE_SIDEBAR_CATEGORY_PAGE-> pk_i_id }}"><span>{{$SHOW_HIDE_SIDEBAR_CATEGORY_PAGE-> s_name_ar }}</span>

                </div>
                <div class="single-check">
                    <input class="myCheckBox"
                           {{$SHOW_HIDE_SIDEBAR_ADD_ADS_BTN-> s_value == 1 ? "checked" : ""}}
                           type="checkbox" name="Accept"
                           value="{{$SHOW_HIDE_SIDEBAR_ADD_ADS_BTN-> pk_i_id }}"><span>{{$SHOW_HIDE_SIDEBAR_ADD_ADS_BTN-> s_name_ar }}</span>

                </div>
                <div class="single-check">
                    <input class="myCheckBox"
                           {{$SHOW_HIDE_SIDEBAR_GOTO_SOUQ_BTN-> s_value == 1 ? "checked" : ""}}
                           type="checkbox" name="Accept"
                           value="{{$SHOW_HIDE_SIDEBAR_GOTO_SOUQ_BTN-> pk_i_id }}"><span>{{$SHOW_HIDE_SIDEBAR_GOTO_SOUQ_BTN-> s_name_ar }}</span>
                </div>
            </div>
            <div class="hide-show">
                <span>إظهار القائمة في صفحة :</span>
                <div class="single-check">
                    <input class="myCheckBox"
                           {{$SHOW_HIDE_SIDEBAR_NEWST_PAGE-> s_value == 1 ? "checked" : ""}}
                           type="checkbox" name="Accept"
                           value="{{$SHOW_HIDE_SIDEBAR_NEWST_PAGE-> pk_i_id }}"><span>{{$SHOW_HIDE_SIDEBAR_NEWST_PAGE-> s_name_ar }}</span>
                </div>
                <div class="single-check">
                    <input class="myCheckBox"
                           {{$SHOW_HIDE_SIDEBAR_SOUQ_PAGE-> s_value == 1 ? "checked" : ""}}
                           type="checkbox" name="Accept"
                           value="{{$SHOW_HIDE_SIDEBAR_SOUQ_PAGE-> pk_i_id }}"><span>{{$SHOW_HIDE_SIDEBAR_SOUQ_PAGE-> s_name_ar }}</span>
                </div>
            </div>
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