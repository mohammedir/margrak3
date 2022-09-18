<?php

//namespace Packages\RecentController\Http\Controllers;
namespace Packages\RecentAdd\Http\Controllers;

//namespace Packages\RecentController\src\Http\Controllers;
use App\User;
//use Gumlet\ImageResize;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Packages\Adds\AddsModel;
use Packages\Adds\ConstantModel;
use Packages\Adds\UserAddsMeta;
use Packages\Category\KeyWordModel;
use Packages\RecentAdd\TempImgModel;
use Packages\System\Notification;
use Packages\System\NotificationUser;

use Packages\Adds\UserAddsModel;
use Packages\RecentAdd\AddsComments;
use Packages\RecentAdd\CommentsComplains_Model;
use Packages\RecentAdd\FieldsAnswersModel;
use Packages\RecentAdd\RecentModel;
use Packages\RecentAdd\UserReactModel;
use Packages\System\SystemModel;
use Packages\Template\FieldsModel;
use Packages\Template\TemplateFieldsModel;
use Packages\Template\TemplateModel;
use Packages\Users\UserModel;
use Illuminate\Support\Facades\Session;

class RecentController extends BaseController
{

    public function addMatger(Request $request)
    {
        if ($request->input()) {
            if ($request->input("matger_edit_id") == "") {
                $record = [
                    'fk_i_parent_id' => 127,
                    's_key' => "MATAGER",
                    's_name_ar' => $request->input("matger"),
                    's_extra_1' => $request->input("mtger_color"),
                    "b_enabled" => 1,
                    "dt_created_date" => date('Y-m-d H:i:s'),
                ];
                ConstantModel::create($record);
            } else {
                $record = [
                    's_name_ar' => $request->input("matger"),
                    's_extra_1' => $request->input("mtger_color"),
                    "dt_modified_date" => date('Y-m-d H:i:s'),
                ];
                ConstantModel::where([
                    "pk_i_id" => $request->input("matger_edit_id")
                ])->update($record);
            }
            return back()->with("s_msg", "تمت العملية بنجاح");
        }
    }

    public function deleteMatger($id)
    {
        $matger = ConstantModel::where([
            "pk_i_id" => $id
        ])->first();
        UserModel::where([
            "fk_i_role_id" => $id
        ])->update([
            "fk_i_role_id" => 92
        ]);

        foreach ($matger->getChilds as $d) {
            ConstantModel::where([
                "pk_i_id" => $d->pk_i_id
            ])->delete();
            $adds = UserAddsModel::where([
                "i_fk_category_id" => $d->pk_i_id,
            ])->get();
            foreach ($adds as $a) {
                UserAddsModel::where([
                    "pk_i_id" => $a->pk_i_id,
                ])->delete();
                Notification::where([
                    "record_id" => $a->pk_i_id
                ])->delete();
            }
        }
        ConstantModel::where([
            "pk_i_id" => $id
        ])->delete();
        return back()->with("s_msg", "تمت العملية بنجاح");
    }

    public function constant_mtger(Request $request)
    {
        if ($request->input()) {
            $record = [
                "b_enabled" => $request->input("checked"),
            ];
            ConstantModel::where([
                "pk_i_id" => $request->input("id"),
            ])->update($record);
            $json['status'] = 1;
            $json['msg'] = 'تم احضار المعلومات';
            echo json_encode($json);

        }
    }

    public function AddsReact($add_id, $user_id, Request $request)
    {
        if ($request->input()) {
            switch ($request->input("i_type_value")) {
                case 1:
                    $record = [
                        'fk_i_ads_user_id' => $add_id,
                        'fk_i_user_id' => $user_id,
                        'i_type' => 2,
                    ];
                    UserReactModel::create($record);
                    $old_data = UserAddsModel::where([
                        "pk_i_id" => $add_id,
                        "i_adds_type" => 0,
                    ])->first();
                    $record = [
                        "i_target_users_id" => 2,
                        "fk_i_actor_user_id" => $user_id,
                        "s_url" => "/newest/show/" . $add_id . "/" . str_replace(" ", "-", trim($old_data->s_title_ar)),
                        "s_url_msg" => $old_data->s_title_ar,
                        "record_id" => $add_id,
                        "b_enabled" => 1,
                        "dt_created_date" => date('Y-m-d H:i:s'),
                    ];
                    $notif_obj = Notification::create($record);
                    $user_record = [
                        "fk_i_notification_id" => $notif_obj->pk_i_id,
                        "fk_i_user_id" => $user_id,
                        "dt_created_date" => date('Y-m-d H:i:s'),
                        "i_title_type" => 2,
                    ];
                    NotificationUser::create($user_record);

                    break;
                case 2:
                    $record = [
                        'fk_i_ads_user_id' => $add_id,
                        'fk_i_user_id' => $user_id,
                        'i_type' => 1,
                    ];
                    UserReactModel::create($record);
                    break;
                case 3:
                    $record = [
                        'fk_i_ads_user_id' => $add_id,
                        'fk_i_user_id' => $user_id,
                        'i_type' => 2,
                    ];
                    $record1 = [
                        'record_id' => $add_id,
                        "fk_i_actor_user_id" => $user_id,
                    ];
                    UserReactModel::where($record)->delete();
                    Notification::where($record1)->delete();
                    break;
                case 4:
                    $record = [
                        'fk_i_ads_user_id' => $add_id,
                        'fk_i_user_id' => $user_id,
                        'i_type' => 1,
                    ];
                    UserReactModel::where($record)->delete();
                    break;
            }
            return back()->with("s_msg", "تمت العملية بنجاح");
        }
    }

    public function AddsReactForSubject($mtger_id, $department_id, $user_id, Request $request)
    {
        $subject_id = $request->input("sub_id");
        if ($request->input()) {
            switch ($request->input("i_type_value")) {
                case 1:
                    $record = [
                        'fk_i_ads_user_id' => $subject_id,
                        'fk_i_user_id' => $user_id,
                        'i_type' => 2,
                    ];
                    UserReactModel::create($record);
                    $old_data = UserAddsModel::where([
                        "pk_i_id" => $subject_id,
                        "i_adds_type" => 1,
                    ])->first();
                    $record = [
                        "i_target_users_id" => 2,
                        "fk_i_actor_user_id" => $user_id,
                        "s_url" => "/mtger/$mtger_id?department=$department_id&subject=$subject_id",
                        "s_url_msg" => $old_data->s_title_ar,
                        "record_id" => $subject_id,
                        "b_enabled" => 1,
                        "dt_created_date" => date('Y-m-d H:i:s'),
                    ];
                    $notif_obj = Notification::create($record);
                    $user_record = [
                        "fk_i_notification_id" => $notif_obj->pk_i_id,
                        "fk_i_user_id" => $user_id,
                        "dt_created_date" => date('Y-m-d H:i:s'),
                        "i_title_type" => 2,
                    ];
                    NotificationUser::create($user_record);

                    break;
                case 3:
                    $record = [
                        'fk_i_ads_user_id' => $subject_id,
                        'fk_i_user_id' => $user_id,
                        'i_type' => 2,
                    ];
                    $record1 = [
                        'record_id' => $subject_id,
                        "fk_i_actor_user_id" => $user_id,
                    ];
                    UserReactModel::where($record)->delete();
                    Notification::where($record1)->delete();
                    break;
            }
            return back()->with("s_msg", "تمت العملية بنجاح");
        }
    }

