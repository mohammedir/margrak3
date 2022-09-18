<?php

namespace Packages\Users;

use Illuminate\Database\Eloquent\Model;


class EvaluationDataModel extends Model
{


    protected $table = "t_evaluation_data";
    protected $primaryKey = "pk_i_id";
    protected $fillable = [
        "fk_i_evaluation_id",
        "fk_i_by_user_id",
        "fk_i_for_user_id",
        "fk_i_for_subject_id",
        "s_value",
        "b_enabled",
        "dt_created_date",
    ];
    public $timestamps = false;
    public function getEvaluationUser()
    {
        return $this->belongsTo(UserModel::class, "fk_i_by_user_id", "pk_i_id");
    }
}