<?php

namespace Packages\Adds;

use Illuminate\Database\Eloquent\Model;


class SpaceAreaModel extends Model
{
    protected $table = "t_ads_space";
    protected $primaryKey = "pk_i_id";
    protected $fillable = [
        "s_title",
        "s_desc",
        "s_pic",
        "s_url",
        "i_fk_category_id",
        "i_clicks_count",
        "b_enabled",
        "dt_created_date",
        "dt_modified_date",
        "dt_deleted_date",
    ];
    public $timestamps = false;
}
