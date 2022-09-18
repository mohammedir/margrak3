<?php

namespace Packages\Template;

use Illuminate\Database\Eloquent\Model;


class TemplateModel extends Model
{

    protected $table = "t_ads_template";
    protected $primaryKey = "pk_i_id";
    protected $fillable = [
        "s_name_ar",
        "s_name_en",
        "b_enable",
        "dt_created_date",
        "dt_modified_date",
        "dt_deleted_date",
    ];
    public $timestamps = false;

}
                            