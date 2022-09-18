<?php

//namespace Packages\BlockController\Http\Controllers;
namespace Packages\Block\Http\Controllers;

//namespace Packages\BlockController\src\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Packages\Block\BlockModel;
use Packages\System\SystemModel;

class BlockController extends BaseController
{
    public function coins(Request $request)
    {
        if ($request->input()) {
            $record = [
                "s_value" => $request->input("CALCULATOR_COMMISSION_RATE"),
            ];
            SystemModel::where([
                "s_key" => "CALCULATOR_COMMISSION_RATE"
            ])->update($record);
            return back()->with("s_msg", "تمت العملية بنجاح");

        }
        $data["title"] = "صفحة العمولة";
        $data["coins"] = BlockModel::where([
            "i_type" => 1
        ])->get();
        $data["banks"] = BlockModel::where([
            "i_type" => 2
        ])->get();
        return view('Block::coins', $data);
    }

    public function coinspage()
    {
        $data["title"] = "صفحة العمولة";
        $data["coins"] = BlockModel::where([
            "i_type" => 1
        ])->get();
        $data["banks"] = BlockModel::where([
            "i_type" => 2
        ])->get();
        return view('Block::coinspage', $data);
    }

    public function rulespage()
    {
        $data["title"] = "صفحة القوانين";
        $data["rules"] = BlockModel::where([
            "i_type" => 3
        ])->get();
        return view('Block::rulespage', $data);
    }

    public function blacklistpage(Request $request)
    {
        if (!session("user_id")) {
            return redirect("/")->with("e_msg", "عليك تسجيل الدخول قبل الدخول على القائمة السوداء");
        }
        $data["title"] = "القائمة السوداء";
        $data["blacklists"] = array();
        $data["search"] = "";
        if ($request->input("search")) {
            $data["search"] = $request->input("search");
            $data["blacklists"] = DB::select("select * from t_blocks where i_type = 5 and (s_title like '%" . $request->input("search") . "%' or s_desc  like '%" . $request->input("search") . "%')");
        }
        return view('Block::blacklistpage', $data);
    }

    public function faqpage()
    {
        $data["title"] = "الأسئلة الشائعة";
        $data["blacklists"] = BlockModel::where([
            "i_type" => 4
        ])->get();
        return view('Block::faqpage', $data);
    }

    public function addCoins(Request $request)
    {
        if ($request->input()) {
            $record = [
                "s_title" => $request->input("title"),
                "s_desc" => $request->input("desc"),
                "i_type" => 1,
                "b_enabled" => $request->input("status"),
                "dt_created_date" => date('Y-m-d H:i:s'),
                "dt_modified_date" => null,
                "dt_deleted_date" => null
            ];

            BlockModel::create($record);
            return back()->with("s_msg", "تمت عملية الإضافة بنجاح");

        }
        $data["title"] = "إضافة عمولة";
        return view('Block::addCoins', $data);
    }

    public function editCoins($id, Request $request)
    {
        if ($request->input()) {
            $record = [
                "s_title" => $request->input("title"),
                "s_desc" => $request->input("desc"),
                "b_enabled" => $request->input("status"),
            ];

            BlockModel::where([
                "pk_i_id" => $id
            ])->update($record);
            return back()->with("s_msg", "تمت عملية التعديل بنجاح");

        }

        $data["title"] = "تعديل بيانات العمولة";
        $data["record"] = BlockModel::where([
            "pk_i_id" => $id
        ])->first();
        return view('Block::editCoins', $data);
    }

    public function deleteCoins($id)
    {
        BlockModel::where([
            "pk_i_id" => $id
        ])->delete();

        return back()->with("s_msg", "تمت عملية الحذف بنجاح");

    }

    public function addBanks(Request $request)
    {
        if ($request->input()) {
            $record = [
                "s_title" => $request->input("title"),
                "s_desc" => $request->input("desc"),
                "i_type" => 2,
                "b_enabled" => $request->input("status"),
                "dt_created_date" => date('Y-m-d H:i:s'),
                "dt_modified_date" => null,
                "dt_deleted_date" => null
            ];

            BlockModel::create($record);
            return back()->with("s_msg", "تمت عملية الإضافة بنجاح");

        }
        $data["title"] = "إضافة بنك";
        return view('Block::addBanks', $data);
    }

    public function editBanks($id, Request $request)
    {
        if ($request->input()) {
            $record = [
                "s_title" => $request->input("title"),
                "s_desc" => $request->input("desc"),
                "b_enabled" => $request->input("status"),
            ];

            BlockModel::where([
                "pk_i_id" => $id
            ])->update($record);
            return back()->with("s_msg", "تمت عملية التعديل بنجاح");

        }

        $data["title"] = "تعديل بيانات البنك";
        $data["record"] = BlockModel::where([
            "pk_i_id" => $id
        ])->first();
        return view('Block::editBanks', $data);
    }

