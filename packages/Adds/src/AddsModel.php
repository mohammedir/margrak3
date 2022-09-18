<?php

namespace Packages\Adds;

use Illuminate\Database\Eloquent\Model;


class AddsModel extends Model
{

    protected $table = "t_categories";
    protected $primaryKey = "pk_i_id";
    protected $fillable = [
        "s_name_ar",
        "s_name_en",
        "s_color",
        "s_pic",
        "i_parent_id",
        "b_is_filter",
        "b_is_tag",
        "b_show_in_souq_menu",
        "b_show_in_newest_menu",
        "b_in_sidebar",
        "s_sidebar_pic",
        "i_view_count",
        "fk_i_template_id",
        "b_has_ads_space",
        "b_enable",
        "dt_created_date",
        "dt_modified_date",
        "dt_deleted_date",
    ];
    public $timestamps = false;

    public function getChilds()
    {
        return $this->hasMany(AddsModel::class, "i_parent_id", "pk_i_id");
    }

    public function getChildsForSide()
    {
        return $this->hasMany(AddsModel::class, "i_parent_id", "pk_i_id")->where([
            "b_in_sidebar" => 1
        ]);
    }

    public function getChilds1()
    {
        return $this->hasMany(AddsModel::class, "i_parent_id", "pk_i_id")->where([
            "fk_i_template_id" => $this->fk_i_template_id
        ]);
    }

    public function getParent()
    {
        return $this->belongsTo(AddsModel::class, "i_parent_id", "pk_i_id");
    }
}

                            