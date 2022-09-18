<?php

namespace Packages\Adds;

use Illuminate\Database\Eloquent\Model;


class ConstantModel extends Model
{

    protected $table = "t_constant";
    protected $primaryKey = "pk_i_id";
    protected $fillable = [
        "fk_i_parent_id",
        "s_key",
        "s_name_ar",
        "s_extra_1",
        "b_enabled",
        "dt_created_date",
        "dt_modified_date",
        "dt_deleted_date",
    ];
    public $timestamps = false;

    public function getChilds()
    {
        return $this->hasMany(ConstantModel::class, "fk_i_parent_id", "pk_i_id");
    }

    public function getParent()
    {
        return $this->belongsTo(ConstantModel::class, "fk_i_parent_id", "pk_i_id");
    }

    public function getSubjects()
    {
        return $this->hasMany(UserAddsModel::class, "i_fk_category_id", "pk_i_id")->where([
            "i_adds_type" => "1"
        ]);
    }
}

                            