    public function deleteBanks($id)
    {
        BlockModel::where([
            "pk_i_id" => $id
        ])->delete();

        return back()->with("s_msg", "تمت عملية الحذف بنجاح");

    }

    public function rules()
    {

        $data["title"] = "القوانين";
        $data["rules"] = BlockModel::where([
            "i_type" => 3
        ])->get();
        return view('Block::rules', $data);
    }

    public function addRules(Request $request)
    {
        if ($request->input()) {
            $record = [
                "s_title" => $request->input("title"),
                "s_desc" => $request->input("desc"),
                "i_type" => 3,
                "b_enabled" => $request->input("status"),
                "dt_created_date" => date('Y-m-d H:i:s'),
                "dt_modified_date" => null,
                "dt_deleted_date" => null
            ];

            BlockModel::create($record);
            return back()->with("s_msg", "تمت عملية الإضافة بنجاح");

        }
        $data["title"] = "إضافة قانون";
        return view('Block::addRules', $data);
    }

    public function editRules($id, Request $request)
    {
        if ($request->input()) {
            $record = [
                "s_title" => $request->input("title"),
                "s_desc" => $request->input("desc"),
                "b_enabled" => $request->input("status"),
            ];

            BlockModel::where([
                "pk_i_id" => $id
            ])->update($record);
            return back()->with("s_msg", "تمت عملية التعديل بنجاح");

        }

        $data["title"] = "تعديل بيانات القانون";
        $data["record"] = BlockModel::where([
            "pk_i_id" => $id
        ])->first();
        return view('Block::editRules', $data);
    }

    public function deleteRules($id)
    {
        BlockModel::where([
            "pk_i_id" => $id
        ])->delete();

        return back()->with("s_msg", "تمت عملية الحذف بنجاح");

    }

    public function FAQ()
    {

        $data["title"] = "الاسئلة الشائعة";
        $data["FAQ"] = BlockModel::where([
            "i_type" => 4
        ])->get();
        return view('Block::FAQ', $data);
    }

    public function addFAQ(Request $request)
    {
        if ($request->input()) {
            $record = [
                "s_title" => $request->input("title"),
                "s_desc" => $request->input("desc"),
                "i_type" => 4,
                "b_enabled" => $request->input("status"),
                "dt_created_date" => date('Y-m-d H:i:s'),
                "dt_modified_date" => null,
                "dt_deleted_date" => null
            ];

            BlockModel::create($record);
            return back()->with("s_msg", "تمت عملية الإضافة بنجاح");

        }
        $data["title"] = "إضافة سؤال شائع";
        return view('Block::addFAQ', $data);
    }

    public function editFAQ($id, Request $request)
    {
        if ($request->input()) {
            $record = [
                "s_title" => $request->input("title"),
                "s_desc" => $request->input("desc"),
                "b_enabled" => $request->input("status"),
            ];

            BlockModel::where([
                "pk_i_id" => $id
            ])->update($record);
            return back()->with("s_msg", "تمت عملية التعديل بنجاح");

        }

        $data["title"] = "تعديل بيانات السؤال";
        $data["record"] = BlockModel::where([
            "pk_i_id" => $id
        ])->first();
        return view('Block::editFAQ', $data);
    }

    public function deleteFAQ($id)
    {
        BlockModel::where([
            "pk_i_id" => $id
        ])->delete();

        return back()->with("s_msg", "تمت عملية الحذف بنجاح");

    }

    public function blacklists()
    {

        $data["title"] = "القائمة السوداء";
        $data["blacklists"] = BlockModel::where([
            "i_type" => 5
        ])->get();
        return view('Block::blacklist', $data);
    }

    public function addBlacklist(Request $request)
    {
        if ($request->input()) {
            $record = [
                "s_title" => $request->input("title"),
                "s_desc" => $request->input("desc"),
                "i_type" => 5,
                "b_enabled" => $request->input("status"),
                "dt_created_date" => date('Y-m-d H:i:s'),
                "dt_modified_date" => null,
                "dt_deleted_date" => null
            ];
            BlockModel::create($record);
            return back()->with("s_msg", "تمت عملية الإضافة بنجاح");
        }
        $data["title"] = "إضافة قائمة سوداء";
        return view('Block::addBlacklist', $data);
    }

    public function editBlacklist($id, Request $request)
    {
        if ($request->input()) {
            $record = [
                "s_title" => $request->input("title"),
                "s_desc" => $request->input("desc"),
                "b_enabled" => $request->input("status"),
            ];

            BlockModel::where([
                "pk_i_id" => $id
            ])->update($record);
            return back()->with("s_msg", "تمت عملية التعديل بنجاح");

        }

        $data["title"] = "تعديل القائمة السوداء";
        $data["record"] = BlockModel::where([
            "pk_i_id" => $id
        ])->first();
        return view('Block::editBlacklist', $data);
    }

    public function deleteBlacklist($id)
    {
        BlockModel::where([
            "pk_i_id" => $id
        ])->delete();

        return back()->with("s_msg", "تمت عملية الحذف بنجاح");

    }
}

?>