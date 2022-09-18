<?php

namespace Packages\Users\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Packages\Adds\AddsModel;
use Packages\Adds\ConstantModel;
use Packages\Adds\FieldOptionsModel;
use Packages\Adds\UserAddsModel;
use Packages\RecentAdd\AddsComments;
use Packages\RecentAdd\CommentsComplains_Model;
use Packages\System\Notification;
use Packages\Users\Contact;
use Packages\Users\EvaluationDataModel;
use Packages\Users\EvaluationModel;
use Packages\Users\UserModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

class UserController extends BaseController
{
    public function cities()
    {
        $data["title"] = "الدول والمدن";
        $data["countries"] = FieldOptionsModel::where([
            "i_parent_id" => 0,
            "fk_i_field_id" => 2,
            "b_enable" => 1,
        ])->get();
        $data["table_data"] = FieldOptionsModel::where([
            "fk_i_field_id" => 2,
            "b_enable" => 1,
        ])->where("i_parent_id", "<>", 0)->get();

        return view("Users::cities", $data);
    }

    public function deleteCities($id)
    {
        FieldOptionsModel::where([
            "pk_i_id" => $id,
        ])->update([
            "b_enable" => 0
        ]);
        return back()->with("s_msg", "تمت العملية بنجاح");
    }

    public function addCities(Request $request)
    {
        if ($request->input()) {
            $record = [
                "s_name_ar" => $request->input("s_name_ar_add"),
                "s_color" => $request->input("add_color"),
                "i_parent_id" => $request->input("i_country_id_add"),
                "fk_i_field_id" => 2,
                "b_enable" => 1,
                "dt_created_date" => date('Y-m-d H:i:s'),
            ];
            FieldOptionsModel::create($record);
            return back()->with("s_msg", "تمت العملية بنجاح");
        }
    }

    public function editCities(Request $request)
    {
        if ($request->input()) {
            $record = [
                "s_color" => $request->input("add_color3"),
                "s_name_ar" => $request->input("s_name_ar_edit"),
                "i_parent_id" => $request->input("i_country_id_edit"),
            ];
            FieldOptionsModel::where("pk_i_id", $request->input("religin_id1"))->update($record);
            return back()->with("s_msg", "تمت العملية بنجاح");
        }
    }

    public function addCountry(Request $request)
    {
        if ($request->input()) {
            $record = [
                "s_name_ar" => $request->input("s_name_ar_add_c"),
                "s_color" => $request->input("add_color1"),
                "i_parent_id" => 0,
                "fk_i_field_id" => 2,
                "b_enable" => 1,
                "dt_created_date" => date('Y-m-d H:i:s'),
            ];
            FieldOptionsModel::create($record);
            return back()->with("s_msg", "تمت العملية بنجاح");
        }
    }

    public function editCountry(Request $request)
    {
        if ($request->input()) {
            $record = [
                "s_name_ar" => $request->input("s_name_ar_edit_c"),
                "s_color" => $request->input("add_color2"),
            ];
            FieldOptionsModel::where("pk_i_id", $request->input("country_id_c"))->update($record);
            return back()->with("s_msg", "تمت العملية بنجاح");
        }
    }

    public function delMsg($id)
    {
        Contact::where("pk_i_id", $id)->delete();
        return back()->with("s_msg", "تم الحذف بنجاح");
    }

    public function viewMessages($id1, $id2)
    {
        $data["msgs"] = Notification::join('t_notification_user', 't_notification_user.fk_i_notification_id', '=', 't_notification.pk_i_id')
            ->where([
                "t_notification_user.fk_i_user_id" => $id2,
                "t_notification_user.i_title_type" => 1,
                "fk_i_actor_user_id" => $id1,
            ])->orWhere([
                "t_notification_user.fk_i_user_id" => $id1,
                "t_notification_user.i_title_type" => 1,
                "fk_i_actor_user_id" => $id2,
            ])->where("t_notification_user.is_deleted", "<>", $id2)->orderBy("t_notification.dt_created_date", "desc")
            ->get();
        Notification::join('t_notification_user', 't_notification_user.fk_i_notification_id', '=', 't_notification.pk_i_id')
            ->where([
                "t_notification_user.fk_i_user_id" => $id2,
                "t_notification_user.i_title_type" => 1,
            ])->update(["dt_seen_date" => date('Y-m-d H:i:s')]);
        $data["SenderDetails"] = UserModel::where([
            "pk_i_id" => $id1,
        ])->first();
        $data["title"] = "الرسائل";
        $data["r_id"] = $id1;
        $data["user_id"] = $id2;
        return view('Users::users_users_msgs', $data);
    }

