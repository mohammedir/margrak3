<?php

namespace Packages\System;

use Illuminate\Database\Eloquent\Model;


class SystemModel extends Model
{

    protected $table = "t_system_settings";
    protected $primaryKey = "pk_i_id";
    protected $fillable = [
        "s_name_ar",
        "s_key",
        "i_data_type",
        "s_value",
    ];
    public $timestamps = false;

}
                            