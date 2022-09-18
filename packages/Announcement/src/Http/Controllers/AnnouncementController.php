<?php

//namespace Packages\Announcement\Http\AnnouncementControllers;
namespace Packages\Announcement\Http\Controllers;

//namespace Packages\Announcement\src\Http\AnnouncementControllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;
use Packages\Adds\AddsModel;
use Packages\Announcement\AnnouncementModel;

class AnnouncementController extends BaseController
{

    public function addAnnouncement(Request $request)
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
                                array_push($ary,
                                    [
                                        $c2->pk_i_id
                                    ]
                                );
                            }
                            if ($mainFlag || $request->input("cat_" . $c1->pk_i_id)) {
                                array_push($ary,
                                    [
                                        $c1->pk_i_id
                                    ]
                                );
                            }
                        }
                        if ($primFlag || $request->input("cat_" . $p->pk_i_id)) {
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
                    "i_fk_category_id" => json_encode($ary),
                    "b_enabled" => $request->input("status"),
                    "dt_created_date" => date('Y-m-d H:i:s'),
                    "dt_modified_date" => null,
                    "dt_deleted_date" => null
                ];
            } else {
                $record = [
                    "s_title" => $request->input("title"),
                    "s_desc" => $request->input("desc"),
                    "i_fk_category_id" => 0,
                    "b_enabled" => $request->input("status"),
                    "dt_created_date" => date('Y-m-d H:i:s'),
                    "dt_modified_date" => null,
                    "dt_deleted_date" => null
                ];
            }
            AnnouncementModel::create($record);
            return back()->with("s_msg", "تمت عملية الإضافة بنجاح");
        }
        $data["primCategory"] = AddsModel::where([
            "i_parent_id" => 0,
            //"b_enable" => 1,
        ])->get();
        $data["title"] = "إضافة شريط جديد";
        return view('Announcement::addAnnouncement', $data);
    }

    public function announcement()
    {

        $data["title"] = "الأشرطة";
        $data["adds_area"] = AnnouncementModel::all();

        return view('Announcement::announcement', $data);
    }

    public function getAnnouncementBody(Request $request)
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
            $myData["record"] = AnnouncementModel::where([
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

    public function deleteAnnouncement($id)
    {
        AnnouncementModel::where("pk_i_id", $id)->delete();
        return back()->with("s_msg", "تمت عملية الإضافة بنجاح");
    }

    public function editAnnouncement($id, Request $request)
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
                                array_push($ary,
                                    [
                                        $c2->pk_i_id
                                    ]
                                );
                            }
                            if ($mainFlag || $request->input("cat_" . $c1->pk_i_id)) {
                                array_push($ary,
                                    [
                                        $c1->pk_i_id
                                    ]
                                );
                            }
                        }
                        if ($primFlag || $request->input("cat_" . $p->pk_i_id)) {
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
                    "i_fk_category_id" => json_encode($ary),
                    "b_enabled" => $request->input("status"),
                    "dt_created_date" => date('Y-m-d H:i:s'),
                    "dt_modified_date" => null,
                    "dt_deleted_date" => null
                ];

            } else {
                $record = [
                    "s_title" => $request->input("title"),
                    "s_desc" => $request->input("desc"),
                    "i_fk_category_id" => 0,
                    "b_enabled" => $request->input("status"),
                    "dt_created_date" => date('Y-m-d H:i:s'),
                    "dt_modified_date" => null,
                    "dt_deleted_date" => null
                ];
            }

            AnnouncementModel::where([
                "pk_i_id" => $id
            ])->update($record);
            return back()->with("s_msg", "تمت عملية التعديل بنجاح");
        }
        $data["title"] = "تعديل بيانات الشريط";
        $data["record"] = AnnouncementModel::where([
            "pk_i_id" => $id
        ])->first();
        $data["primCategory"] = AddsModel::where([
            "i_parent_id" => 0,
            //"b_enable" => 1,
        ])->get();
        return view('Announcement::editAnnouncement', $data);
    }
}

?>