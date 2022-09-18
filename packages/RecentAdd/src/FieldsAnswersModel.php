<?php

namespace Packages\RecentAdd;

use Illuminate\Database\Eloquent\Model;
use Packages\Adds\FieldOptionsModel;


class FieldsAnswersModel extends Model
{
    protected $table = "t_ads_user_field_answer";
    protected $primaryKey = "pk_i_id";
    protected $fillable = [
        "fk_i_ads_user_id",
        "fk_i_field_id",
        "s_answer",
    ];
    public $timestamps = false;

    public function fieldOption()
    {
        return $this->belongsTo(FieldOptionsModel::class, "s_answer", "pk_i_id");
    }

}