    public function change_select(Request $request)
    {
        header('Content-Type: application/json');
        $post_data = $request->input();
        $index = $post_data["index"];
        $json['status'] = 1;
        $json['msg'] = 'تم احضار المعلومات';
        $myData1["tags_ary"] = array();
        if (!$request->input("cat") && !$request->input("main") && !$request->input("prim")) {
            $where_ary1 = array();
            $where_ary2 = array();
            $where_ary3 = array();
            $where_ary4 = array();
            $flag = true;
            $city_select = isset($post_data["city_select"]) ? $post_data["city_select"] : "";
            if ($city_select != "") {
                $flag = false;
                $where_ary1["s_answer"] = $city_select;
                $where_ary1["fk_i_field_id"] = 2;
            }
            $ads_select = $post_data["ads_select"];
            if ($ads_select != "") {
                $where_ary2["i_fk_category_id"] = $ads_select;
                $cat = $ads_select;
                $where_ary2["i_fk_category_id"] = $cat;
                $myData1["tags_ary"] = KeyWordModel::where([
                    "fk_i_ads_user_id" => $cat
                ])->get();
            }
            $view_select = isset($post_data["view_select"]) ? $post_data["view_select"] : "";
            if ($view_select != "") {
                if ($view_select == 11) {
                    $where_ary3["i_type"] = 1;
                } else {
                    $where_ary3["i_type"] = 2;
                }
            }
            $model_select = isset($post_data["model_select"]) ? $post_data["model_select"] : "";
            if ($model_select != "") {
                $flag = false;
                $where_ary4["s_answer"] = $model_select;
                $where_ary4["fk_i_field_id"] = 1;
            }
            $text_select = $post_data["text_select"];
            if ($flag) {
                if (isset($post_data["date"])) {
                    $myData["user_ads"] = UserAddsModel::where($where_ary2)
                        ->where("dt_created_date", "<", $post_data["date"])
                        ->where($where_ary2)
                        ->where($where_ary3)
                        ->where(["b_enable" => 1,
                            "i_adds_type" => 0,
                        ])
                        ->where("s_title_ar", "like", "%$text_select%")->groupBy("t_ads_user.pk_i_id")->orderBy("dt_created_date", "desc")->limit(10)->get();
                } else {
                    $myData["user_ads"] = UserAddsModel::where($where_ary2)
                        ->where($where_ary2)
                        ->where($where_ary3)
                        ->where(["b_enable" => 1, "i_adds_type" => 0,
                        ])
                        ->where("s_title_ar", "like", "%$text_select%")->groupBy("t_ads_user.pk_i_id")->orderBy("dt_created_date", "desc")->limit(10)->get();
                }
            } else {
                if (isset($post_data["date"])) {
                    $myData["user_ads"] = UserAddsModel::join("t_ads_user_field_answer", "t_ads_user_field_answer.fk_i_ads_user_id", "=", "t_ads_user.pk_i_id")->where([
                        "b_enable" => 1,
                    ])->select("t_ads_user.*")
                        ->where("t_ads_user.dt_created_date", "<", $post_data["date"])
                        ->where($where_ary2)
                        ->where($where_ary3)
                        ->where($where_ary4)
                        ->where($where_ary1)
                        ->where(["t_ads_user.b_enable" => 1, "i_adds_type" => 0,
                        ])
                        ->where("s_title_ar", "like", "%$text_select%")->groupBy("t_ads_user.pk_i_id")->orderBy("t_ads_user.dt_created_date", "desc")->limit(10)->get();
                } else {
                    $myData["user_ads"] = UserAddsModel::join("t_ads_user_field_answer", "t_ads_user_field_answer.fk_i_ads_user_id", "=", "t_ads_user.pk_i_id")->where([
                        "b_enable" => 1,
                    ])->select("t_ads_user.*")
                        ->where($where_ary2)
                        ->where($where_ary3)
                        ->where($where_ary4)
                        ->where($where_ary1)
                        ->where(["t_ads_user.b_enable" => 1, "i_adds_type" => 0,
                        ])
                        ->where("s_title_ar", "like", "%$text_select%")->groupBy("t_ads_user.pk_i_id")->orderBy("t_ads_user.dt_created_date", "desc")->limit(10)->get();
                }
            }
        } else {
            $where_ary2 = array();
            if ($request->input("cat") != null) {
                $cat = $request->input("cat");
                $where_ary2["i_fk_category_id"] = $cat;
                $myData["user_ads"] = UserAddsModel::where([
                    "i_adds_type" => 0,
                    "b_enable" => 1,
                ])->where("t_ads_user.dt_created_date", "<", $post_data["date"])
                    ->where($where_ary2)->orderBy("dt_created_date", "desc")->limit(10)->get();
            }
            $main = "";
            if ($request->input("main") != null) {
                $where_ary3 = array();
                $main = $request->input("main");
                $main_ary = AddsModel::where([
                    "i_parent_id" => $main
                ])->get();
                foreach ($main_ary as $m) {
                    array_push(
                        $where_ary3, $m->pk_i_id
                    );
                }
                $myData["user_ads"] = UserAddsModel::where([
                    "i_adds_type" => 0,
                    "b_enable" => 1,
                ])->where("t_ads_user.dt_created_date", "<", $post_data["date"])
                    ->whereIn('i_fk_category_id', $where_ary3)->orderBy("dt_created_date", "desc")->limit(10)->get();
            }
            $prim = "";
            $where_ary4 = array();
            if ($request->input("prim") != null) {
                $where_ary4 = array();
                $prim = $request->input("prim");
                $main_ary = AddsModel::where([
                    "i_parent_id" => $prim
                ])->get();
                foreach ($main_ary as $m) {
                    $main_ary1 = AddsModel::where([
                        "i_parent_id" => $m->pk_i_id
                    ])->get();
                    foreach ($main_ary1 as $m1) {
                        array_push(
                            $where_ary4, $m1->pk_i_id
                        );
                    }
                }
                $myData["user_ads"] = UserAddsModel::where([
                    "i_adds_type" => 0,
                    "b_enable" => 1,
                ])->where("t_ads_user.dt_created_date", "<", $post_data["date"])
                    ->whereIn('i_fk_category_id', $where_ary4)->orderBy("dt_created_date", "desc")->limit(10)->get();
            }
        }

        $myData["index"] = $index;
        $html = View::make('RecentAdd::NewestBody', $myData)->render();
        $html1 = View::make('RecentAdd::tags_html', $myData1)->render();
        $json['view'] = $html;
        $json['view1'] = $html1;
        if (isset($myData["user_ads"]->last()->dt_created_date)) {


            $json['date'] = $myData["user_ads"]->last()->dt_created_date;
        } else {
            $json['date'] = "";
        }
        echo json_encode($json);

    }

    public function change_select_for_user(Request $request)
    {
        $post_data = $request->input();
        header('Content-Type: application/json');
        $json['status'] = 1;
        $json['msg'] = 'تم احضار المعلومات';
        $index = $post_data["index"];
        $myData["user_ads"] = UserAddsModel::where("dt_created_date", "<", $post_data["date"])->where("fk_i_by_user_id", $post_data["id"])->where(["i_adds_type" => 0,])->orderBy("dt_created_date", "desc")->limit(6)->get();

        $myData["index"] = $index;
        $html = View::make('RecentAdd::NewestBody', $myData)->render();
        $json['view'] = $html;
        if (isset($myData["user_ads"]->last()->dt_created_date)) {


            $json['date'] = $myData["user_ads"]->last()->dt_created_date;
        } else {
            $json['date'] = "";
        }
        echo json_encode($json);

    }

