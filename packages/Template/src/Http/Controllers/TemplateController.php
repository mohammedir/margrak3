<?php

namespace Packages\Template\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;
use Packages\Adds\AddsModel;
use Packages\Template\TemplateFieldsModel;
use Packages\Template\FieldOptionsModel;
use Packages\Template\FieldsModel;
use Packages\Template\TemplateModel;

class TemplateController extends BaseController
{


    public function templates()
    {
        $data["templates"] = TemplateModel::all();
        $data["title"] = "قوالب اضافة اعلان";
        return view('Template::templates', $data);
    }

    public function getTemplateModalBody(Request $request)
    {
        $post_data = $request->input();
        header('Content-Type: application/json');
        if (isset($post_data['id'])) {
            $json['status'] = 1;
            $json['msg'] = 'تم احضار المعلومات';
            $myData["primCategory"] = AddsModel::where([
                "fk_i_template_id" => $post_data['id'],
                "i_parent_id" => 0
            ])->get();
            $html = View::make('Template::TemplateModalBody', $myData)->render();
            $json['view1'] = $html;
        } else {
            $json['status'] = 0;
            $json['msg'] = 'خطأ في ارسال البيانات';
        }

        echo json_encode($json);

    }

    public function checkIfCategoryIsTempalted(Request $request)
    {
        $post_data = $request->input();
        header('Content-Type: application/json');
        if (isset($post_data['id'])) {
            $json['status'] = 1;
            $json['msg'] = 'تم احضار المعلومات';
            $cat = AddsModel::where([
                "pk_i_id" => $request->input("id"),
            ])->first();
            if ($cat->fk_i_template_id != null) {
                $json['check'] = true;
                $json['template'] = TemplateModel::where([
                    "pk_i_id" => $cat->fk_i_template_id
                ])->first();
            } else {
                $json['check'] = false;
            }
        } else {
            $json['status'] = 0;
            $json['msg'] = 'خطأ في ارسال البيانات';
        }

        echo json_encode($json);
    }

    public function addTemplate(Request $request)
    {
        if ($request->input()) {
            $record = [
                "s_name_ar" => $request->input("template_name"),
                "b_enabled" => $request->input("template_status"),
                "dt_created_date" => date('Y-m-d H:i:s'),
                "dt_modified_date" => null,
                "dt_deleted_date" => null,
            ];
            $obj = TemplateModel::create($record);
            $primCategory = AddsModel::where([
                "pk_i_id" => $request->input("fk_i_category_id"),
            ])->first();
            AddsModel::where([
                "pk_i_id" => $request->input("fk_i_category_id"),
            ])->update([
                "fk_i_template_id" => $obj->pk_i_id,
            ]);
            foreach ($primCategory->getChilds as $c1) {
                AddsModel::where([
                    "pk_i_id" => $c1->pk_i_id,
                ])->update([
                    "fk_i_template_id" => $obj->pk_i_id,
                ]);
                foreach ($c1->getChilds as $c2) {
                    AddsModel::where([
                        "pk_i_id" => $c2->pk_i_id,
                    ])->update([
                        "fk_i_template_id" => $obj->pk_i_id,
                    ]);
                }
            }
            $fields = FieldsModel::where([
                "b_is_field" => 1
            ])->get();
            foreach ($fields as $f) {
                if ($request->input("f_" . $f->pk_i_id)) {
                    TemplateFieldsModel::create([
                        "fk_i_field_id" => $f->pk_i_id,
                        "fk_i_ads_template_id" => $obj->pk_i_id,
                    ]);
                }
            }
            return redirect(url("/") . "/editTemplate/" . $obj->pk_i_id)->with("s_msg", "تمت عملية الإضافة بنجاح");
        }
        $data["primCategory"] = AddsModel::where([
            "i_parent_id" => 0,
            //"b_enable" => 1,
        ])->get();
        $data["title"] = "اضافة قالب";
        $data["fields"] = FieldsModel::where([
            "b_is_field" => 1
        ])->get();

        return view('Template::addTemplate', $data);
    }

