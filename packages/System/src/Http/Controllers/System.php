<?php

//namespace Packages\System\Http\Controllers;
namespace Packages\System\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Packages\Adds\ConstantModel;
use Packages\Adds\UserAddsModel;
use Packages\RecentAdd\UserReactModel;
use Packages\System\Notification;
use Packages\System\NotificationUser;
use Packages\System\SystemModel;
use Packages\Adds\AddsModel;
use DB;
//namespace Packages\System\src\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use Packages\Users\UserModel;

class System extends BaseController
{
    public function readNotification($id)
    {
        $not = Notification::where([
            "pk_i_id" => $id,
        ])->first();
        NotificationUser::where([
            "fk_i_notification_id" => $id,
            "fk_i_user_id" => Auth::user()->pk_i_id,
        ])->delete();
        return redirect($not->s_url);
    }

    public function send_msg(Request $request)
    {
        if ($request->input()) {
            $sender_details = UserModel::where([
                "pk_i_id" => $request->input("sender")
            ])->first();
            if ($request->input("reciver") != 0) {
                $record = [
                    "s_msg" => $request->input("msg"),
                    "i_target_users_id" => 2,
                    "fk_i_actor_user_id" => $request->input("sender"),
                    "s_url" => "/viewMessages/" . $sender_details->pk_i_id,
                    "s_url_msg" => "لديك رسالة من: " . $sender_details->s_username,
                    "b_enabled" => 1,
                    "dt_created_date" => date('Y-m-d H:i:s'),
                ];
                $notif_obj = Notification::create($record);
                $user_record = [
                    "fk_i_notification_id" => $notif_obj->pk_i_id,
                    "fk_i_user_id" => $request->input("reciver"),
                    "dt_created_date" => date('Y-m-d H:i:s'),
                    "i_title_type" => 1,//message
                ];
                NotificationUser::create($user_record);
            } else {
                $users = UserModel::where(
                    "pk_i_id", "<>", $request->input("sender")
                )->get();
                foreach ($users as $uu) {
                    $record = [
                        "s_msg" => $request->input("msg"),
                        "i_target_users_id" => 2,
                        "fk_i_actor_user_id" => $request->input("sender"),
                        "s_url" => "/viewMessages/" . $sender_details->pk_i_id,
                        "s_url_msg" => "لديك رسالة من: " . $sender_details->s_username,
                        "b_enabled" => 1,
                        "dt_created_date" => date('Y-m-d H:i:s'),
                    ];
                    $notif_obj = Notification::create($record);
                    $user_record = [
                        "fk_i_notification_id" => $notif_obj->pk_i_id,
                        "fk_i_user_id" => $uu->pk_i_id,
                        "dt_created_date" => date('Y-m-d H:i:s'),
                        "i_title_type" => 1,//message
                    ];
                    NotificationUser::create($user_record);
                }
            }
            return back()->with("s_msg", "تمت العملية بنجاح");
        }
    }

    public function send_msg1(Request $request)
    {
        if ($request->input()) {
            $sender_details = UserModel::where([
                "pk_i_id" => $request->input("sender")
            ])->first();
            $subject = UserAddsModel::where([
                "pk_i_id" => $request->input("subject_id_msg")
            ])->first();
            $text = "";
            if ($request->input("flag_auth") != "true") {
                $text .= "الإسم: " . $request->input("username_msg_mtger") . "<br>";
                $text .= "رقم الهاتف: " . $request->input("mobile_msg_mtger") . "<br>";
            }
            $text .= "الرسالة تابعة للموضوع: <a href='" . url("/") . "/mtger/" . $request->input("mtger_id_msg") . "?department=" . $request->input("department_id_msg") . "&subject=" . $request->input("subject_id_msg") . "" . "'>" . $subject->s_title_ar . "</a><br>";
            $text .= $request->input("msg");
            if ($request->input("reciver") != 0) {
                $record = [
                    "s_msg" => $text,
                    "i_target_users_id" => 2,
                    "fk_i_actor_user_id" => $request->input("sender"),
                    "s_url" => "/viewMessages/" . $sender_details->pk_i_id,
                    "s_url_msg" => "لديك رسالة من: " . $sender_details->s_username,
                    "b_enabled" => 1,
                    "dt_created_date" => date('Y-m-d H:i:s'),
                ];
                $notif_obj = Notification::create($record);
                $user_record = [
                    "fk_i_notification_id" => $notif_obj->pk_i_id,
                    "fk_i_user_id" => $request->input("reciver"),
                    "dt_created_date" => date('Y-m-d H:i:s'),
                    "i_title_type" => 1,//message
                ];
                NotificationUser::create($user_record);
            } else {
                $users = UserModel::where(
                    "pk_i_id", "<>", $request->input("sender")
                )->get();
                foreach ($users as $uu) {
                    $record = [
                        "s_msg" => $text,
                        "i_target_users_id" => 2,
                        "fk_i_actor_user_id" => $request->input("sender"),
                        "s_url" => "/viewMessages/" . $sender_details->pk_i_id,
                        "s_url_msg" => "لديك رسالة من: " . $sender_details->s_username,
                        "b_enabled" => 1,
                        "dt_created_date" => date('Y-m-d H:i:s'),
                    ];
                    $notif_obj = Notification::create($record);
                    $user_record = [
                        "fk_i_notification_id" => $notif_obj->pk_i_id,
                        "fk_i_user_id" => $uu->pk_i_id,
                        "dt_created_date" => date('Y-m-d H:i:s'),
                        "i_title_type" => 1,//message
                    ];
                    NotificationUser::create($user_record);
                }
            }
            return back()->with("s_msg", "تمت العملية بنجاح");
        }
    }