    public function change_category(Request $request)
    {
        $post_data = $request->input();
        header('Content-Type: application/json');
        if (isset($post_data['category'])) {
            $json['status'] = 1;
            $json['msg'] = 'تم احضار المعلومات';
            $category_id = $post_data["category"];
            $category = AddsModel::where([
                "pk_i_id" => $category_id
            ])->first();
            if ($category->fk_i_template_id != "") {
                $templates = TemplateModel::where([
                    "pk_i_id" => $category->fk_i_template_id
                ])->first();
                $myData["fields"] = TemplateFieldsModel::where([
                    "fk_i_ads_template_id" => $templates->pk_i_id,
                ])->get();

            } else {
                $myData["fields"] = array();
            }
            $html = View::make('RecentAdd::addRequestBody', $myData)->render();
            $json['view1'] = $html;
        } else {
            $json['status'] = 0;
            $json['msg'] = 'خطأ في ارسال البيانات';
        }

        echo json_encode($json);

    }

    public function show($id, Request $request)
    {
        if ($request->input()) {
            $record = [
                "fk_i_deleted_by_user_id" => 1,
                "s_delete_notes" => $request->input("notes"),
                "b_enable" => 0,
            ];
            UserAddsModel::where([
                "i_adds_type" => 0,
                "pk_i_id" => $request->input("d_pk_i_id"),
            ])->update($record);
            return back()->with("s_msg", "تمت عملية إغلاق الإعلان بنجاح");
        }
        $old_data = UserAddsModel::where([
            "i_adds_type" => 0,
            "pk_i_id" => $id,
        ])->first();
        $old_data_for_category = AddsModel::where([
            "pk_i_id" => $old_data->i_fk_category_id,
        ])->first();
        AddsModel::where([
            "pk_i_id" => $old_data_for_category->pk_i_id,
        ])->update([
            "i_view_count" => ((int)$old_data_for_category->i_view_count + 1)
        ]);

        $data["user_ads"] = UserAddsModel::where([
            "i_adds_type" => 0,
            "b_enable" => 1,
        ])->where('pk_i_id', '!=', $old_data->pk_i_id)->where([
            "i_fk_category_id" => $old_data->i_fk_category_id
        ])->orderBy("dt_created_date", "desc")->limit(6)->get();

        UserAddsModel::where([
            "pk_i_id" => $id,
        ])->update([
            "i_view_count" => ((int)$old_data->i_view_count + 1)
        ]);
        $data["record"] = UserAddsModel::where([
            "i_adds_type" => 0,
            "pk_i_id" => $id,
        ])->first();
        $data["user_details"] = UserModel::where([
            "pk_i_id" => $data["record"]->fk_i_by_user_id,
        ])->first();
        $data["comments"] = AddsComments::where([
            "fk_i_ads_user_id" => $id,
            "b_enabled" => 1,
        ])->orderBy("dt_created_date")->get();
        $data["title"] = "مشاهدة الإعلان";
        return view('RecentAdd::show', $data);
    }

    public function newest(Request $request)
    {
        // $primCategory = \App\Helper\Helper::getParentForTppBtn("b_in_sidebar");
        // foreach ($primCategory as $c) {
        //     foreach ($c->getChilds as $c1) {
        //         foreach ($c1->getChilds as $c2) {
        //             $pic_name = $c2->s_sidebar_pic;
        //             if ($c2->s_sidebar_pic == "")
        //                 $pic_name = $c2->s_pic;
        //             if ($pic_name != "") {

        //                 $image = new ImageResize(str_replace("/", "\\", public_path('uploads') . $pic_name));

        //                 $image->resizeToWidth(40);
        //                 $image->save(str_replace("/", "\\", public_path('uploads') . $pic_name));
        //             }
        //         }
        //     }
        // }
        // echo "Done!";
        // die();
        $ADS_SPACE_BAR_COUNT = \App\Helper\Helper::getSystemRecord("ADS_SPACE_BAR_COUNT");
        $data["newest_flag"] = true;
        $cat = "";
        $where_ary2 = array();
        $data["user_ads"] = UserAddsModel::where([
            "i_adds_type" => 0,
            "b_enable" => 1,
        ])->orderBy("dt_created_date", "desc")->limit($ADS_SPACE_BAR_COUNT->s_value)->get();

        if ($request->input("cat") != null) {
            $cat = $request->input("cat");
            $where_ary2["i_fk_category_id"] = $cat;
            $data["user_ads"] = UserAddsModel::where([
                "i_adds_type" => 0,
                "b_enable" => 1,
            ])->where($where_ary2)->orderBy("dt_created_date", "desc")->limit($ADS_SPACE_BAR_COUNT->s_value)->get();
            if ($request->input("tag_text")) {
                $data["user_ads"] = UserAddsModel::where([
                    "i_adds_type" => 0,
                    "b_enable" => 1,
                ])->where("s_title_ar", "like", "%" . $request->input("tag_text") . "%")->orderBy("dt_created_date", "desc")->limit($ADS_SPACE_BAR_COUNT->s_value)->get();
            } else {
                $data["user_ads"] = UserAddsModel::where([
                    "i_adds_type" => 0,
                    "b_enable" => 1,
                ])->where($where_ary2)->orderBy("dt_created_date", "desc")->limit($ADS_SPACE_BAR_COUNT->s_value)->get();
            }

            $data["tags_ary"] = KeyWordModel::where([
                "fk_i_ads_user_id" => $cat
            ])->get();
        }
        $main = "";
        if ($request->input("main") != null) {
            $where_ary3 = array();
            $main = $request->input("main");
            $data["main_data"] = AddsModel::where([
                "pk_i_id" => $main
            ])->first();
            $main_ary = AddsModel::where([
                "i_parent_id" => $main
            ])->get();
            foreach ($main_ary as $m) {
                array_push(
                    $where_ary3, $m->pk_i_id
                );
            }
            $data["user_ads"] = UserAddsModel::where([
                "i_adds_type" => 0,
                "b_enable" => 1,
            ])->whereIn('i_fk_category_id', $where_ary3)->orderBy("dt_created_date", "desc")->limit($ADS_SPACE_BAR_COUNT->s_value)->get();
        }
        $prim = "";
        $where_ary4 = array();
        if ($request->input("prim") != null) {
            $where_ary4 = array();
            $prim = $request->input("prim");
            $main_ary = AddsModel::where([
                "i_parent_id" => $prim
            ])->get();
            foreach ($main_ary as $m) {
                $main_ary1 = AddsModel::where([
                    "i_parent_id" => $m->pk_i_id
                ])->get();
                foreach ($main_ary1 as $m1) {
                    array_push(
                        $where_ary4, $m1->pk_i_id
                    );
                }
            }
            $data["user_ads"] = UserAddsModel::where([
                "b_enable" => 1,
                "i_adds_type" => 0,
            ])->whereIn('i_fk_category_id', $where_ary4)->orderBy("dt_created_date", "desc")->limit($ADS_SPACE_BAR_COUNT->s_value)->get();
        }
        $data["title"] = "الأحدث";
        $data["cat"] = $cat;
        $data["main"] = $main;
        $data["prim"] = $prim;
        return view('RecentAdd::newest', $data);
    }

    public function market()
    {
        $data["primCategory"] = AddsModel::where([
            "i_parent_id" => 0,
        ])->get();
        $data["title"] = "السوق";
        return view('RecentAdd::market', $data);
    }

    public function commentComplain($id)
    {
        AddsComments::where(["pk_i_id" => $id])->update([
            "b_enabled" => 0
        ]);
        CommentsComplains_Model::create([
            "fk_i_ads_comments_id" => $id,
            "fk_by_user_id" => Auth::user()->pk_i_id
        ]);
        return back()->with("s_msg", "تم تقديم الإبلاغ بنجاح");
    }

    public function deleteComment($id)
    {
        CommentsComplains_Model::where([
            "fk_i_ads_comments_id" => $id,
        ])->delete();
        AddsComments::where([
            "pk_i_id" => $id,
        ])->delete();
        return back()->with("s_msg", "تم حذف التعليق بنجاح");
    }

