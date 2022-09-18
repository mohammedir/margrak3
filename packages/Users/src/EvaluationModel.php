<?php

namespace Packages\Users;

use Illuminate\Database\Eloquent\Model;


class EvaluationModel extends Model
{


    protected $table = "t_evaluation";
    protected $primaryKey = "pk_i_id";
    protected $fillable = [
        "s_name_ar",
        "i_type",
        "b_enabled",
        "dt_created_date",
        "dt_modified_date",
        "dt_deleted_date",
    ];
    public $timestamps = false;
}