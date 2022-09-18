@extends("_manageLayout")
@section("body")
    <div class="col-sm-10 col-xs-12">
        <section class="manage-content">
            <div class="row">
                <div class="manage-content">
                    <div class="manage-content-show">
                        <div class="manage-title">
                            <div class="row">
                                @include("System::side_list")
                            </div>
                        </div>
                        <form action="" method="post">
                            {{csrf_field()}}
                            @foreach($primCategory as $p)
                                <div class="row">
                                    <div class="market-single-line row">
                                        <div class="manage-content-title row">
                                            <input {{-- {{$p->b_is_tag == 1 ? "checked" : ""}} --}}type="checkbox"
                                                   id="select_all_{{$p->pk_i_id}}"
                                                   name="cat_{{$p->pk_i_id}}"
                                                   value="Agree"><span><a>{{$p->s_name_ar}}</a></span>
                                        </div>
                                        @foreach($p->getChilds as $c1)
                                            <div class="row market-single-show">
                                                <div class="manage-types">
                                                    <a>{{$c1->s_name_ar}} <span>جميع أنواع {{$c1->s_name_ar}}</span></a>
                                                    <br>
                                                    <div class="types-show">
                                                        @foreach($c1->getChilds as $c2)
                                                            <span>
                                                                <input {{$c2->b_in_sidebar == 1 ? "checked" : ""}} type="checkbox"
                                                                       name="cat_{{$c2->pk_i_id}}"
                                                                       class="my_e_check_{{$p->pk_i_id}}"
                                                                       value="Agree">
                                                                <input type="hidden" id="side_list_id"
                                                                       value="{{$c2->pk_i_id}}">
                                                                <a class="sidelist_btn">
                                                        <span>
                                                            @if($c2->s_sidebar_pic != "")
                                                                <img src="{{url("/")}}/uploads/{{$c2->s_sidebar_pic}}">
                                                            @endif
                                                        </span> {{$c2->s_name_ar}}
                                                                </a>
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                            <br>
                            <div class="row" style="margin-bottom:20px;">
                                <input class="btn btn-success" type="submit" value="حفظ">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <form action="{{url("/")}}/saveImageSidelist" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div id="sidelist_modal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">صورة القسم في القائمة الجانبية</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row pic-choose">
                            <label class="control-label">الشعار</label>
                            <div class="form-group">
                                <div class="col-xs-12" style="padding-right:0px;">
                                    <!-- image-preview-filename input [CUT FROM HERE]-->
                                    <div class="input-group image-preview">
                                                                        <span class="input-group-btn">
                                                                            <!-- image-preview-clear button -->
                                                                            <button type="button"
                                                                                    class="btn btn-default image-preview-clear"
                                                                                    style="display:none;">
                                                                                <span class="glyphicon glyphicon-remove"></span> إزالة
                                                                            </button>
                                                                            <!-- image-preview-input -->
                                                                            <div class="btn btn-default image-preview-input">
                                                                                <span class="glyphicon glyphicon-folder-open"></span>
                                                                                <span class="image-preview-input-title">اختيار</span>
                                                                                <input type="file"
                                                                                       accept="image/png, image/jpeg, image/gif"
                                                                                       name="cat_img"/>
                                                                                <!-- rename it -->
                                                                            </div>
                                                                        </span>
                                        <input type="text" class="form-control image-preview-filename"
                                               disabled="disabled">
                                        <!-- don't give a name === doesn't send on POST/GET -->
                                    </div><!-- /input-group image-preview [TO HERE]-->
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin:20px 0px;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input class="btn btn-success" type="submit" value="حفظ">
                        <button type="button" class="btn btn-default" data-dismiss="modal">إغلاق</button>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="s_l_id" name="s_l_id">

    </form>
    <script>
        $(function () {
            $(".sidelist_btn").click(function () {
                var id = $(this).siblings("#side_list_id").val();
                $("#s_l_id").val(id);
                $("#sidelist_modal").modal("show");
            });
                    @foreach($primCategory as $p)
            var select_all_{{$p->pk_i_id}} = document.getElementById("select_all_{{$p->pk_i_id}}");
            var checkboxes_{{$p->pk_i_id}} = document.getElementsByClassName("my_e_check_{{$p->pk_i_id}}");

            select_all_{{$p->pk_i_id}}.addEventListener("change", function (e) {
                for (i = 0; i < checkboxes_{{$p->pk_i_id}}.length; i++) {
                    checkboxes_{{$p->pk_i_id}}[i].checked = select_all_{{$p->pk_i_id}}.checked;
                }
            });
            for (var i = 0; i < checkboxes_{{$p->pk_i_id}}.length; i++) {
                checkboxes_{{$p->pk_i_id}}[i].addEventListener('change', function (e) { //".checkbox" change
                    if (this.checked == false) {
                        select_all_{{$p->pk_i_id}}.checked = false;
                    }
                    if (document.querySelectorAll('.check_bg:checked').length == checkboxes_{{$p->pk_i_id}}.length) {
                        select_all_{{$p->pk_i_id}}.checked = true;
                    }
                });
            }
            @endforeach
        });
    </script>
@endsection