    public function ruturn_comment($id)
    {
        CommentsComplains_Model::where([
            "fk_i_ads_comments_id" => $id,
        ])->delete();
        AddsComments::where([
            "pk_i_id" => $id,
        ])->update(["b_enabled" => 1]);
        return back()->with("s_msg", "تم حذف التعليق بنجاح");
    }

    public function view_notification()
    {
        $data["Notification"] = Notification::join('t_notification_user', 't_notification_user.fk_i_notification_id', '=', 't_notification.pk_i_id')
            ->where([
                "t_notification_user.fk_i_user_id" => Auth::user()->pk_i_id,
                "t_notification_user.i_title_type" => 0,
            ])->orderBy('t_notification.dt_created_date', 'desc')->get();
        $data["title"] = "عرض التنبيهات";
        return view('RecentAdd::notification', $data);
    }

    public function view_favorites()
    {
        $data["Notification"] = Notification::join('t_notification_user', 't_notification_user.fk_i_notification_id', '=', 't_notification.pk_i_id')
            ->where([
                "t_notification_user.fk_i_user_id" => Auth::user()->pk_i_id,
                "t_notification_user.i_title_type" => 2,
            ])->orderBy('t_notification.dt_created_date', 'desc')->get();
        $data["title"] = "عرض المفضلة";
        return view('RecentAdd::notification', $data);
    }

    public function view_follows()
    {
        $data["Notification"] = Notification::join('t_notification_user', 't_notification_user.fk_i_notification_id', '=', 't_notification.pk_i_id')
            ->where([
                "t_notification_user.fk_i_user_id" => Auth::user()->pk_i_id,
                "t_notification_user.i_title_type" => 3,
            ])->orderBy('t_notification.dt_created_date', 'desc')->get();
        $data["title"] = "عرض المتابعة";
        return view('RecentAdd::notification', $data);
    }

    public function requestAdd(Request $request)
    {

        $data["title"] = "طلب إعلان";
        $data["primCategory"] = RecentModel::where([
            "i_parent_id" => 0,
        ])->get();
        return view('RecentAdd::requestAdd', $data);
    }

    public function requestAdd1(Request $request)
    {
        if ($request->input()) {
            $json = array();
            $count_adds = UserAddsModel::where([
                "fk_i_by_user_id" => Auth::user()->pk_i_id,
                "i_adds_type" => 0,
            ])
                ->where("dt_created_date", ">", date('Y-m-d') . " 00:00:00")
                ->where("dt_created_date", "<", date('Y-m-d') . " 23:59:59")
                ->count();
            $adds_no = \App\Helper\Helper::getSystemRecord("adds_no");
            if ((int)$adds_no->s_value <= $count_adds) {

                session()->flash("e_msg", "لا يمكن إضافة الإعلان وذلك لتجاوز الحد المسموح به لإضافة الإعلانات في اليوم الواحد");
                $json = array([["status" => "0"]]);
            } else {
                $category = AddsModel::where([
                    "pk_i_id" => $request->input("i_fk_category_id"),
                ])->first();
                $templates = TemplateModel::where([
                    "pk_i_id" => $category->fk_i_template_id
                ])->first();
                if ($templates) {
                    $fields = TemplateFieldsModel::where([
                        "fk_i_ads_template_id" => $templates->pk_i_id,
                    ])->get();
                }
                $string_array = explode(" ", $request->input("s_title_ar"));
                foreach ($string_array as $d) {
                    $text = AddsModel::where("s_name_ar", "like", "%$d%")->where('i_parent_id', '!=', 0)->first();
                    if ($text) {
                        $parent1 = AddsModel::where([
                            "pk_i_id" => $text->i_parent_id
                        ])->first();
                        if ($parent1->i_parent_id == 0 || $parent1->i_parent_id != $request->input("i_fk_category_id")) {
                            $test = null;
                            continue;
                        } else {
                            break;
                        }
                    }
                }
                $id1 = "";
                if (!$text) {
                    $other_array = AddsModel::where("s_name_ar", "like", "%أخرى%")
                        ->where('i_parent_id', '!=', 0)->get();

                    foreach ($other_array as $d) {
                        $parent1 = AddsModel::where([
                            "pk_i_id" => $d->i_parent_id
                        ])->first();
                        if ($parent1->i_parent_id == 0 || $parent1->i_parent_id != $request->input("i_fk_category_id")) {
                            $test = null;
                            continue;
                        } else {
                            $id1 = $d->pk_i_id;
                            break;
                        }
                    }
                } else {
                    $id1 = $text->pk_i_id;
                }
                $record = [
                    "s_title_ar" => $request->input("s_title_ar"),
                    "s_details" => $request->input("s_details"),
                    "i_type" => $request->input("i_type"),
                    "i_contact_method" => $request->input("i_contact_method"),
                    "i_fk_category_id" => $request->input("i_fk_category_id"),
                    "fk_i_by_user_id" => Auth::user()->pk_i_id,
                    "b_enable" => 1,
                    "dt_created_date" => date('Y-m-d H:i:s'),
                ];
                $adds_obj = UserAddsModel::create($record);
                if ($templates) {
                    foreach ($fields as $f) {
                        $answer_record = [
                            "fk_i_ads_user_id" => $adds_obj->pk_i_id,
                            "fk_i_field_id" => $f->getFieldData->pk_i_id,
                            "s_answer" => $request->input("s_answer" . $f->getFieldData->pk_i_id),
                        ];
                        FieldsAnswersModel::create($answer_record);
                    }
                }
                $json = array(["status" => "1", "id" => $adds_obj->pk_i_id]);

//            return back()->with("s_msg", "تمت عملية الحفظ بنجاح");
            }
        }
        return response()->json($json);
    }

    public function exQuery(Request $request)
    {
        $parent_id = 0;
        $sub_id = 0;
        $id1 = 0;

        $string1 = explode(" ", $request->input("s_title_ar"));
        foreach ($string1 as $string) {
            $text = KeyWordModel::where("key_word", "like", "%$string%")->first();
            if ($text) {
                break;
            }
        }
        if ($text) {
            $cat = AddsModel::where([
                "pk_i_id" => $text->fk_i_ads_user_id
            ])->first();
            $cat1 = AddsModel::where([
                "pk_i_id" => $cat->i_parent_id
            ])->first();
            $parent_id = $cat1->i_parent_id;
            $id1 = $cat->pk_i_id;
            $sub_id = $cat1->pk_i_id;
        }
        return response()->json(["status" => "1", "id" => $id1, "parent_id" => $parent_id, "sub_id" => $sub_id]);
    }

