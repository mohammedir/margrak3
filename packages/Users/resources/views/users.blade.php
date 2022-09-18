@extends("_manageLayout")
@section("body")
    <div class="col-sm-10 col-xs-12">
        <section class="manage-content">
            <p class="manage-head-p">الاعضاء :</p>

            <div class="row">

                <form action="" method="get">
                    <div class="row">
                        <div class="col-md-2" style="margin: 20px 0px;display:inline-block;">
                            <span style="float:right;">نوع العضوية :</span>
                            <div class="col-md-5" style="margin: 0px 5px;">
                                <select name="type" style="padding: 5px;border: 1px solid #ccc;border-radius: 5px;">
                                    <option value="">عرض الكل</option>
                                    @foreach($roles->getChilds as $c)
                                        <option {{$type==$c->pk_i_id ? "selected" : "" }} value="{{$c->pk_i_id}}">{{$c->s_name_ar}}</option>
                                    @endforeach
                                    <?php
                                    $mtgers = \App\Helper\Helper::getFromConstant("MATAGER", 127);

                                    ?>

                                    @foreach($mtgers as $c)
                                        <option {{$type==$c->pk_i_id ? "selected" : "" }} value="{{$c->pk_i_id}}">أعضاء {{$c->s_name_ar}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-md-2" style="margin: 20px 0px;display:inline-block;">
                            <span style="float:right;margin-right: 25px;">الحالة  :</span>
                            <div class="col-md-5" style="margin: 0px 5px;">
                                <select name="enabled" selected
                                        style="padding: 5px;border: 1px solid #ccc;border-radius: 5px;">
                                    <option value="">عرض الكل</option>
                                    <option {{$status=="1" ? "selected" : "" }} value="1">فعال</option>
                                    <option {{$status=="0" ? "selected" : "" }} value="0">غير فعال</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1" style="margin: 20px 0px;display:inline-block;">
                            <input type="submit" class="btn btn-primary" value="عرض">
                        </div>
                    </div>
                </form>
            </div>

            <div style="float: left">
                <a class="send_msg" style="margin-left:100px "><i class="fa fa-envelope"></i> رسالة للجميع</a>
                <input type="hidden" id="sender_id" value="{{ session("user_id") }}">
                <input type="hidden" id="reciver_id" value="0">
            </div>
            <table class="table">
                <thead class="thead-default">
                <tr>
                    <th>الاسم</th>
                    <th>الحالة</th>
                    <th>نوع العضوية</th>
                    <th>رقم الجوال</th>
                    <th>البريد الالكتروني</th>
                    <th>خيارات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $u)

                    <tr style="color:
@if($u->fk_i_role_id == 95)
                            #04ad67;
                            @elseif($u->fk_i_role_id == 96)
                            red;
                            @elseif($u->fk_i_role_id == 92)
                            #1271c7;
                            @endif
">
                        <th>{{$u->s_username}}</th>
                        <th>{{$u->b_enabled == 1 ? "فعال" : "غير فعال"}}</th>
                        <th>{{$u->getRole->s_name_ar}}</th>
                        <th>{{$u->s_mobile_number}}</th>
                        <th>{{$u->s_email}}</th>
                        <th>
                            <a title="تعديل" href="{{url("/")}}/editUser/{{$u->pk_i_id}}"><i class="fa fa-user"
                                                                                             aria-hidden="true"></i></a>
                            @if($u->b_enabled == 1)
                                <a class="Confirm" title="حظر" href="{{url("/")}}/block/{{$u->pk_i_id}}/0"><i
                                            class="fa fa-ban"
                                            aria-hidden="true"></i></a>
                            @else
                                <a class="Confirm" title="إلغاء الحظر" href="{{url("/")}}/block/{{$u->pk_i_id}}/1"><i
                                            class="fa fa-ban"
                                            aria-hidden="true"></i></a>
                            @endif
                            <a class="Confirm" title="حذف" href="{{url("/")}}/deleteUser/{{$u->pk_i_id}}"><i
                                        class="fa fa-trash-o"
                                        aria-hidden="true"></i></a>
                            <a class="" title="حذف" href="{{url("/")}}/users_msgs/{{$u->pk_i_id}}"><i
                                        class="fa fa-envelope"
                                        aria-hidden="true"></i></a>
                            @if($u->pk_i_id != session("user_id"))
                                <a class="send_msg">رسالة خاصة</a>
                                <input type="hidden" id="sender_id" value="{{ session("user_id") }}">
                                <input type="hidden" id="reciver_id" value="{{$u->pk_i_id}}">
                            @endif
                        </th>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </section>
    </div>
@endsection