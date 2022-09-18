<?php

namespace Packages\Category;

use Illuminate\Database\Eloquent\Model;


class CategoryModel extends Model
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
        "s_tape_color",
        "b_show_in_souq_menu",
        "b_show_in_newest_menu",
        "fk_i_template_id",
        "b_in_sidebar",
        "s_sidebar_pic",
        "i_view_count",
        "b_has_ads_space",
        "b_enable",
        "dt_created_date",
        "dt_modified_date",
        "dt_deleted_date",
    ];
    public $timestamps = false;

    public function getChilds()
    {
        return $this->hasMany(CategoryModel::class, "i_parent_id", "pk_i_id");
    }

    public function getParent()
    {
        return $this->belongsTo(CategoryModel::class, "i_parent_id", "pk_i_id");
    }
}
                            