    public function editAdd1($id, Request $request)
    {

        if ($request->input()) {

            $category = AddsModel::where([
                "pk_i_id" => $request->input("i_fk_category_id"),
            ])->first();
            $templates = TemplateModel::where([
                "pk_i_id" => $category->fk_i_template_id
            ])->first();
            if ($templates) {
                $fields = TemplateFieldsModel::where([
                    "fk_i_ads_template_id" => $templates->pk_i_id,
                ])->get();
            }
            $string_array = explode(" ", $request->input("s_title_ar"));
            foreach ($string_array as $d) {
                $text = AddsModel::where("s_name_ar", "like", "%$d%")->where('i_parent_id', '!=', 0)->first();
                if ($text) {
                    $parent1 = AddsModel::where([
                        "pk_i_id" => $text->i_parent_id
                    ])->first();
                    if ($parent1->i_parent_id == 0 || $parent1->i_parent_id != $request->input("i_fk_category_id")) {
                        $test = null;
                        continue;
                    } else {
                        break;
                    }
                }
            }
            $id1 = "";
            if (!$text) {
                $other_array = AddsModel::where("s_name_ar", "like", "%أخرى%")
                    ->where('i_parent_id', '!=', 0)->get();

                foreach ($other_array as $d) {
                    $parent1 = AddsModel::where([
                        "pk_i_id" => $d->i_parent_id
                    ])->first();
                    if ($parent1->i_parent_id == 0 || $parent1->i_parent_id != $request->input("i_fk_category_id")) {
                        $test = null;
                        continue;
                    } else {
                        $id1 = $d->pk_i_id;
                        break;
                    }
                }
            } else {
                $id1 = $text->pk_i_id;
            }
            $record = [
                "s_title_ar" => $request->input("s_title_ar"),
                "s_details" => $request->input("s_details"),
                "i_type" => $request->input("i_type"),
                "i_contact_method" => $request->input("i_contact_method"),
                "i_fk_category_id" => $request->input("i_fk_category_id"),
                "b_enable" => 1,
            ];
            UserAddsModel::where([
                "pk_i_id" => $id,
            ])->update($record);
            FieldsAnswersModel::where([
                "fk_i_ads_user_id" => $id,
            ])->delete();
            if ($templates) {
                foreach ($fields as $f) {
                    $answer_record = [
                        "fk_i_ads_user_id" => $id,
                        "fk_i_field_id" => $f->getFieldData->pk_i_id,
                        "s_answer" => $request->input("s_answer" . $f->getFieldData->pk_i_id),
                    ];
                    FieldsAnswersModel::create($answer_record);
                }
            }
        }
        $imges = TempImgModel::where([
            'fk_i_user_id' => Auth::user()->pk_i_id,
        ])->get();
        //ضيف الصور واربط الid
        foreach ($imges as $i) {

        }
        return response()->json(["status" => "1", "id" => $id]);
    }

