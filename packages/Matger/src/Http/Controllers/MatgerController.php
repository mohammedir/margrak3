<?php

//namespace Packages\Matger\Http\MatgerControllers;
namespace Packages\Matger\Http\Controllers;

//namespace Packages\Matger\src\Http\MatgerControllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Packages\Adds\ConstantModel;
use Packages\Adds\UserAddsModel;
use Packages\System\Notification;

class MatgerController extends BaseController
{

    public function mtger($id, Request $request)
    {
        $data["department_id"] = null;
        $data["department"] = null;
        $data["subject"] = null;
        $data["subjects"] = array();
        $data["record"] = ConstantModel::where([
            "pk_i_id" => $id,
        ])->first();

        if ($request->input()) {
            $data["department"] = ConstantModel::where([
                "s_key" => "MATAGER_DEPARTMENTS",
                "pk_i_id" => $request->input("department"),
            ])->first();
            $data["department_id"] = $request->input("department");
        } else {
            $my_id = 0;
            if (count($data["record"]->getChilds) > 0) {
                foreach ($data["record"]->getChilds as $c) {
                    $my_id = $c->pk_i_id;
                    break;
                }
            }
            if ($my_id == 0) {
                $data["subjects"] = array();
            } else {
                $data["subjects"] = UserAddsModel::where([
                    "i_adds_type" => 1,
                    "i_fk_category_id" => $my_id
                ])->get();
                $data["department_id"] = $my_id;
            }

        }
        if ($request->input("subject") != "") {
            $data["subject"] = UserAddsModel::where([
                "pk_i_id" => $request->input("subject"),
                "i_adds_type" => 1,
            ])->first();
        }

        $data["title"] = $data["record"]->s_name_ar;
        //
        $data["user_flag"] = false;
        if (Auth::user()) {
            if (Auth::user()->fk_i_role_id == $id || Auth::user()->fk_i_role_id == 96) {
                $data["user_flag"] = true;

            }
        }
        return view('Matger::index', $data);
    }

    public function addDepartment($id, Request $request)
    {
        if ($request->input()) {
            $record = [
                "fk_i_parent_id" => $id,
                "s_key" => "MATAGER_DEPARTMENTS",
                "s_name_ar" => $request->input("s_name_ar_add"),
                "b_enable" => 1,
                "dt_created_date" => date('Y-m-d H:i:s'),
            ];
            ConstantModel::create($record);
            return back()->with("s_msg", "تمت عملية الحفظ بنجاح");
        }
    }

    public function addSubject($id, $department, Request $request)
    {
        if ($request->input()) {
            $string_array = explode(" ", $request->input("s_title_ar"));
            $record = [
                "s_title_ar" => $request->input("subject_title"),
                "s_details" => $request->input("subject_category"),
                "s_price" => $request->input("subject_price"),
                "s_subject_color" => $request->input("subject_color"),
                "i_adds_type" => 1,
                "i_fk_category_id" => $department,
                "fk_i_by_user_id" => Auth::user()->pk_i_id,
                "b_enable" => 1,
                "dt_created_date" => date('Y-m-d H:i:s'),
            ];
            $adds_obj = UserAddsModel::create($record);

            $json = array(["status" => "1", "id" => $adds_obj->pk_i_id]);
            return response()->json($json);
        }
    }

    public function deleteSubject($id)
    {
        UserAddsModel::where([
            "pk_i_id" => $id,
        ])->delete();
        Notification::where([
            "record_id" => $id
        ])->delete();

        return back()->with("s_msg", "تمت العملية بنجاح");
    }

    public function deleteDepartment($id)
    {
        ConstantModel::where([
            "pk_i_id" => $id
        ])->delete();
        $adds = UserAddsModel::where([
            "i_fk_category_id" => $id,
        ])->get();
        foreach ($adds as $a) {
            UserAddsModel::where([
                "pk_i_id" => $a->pk_i_id,
            ])->delete();
            Notification::where([
                "record_id" => $a->pk_i_id
            ])->delete();
        }

        return back()->with("s_msg", "تمت العملية بنجاح");
    }
}

?>