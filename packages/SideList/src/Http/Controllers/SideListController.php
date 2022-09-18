<?php

//namespace Packages\SideListController\Http\Controllers;
namespace Packages\SideList\Http\Controllers;

//namespace Packages\SideListController\src\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Packages\Adds\AddsModel;

class SideListController extends BaseController
{

    public function sidelist(Request $request)
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
                                "b_in_sidebar" => 1,
                            ];
                        } else {
                            $record = [
                                "b_in_sidebar" => 0,
                            ];
                        }
                        AddsModel::where([
                            "pk_i_id" => $c2->pk_i_id,
                        ])->update($record);
                    }
                    $record = [
                        "b_in_sidebar" => 1,
                    ];
                    if ($mainFlag || $request->input("cat_" . $c1->pk_i_id)) {
                        AddsModel::where([
                            "pk_i_id" => $c1->pk_i_id,
                        ])->update($record);
                    }
                }
                $record = [
                    "b_in_sidebar" => 1,
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
        $data["title"] = "القائمة الجانبية";
        return view('SideList::sidelist', $data);
    }

    public function topbtn()
    {
        $data["primCategory"] = AddsModel::where([
            "i_parent_id" => 0,
            //"b_enable" => 1,
        ])->get();
        $data["title"] = "ازرار القائمة العلوية";
        return view('SideList::top_index', $data);
    }

    public function saveImageSidelist(Request $request)
    {
        $getimageName = "";
        if (Input::hasFile('cat_img')) {
            $getimageName = time() . '.' . $request->cat_img->getClientOriginalExtension();
            $request->cat_img->move(public_path('uploads'), $getimageName);
        }
        if ($getimageName != "") {
            $record = [
                "s_sidebar_pic" => $getimageName
            ];
            AddsModel::where([
                "pk_i_id" => $request->input("s_l_id")
            ])->update($record);
            return back()->with("s_msg", "تمت عملية الحفظ بنجاح");
        }else{
            return back()->with("s_msg", "لم تتم أية تعديلات لعدم إختيار صورة");
        }

    }

    public function saveNewTab(Request $request)
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
                        if ($request->input("cat_new_" . $c2->pk_i_id)) {
                            $primFlag = true;
                            $mainFlag = true;
                            $record = [
                                "b_show_in_newest_menu" => 1,
                            ];
                        } else {
                            $record = [
                                "b_show_in_newest_menu" => 0,
                            ];
                        }
                        AddsModel::where([
                            "pk_i_id" => $c2->pk_i_id,
                        ])->update($record);
                    }
                    $record = [
                        "b_show_in_newest_menu" => 1,
                    ];
                    if ($mainFlag || $request->input("cat_new_" . $c1->pk_i_id)) {
                        AddsModel::where([
                            "pk_i_id" => $c1->pk_i_id,
                        ])->update($record);
                    }
                }
                $record = [
                    "b_show_in_newest_menu" => 1,
                ];
                if ($primFlag || $request->input("cat_new_" . $p->pk_i_id)) {
                    AddsModel::where([
                        "pk_i_id" => $p->pk_i_id,
                    ])->update($record);
                }
            }
            return back()->with("s_msg", "تمت عملية الحفظ بنجاح");
        }
    }

    public function saveSouqTab(Request $request)
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
                        if ($request->input("cat_souq_" . $c2->pk_i_id)) {
                            $primFlag = true;
                            $mainFlag = true;
                            $record = [
                                "b_show_in_souq_menu" => 1,
                            ];
                        } else {
                            $record = [
                                "b_show_in_souq_menu" => 0,
                            ];
                        }
                        AddsModel::where([
                            "pk_i_id" => $c2->pk_i_id,
                        ])->update($record);
                    }
                    $record = [
                        "b_show_in_souq_menu" => 1,
                    ];
                    if ($mainFlag || $request->input("cat_souq_" . $c1->pk_i_id)) {
                        AddsModel::where([
                            "pk_i_id" => $c1->pk_i_id,
                        ])->update($record);
                    }
                }
                $record = [
                    "b_show_in_souq_menu" => 1,
                ];
                if ($primFlag || $request->input("cat_souq_" . $p->pk_i_id)) {
                    AddsModel::where([
                        "pk_i_id" => $p->pk_i_id,
                    ])->update($record);
                }
            }
            return back()->with("s_msg", "تمت عملية الحفظ بنجاح");
        }
    }
}


?>