    public function users_msgs($id)
    {
        $data["user_id"] = $id;
        $data["title"] = "جميع المحادثات";
        return view('Users::users_msgs', $data);
    }

    public function manageMessages()
    {
        $data["CommentsComplains"] = CommentsComplains_Model::get();
        $data["user_ads"] = UserAddsModel::whereNotNull("ads_value")->where(["i_adds_type" => 0,
        ])->get();
        $data["user_manual"] = UserModel::where([
            "b_enabled" => 0
        ])->whereNull("dt_block_to_date")->get();
        $data["user_auto"] = UserModel::where([
            "b_enabled" => 0
        ])->whereNotNull("dt_block_to_date")->orderBy("dt_block_to_date", "desc")->get();
        $data["contacts"] = Contact::get();
        $data["title"] = "الاشعارات والرسائل";
        return view('Users::manageMessages', $data);
    }

    public function resetPassword(Request $request)
    {
        if ($request->input()) {
            $email = $request->input('email');
            $data = [];
            $user = UserModel::where('s_email', $email)->first();
            if (!$user) {
                return back()->with('e_msg', 'الإيميل غير موجود');
            }
            Mail::send('Users::resetPassEmail', ['email' => $email], function ($message) use ($email) {
                $message->from('no-reply@mtgrak.com', "متجري");
                $message->subject("إعادة تعيين كلمة المرور");
                $message->to($email);
            });
            return redirect('/login')->with('s_msg', 'تم إرسال الإيميل بنجاح');

        }
        $data["title"] = "إعادة تعيين كلمة المرور";
        return view('Users::resetPassword', $data);
    }