    public function saveAddsNo(Request $request)
    {
        if ($request->input()) {
            $record = [
                "s_value" => $request->input("adds_no"),
            ];
            SystemModel::where([
                "s_key" => "adds_no",
            ])->update($record);

            return back()->with("s_msg", "تمت العملية بنجاح");
        }
    }

    public function viewMessages($id)
    {
        $data["msgs"] = Notification::join('t_notification_user', 't_notification_user.fk_i_notification_id', '=', 't_notification.pk_i_id')
            ->where([
                "t_notification_user.fk_i_user_id" => Auth::user()->pk_i_id,
                "t_notification_user.i_title_type" => 1,
                "fk_i_actor_user_id" => $id,
            ])->orWhere([
                "t_notification_user.fk_i_user_id" => $id,
                "t_notification_user.i_title_type" => 1,
                "fk_i_actor_user_id" => Auth::user()->pk_i_id,
            ])->where("t_notification_user.is_deleted", "<>", Auth::user()->pk_i_id)->orderBy("t_notification.dt_created_date", "desc")
            ->get();
        Notification::join('t_notification_user', 't_notification_user.fk_i_notification_id', '=', 't_notification.pk_i_id')
            ->where([
                "t_notification_user.fk_i_user_id" => Auth::user()->pk_i_id,
                "t_notification_user.i_title_type" => 1,
            ])->update(["dt_seen_date" => date('Y-m-d H:i:s')]);
        $data["SenderDetails"] = UserModel::where([
            "pk_i_id" => $id,
        ])->first();
        $data["title"] = "الرسائل";
        $data["r_id"] = $id;
        return view('System::msgs', $data);
    }

    public function delete_msg($id)
    {
        $msgs = Notification::join('t_notification_user', 't_notification_user.fk_i_notification_id', '=', 't_notification.pk_i_id')
            ->select("t_notification_user.pk_i_id as n_user_id", "t_notification.pk_i_id as n_id", "t_notification.is_deleted")
            ->where([
                "t_notification_user.fk_i_user_id" => Auth::user()->pk_i_id,
                "t_notification_user.i_title_type" => 1,
                "fk_i_actor_user_id" => $id,
            ])->orWhere([
                "t_notification_user.fk_i_user_id" => $id,
                "t_notification_user.i_title_type" => 1,
                "fk_i_actor_user_id" => Auth::user()->pk_i_id,
            ])->orderBy("t_notification.dt_created_date", "desc")
            ->get();
        foreach ($msgs as $m) {
            if ($m->is_deleted == "" || $m->is_deleted == Auth::user()->pk_i_id) {
                Notification::where([
                    "pk_i_id" => $m->n_id,
                ])->update([
                    "is_deleted" => Auth::user()->pk_i_id
                ]);
                NotificationUser::where([
                    "pk_i_id" => $m->n_user_id,
                ])->update([
                    "is_deleted" => Auth::user()->pk_i_id
                ]);
            } else {
                Notification::where([
                    "pk_i_id" => $m->n_id,
                ])->delete();
                NotificationUser::where([
                    "pk_i_id" => $m->n_user_id,
                ])->delete();
            }
        }
        return back()->with("s_msg", "تمت عملية حذف المحادثة بنجاح");
    }

    public function v_messages()
    {
        $data["title"] = "جميع الرسائل";
        return view('System::v_messages', $data);
    }

