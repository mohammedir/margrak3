<?php

namespace App\helper;

use Packages\Adds\AddsModel;
use Packages\Adds\ConstantModel;
use Packages\Adds\FieldOptionsModel;
use Packages\Adds\SpaceAreaModel;
use Packages\Adds\UserAddsMeta;
use Packages\Adds\UserAddsModel;
use Packages\Announcement\AnnouncementModel;
use Packages\RecentAdd\AddsComments;
use Packages\RecentAdd\UserReactModel;
use Packages\System\Notification;
use Packages\System\SystemModel;
use Packages\Template\TemplateFieldsModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Packages\Users\EvaluationDataModel;

class Helper
{
    public static function getLastAnnouncement()
    {
        return AnnouncementModel::orderBy("dt_created_date", "desc")->first();
    }

    public static function get_NEW_REQUEST_ary()
    {
        return UserAddsModel::where([
            "i_type" => 2,
            "b_enable" => 1
        ])->orderBy("dt_created_date", "desc")->limit(15)->get();
    }

    public static function get_NEW_Offer_ary()
    {
        return UserAddsModel::where([
            "i_type" => 1,
            "b_enable" => 1

        ])->orderBy("dt_created_date")->limit(15)->get();
    }

    public static function getSystemRecord($key)
    {
        return SystemModel::where("s_key", $key)->first();
    }

    public static function getFromConstant($key, $parent)
    {
        return ConstantModel::where(["s_key" => $key,"fk_i_parent_id" => $parent,])->get();
    }


    public static function getFromConstant12($key, $parent)
    {
        return ConstantModel::where(["s_key" => $key,"fk_i_parent_id" => $parent,"b_enabled" => 1,])->get();
    }

    public static function getEvaluationData($id = "", $fk_i_evaluation_id = "")
    {
        if ($fk_i_evaluation_id == "") {
            return EvaluationDataModel::
            where("fk_i_for_user_id", $id)
                ->groupBy("fk_i_for_user_id", "fk_i_by_user_id")->get()->count();
        } else {
            return EvaluationDataModel::where([
                "fk_i_for_user_id" => $id,
                "fk_i_evaluation_id" => $fk_i_evaluation_id,
            ])->get();
        }
    }
    public static function getEvaluationDataForSubject($id = "", $fk_i_evaluation_id = "")
    {
        if ($fk_i_evaluation_id == "") {
            return EvaluationDataModel::
            where("fk_i_for_subject_id", $id)
                ->groupBy("fk_i_for_subject_id", "fk_i_by_user_id")->get()->count();
        } else {
            return EvaluationDataModel::where([
                "fk_i_for_subject_id" => $id,
                "fk_i_evaluation_id" => $fk_i_evaluation_id,
            ])->get();
        }
    }

    public static function getEvaluationData1($for_id, $by_id)
    {
        return EvaluationDataModel::where([
            "fk_i_for_user_id" => $for_id,
            "fk_i_by_user_id" => $by_id,
            "fk_i_evaluation_id" => 3,
        ])->first();
    }

    public static function getFieldOptions($fk_i_field_id)
    {
        return FieldOptionsModel::where([
            "b_is_filter" => 1,
            "i_parent_id" => 0,
            "fk_i_field_id" => $fk_i_field_id,
            "b_enable" => 1
        ])->get();
    }

    public static function getSpaceArea($limit)
    {
        return SpaceAreaModel::limit($limit)
            ->get();
    }

    public static function getParentForTppBtn($key)
    {
        return AddsModel::where([
            "i_parent_id" => 0,
            "$key" => 1,
            "b_enable" => 1,
        ])->get();
    }

    public static function checkReact($type, $adds_id, $user_id)
    {
        if ($type != 0) {
            return UserReactModel::where([
                    "i_type" => $type,
                    "fk_i_ads_user_id" => $adds_id,
                    "fk_i_user_id" => $user_id,
                ])->count() > 0;
        } else {
            return UserReactModel::where([
                    "fk_i_ads_user_id" => $adds_id,
                    "fk_i_user_id" => $user_id,
                ])->count() > 0;

        }
    }

    public static function getLastComment($id)
    {
        return AddsComments::where([
            "fk_i_ads_user_id" => $id,
        ])->orderBy('dt_created_date', 'desc')
            ->first();
    }

    public static function checkIfContainField($t_id, $f_id)
    {
        return TemplateFieldsModel::where([
                "fk_i_field_id" => $f_id,
                "fk_i_ads_template_id" => $t_id,
            ])->count() > 0;
    }

    public static function getNotificationsCount($reciver_id, $type)
    {
        return Notification::join('t_notification_user', 't_notification_user.fk_i_notification_id', '=', 't_notification.pk_i_id')
            ->whereNull("t_notification_user.dt_seen_date")
            ->where([
                "t_notification_user.fk_i_user_id" => $reciver_id,
                "t_notification_user.i_title_type" => $type,
            ])
            ->count();
    }

    public static function getNotifications($reciver_id, $type)
    {
        if ($type == 0) {
            return Notification::select("t_notification_user.*", "t_notification.*", "t_notification.pk_i_id as t_notification_id")
                ->join('t_notification_user', 't_notification_user.fk_i_notification_id', '=', 't_notification.pk_i_id')
                ->where([
                    "t_notification_user.fk_i_user_id" => $reciver_id,
                    "t_notification_user.i_title_type" => $type,
                ])->orderBy('t_notification.dt_created_date', 'desc')->limit(6)->get();

        } else {
            return Notification::join('t_notification_user', 't_notification_user.fk_i_notification_id', '=', 't_notification.pk_i_id')
                ->where([
                    "t_notification_user.fk_i_user_id" => $reciver_id,
                    "t_notification_user.i_title_type" => $type,
                ])->orderBy('t_notification.dt_created_date', 'desc')->get();

        }
    }

    public static function getNotifications1($reciver_id, $type)
    {
        return Notification::join('t_notification_user', 't_notification_user.fk_i_notification_id', '=', 't_notification.pk_i_id')
            ->where([
                "t_notification_user.fk_i_user_id" => $reciver_id,
                "t_notification_user.i_title_type" => $type,
            ])->orderBy('t_notification_user.dt_created_date', 'desc')
            ->groupBy("t_notification.fk_i_actor_user_id")->get();
    }

    public static function getNotifications12($reciver_id, $type)
    {
        return Notification::join('t_notification_user', 't_notification_user.fk_i_notification_id', '=', 't_notification.pk_i_id')
            ->where([
                "t_notification_user.fk_i_user_id" => $reciver_id,
                "t_notification_user.i_title_type" => $type,
            ])->where("t_notification_user.is_deleted", "<>", $reciver_id)->orderBy('t_notification_user.dt_created_date', 'desc')
            ->groupBy("t_notification.fk_i_actor_user_id")->get();
    }

    public static function getNotificationsCount1($reciver_id, $type)
    {
        return Notification::join('t_notification_user', 't_notification_user.fk_i_notification_id', '=', 't_notification.pk_i_id')
            ->whereNull("t_notification_user.dt_seen_date")
            ->where([
                "t_notification_user.fk_i_user_id" => $reciver_id,
                "t_notification_user.i_title_type" => $type,
            ])->groupBy("t_notification.fk_i_actor_user_id")->get()
            ->count();
    }
}