    public function newPassword($e_email, Request $request)
    {
        $e_email = str_replace("3sAdW3x32wa0O", "/", $e_email);

        $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
        $email = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256,
            md5($secretHash),
            base64_decode($e_email),
            MCRYPT_MODE_CBC,
            md5(md5($secretHash))), "\0");

        $user = UserModel::where('s_email', $email)->first();
        if (!$user) {
            return redirect("/login")->with('e_msg', 'الإيميل غير موجود');
        }
        if ($request->input()) {
            UserModel::where([
                "s_email" => $email
            ])->update([
                "s_password" => md5($request->input("password"))
            ]);
            return redirect('/login')->with('s_msg', 'تم إعادة تعيين كلمة المرور بنجاح');
        }
        $data["title"] = "إعادة تعيين كلمة المرور";
        return view('Users::newPassword', $data);
    }

    public function evaluation($id, Request $request)
    {
        if ($request->input()) {
            $evaluations = EvaluationModel::all();
            foreach ($evaluations as $e) {
                $record = [
                    "fk_i_evaluation_id" => $e->pk_i_id,
                    "fk_i_by_user_id" => Auth::user()->pk_i_id,
                    "fk_i_for_user_id" => $id,
                    "s_value" => $request->input("evaluation_" . $e->pk_i_id),
                    "b_enabled" => 1,
                    "dt_created_date" => date("Y-m-d H:i:s"),
                ];
                EvaluationDataModel::create($record);
            }
            return redirect("/accountDetails/" . $id)->with("s_msg", "تمت عملية الحفظ بنجاح");
        }
        $check = EvaluationDataModel::where([
            "fk_i_by_user_id" => Auth::user()->pk_i_id,
            "fk_i_for_user_id" => $id,
        ])->get();
        if (Auth::user()->pk_i_id == $id) {
            return back()->with("e_msg", "لا يمكنك تقييم نفسك !");
        }
        if (count($check) > 0) {
            return back()->with("e_msg", "لقد قمت بتقييم هذا المستخدم مسبقاً");
        }
        $data["title"] = "التقييم";
        $data["user_details"] = UserModel::where([
            "pk_i_id" => $id
        ])->first();
        $data["evaluations"] = EvaluationModel::all();
        return view('Users::evaluation', $data);
    }

    public function evaluationSubject($id, Request $request)
    {
        if ($request->input()) {
            $subject = UserAddsModel::where([
                "pk_i_id" => $id
            ])->first();
            $record = [
                "fk_i_evaluation_id" => 3,
                "fk_i_by_user_id" => Auth::user()->pk_i_id,
                "fk_i_for_user_id" => 0,
                "fk_i_for_subject_id" => $id,
                "s_value" => $request->input("evaluation"),
                "b_enabled" => 1,
                "dt_created_date" => date("Y-m-d H:i:s"),
            ];
            EvaluationDataModel::create($record);
            return redirect("mtger/" . $subject->getDepartment->getParent->pk_i_id . "?department=" . $subject->getDepartment->pk_i_id . "&subject=$id")->with("s_msg", "تمت عملية الحفظ بنجاح");
        }
        $check = EvaluationDataModel::where([
            "fk_i_by_user_id" => Auth::user()->pk_i_id,
            "fk_i_for_subject_id" => $id,
        ])->get();
        if (count($check) > 0) {
            return back()->with("e_msg", "لقد قمت بتقييم هذا الموضوع مسبقاً");
        }
        $data["title"] = "تقييم الموضوع";
        $data["subject"] = UserAddsModel::where([
            "pk_i_id" => $id
        ])->first();
        return view('Users::evaluationSubject', $data);
    }

    public function comments($id)
    {
        $data["title"] = "التعليقات";
        $data["user_details"] = UserModel::where([
            "pk_i_id" => $id
        ])->first();
        $data["comments"] = EvaluationDataModel::where([
            "fk_i_for_user_id" => $id,
            "fk_i_evaluation_id" => 4,
        ])->limit(5)->orderBy("dt_created_date")->get();

        return view('Users::comments', $data);
    }

    public function contact(Request $request)
    {
        $data["type"] = $request->input("type");
        $data["title"] = "تواصل معنا";

        return view('Users::contact', $data);
    }

    public function contact_post(Request $request)
    {
        if ($request->input()) {
            $record = [
                "s_name_ar" => $request->input("s_name_ar"),
                "i_type" => $request->input("i_type"),
                "s_title" => $request->input("s_title"),
                "s_desc" => $request->input("s_desc"),
                "s_email" => $request->input("s_email"),
                "s_mobile" => $request->input("s_mobile"),
                "dt_seen_date" => null,
                "b_enabled" => 1,
                "dt_created_date" => date("Y-m-d H:i:s"),
                "dt_modified_date" => null,
                "dt_deleted_date" => null,
            ];
            Contact::create($record);
            return back()->with("s_msg", "تمت عملية الحفظ بنجاح");
        }
    }

    public function accountDetails($id)
    {
        $data["title"] = "مشاهدة الحساب";
        $data["user_details"] = UserModel::where([
            "pk_i_id" => $id
        ])->first();
        $data["user_ads"] = UserAddsModel::where([
            "i_adds_type" => 0,
            "b_enable" => 1,
            "fk_i_by_user_id" => $id
        ])->orderBy("dt_created_date", "desc")
            ->limit(6)->get();
        return view('Users::accountdetails', $data);
    }

    public function my_adds()
    {
        $data["title"] = "إعلاناتي";
        $data["user_details"] = UserModel::where([
            "pk_i_id" => Auth::user()->pk_i_id
        ])->first();
        $data["user_ads"] = UserAddsModel::where([
            "i_adds_type" => 0,
            "b_enable" => 1,
            "fk_i_by_user_id" => Auth::user()->pk_i_id
        ])->orderBy("dt_created_date", "desc")
            ->limit(6)->get();
        return view('Users::accountdetails', $data);
    }

    public function block($id, $status)
    {
        UserModel::where([
            "pk_i_id" => $id
        ])->update([
            "b_enabled" => $status
        ]);
        return back()->with("s_msg", "تمت العملية  بنجاح");

    }

    public function deleteUser($id)
    {
        Notification::join('t_notification_user', 't_notification_user.fk_i_notification_id', '=', 't_notification.pk_i_id')
            ->where([
                "fk_i_actor_user_id" => $id,
            ])->orWhere([
                "t_notification_user.fk_i_user_id" => $id,
            ])->delete();
        UserAddsModel::where([
            "i_adds_type" => 0,
            "fk_i_by_user_id" => $id
        ])->delete();
        UserModel::where([
            "pk_i_id" => $id
        ])->delete();
        return back()->with("s_msg", "تمت عملية الحذف بنجاح");
    }

    public function register(Request $request)
    {
        if ($request->input()) {
            $getimageName = "";
            if (Input::hasFile('pic')) {
                $getimageName = time() . '.' . $request->pic->getClientOriginalExtension();
                $request->pic->move(public_path('uploads'), $getimageName);
            }
            $user1 = UserModel::where([
                "s_username" => trim($request->input("username")),
            ])->first();
            $user2 = UserModel::where([
                "s_email" => trim($request->input("email")),
            ])->first();
            $user3 = UserModel::where([
                "s_mobile_number" => $request->input("mobile"),
            ])->first();
            if (!$user1 && !$user2 && !$user3) {
                $record = [
                    "fk_i_role_id" => 92,
                    "s_username" => $request->input("username"),
                    "s_first_name" => $request->input("f_name"),
                    "s_last_name" => $request->input("l_name"),
                    "s_mobile_number" => $request->input("mobile"),
                    "s_email" => $request->input("email"),
                    "s_password" => md5($request->input("password")),
                    "i_country_id" => $request->input("country_id"),
                    "i_city_id" => $request->input("city_id"),
                    "s_pic" => $getimageName,
                    "fk_i_secret_question_id" => $request->input("fk_i_secret_question_id") ? $request->input("fk_i_secret_question_id") : null,
                    "s_secret_question_answer" => $request->input("fk_i_secret_question_id") ? $request->input("s_secret_question_answer") : null,
                    "b_enabled" => 1,
                    "dt_created_date" => date("Y-m-d H:i:s"),
                    "dt_modified_date" => null,
                    "dt_deleted_date" => null,

                ];
                $user_obj = UserModel::create($record);
                Auth::login($user_obj);
                session()->put("user_id", Auth::user()->pk_i_id);
                return redirect("/newest")->with("s_msg", "تمت عملية الاعتماد بنجاح");
            } else {
                if ($user1) {
                    return back()->with("e_msg", "إسم المستخدم غير متاح");
                }
                if ($user2) {
                    return back()->with("e_msg", "الإيميل غير متاح");
                }
                if ($user3) {
                    return back()->with("e_msg", "رقم الجوال غير متاح");
                }
            }
        }
        $data["title"] = "التسجيل";
        $data["Countries"] = FieldOptionsModel::where([
            "i_parent_id" => 0,
            "fk_i_field_id" => 2,
            "b_enable" => 1,
        ])->get();
        $data["secret_questions"] = ConstantModel::where([
            "fk_i_parent_id" => 97,
            //"b_enable" => 1,
        ])->get();

        return view('Users::register', $data);
    }

    public
    function getCitiesForCountry(Request $request)
    {
        if ($request->input()) {
            $post_data = $request->input();
            $json["cities"] = FieldOptionsModel::where([
                "i_parent_id" => $post_data["id"],
                "b_enable" => 1,
            ])->get();
            $json['status'] = 1;
            $json['msg'] = 'تم احضار المعلومات';
            echo json_encode($json);
        }
    }

    public
    function logout()
    {

        Auth::logout();
        Session::flush();
        return redirect("/login");
    }

    public
    function login()
    {
        if (session("user_id")) {
            return redirect("/newest");
        }
        $data["title"] = "تسجيل الدخول";
        return view("Users::login", $data);
    }

    public
    function users(Request $request)
    {
        $type = "";
        $where1 = [];
        if ($request->input("type") != null) {
            $type = $request->input("type");
            $where1 = [
                "fk_i_role_id" => $type
            ];
        }
        $status = "";
        $where2 = [];
        if ($request->input("enabled") != null) {
            $status = $request->input("enabled");
            $where2 = [
                "b_enabled" => $status
            ];

        }
        $data["users"] = UserModel::where(
            $where1
        )->where(
            $where2
        )->get();
        $data["type"] = $type;
        $data["status"] = $status;
        $data["roles"] = ConstantModel::where([
            "s_key" => "ROLE",
            "fk_i_parent_id" => 0,
            //"b_enable" => 1,
        ])->first();
        $data["title"] = "الاعضاء";
        return view("Users::users", $data);
    }

    public
    function editUser($id, Request $request)
    {
        if ($request->input()) {
            $getimageName = "";
            if (Input::hasFile('pic')) {
                $getimageName = time() . '.' . $request->pic->getClientOriginalExtension();
                $request->pic->move(public_path('uploads'), $getimageName);
            }
            $user1 = UserModel::where([
                "s_username" => trim($request->input("username")),
            ])->where("pk_i_id", "<>", $id)->first();
            $user2 = UserModel::where([
                "s_email" => trim($request->input("email")),
            ])->where("pk_i_id", "<>", $id)->first();
            $user3 = UserModel::where([
                "s_mobile_number" => $request->input("mobile"),
            ])->where("pk_i_id", "<>", $id)->first();
            if (!$user1 && !$user2 && !$user3) {

                if ($getimageName != "") {
                    $record = [
                        "fk_i_role_id" => $request->input("fk_i_role_id"),
                        "s_username" => $request->input("username"),
                        "s_first_name" => $request->input("f_name"),
                        "s_last_name" => $request->input("l_name"),
                        "s_mobile_number" => $request->input("mobile"),
                        "s_email" => $request->input("email"),
                        "i_country_id" => $request->input("country_id"),
                        "i_city_id" => $request->input("city_id"),
                        "s_pic" => $getimageName,
                        "dt_modified_date" => date("Y-m-d H:i:s"),
                    ];
                } else {
                    $record = [
                        "fk_i_role_id" => $request->input("fk_i_role_id"),
                        "s_username" => $request->input("username"),
                        "s_first_name" => $request->input("f_name"),
                        "s_last_name" => $request->input("l_name"),
                        "s_mobile_number" => $request->input("mobile"),
                        "s_email" => $request->input("email"),
                        "i_country_id" => $request->input("country_id"),
                        "i_city_id" => $request->input("city_id"),
                        "dt_modified_date" => date("Y-m-d H:i:s"),
                    ];
                }
                UserModel::where([
                    "pk_i_id" => $id
                ])->update($record);
                return back()->with("s_msg", "تمت عملية التعديل بنجاح");
            } else {
                if ($user1) {
                    return back()->with("e_msg", "إسم المستخدم غير متاح");
                }
                if ($user2) {
                    return back()->with("e_msg", "الإيميل غير متاح");
                }
                if ($user3) {
                    return back()->with("e_msg", "رقم الجوال غير متاح");
                }
            }

        }
        $data["user_details"] = UserModel::where([
            "pk_i_id" => $id
        ])->first();

        $data["title"] = "تعديل بيانات العضو";
        $data["Countries"] = FieldOptionsModel::where([
            "i_parent_id" => 0,
            "fk_i_field_id" => 2,
            //"b_enable" => 1,
        ])->get();
        $data["roles"] = ConstantModel::where([
            "s_key" => "ROLE",
            "fk_i_parent_id" => 0,
            //"b_enable" => 1,
        ])->first();


        return view("Users::editUser", $data);
    }

    public
    function editAccount(Request $request)
    {
        $id = Auth::user()->pk_i_id;
        if ($request->input()) {
            $getimageName = "";
            if (Input::hasFile('pic')) {
                $getimageName = time() . '.' . $request->pic->getClientOriginalExtension();
                $request->pic->move(public_path('uploads'), $getimageName);
            }
            $user1 = UserModel::where([
                "s_username" => trim($request->input("username")),
            ])->where("pk_i_id", "<>", $id)->first();
            $user2 = UserModel::where([
                "s_email" => trim($request->input("email")),
            ])->where("pk_i_id", "<>", $id)->first();
            $user3 = UserModel::where([
                "s_mobile_number" => $request->input("mobile"),
            ])->where("pk_i_id", "<>", $id)->first();
            if (!$user1 && !$user2 && !$user3) {
                if ($getimageName != "") {
                    $record = [
                        "s_username" => $request->input("username"),
                        "s_first_name" => $request->input("f_name"),
                        "s_last_name" => $request->input("l_name"),
                        "s_mobile_number" => $request->input("mobile"),
                        "s_email" => $request->input("email"),
                        "i_country_id" => $request->input("country_id"),
                        "i_city_id" => $request->input("city_id"),
                        "s_pic" => $getimageName,
                        "dt_modified_date" => date("Y-m-d H:i:s"),
                    ];
                } else {
                    $record = [
                        "s_username" => $request->input("username"),
                        "s_first_name" => $request->input("f_name"),
                        "s_last_name" => $request->input("l_name"),
                        "s_mobile_number" => $request->input("mobile"),
                        "s_email" => $request->input("email"),
                        "i_country_id" => $request->input("country_id"),
                        "i_city_id" => $request->input("city_id"),
                        "dt_modified_date" => date("Y-m-d H:i:s"),
                    ];
                }
                UserModel::where([
                    "pk_i_id" => $id
                ])->update($record);
                return back()->with("s_msg", "تمت عملية التعديل بنجاح");
            } else {
                if ($user1) {
                    return back()->with("e_msg", "إسم المستخدم غير متاح");
                }
                if ($user2) {
                    return back()->with("e_msg", "الإيميل غير متاح");
                }
                if ($user3) {
                    return back()->with("e_msg", "رقم الجوال غير متاح");
                }
            }
        }
        $data["user_details"] = UserModel::where([
            "pk_i_id" => $id
        ])->first();

        $data["title"] = "تعديل بيانات العضو";
        $data["Countries"] = FieldOptionsModel::where([
            "i_parent_id" => 0,
            "fk_i_field_id" => 2,
            //"b_enable" => 1,
        ])->get();
        $data["roles"] = ConstantModel::where([
            "s_key" => "ROLE",
            "fk_i_parent_id" => 0,
            //"b_enable" => 1,
        ])->first();


        return view("Users::editAccount", $data);
    }

    public
    function checkLogin(Request $request)
    {
        $email = $request->input("email");
        $user = UserModel::where([
            "s_password" => md5($request->input("password")),
        ])->where(function ($q) use ($email) {
            $q->where('s_email', '=', $email)
                ->orWhere('s_username', '=', $email)
                ->orWhere('s_mobile_number', '=', $email);
        })->first();
        if ($user != null) {
            if ($user->dt_last_block_date <= date("Y-m-d H:i:s")) {
                if ($user->i_bad_words_count < 2) {
                    UserModel::where([
                        "pk_i_id" => $user->pk_i_id
                    ])->update([
                        "b_enabled" => 1,
                        "dt_last_block_date" => null,
                        "dt_block_to_date" => null,
                    ]);
                    $user = UserModel::where([
                        "pk_i_id" => $user->pk_i_id
                    ])->first();
                }
            }
            if ($user->b_enabled == 1) {
                Auth::login($user);
                session()->put("user_id", Auth::user()->pk_i_id);
                return redirect("/newest");
            } else {
                return redirect()->back()->with("e_msg", "أنت محظور من الموقع");
            }
        } else {
            return redirect()->back()->with("e_msg", "بيانات الحساب خاطئة");
        }
    }

    public
    function CommentsBody(Request $request)
    {
        $post_data = $request->input();
        header('Content-Type: application/json');
        $json['status'] = 1;
        $json['msg'] = 'تم احضار المعلومات';

        $myData["comments"] = EvaluationDataModel::where([
            "fk_i_for_user_id" => $post_data["id"],
            "fk_i_evaluation_id" => 4,
        ])->where("dt_created_date", "<", $post_data["date"])
            ->limit(5)->orderBy("dt_created_date")->get();
        $myData["user_details"] = UserModel::where([
            "pk_i_id" => $post_data["id"]
        ])->first();
        $myData["index"] = $post_data["index"];
        $html = View::make('Users::CommentsBody', $myData)->render();
        $json['view'] = $html;
        $json['date'] = $myData["comments"]->last()->dt_created_date;
        echo json_encode($json);
    }
}

?>