    public function statistics(Request $request)
    {
        +$data["graph"] = "year";
        if ($request->input()) {
            if ($request->input("graph") == "month") {
                $data["graph"] = "month";
            } else if ($request->input("graph") == "day") {
                $data["graph"] = "day";
            }
        }
        if ($data["graph"] == "month") {
            $data["graph"] = "month";
            $data["effecancy"] = UserAddsModel::select(
                DB::raw('count(pk_i_id) as data'),
                DB::raw("CONCAT_WS('-',MONTH(dt_created_date),YEAR(dt_created_date)) as monthyear"))
                ->groupby('monthyear')
                ->orderby('dt_created_date')
                ->get();
        } else if ($data["graph"] == "day") {
            $data["graph"] = "day";
            $data["effecancy"] = UserAddsModel::select(
                DB::raw('count(pk_i_id) as data'),
                DB::raw("DATE(dt_created_date) as monthyear"))
                ->groupby('monthyear')
                ->orderby('dt_created_date')
                ->get();
        } else {
            $data["graph"] = "year";
            $data["effecancy"] = UserAddsModel::select(
                DB::raw('count(pk_i_id) as data'),
                DB::raw("YEAR(dt_created_date) as monthyear"))
                ->groupby('monthyear')
                ->orderby('dt_created_date')
                ->get();
        }

        $data["categories_visits"] = AddsModel::select(
            DB::raw('i_view_count as data'),
            DB::raw("s_name_ar as monthyear"))
            ->where([
                "b_enable" => 1
            ])->whereNotNull("i_view_count")->orderby('i_view_count', "desc")
            ->limit(7)->get();

        $data["categories_adds"] = AddsModel::join("t_ads_user", "t_ads_user.i_fk_category_id", "=", "t_categories.pk_i_id")->
        select(
            DB::raw('count(t_categories.pk_i_id) as data'),
            DB::raw("t_categories.s_name_ar as monthyear"))
            ->where([
                "t_ads_user.b_enable" => 1,
                "t_categories.b_enable" => 1
            ])->groupby('monthyear')->get();

        $data["effecancy1"] = UserAddsModel::select(
            DB::raw('i_view_count as data'),
            DB::raw("s_title_ar as monthyear"))
            ->where([
                "b_enable" => 1
            ])->orderby('i_view_count', "desc")
            ->limit(7)->get();

        $data["enabled_user"] = UserModel::select(
            DB::raw('count(b_enabled) as data'),
            DB::raw("b_enabled as monthyear"))
            ->groupby('monthyear')->get();

        $data["adds_enabled"] = UserAddsModel::select(
            DB::raw('count(b_enable) as data'),
            DB::raw("b_enable as monthyear"))
            ->groupby('monthyear')->get();

        $data["title"] = "إحصائيات الموقع";
        return view('System::statistics', $data);
    }

    public function send_notification($s_url_msg, $adds_id)
    {
        $adss_record = UserAddsModel::where([
            "pk_i_id" => $adds_id,
        ])->first();
        $sender_details = UserModel::where([
            "pk_i_id" => Auth::user()->pk_i_id
        ])->first();
        $record = [
            "i_target_users_id" => 2,
            "fk_i_actor_user_id" => $sender_details->pk_i_id,
            "s_url" => "/newest/show/" . $adds_id . "/" . str_replace(" ", "-", trim($adss_record->s_title_ar)),
            "s_url_msg" => $s_url_msg,
            "b_enabled" => 1,
            "dt_created_date" => date('Y-m-d H:i:s'),
        ];
        $notif_obj = Notification::create($record);
        $user_record = [
            "fk_i_notification_id" => $notif_obj->pk_i_id,
            "fk_i_user_id" => $adss_record->fk_i_by_user_id,
            "dt_created_date" => date('Y-m-d H:i:s'),
            "i_title_type" => 0,
        ];
        NotificationUser::create($user_record);
        $users = UserReactModel::where([
            "fk_i_ads_user_id" => $adds_id,
        ])->get();
        foreach ($users as $u) {
            if ($u->i_type == 1) {
                $user_record = [
                    "fk_i_notification_id" => $notif_obj->pk_i_id,
                    "fk_i_user_id" => $u->fk_i_user_id,
                    "dt_created_date" => date('Y-m-d H:i:s'),
                    "i_title_type" => 3,
                ];
                NotificationUser::create($user_record);
            }
            if ($u->i_type == 2) {
//                $user_record = [
//                    "fk_i_notification_id" => $notif_obj->pk_i_id,
//                    "fk_i_user_id" => $u->fk_i_user_id,
//                    "dt_created_date" => date('Y-m-d H:i:s'),
//                    "i_title_type" => 2,
//                ];
//                NotificationUser::create($user_record);
            }

        }
        return back()->with("s_msg", "تمت العملية بنجاح");
    }