    public function requestAdd1Image(Request $request)
    {

        if ($request->input()) {
            $list_items = $request->input('pics');
            $i = 1;
            if (is_array($list_items) || is_object($list_items)) {

                foreach ($list_items as $file) {
                    $data = null;
                    $type = null;
                    if ($request->input('edit')) {

                        if (isset($file["file"])) {
                            if ($file["is_delete"] != 1) {
                                $data = $file["file"];
                                list($type, $data) = explode(';', $data);
                                list(, $data) = explode(',', $data);
                                $my_type = explode("/", $type);
                                $data = base64_decode($data);
                                $name = time() . $file["order"] . "." . $my_type[1];
                                file_put_contents(public_path('uploads') . $name, $data);
                                //$name = time() . '' . $file["file"]->getClientOriginalName();
                                $LOGO_WATERMARK_WIDTH = \App\Helper\Helper::getSystemRecord("LOGO_WATERMARK_WIDTH");
                                $LOGO_WATERMARK = \App\Helper\Helper::getSystemRecord("LOGO_WATERMARK");
                                $LOGO_WATERMARK_TRANSPARENCY = \App\Helper\Helper::getSystemRecord("LOGO_WATERMARK_TRANSPARENCY");
                                $LOGO_WATERMARK_POSITION = \App\Helper\Helper::getSystemRecord("LOGO_WATERMARK_POSITION");
                                // $file->move(public_path('uploads'), $name);
                                if ($LOGO_WATERMARK->s_value != "") {
                                    $filename_x = public_path('uploads') . $name;

                                    $filename_result = public_path('uploads') . $name;
                                    // Get dimensions for specified images
                                    list($width_x, $height_x) = getimagesize($filename_x);
//                                    list($width_y, $height_y) = getimagesize($filename_y);
                                    $width_y = $width_x / 3;
                                    $height_y = $height_x / 3;
                                    $filename_y = public_path('uploads') . $LOGO_WATERMARK->s_value;
                                    $original_info = getimagesize($filename_y);
                                    $original_w = $original_info[0];
                                    $original_h = $original_info[1];
                                    $ex = explode(".", $LOGO_WATERMARK->s_value);

                                    if ($ex[1] == "png" || $ex[1] == "PNG") {
                                        $original_img = imagecreatefrompng($filename_y);
                                    } else {
                                        $original_img = imagecreatefromjpeg($filename_y);
                                    }
                                    $thumb_w = ($width_x * $LOGO_WATERMARK_WIDTH->s_value) / 100;
                                    $thumb_h = ($height_x * $LOGO_WATERMARK_WIDTH->s_value) / 100;
                                    $thumb_img = imagecreatetruecolor($thumb_w, $thumb_h);
                                    imagecopyresampled($thumb_img, $original_img,
                                        0, 0,
                                        0, 0,
                                        $thumb_w, $thumb_h,
                                        $original_w, $original_h);

                                    // Create new image with desired dimensions
                                    $image = imagecreatetruecolor($width_x, $height_x);
                                    // Load images and then copy to destination image
                                    $v1 = 0;
                                    $v2 = 0;
                                    $v3 = 0;
                                    $v4 = 0;
                                    switch ($LOGO_WATERMARK_POSITION->s_value) {
                                        case "top_right":
                                            $v1 = 0;
                                            $v2 = 0;
                                            $v3 = 0;
                                            $v4 = 0;
                                            break;
                                        case "top_mid":
                                            $v1 = $width_y;
                                            $v2 = 0;
                                            $v3 = 0;
                                            $v4 = 0;
                                            break;
                                        case "top_left":
                                            $v1 = ($width_y * 2);
                                            $v2 = 0;
                                            $v3 = 0;
                                            $v4 = 0;
                                            break;
                                        case "mid_right":
                                            $v1 = 0;
                                            $v2 = $height_y;
                                            $v3 = 0;
                                            $v4 = 0;
                                            break;
                                        case "mid_mid":
                                            $v1 = $width_y;
                                            $v2 = $height_y;
                                            $v3 = 0;
                                            $v4 = 0;
                                            break;
                                        case "mid_left":
                                            $v1 = ($width_y * 2);
                                            $v2 = $height_y;
                                            $v3 = 0;
                                            $v4 = 0;
                                            break;
                                        case "bottom_right":
                                            $v1 = 0;
                                            $v2 = ($height_y * 2);
                                            $v3 = 0;
                                            $v4 = 0;
                                            break;
                                        case "bottom_mid":
                                            $v1 = $width_y;
                                            $v2 = ($height_y * 2);
                                            $v3 = 0;
                                            $v4 = 0;
                                            break;
                                        case "bottom_left":
                                            $v1 = ($width_y * 2);
                                            $v2 = ($height_y * 2);
                                            $v3 = 0;
                                            $v4 = 0;
                                            break;
                                    }
                                    $ex = explode(".", $name);
                                    $ey = explode(".", $LOGO_WATERMARK->s_value);

                                    if ($ex[1] == "png" || $ex[1] == "PNG") {
                                        $image_x = imagecreatefrompng($filename_x);
                                    } else {
                                        $image_x = imagecreatefromjpeg($filename_x);

                                    }
                                    if ($ey[1] == "png" || $ey[1] == "PNG") {
                                        imagepng($thumb_img, public_path('uploads') . $LOGO_WATERMARK->s_value);

                                        $image_y = imagecreatefrompng($filename_y);
                                    } else {
                                        imagejpeg($thumb_img, public_path('uploads') . $LOGO_WATERMARK->s_value);

                                        $image_y = imagecreatefromjpeg($filename_y);

                                    }
                                    imagecopy($image, $image_x, 0, 0, 0, 0, $width_x, $height_x);
                                    if ($LOGO_WATERMARK_TRANSPARENCY->s_value != "") {
                                        imagecopymerge($image, $image_y, $v1, $v2, $v3, $v4, $thumb_w, $thumb_h, ($LOGO_WATERMARK_TRANSPARENCY->s_value * 100));
                                    } else {
                                        imagecopy($image, $image_y, $v1, $v2, $v3, $v4, $thumb_w, $thumb_h);
                                    }
                                    // Save the resulting image to disk (as JPEG)
                                    imagepng($image, $filename_result);
                                    // Clean up
                                    imagedestroy($image);
                                    imagedestroy($image_x);
                                    imagedestroy($image_y);
                                }
                                UserAddsMeta::create([
                                    'fk_i_ads_user_id' => $request->input("id"),
                                    's_key' => "ADS_PIC",
                                    's_value' => $name,
                                    'i_order' => $file["order"],
                                ]);
                            }
                        } else {
                            if ($file["is_delete"] != 1) {
                                UserAddsMeta::where([
                                    'fk_i_ads_user_id' => $request->input("id"),
                                    's_value' => $file["name"],
                                ])->update([
                                    'i_order' => $file["order"],
                                ]);
                            } else {
                                UserAddsMeta::where([
                                    'fk_i_ads_user_id' => $request->input("id"),
                                    's_value' => $file["name"],
                                ])->delete();
                            }
                        }


                    } else {
                        if ($file["is_delete"] != 1) {
                            $data = $file["file"];
                            list($type, $data) = explode(';', $data);
                            list(, $data) = explode(',', $data);
                            $my_type = explode("/", $type);
                            $data = base64_decode($data);
                            $name = time() . $file["order"] . "." . $my_type[1];
                            file_put_contents(public_path('uploads') . $name, $data);
                            //$name = time() . '' . $file["file"]->getClientOriginalName();
                            $LOGO_WATERMARK_WIDTH = \App\Helper\Helper::getSystemRecord("LOGO_WATERMARK_WIDTH");
                            $LOGO_WATERMARK = \App\Helper\Helper::getSystemRecord("LOGO_WATERMARK");
                            $LOGO_WATERMARK_TRANSPARENCY = \App\Helper\Helper::getSystemRecord("LOGO_WATERMARK_TRANSPARENCY");
                            $LOGO_WATERMARK_POSITION = \App\Helper\Helper::getSystemRecord("LOGO_WATERMARK_POSITION");
                            // $file->move(public_path('uploads'), $name);
                            if ($LOGO_WATERMARK->s_value != "") {
                                $filename_x = public_path('uploads') . $name;

                                $filename_result = public_path('uploads') . $name;
                                // Get dimensions for specified images
                                list($width_x, $height_x) = getimagesize($filename_x);
//                                    list($width_y, $height_y) = getimagesize($filename_y);
                                $width_y = $width_x / 3;
                                $height_y = $height_x / 3;
                                $filename_y = public_path('uploads') . $LOGO_WATERMARK->s_value;
                                $original_info = getimagesize($filename_y);
                                $original_w = $original_info[0];
                                $original_h = $original_info[1];
                                $ex = explode(".", $LOGO_WATERMARK->s_value);

                                if ($ex[1] == "png" || $ex[1] == "PNG") {
                                    $original_img = imagecreatefrompng($filename_y);
                                } else {
                                    $original_img = imagecreatefromjpeg($filename_y);
                                }
                                $thumb_w = ($width_x * $LOGO_WATERMARK_WIDTH->s_value) / 100;
                                $thumb_h = ($height_x * $LOGO_WATERMARK_WIDTH->s_value) / 100;
                                $thumb_img = imagecreatetruecolor($thumb_w, $thumb_h);
                                imagecopyresampled($thumb_img, $original_img,
                                    0, 0,
                                    0, 0,
                                    $thumb_w, $thumb_h,
                                    $original_w, $original_h);

                                // Create new image with desired dimensions
                                $image = imagecreatetruecolor($width_x, $height_x);
                                // Load images and then copy to destination image
                                $v1 = 0;
                                $v2 = 0;
                                $v3 = 0;
                                $v4 = 0;
                                switch ($LOGO_WATERMARK_POSITION->s_value) {
                                    case "top_right":
                                        $v1 = 0;
                                        $v2 = 0;
                                        $v3 = 0;
                                        $v4 = 0;
                                        break;
                                    case "top_mid":
                                        $v1 = $width_y;
                                        $v2 = 0;
                                        $v3 = 0;
                                        $v4 = 0;
                                        break;
                                    case "top_left":
                                        $v1 = ($width_y * 2);
                                        $v2 = 0;
                                        $v3 = 0;
                                        $v4 = 0;
                                        break;
                                    case "mid_right":
                                        $v1 = 0;
                                        $v2 = $height_y;
                                        $v3 = 0;
                                        $v4 = 0;
                                        break;
                                    case "mid_mid":
                                        $v1 = $width_y;
                                        $v2 = $height_y;
                                        $v3 = 0;
                                        $v4 = 0;
                                        break;
                                    case "mid_left":
                                        $v1 = ($width_y * 2);
                                        $v2 = $height_y;
                                        $v3 = 0;
                                        $v4 = 0;
                                        break;
                                    case "bottom_right":
                                        $v1 = 0;
                                        $v2 = ($height_y * 2);
                                        $v3 = 0;
                                        $v4 = 0;
                                        break;
                                    case "bottom_mid":
                                        $v1 = $width_y;
                                        $v2 = ($height_y * 2);
                                        $v3 = 0;
                                        $v4 = 0;
                                        break;
                                    case "bottom_left":
                                        $v1 = ($width_y * 2);
                                        $v2 = ($height_y * 2);
                                        $v3 = 0;
                                        $v4 = 0;
                                        break;
                                }
                                $ex = explode(".", $name);
                                $ey = explode(".", $LOGO_WATERMARK->s_value);

                                if ($ex[1] == "png" || $ex[1] == "PNG") {
                                    $image_x = imagecreatefrompng($filename_x);
                                } else {
                                    $image_x = imagecreatefromjpeg($filename_x);

                                }
                                if ($ey[1] == "png" || $ey[1] == "PNG") {
                                    imagepng($thumb_img, public_path('uploads') . $LOGO_WATERMARK->s_value);

                                    $image_y = imagecreatefrompng($filename_y);
                                } else {
                                    imagejpeg($thumb_img, public_path('uploads') . $LOGO_WATERMARK->s_value);

                                    $image_y = imagecreatefromjpeg($filename_y);

                                }
                                imagecopy($image, $image_x, 0, 0, 0, 0, $width_x, $height_x);
                                if ($LOGO_WATERMARK_TRANSPARENCY->s_value != "") {
                                    imagecopymerge($image, $image_y, $v1, $v2, $v3, $v4, $thumb_w, $thumb_h, ($LOGO_WATERMARK_TRANSPARENCY->s_value * 100));
                                } else {
                                    imagecopy($image, $image_y, $v1, $v2, $v3, $v4, $thumb_w, $thumb_h);
                                }
                                // Save the resulting image to disk (as JPEG)
                                imagepng($image, $filename_result);
                                // Clean up
                                imagedestroy($image);
                                imagedestroy($image_x);
                                imagedestroy($image_y);
                            }
                            UserAddsMeta::create([
                                'fk_i_ads_user_id' => $request->input("id"),
                                's_key' => "ADS_PIC",
                                's_value' => $name,
                                'i_order' => $file["order"],
                            ]);
                        }
                    }
                }
            }
//            return back()->with("s_msg", "تمت عملية الحفظ بنجاح");
        }
        session()->flash("s_msg", "تم الحفظ بنجاح");
        return response()->json(["status" => "1"]);
    }

