<?php

//namespace Packages\Category\Http\Controllers;
namespace Packages\Category\Http\Controllers;
//namespace Packages\Category\src\Http\Controllers;
//use Gumlet\ImageResize;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Packages\Category\CategoryModel;
use Packages\Adds\UserAddsModel;
use Packages\Category\KeyWordModel;
use Packages\System\Notification;

class CategoryController extends BaseController
{
    public function index()
    {
        $data["primCategory"] = CategoryModel::where([
            "i_parent_id" => 0,
            //"b_enable" => 1,
        ])->get();
        $data["title"] = "الأقسام";
        return view('Category::index', $data);
    }

    public function add(Request $request)
    {
        if ($request->input()) {
//            $this->validate($request, [
//                // check validtion for image or file
//                'uplode_image_file' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
//            ]);
            // rename image name or file name
            $getimageName = "";
            if (Input::hasFile('cat_img')) {
                $getimageName = time() . '.' . $request->cat_img->getClientOriginalExtension();
                $request->cat_img->move(public_path('uploads'), $getimageName);
            }
            $record = [
                "s_name_ar" => $request->input("category_name"),
                "s_color" => $request->input("cat_color"),
                "s_tape_color" => $request->input("cat_color1"),
                "b_has_ads_space" => $request->input("b_has_ads_space") ? 1 : 0,
                "s_pic" => $getimageName,
                "b_enable" => $request->input("cat_status"),
                "dt_created_date" => date('Y-m-d H:i:s'),
                "dt_modified_date" => null,
                "dt_deleted_date" => null
            ];
            switch ($request->input("category_type")) {
                case 0:
                    $record["i_parent_id"] = 0;
                    CategoryModel::create($record);
                    break;
                case 1:
                    $record["i_parent_id"] = $request->input("prim_cat");
                    CategoryModel::create($record);
                    break;
                case 2:
                    $record["i_parent_id"] = $request->input("main_cat");
                    $cat_obj = CategoryModel::create($record);
                    if ($request->input("key_word") != "") {
                        $key_words = explode(",", $request->input("key_word"));
                        foreach ($key_words as $k) {
                            if ($k != "") {
                                KeyWordModel::create([
                                    "fk_i_ads_user_id" => $cat_obj->pk_i_id,
                                    "key_word" => $k
                                ]);
                            }
                        }
                    }
                    break;
            }
            if ($request->input("category_type") != 0 && Input::hasFile('cat_img')) {
//                $image = new ImageResize(str_replace("/", "\\", public_path('uploads') . $getimageName));
//                if ($request->input("category_type") == 1) {
//                    $image->resizeToWidth(90);
//                } else {
//                    $image->resizeToWidth(40);
//                }
//                $image->save(str_replace("/", "\\", public_path('uploads') . $getimageName));

            }
            return back()->with("s_msg", "تمت عملية الإضافة بنجاح");
        }
        $data["title"] = "إضافة قسم جديد";
        $data["prim_categories"] = CategoryModel::where(["i_parent_id" => 0,
            //"b_enable" => 1,
        ])->get();
        return view('Category::add', $data);
    }

    public
    function edit($id, Request $request)
    {
        if ($request->input()) {
//            $this->validate($request, [
//                // check validtion for image or file
//                'uplode_image_file' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
//            ]);
            // rename image name or file name
            if (Input::hasFile('cat_img')) {
                $getimageName = time() . '.' . $request->cat_img->getClientOriginalExtension();
                $request->cat_img->move(public_path('uploads'), $getimageName);
                $record = [
                    "s_name_ar" => $request->input("category_name"),
                    "s_color" => $request->input("cat_color"),
                    "s_tape_color" => $request->input("cat_color1"),
                    "b_has_ads_space" => $request->input("b_has_ads_space") ? 1 : 0,
                    "s_pic" => $getimageName,
                    "b_enable" => $request->input("cat_status"),
                    "dt_modified_date" => date('Y-m-d H:i:s'),
                ];

            } else {

                $record = [
                    "s_name_ar" => $request->input("category_name"),
                    "b_has_ads_space" => $request->input("b_has_ads_space") ? 1 : 0,
                    "s_tape_color" => $request->input("cat_color1"),
                    "s_color" => $request->input("cat_color"),
                    "b_enable" => $request->input("cat_status"),
                    "dt_modified_date" => date('Y-m-d H:i:s'),
                ];

            }
            CategoryModel::where([
                "pk_i_id" => $id
            ])->update($record);
            if ($request->input("key_word") != "") {
                KeyWordModel::where([
                    "fk_i_ads_user_id" => $id,
                ])->delete();
                $key_words = explode(",", $request->input("key_word"));
                foreach ($key_words as $k) {
                    if ($k != "") {
                        KeyWordModel::create([
                            "fk_i_ads_user_id" => $id,
                            "key_word" => $k
                        ]);
                    }
                }
            }
            return back()->with("s_msg", "تمت عملية التعديل بنجاح");
        }
        $data["title"] = "تعديل بيانات القسم";
        $data["record_data"] = CategoryModel::where([
            "pk_i_id" => $id
        ])->first();
        $data["key_words"] = KeyWordModel::where([
            "fk_i_ads_user_id" => $id
        ])->get();
        return view('Category::edit', $data);
    }

    public
    function delete($id)
    {

        UserAddsModel::where([
            "i_fk_category_id" => $id,
        ])->delete();
        Notification::where([
            "record_id" => $id,
        ])->delete();
        CategoryModel::where([
            "pk_i_id" => $id,
        ])->delete();
        return redirect("/categories")->with("s_msg", "تمت عملية الحذف بنجاح");
    }

    public
    function getMainCategory(Request $request)
    {
        if ($request->input()) {
            $post_data = $request->input();
            $json["main_cats"] = CategoryModel::where([
                "i_parent_id" => $post_data["id"],
                // "b_enable" => 1,
            ])->get();
            $json['status'] = 1;
            $json['msg'] = 'تم احضار المعلومات';
            echo json_encode($json);
        }
    }

}

?>

