<?php

namespace Packages\Adds\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Packages\Adds\AddsModel;
use Packages\Adds\ConstantModel;
use Packages\Adds\FieldOptionsModel;
use Packages\Adds\SpaceAreaModel;
use Packages\Adds\UserAddsModel;
use Packages\RecentAdd\AddsComments;
use Packages\RecentAdd\CommentsComplains_Model;
use Packages\System\Notification;
use Packages\System\NotificationUser;

class Adds extends BaseController
{
    public function index(Request $request)
    {
        if ($request->input()) {
            $primCategory = AddsModel::where([
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
                                "b_is_filter" => 1,
                            ];
                        } else {
                            $record = [
                                "b_is_filter" => 0,
                            ];
                        }
                        AddsModel::where([
                            "pk_i_id" => $c2->pk_i_id,
                        ])->update($record);
                    }
                    $record = [
                        "b_is_filter" => 1,
                    ];
                    if ($mainFlag || $request->input("cat_" . $c1->pk_i_id)) {
                        AddsModel::where([
                            "pk_i_id" => $c1->pk_i_id,
                        ])->update($record);
                    }
                }
                $record = [
                    "b_is_filter" => 1,
                ];
                if ($primFlag || $request->input("cat_" . $p->pk_i_id)) {
                    AddsModel::where([
                        "pk_i_id" => $p->pk_i_id,
                    ])->update($record);
                }
            }
            return back()->with("s_msg", "تمت عملية الحفظ بنجاح");
        }
        $data["primCategory"] = AddsModel::where([
            "i_parent_id" => 0,
            //"b_enable" => 1,
        ])->get();
        $data["Countries"] = FieldOptionsModel::where([
            "i_parent_id" => 0,
            "fk_i_field_id" => 2,
            //"b_enable" => 1,
        ])->get();
        $data["VIEW_ASK_ADS"] = FieldOptionsModel::where([
            "i_parent_id" => 0,
            "fk_i_field_id" => 4,
            //"b_enable" => 1,
        ])->get();
        $data["Models"] = FieldOptionsModel::where([
            "fk_i_field_id" => "1",
            //"b_enable" => 1,
        ])->get();
        $data["title"] = "فلتر الإعلانات";
        return view('Adds::index', $data);
    }

    public function user_ads(Request $request)
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
        $data["user_ads"] = UserAddsModel::where([
            "i_adds_type" => 0,
            "b_enable" => 1,
        ])->get();
        $data["title"] = "اعلانات الاعضاء";
        return view('Adds::user_ads', $data);
    }

    public function archives()
    {
        $data["user_ads"] = UserAddsModel::where([
            "i_adds_type" => 0,
            "b_enable" => 0,
        ])->get();
        $data["title"] = "الارشيف";
        return view('Adds::archives', $data);
    }

    public function edit_user_ads($id, Request $request)
    {
        if ($request->input()) {
            if ($request->input("category_id") == "special") {
                $primCategory = AddsModel::where([
                    "i_parent_id" => 0,
                    //"b_enable" => 1,
                ])->get();
                $ary = array();
                foreach ($primCategory as $p) {
                    $primFlag = false;
                    foreach ($p->getChilds as $c1) {
                        $mainFlag = false;
                        foreach ($c1->getChilds as $c2) {
                            if ($request->input("cat_" . $c2->pk_i_id)) {
                                $primFlag = true;
                                $mainFlag = true;
                                $record = [
                                    "b_has_ads_space" => 1,
                                ];
                                AddsModel::where([
                                    "pk_i_id" => $c2->pk_i_id,
                                ])->update($record);
                                array_push($ary,
                                    [
                                        $c2->pk_i_id
                                    ]
                                );
                            }
                            $record = [
                                "b_has_ads_space" => 1,
                            ];
                            if ($mainFlag || $request->input("cat_" . $c1->pk_i_id)) {
                                AddsModel::where([
                                    "pk_i_id" => $c1->pk_i_id,
                                ])->update($record);
                                array_push($ary,
                                    [
                                        $c1->pk_i_id
                                    ]
                                );
                            }
                        }
                        $record = [
                            "b_has_ads_space" => 1,
                        ];
                        if ($primFlag || $request->input("cat_" . $p->pk_i_id)) {
                            AddsModel::where([
                                "pk_i_id" => $p->pk_i_id,
                            ])->update($record);
                            array_push($ary,
                                [
                                    $p->pk_i_id
                                ]
                            );
                        }
                    }
                }
                $record = [
                    "i_is_featured" => 1,
                    "s_is_featured_ary" => json_encode($ary),
                ];
            } else if ($request->input("category_id") == "selectAll") {
                $record = [
                    "i_is_featured" => 1,
                    "s_is_featured_ary" => 0,
                ];
            } else {
                $record = [
                    "i_is_featured" => 0,
                ];
            }

            UserAddsModel::where([
                "i_adds_type" => 0,
                "pk_i_id" => $id
            ])->update($record);
            return back()->with("s_msg", "تمت عملية التعديل بنجاح");
        }
        $data["record"] = UserAddsModel::where(["pk_i_id" => $id,            "i_adds_type" => 0,
        ])->first();
        $data["primCategory"] = AddsModel::where([
            "i_parent_id" => 0,
            //"b_enable" => 1,
        ])->get();
        $data["title"] = "تعديل بيانات اعلان العضو";
        return view('Adds::edit_user_ads', $data);
    }

    public function saveCountriesFilterss(Request $request)
    {
        if ($request->input()) {
            $Countries = FieldOptionsModel::where([
                "i_parent_id" => 0,
                "fk_i_field_id" => 2,
                //"b_enable" => 1,
            ])->get();
            foreach ($Countries as $p) {
                $primFlag = false;
                foreach ($p->getChilds as $c1) {
                    if ($request->input("cant_" . $c1->pk_i_id)) {
                        $primFlag = true;
                        $record = [
                            "b_is_filter" => 1,
                        ];
                    } else {
                        $record = [
                            "b_is_filter" => 0,
                        ];
                    }
                    FieldOptionsModel::where([
                        "pk_i_id" => $c1->pk_i_id,
                    ])->update($record);
                }
                $record = [
                    "b_is_filter" => 1,
                ];
                if ($primFlag || $request->input("cant_" . $p->pk_i_id)) {
                    FieldOptionsModel::where([
                        "pk_i_id" => $p->pk_i_id,
                    ])->update($record);
                }
            }
            return back()->with("s_msg", "تمت عملية الحفظ بنجاح");
        }
    }

    public function saveASK_VIEW_Filterss(Request $request)
    {
        if ($request->input()) {
            $VIEW_ASK_ADS = FieldOptionsModel::where([
                "i_parent_id" => 0,
                "fk_i_field_id" => 4,
                //"b_enable" => 1,
            ])->get();
            foreach ($VIEW_ASK_ADS as $p) {
                if ($request->input("view_ask_" . $p->pk_i_id)) {
                    $record = [
                        "b_is_filter" => 1,
                    ];
                } else {
                    $record = [
                        "b_is_filter" => 0,
                    ];
                }
                FieldOptionsModel::where([
                    "pk_i_id" => $p->pk_i_id,
                ])->update($record);
            }
            return back()->with("s_msg", "تمت عملية الحفظ بنجاح");
        }
    }

    public function saveModel_Filterss(Request $request)
    {
        if ($request->input()) {
            $Models = FieldOptionsModel::where([
                "fk_i_field_id" => "1",
                //"b_enable" => 1,
            ])->get();
            foreach ($Models as $p) {
                if ($request->input("model_" . $p->pk_i_id)) {
                    $record = [
                        "b_is_filter" => 1,
                    ];
                } else {
                    $record = [
                        "b_is_filter" => 0,
                    ];
                }
                FieldOptionsModel::where([
                    "pk_i_id" => $p->pk_i_id,
                ])->update($record);
            }
            return back()->with("s_msg", "تمت عملية الحفظ بنجاح");

        }
    }

    public function adds_area()
    {

        $data["title"] = "المساحة الاعلانية";
        $data["adds_area"] = SpaceAreaModel::all();

        return view('Adds::adds_area', $data);
    }

    public function addurl($id)
    {
        $record = SpaceAreaModel::where([
            "pk_i_id" => $id
        ])->first();
        $count = (int)$record->i_clicks_count + 1;
        SpaceAreaModel::where([
            "pk_i_id" => $id
        ])->update([
            "i_clicks_count" => $count
        ]);
        return Redirect::to("http://" . $record->s_url);
    }

    public function add_adds_area(Request $request)
    {
        if ($request->input()) {
            $getimageName = "";
            if (Input::hasFile('s_pic')) {
                $getimageName = time() . '.' . $request->s_pic->getClientOriginalExtension();
                $request->s_pic->move(public_path('uploads'), $getimageName);
            }
            if ($request->input("category_id") == "special") {
                $primCategory = AddsModel::where([
                    "i_parent_id" => 0,
                    //"b_enable" => 1,
                ])->get();
                $ary = array();
                foreach ($primCategory as $p) {
                    $primFlag = false;
                    foreach ($p->getChilds as $c1) {
                        $mainFlag = false;
                        foreach ($c1->getChilds as $c2) {
                            if ($request->input("cat_" . $c2->pk_i_id)) {
                                $primFlag = true;
                                $mainFlag = true;
                                $record = [
                                    "b_has_ads_space" => 1,
                                ];
                                AddsModel::where([
                                    "pk_i_id" => $c2->pk_i_id,
                                ])->update($record);
                                array_push($ary,
                                    [
                                        $c2->pk_i_id
                                    ]
                                );
                            }
                            $record = [
                                "b_has_ads_space" => 1,
                            ];
                            if ($mainFlag || $request->input("cat_" . $c1->pk_i_id)) {
                                AddsModel::where([
                                    "pk_i_id" => $c1->pk_i_id,
                                ])->update($record);
                                array_push($ary,
                                    [
                                        $c1->pk_i_id
                                    ]
                                );
                            }
                        }
                        $record = [
                            "b_has_ads_space" => 1,
                        ];
                        if ($primFlag || $request->input("cat_" . $p->pk_i_id)) {
                            AddsModel::where([
                                "pk_i_id" => $p->pk_i_id,
                            ])->update($record);
                            array_push($ary,
                                [
                                    $p->pk_i_id
                                ]
                            );
                        }
                    }
                }
                $record = [
                    "s_title" => $request->input("title"),
                    "s_desc" => $request->input("desc"),
                    "s_url" => $request->input("url"),
                    "i_fk_category_id" => json_encode($ary),
                    "s_pic" => $getimageName,
                    "b_enabled" => $request->input("status"),
                    "dt_created_date" => date('Y-m-d H:i:s'),
                    "dt_modified_date" => null,
                    "dt_deleted_date" => null
                ];
            } else {
                $record = [
                    "s_title" => $request->input("title"),
                    "s_desc" => $request->input("desc"),
                    "s_url" => $request->input("url"),
                    "i_fk_category_id" => 0,
                    "s_pic" => $getimageName,
                    "b_enabled" => $request->input("status"),
                    "dt_created_date" => date('Y-m-d H:i:s'),
                    "dt_modified_date" => null,
                    "dt_deleted_date" => null
                ];
            }
            SpaceAreaModel::create($record);
            return back()->with("s_msg", "تمت عملية الإضافة بنجاح");
        }
        $data["primCategory"] = AddsModel::where([
            "i_parent_id" => 0,
            //"b_enable" => 1,
        ])->get();
        $data["title"] = "إضافة مساحة اعلانية";
        return view('Adds::add_adds_area', $data);
    }

    public function edit_adds_area($id, Request $request)
    {
        if ($request->input()) {
            $getimageName = "";
            if (Input::hasFile('s_pic')) {
                $getimageName = time() . '.' . $request->s_pic->getClientOriginalExtension();
                $request->s_pic->move(public_path('uploads'), $getimageName);
            }
            if ($request->input("category_id") == "special") {
                $primCategory = AddsModel::where([
                    "i_parent_id" => 0,
                    //"b_enable" => 1,
                ])->get();
                $ary = array();
                foreach ($primCategory as $p) {
                    $primFlag = false;
                    foreach ($p->getChilds as $c1) {
                        $mainFlag = false;
                        foreach ($c1->getChilds as $c2) {
                            if ($request->input("cat_" . $c2->pk_i_id)) {
                                $primFlag = true;
                                $mainFlag = true;
                                $record = [
                                    "b_has_ads_space" => 1,
                                ];
                                AddsModel::where([
                                    "pk_i_id" => $c2->pk_i_id,
                                ])->update($record);
                                array_push($ary,
                                    [
                                        $c2->pk_i_id
                                    ]
                                );
                            }
                            $record = [
                                "b_has_ads_space" => 1,
                            ];
                            if ($mainFlag || $request->input("cat_" . $c1->pk_i_id)) {
                                AddsModel::where([
                                    "pk_i_id" => $c1->pk_i_id,
                                ])->update($record);
                                array_push($ary,
                                    [
                                        $c1->pk_i_id
                                    ]
                                );
                            }
                        }
                        $record = [
                            "b_has_ads_space" => 1,
                        ];
                        if ($primFlag || $request->input("cat_" . $p->pk_i_id)) {
                            AddsModel::where([
                                "pk_i_id" => $p->pk_i_id,
                            ])->update($record);
                            array_push($ary,
                                [
                                    $p->pk_i_id
                                ]
                            );
                        }
                    }
                }
                if ($getimageName != "") {
                    $record = [
                        "s_title" => $request->input("title"),
                        "s_desc" => $request->input("desc"),
                        "s_url" => $request->input("url"),
                        "i_fk_category_id" => json_encode($ary),
                        "s_pic" => $getimageName,
                        "b_enabled" => $request->input("status"),
                        "dt_created_date" => date('Y-m-d H:i:s'),
                        "dt_modified_date" => null,
                        "dt_deleted_date" => null
                    ];
                } else {
                    $record = [
                        "s_title" => $request->input("title"),
                        "s_desc" => $request->input("desc"),
                        "s_url" => $request->input("url"),
                        "i_fk_category_id" => json_encode($ary),
                        "b_enabled" => $request->input("status"),
                        "dt_created_date" => date('Y-m-d H:i:s'),
                        "dt_modified_date" => null,
                        "dt_deleted_date" => null
                    ];
                }
            } else {
                if ($getimageName != "") {
                    $record = [
                        "s_title" => $request->input("title"),
                        "s_desc" => $request->input("desc"),
                        "s_url" => $request->input("url"),
                        "i_fk_category_id" => 0,
                        "s_pic" => $getimageName,
                        "b_enabled" => $request->input("status"),
                        "dt_created_date" => date('Y-m-d H:i:s'),
                        "dt_modified_date" => null,
                        "dt_deleted_date" => null
                    ];
                } else {
                    $record = [
                        "s_title" => $request->input("title"),
                        "s_desc" => $request->input("desc"),
                        "s_url" => $request->input("url"),
                        "i_fk_category_id" => 0,
                        "b_enabled" => $request->input("status"),
                        "dt_created_date" => date('Y-m-d H:i:s'),
                        "dt_modified_date" => null,
                        "dt_deleted_date" => null
                    ];
                }
            }

            SpaceAreaModel::where([
                "pk_i_id" => $id
            ])->update($record);
            return back()->with("s_msg", "تمت عملية التعديل بنجاح");
        }
        $data["title"] = "تعديل بيانات المساحة الاعلانية";
        $data["record"] = SpaceAreaModel::where([
            "pk_i_id" => $id
        ])->first();
        $data["primCategory"] = AddsModel::where([
            "i_parent_id" => 0,
            //"b_enable" => 1,
        ])->get();
        return view('Adds::edit_adds_area', $data);
    }

    public function delete_adds_area($id)
    {
        SpaceAreaModel::where([
            "pk_i_id" => $id
        ])->delete();

        return back()->with("s_msg", "تمت عملية الحذف بنجاح");

    }

    public function delete_adds_area1($id, $status)
    {
        UserAddsModel::where([
            "i_adds_type" => 0,
            "pk_i_id" => $id
        ])->update([
            "b_enable" => $status
        ]);
        return back()->with("s_msg", "تمت العملية بنجاح");
    }

    public function delete_adds_area12($id)
    {
        UserAddsModel::where([
            "i_adds_type" => 0,
            "pk_i_id" => $id
        ])->delete();
        Notification::where([
            "record_id" => $id
        ])->delete();
        $coments = AddsComments::where([
            "fk_i_ads_user_id" => $id
        ])->get();
        foreach ($coments as $c) {
            CommentsComplains_Model::where([
                "fk_i_ads_comments_id" => $c->pk_i_id
            ])->delete();
        }
        AddsComments::where([
            "fk_i_ads_user_id" => $id
        ])->delete();
        return back()->with("s_msg", "تمت العملية بنجاح");
    }

    public function getAreaModalBody(Request $request)
    {
        $post_data = $request->input();
        header('Content-Type: application/json');
        if (isset($post_data['id'])) {
            $json['status'] = 1;
            $json['msg'] = 'تم احضار المعلومات';
            $myData["primCategory"] = AddsModel::where([
                "i_parent_id" => 0,
                //"b_enable" => 1,
            ])->get();
            $myData["record"] = SpaceAreaModel::where([
                "pk_i_id" => $post_data['id']
            ])->first();
            $html = View::make('Adds::AreaModalBody', $myData)->render();
            $json['view1'] = $html;
        } else {
            $json['status'] = 0;
            $json['msg'] = 'خطأ في ارسال البيانات';
        }

        echo json_encode($json);

    }

    public function getUserAddsModalBody(Request $request)
    {
        $post_data = $request->input();
        header('Content-Type: application/json');
        if (isset($post_data['id'])) {
            $json['status'] = 1;
            $json['msg'] = 'تم احضار المعلومات';
            $myData["primCategory"] = AddsModel::where([
                "i_parent_id" => 0,
                //"b_enable" => 1,
            ])->get();
            $myData["record"] = UserAddsModel::where([
                "i_adds_type" => 0,
                "pk_i_id" => $post_data['id']
            ])->first();
            $html = View::make('Adds::UserAddsBody', $myData)->render();
            $json['view1'] = $html;
        } else {
            $json['status'] = 0;
            $json['msg'] = 'خطأ في ارسال البيانات';
        }

        echo json_encode($json);

    }
}

?>