    public function requestAdd1Image1(Request $request)
    {

        if ($request->input()) {
            $file = $request->input('pics');
            $i = 1;
            $data = null;
            $type = null;
            $data = $file["file"];
            list($type, $data) = explode(';', $data);
            list(, $data) = explode(',', $data);
            $my_type = explode("/", $type);
            $data = base64_decode($data);
            $name = time() . $file["order"] . "." . $my_type[1];
            file_put_contents(public_path('uploads') . $name, $data);
            //$name = time() . '' . $file["file"]->getClientOriginalName();
            $LOGO_WATERMARK_WIDTH = \App\Helper\Helper::getSystemRecord("LOGO_WATERMARK_WIDTH");
            $LOGO_WATERMARK = \App\Helper\Helper::getSystemRecord("LOGO_WATERMARK");
            $LOGO_WATERMARK_TRANSPARENCY = \App\Helper\Helper::getSystemRecord("LOGO_WATERMARK_TRANSPARENCY");
            $LOGO_WATERMARK_POSITION = \App\Helper\Helper::getSystemRecord("LOGO_WATERMARK_POSITION");
            // $file->move(public_path('uploads'), $name);
            if ($LOGO_WATERMARK->s_value != "") {
                $filename_x = public_path('uploads') . $name;

                $filename_result = public_path('uploads') . $name;
                // Get dimensions for specified images
                list($width_x, $height_x) = getimagesize($filename_x);
//                                    list($width_y, $height_y) = getimagesize($filename_y);
                $width_y = $width_x / 3;
                $height_y = $height_x / 3;
                $filename_y = public_path('uploads') . $LOGO_WATERMARK->s_value;
                $original_info = getimagesize($filename_y);
                $original_w = $original_info[0];
                $original_h = $original_info[1];
                $ex = explode(".", $LOGO_WATERMARK->s_value);

                if ($ex[1] == "png" || $ex[1] == "PNG") {
                    $original_img = imagecreatefrompng($filename_y);
                } else {
                    $original_img = imagecreatefromjpeg($filename_y);
                }
                $thumb_w = ($width_x * $LOGO_WATERMARK_WIDTH->s_value) / 100;
                $thumb_h = ($height_x * $LOGO_WATERMARK_WIDTH->s_value) / 100;
                $thumb_img = imagecreatetruecolor($thumb_w, $thumb_h);
                imagecopyresampled($thumb_img, $original_img,
                    0, 0,
                    0, 0,
                    $thumb_w, $thumb_h,
                    $original_w, $original_h);

                // Create new image with desired dimensions
                $image = imagecreatetruecolor($width_x, $height_x);
                // Load images and then copy to destination image
                $v1 = 0;
                $v2 = 0;
                $v3 = 0;
                $v4 = 0;
                switch ($LOGO_WATERMARK_POSITION->s_value) {
                    case "top_right":
                        $v1 = 0;
                        $v2 = 0;
                        $v3 = 0;
                        $v4 = 0;
                        break;
                    case "top_mid":
                        $v1 = $width_y;
                        $v2 = 0;
                        $v3 = 0;
                        $v4 = 0;
                        break;
                    case "top_left":
                        $v1 = ($width_y * 2);
                        $v2 = 0;
                        $v3 = 0;
                        $v4 = 0;
                        break;
                    case "mid_right":
                        $v1 = 0;
                        $v2 = $height_y;
                        $v3 = 0;
                        $v4 = 0;
                        break;
                    case "mid_mid":
                        $v1 = $width_y;
                        $v2 = $height_y;
                        $v3 = 0;
                        $v4 = 0;
                        break;
                    case "mid_left":
                        $v1 = ($width_y * 2);
                        $v2 = $height_y;
                        $v3 = 0;
                        $v4 = 0;
                        break;
                    case "bottom_right":
                        $v1 = 0;
                        $v2 = ($height_y * 2);
                        $v3 = 0;
                        $v4 = 0;
                        break;
                    case "bottom_mid":
                        $v1 = $width_y;
                        $v2 = ($height_y * 2);
                        $v3 = 0;
                        $v4 = 0;
                        break;
                    case "bottom_left":
                        $v1 = ($width_y * 2);
                        $v2 = ($height_y * 2);
                        $v3 = 0;
                        $v4 = 0;
                        break;
                }
                $ex = explode(".", $name);
                $ey = explode(".", $LOGO_WATERMARK->s_value);

                if ($ex[1] == "png" || $ex[1] == "PNG") {
                    $image_x = imagecreatefrompng($filename_x);
                } else {
                    $image_x = imagecreatefromjpeg($filename_x);

                }
                if ($ey[1] == "png" || $ey[1] == "PNG") {
                    imagepng($thumb_img, public_path('uploads') . $LOGO_WATERMARK->s_value);

                    $image_y = imagecreatefrompng($filename_y);
                } else {
                    imagejpeg($thumb_img, public_path('uploads') . $LOGO_WATERMARK->s_value);

                    $image_y = imagecreatefromjpeg($filename_y);

                }
                imagecopy($image, $image_x, 0, 0, 0, 0, $width_x, $height_x);
                if ($LOGO_WATERMARK_TRANSPARENCY->s_value != "") {
                    imagecopymerge($image, $image_y, $v1, $v2, $v3, $v4, $thumb_w, $thumb_h, ($LOGO_WATERMARK_TRANSPARENCY->s_value * 100));
                } else {
                    imagecopy($image, $image_y, $v1, $v2, $v3, $v4, $thumb_w, $thumb_h);
                }
                // Save the resulting image to disk (as JPEG)
                imagepng($image, $filename_result);
                // Clean up
                imagedestroy($image);
                imagedestroy($image_x);
                imagedestroy($image_y);
            }
            TempImgModel::create([
                'fk_i_user_id' => Auth::user()->pk_i_id,
                's_img' => $name,
                'i_order' => $file["order"],
            ]);
//            return back()->with("s_msg", "تمت عملية الحفظ بنجاح");
        }
        return response()->json(["status" => "1"]);
    }

    public function editAdd($id)
    {
        $data["record_data"] = UserAddsModel::where([
            "i_adds_type" => 0,
            "pk_i_id" => $id,
        ])->first();
        if (Auth::user()->fk_i_role_id != 95 && Auth::user()->fk_i_role_id != 96 && $data["record_data"]->fk_i_by_user_id != Auth::user()->pk_i_id) {
            return back();
        }
        $data["title"] = "تعديل الإعلان";
        $data["primCategory"] = RecentModel::where([
            "i_parent_id" => 0,
        ])->get();
        $data["record_data"] = UserAddsModel::where([
            "i_adds_type" => 0,
            "pk_i_id" => $id,
        ])->first();
        $data["answers"] = FieldsAnswersModel::where([
            "fk_i_ads_user_id" => $id,
        ])->get();
        $sub = AddsModel::where([
            "pk_i_id" => $data["record_data"]->i_fk_category_id
        ])->first();
        $data["prim"] = AddsModel::where([
            "pk_i_id" => $sub->i_parent_id
        ])->first();
        if ($data["prim"]) {
            $data["main"] = AddsModel::where([
                "pk_i_id" => $data["prim"]->i_parent_id
            ])->first();
        } else {
            $data["main"] = array();
        }
        $data["main1"] = $sub;
        return view('RecentAdd::editAdd', $data);
    }