    public function change(Request $request)
    {
        if ($request->input()) {
            $record = [
                "s_value" => $request->input("checked"),
            ];
            SystemModel::where([
                "pk_i_id" => $request->input("id"),
            ])->update($record);
            $json['status'] = 1;
            $json['msg'] = 'تم احضار المعلومات';
            echo json_encode($json);

        }
    }

    public function change1(Request $request)
    {
        if ($request->input()) {
            $record = [
                "s_value" => $request->input("value"),
            ];
            SystemModel::where([
                "pk_i_id" => $request->input("id"),
            ])->update($record);
            $json['status'] = 1;
            $json['msg'] = 'تم احضار المعلومات';
            echo json_encode($json);

        }
    }

    public function siteview(Request $request)
    {
        if ($request->input()) {
            $getimageName = "";
            if (Input::hasFile('site_img')) {
                $getimageName = time() . '.' . $request->site_img->getClientOriginalExtension();
                $request->site_img->move(public_path('uploads'), $getimageName);
            }
            $record = [
                "s_value" => $request->input("website_title"),
            ];
            SystemModel::where([
                "s_key" => "website_title",
            ])->update($record);
            $record = [
                "s_value" => $request->input("WEBSITE_COLOR"),
            ];
            SystemModel::where([
                "s_key" => "WEBSITE_COLOR",
            ])->update($record);
            if ($getimageName != "") {
                $record = [
                    "s_value" => $getimageName,
                ];
                SystemModel::where([
                    "s_key" => "website_logo",
                ])->update($record);
            }
            return back()->with("s_msg", "تمت العملية بنجاح");
        }

        $data["title"] = "مظهر الموقع";
        return view('System::siteview', $data);
    }

    public function blockword()
    {
        $data["title"] = "كلمات محظورة";
        $data["blackwords"] = ConstantModel::where([
            "fk_i_parent_id" => 102,
        ])->get();
        return view('System::blockword', $data);
    }


    public function addBlockword(Request $request)
    {
        if ($request->input()) {
            $record = [
                "s_name_ar" => $request->input("word"),
                "fk_i_parent_id" => 102,
                "s_key" => "BLOCKED_WORD",
                "b_enabled" => $request->input("status"),
                "dt_created_date" => date('Y-m-d H:i:s'),
                "dt_modified_date" => null,
                "dt_deleted_date" => null
            ];

            ConstantModel::create($record);
            return back()->with("s_msg", "تمت عملية الإضافة بنجاح");

        }
        $data["title"] = "إضافة قائمة سوداء";
        return view('System::addBlackword', $data);
    }

    public function editBlockword($id, Request $request)
    {
        if ($request->input()) {
            $record = [
                "s_name_ar" => $request->input("word"),
                "b_enabled" => $request->input("status"),
            ];

            ConstantModel::where([
                "pk_i_id" => $id
            ])->update($record);
            return back()->with("s_msg", "تمت عملية التعديل بنجاح");

        }

        $data["title"] = "تعديل القائمة السوداء";
        $data["record"] = ConstantModel::where([
            "pk_i_id" => $id
        ])->first();
        return view('System::editBlockword', $data);
    }

    public function deleteBlockword($id)
    {
        ConstantModel::where([
            "pk_i_id" => $id
        ])->delete();

        return back()->with("s_msg", "تمت عملية الحذف بنجاح");

    }

    public function watermark(Request $request)
    {
        if ($request->input()) {
            $getimageName = "";
            if (Input::hasFile('logo')) {
                $getimageName = time() . '.' . $request->logo->getClientOriginalExtension();
                $request->logo->move(public_path('uploads'), $getimageName);
            }
            $record = [
                "s_value" => $request->input("LOGO_WATERMARK_POSITION"),
            ];
            SystemModel::where([
                "s_key" => "LOGO_WATERMARK_POSITION",
            ])->update($record);
            $record = [
                "s_value" => $request->input("LOGO_WATERMARK_WIDTH"),
            ];
            SystemModel::where([
                "s_key" => "LOGO_WATERMARK_WIDTH",
            ])->update($record);
            $record = [
                "s_value" => $request->input("LOGO_WATERMARK_TRANSPARENCY"),
            ];
            SystemModel::where([
                "s_key" => "LOGO_WATERMARK_TRANSPARENCY",
            ])->update($record);
            if ($getimageName != "") {
                $record = [
                    "s_value" => $getimageName,
                ];
                SystemModel::where([
                    "s_key" => "LOGO_WATERMARK",
                ])->update($record);
            }
            return back()->with("s_msg", "تمت العملية بنجاح");
        }

        $data["title"] = "الشعار على الصور";
        return view('System::watermark', $data);
    }

}


?>