    public function editTemplate($id, Request $request)
    {
        if ($request->input()) {
            AddsModel::where([
                "fk_i_template_id" => $id,
            ])->update([
                "fk_i_template_id" => null,
            ]);
            $primCategory = AddsModel::where([
                "pk_i_id" => $request->input("fk_i_category_id"),
            ])->first();
            AddsModel::where([
                "pk_i_id" => $request->input("fk_i_category_id"),
            ])->update([
                "fk_i_template_id" => $id,
            ]);
            foreach ($primCategory->getChilds as $c1) {
                AddsModel::where([
                    "pk_i_id" => $c1->pk_i_id,
                ])->update([
                    "fk_i_template_id" => $id,
                ]);
                foreach ($c1->getChilds as $c2) {
                    AddsModel::where([
                        "pk_i_id" => $c2->pk_i_id,
                    ])->update([
                        "fk_i_template_id" => $id,
                    ]);
                }
            }
            $record = [
                "s_name_ar" => $request->input("template_name"),
                "b_enable" => $request->input("template_status"),
                "dt_modified_date" => date('Y-m-d H:i:s'),
            ];
            TemplateModel::where([
                "pk_i_id" => $id
            ])->update($record);
            TemplateFieldsModel::where([
                "fk_i_ads_template_id" => $id,
            ])->delete();
            $fields = FieldsModel::where([
                "b_is_field" => 1
            ])->get();
            foreach ($fields as $f) {
                if ($request->input("f_" . $f->pk_i_id)) {
                    TemplateFieldsModel::create([
                        "fk_i_field_id" => $f->pk_i_id,
                        "fk_i_ads_template_id" => $id,
                    ]);
                }
            }
            return back()->with("s_msg", "تمت عملية التعديل بنجاح");
        }
        $data["title"] = "تعديل بيانات القالب";
        $data["record"] = TemplateModel::where([
            "pk_i_id" => $id
        ])->first();
        $data["template_fields"] = TemplateFieldsModel::where([
            "fk_i_ads_template_id" => $id
        ])->get();
        $data["fields"] = FieldsModel::where([
            "b_is_field" => 1
        ])->get();
        $data["primCategory"] = AddsModel::where([
            "i_parent_id" => 0,
            //"b_enable" => 1,
        ])->get();
        return view('Template::editTemplate', $data);
    }

    public function addFieldForTemplate(Request $request)
    {
        if ($request->input()) {
            $post_data = $request->input();
            $type_id = 0;
            switch ($request->input("field_type")) {
                case "text":
                    $type_id = 1;
                    break;
                case "list":
                    $type_id = 2;
                    break;
                case "map":
                    $type_id = 3;
                    break;
            }
            $record = [
                "s_name_ar" => $request->input("field_name"),
                "i_type" => $type_id,
                "b_enable" => 1,
                "b_is_field" => 1,
                "dt_created_date" => date('Y-m-d H:i:s'),
                "dt_modified_date" => null,
                "dt_deleted_date" => null,
            ];
            $obj = FieldsModel::create($record);
            if ($type_id == 2) {
                $list_items = $post_data['list_items'];
                if (is_array($list_items) || is_object($list_items)) {
                    foreach ($list_items as $ary) {
                        if ($ary['is_delete'] == 0) {
                            $option = [
                                "s_name_ar" => $ary["option"],
                                "fk_i_field_id" => $obj->pk_i_id,
                                "b_enable" => 1,
                                "dt_created_date" => date('Y-m-d H:i:s'),
                                "dt_modified_date" => null,
                                "dt_deleted_date" => null,
                            ];
                            FieldOptionsModel::create($option);
                        }
                    }
                }
            }
            $json['status'] = 1;
            $json['msg'] = 'تم احضار المعلومات';
            echo json_encode($json);
        }
    }

    public function editFieldForTemplate($id, Request $request)
    {
        if ($request->input()) {
            $post_data = $request->input();
            $type_id = 0;
            switch ($request->input("field_type_edit")) {
                case "text":
                    $type_id = 1;
                    break;
                case "list":
                    $type_id = 2;
                    break;
                case "map":
                    $type_id = 3;
                    break;
            }
            $record = [
                "s_name_ar" => $request->input("field_name_edit"),
                "i_type" => $type_id,
                "b_enable" => 1,
                "b_is_field" => 1,
                "dt_created_date" => date('Y-m-d H:i:s'),
                "dt_modified_date" => null,
                "dt_deleted_date" => null,
            ];
            FieldsModel::where([
                "pk_i_id" => $id
            ])->update($record);
            if ($type_id == 2) {
                FieldOptionsModel::where([
                    "fk_i_field_id" => $id
                ])->delete();
                $list_items = $post_data['list_items'];
                if (is_array($list_items) || is_object($list_items)) {
                    foreach ($list_items as $ary) {
                        if ($ary['is_delete'] == 0) {
                            $option = [
                                "s_name_ar" => $ary["option"],
                                "fk_i_field_id" => $id,
                                "b_enable" => 1,
                                "dt_created_date" => date('Y-m-d H:i:s'),
                                "dt_modified_date" => null,
                                "dt_deleted_date" => null,
                            ];
                            FieldOptionsModel::create($option);
                        }
                    }
                }
            }
            $json['status'] = 1;
            $json['msg'] = 'تم احضار المعلومات';
            echo json_encode($json);
        }
    }

    public function getFieldsOptions(Request $request)
    {
        if ($request->input()) {
            $json['options'] = FieldOptionsModel::where([
                "fk_i_field_id" => $request->input("id")
            ])->get();
            $json['status'] = 1;
            $json['msg'] = 'تم احضار المعلومات';
            session()->flash('msg', 'created_succes');
            echo json_encode($json);
        }
    }
}

?>