    public function index(Request $request)
    {
        if ($request->input()) {
            SystemModel::where([
                "s_key" => "ADS_SPACE_BAR_COUNT"
            ])->update([
                "s_value" => $request->input("adds_num")
            ]);
            $primCategory = RecentModel::where([
                "i_parent_id" => 0,
                //"b_enable" => 1,
            ])->get();
            foreach ($primCategory as $p) {
                $primFlag = false;
                foreach ($p->getChilds as $c1) {
                    $mainFlag = false;
                    foreach ($c1->getChilds as $c2) {
                        if ($request->input("cat_" . $c2->pk_i_id)) {
                            $primFlag = true;
                            $mainFlag = true;
                            $record = [
                                "b_is_tag" => 1,
                            ];
                        } else {
                            $record = [
                                "b_is_tag" => 0,
                            ];
                        }
                        RecentModel::where([
                            "pk_i_id" => $c2->pk_i_id,
                        ])->update($record);
                    }
//                    $record = [
//                        "b_is_tag" => 1,
//                    ];
//                    if ($mainFlag) {//|| $request->input("cat_" . $c1->pk_i_id)){
//                        RecentModel::where([
//                            "pk_i_id" => $c1->pk_i_id,
//                        ])->update($record);
//                    }
                }
//                $record = [
//                    "b_is_tag" => 1,
//                ];
//                if ($primFlag || $request->input("cat_" . $p->pk_i_id)) {
//                    RecentModel::where([
//                        "pk_i_id" => $p->pk_i_id,
//                    ])->update($record);
//                }
            }
            return back()->with("s_msg", "تمت عملية الحفظ بنجاح");
        }
        $data["primCategory"] = RecentModel::where([
            "i_parent_id" => 0,
            //"b_enable" => 1,
        ])->get();
        $data["adds_num"] = SystemModel::where([
            "s_key" => "ADS_SPACE_BAR_COUNT"
        ])->first();
        $data["title"] = "الأحدث";
        return view('RecentAdd::index', $data);
    }

    public function finishAdds($id, Request $request)
    {
        if ($request->input()) {
            $record = [
                "ads_value" => $request->input("ads_value"),
                "fk_i_currency" => $request->input("fk_i_currency"),
                "fk_i_paid_during" => $request->input("fk_i_paid_during"),
                "s_mobile" => $request->input("s_mobile"),
                "s_fullname" => $request->input("s_fullname"),
                "b_enable" => $request->input("closedAdd"),
            ];
            UserAddsModel::where([
                "pk_i_id" => $id,
            ])->update($record);

            return back()->with("s_msg", "تمت عملية الحفظ بنجاح");
        }
        $data["record"] = UserAddsModel::where([
            "i_adds_type" => 0,
            "pk_i_id" => $id
        ])->first();
        if ($data["record"]->fk_i_by_user_id != Auth::user()->pk_i_id) {
            return back();
        }
        $data["user_details"] = UserModel::where([
            "pk_i_id" => $data["record"]->fk_i_by_user_id,
        ])->first();
        $data["currency"] = ConstantModel::where([
            "fk_i_parent_id" => 0,
            "s_key" => "Currency",
        ])->first();
        $data["CoinsTime"] = ConstantModel::where([
            "fk_i_parent_id" => 0,
            "s_key" => "CoinsTime",
        ])->first();

        $data["title"] = "الأحدث";
        return view('RecentAdd::finishAdds', $data);
    }

    public function insertComment($id, Request $request)
    {
        if ($request->input()) {
            $blackword = ConstantModel::where([
                "fk_i_parent_id" => 102,
            ])->get();
            $flag = true;
            foreach ($blackword as $b) {
                if (strpos($request->input("comment"), $b->s_name_ar) !== false) {
                    $flag = false;
                }
            }
            if (!$flag) {
                $date_today = date('Y-m-d H:i:s');
                $date_3 = date('Y-m-d H:i:s', strtotime('+3 day'));
                UserModel::where([
                    "pk_i_id" => Auth::user()->pk_i_id
                ])->update([
                    "b_enabled" => 0,
                    "dt_last_block_date" => $date_today,
                    "dt_block_to_date" => $date_3,
                    "i_block_count" => (int)Auth::user()->i_block_count + 1,
                    "i_bad_words_count" => (int)Auth::user()->i_bad_words_count + 1,
                ]);
                Auth::logout();
                Session::flush();
                return redirect("/login")->with("e_msg", "لقد تم حظرك من الموقع لمدة 72 ساعة وذلك لعدم الالتزام بالقوانين");
            }
            $record = [
                "s_comment" => $request->input("comment"),
                "fk_i_ads_user_id" => $id,
                "fk_i_user_id" => Auth::user()->pk_i_id,
                "i_status" => 1,
                "b_enabled" => 1,
                "dt_created_date" => date('Y-m-d H:i:s'),
                "dt_modified_date" => null,
                "dt_deleted_date" => null
            ];
            $UserAdds = UserAddsModel::where([
                "i_adds_type" => 0,
                "pk_i_id" => $id,
            ])->first();
            AddsComments::create($record);
            $user_details = UserModel::where([
                "pk_i_id" => Auth::user()->pk_i_id,
            ])->first();
            $msg = "قام " . $user_details->s_first_name . " " . $user_details->s_last_name . " بالتعليق على إعلان: " . $UserAdds->s_title_ar;
            return redirect("/send_notification/" . $msg . "/" . $id);
        }
    }

    public function quoteUser($id, Request $request)
    {
        if ($request->input()) {
            $blackword = ConstantModel::where([
                "fk_i_parent_id" => 102,
            ])->get();
            $flag = true;
            foreach ($blackword as $b) {
                if (strpos($request->input("qouts_comment"), $b->s_name_ar) !== false) {
                    $flag = false;
                }
            }
            if (!$flag) {
                $date_today = date('Y-m-d H:i:s');
                $date_3 = date('Y-m-d H:i:s', strtotime('+3 day'));
                UserModel::where([
                    "pk_i_id" => Auth::user()->pk_i_id
                ])->update([
                    "b_enabled" => 0,
                    "dt_last_block_date" => $date_today,
                    "dt_block_to_date" => $date_3,
                    "i_block_count" => (int)Auth::user()->i_block_count + 1,
                    "i_bad_words_count" => (int)Auth::user()->i_bad_words_count + 1,
                ]);
                Auth::logout();
                Session::flush();
                return redirect("/login")->with("e_msg", "لقد تم حظرك من الموقع لمدة 72 ساعة وذلك لعدم الالتزام بالقوانين");
            }
            $record = [
                "s_comment" => $request->input("hidden_text") . $request->input("qouts_comment"),
                "fk_i_ads_user_id" => $id,
                "fk_i_user_id" => Auth::user()->pk_i_id,
                "i_status" => 1,
                "b_enabled" => 1,
                "dt_created_date" => date('Y-m-d H:i:s'),
                "dt_modified_date" => null,
                "dt_deleted_date" => null
            ];
            $UserAdds = UserAddsModel::where([
                "i_adds_type" => 0,
                "pk_i_id" => $id,
            ])->first();
            AddsComments::create($record);
            $user_details = UserModel::where([
                "pk_i_id" => Auth::user()->pk_i_id,
            ])->first();
            $msg = "قام " . $user_details->s_first_name . " " . $user_details->s_last_name . " بإقتباس الرد الذي يخصك : " . $UserAdds->s_title_ar;
            $adss_record = UserAddsModel::where([
                "pk_i_id" => $id,
            ])->first();
            $sender_details = UserModel::where([
                "pk_i_id" => Auth::user()->pk_i_id
            ])->first();
            $record = [
                "i_target_users_id" => 2,
                "fk_i_actor_user_id" => $sender_details->pk_i_id,
                "s_url" => "/newest/show/" . $id . "/" . str_replace(" ", "-", trim($adss_record->s_title_ar)),
                "s_url_msg" => $msg,
                "b_enabled" => 1,
                "dt_created_date" => date('Y-m-d H:i:s'),
            ];
            $notif_obj = Notification::create($record);
            $user_record = [
                "fk_i_notification_id" => $notif_obj->pk_i_id,
                "fk_i_user_id" => $request->input("user_comment_owner_id") ,
                "dt_created_date" => date('Y-m-d H:i:s'),
                "i_title_type" => 0,
            ];
            NotificationUser::create($user_record);

            $msg = "قام " . $user_details->s_first_name . " " . $user_details->s_last_name . " بالتعليق على إعلان: " . $UserAdds->s_title_ar;
            return redirect("/send_notification/" . $msg . "/" . $id);
        }
    }
}

?>
