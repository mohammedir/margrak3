<?php

namespace Packages\Adds;

use Illuminate\Database\Eloquent\Model;
use Packages\RecentAdd\AddsComments;
use Packages\RecentAdd\FieldsAnswersModel;
use Packages\Users\UserModel;
use Packages\Adds\ConstantModel;


class UserAddsModel extends Model
{

    protected $table = "t_ads_user";
    protected $primaryKey = "pk_i_id";
    protected $fillable = [
        "ads_value",
        "fk_i_currency",
        "fk_i_paid_during",
        "s_mobile",
        "s_fullname",
        "s_title_ar",
        "s_details",
        "i_type",
        "s_price",
        "s_subject_color",
        "i_adds_type",
        "s_is_featured_ary",
        "i_contact_method",
        "i_is_featured",
        "i_view_count",
        "fk_i_deleted_by_user_id",
        "fk_i_by_user_id",
        "s_delete_notes",
        "i_fk_category_id",
        "i_clicks_count",
        "b_enable",
        "dt_created_date",
        "dt_modified_date",
        "dt_deleted_date",
    ];
    public $timestamps = false;

    public function getCategoryName()
    {
        return $this->belongsTo(AddsModel::class, "i_fk_category_id", "pk_i_id");
    }

    public function getDepartment()
    {
        return $this->belongsTo(ConstantModel::class, "i_fk_category_id", "pk_i_id");
    }

    public function getTheNameOfCreator()
    {
        return $this->belongsTo(UserModel::class, "fk_i_by_user_id", "pk_i_id");
    }

    public function getDurationText()
    {
        return $this->belongsTo(ConstantModel::class, "fk_i_paid_during", "pk_i_id");
    }

    public function getTheNameOfDeletor()
    {
        return $this->belongsTo(UserModel::class, "fk_i_deleted_by_user_id", "pk_i_id");
    }

    public function getPicsData()
    {
        return $this->hasMany(UserAddsMeta::class, "fk_i_ads_user_id", "pk_i_id")->where([
            "s_key" => "ADS_PIC"
        ])->orderBy("i_order");
    }

    public function getComments()
    {
        return $this->hasMany(AddsComments::class, "fk_i_ads_user_id", "pk_i_id");
    }
    public function city_field()
    {
        return $this->belongsTo(FieldsAnswersModel::class, "pk_i_id", "fk_i_ads_user_id")->where([
            "fk_i_field_id" => 2
        ]);
    }
}
