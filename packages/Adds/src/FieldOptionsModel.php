<?php

namespace Packages\Adds;

use Illuminate\Database\Eloquent\Model;


class FieldOptionsModel extends Model
{

    protected $table = "t_field_options";
    protected $primaryKey = "pk_i_id";
    protected $fillable = [
        "s_name_ar",
        "s_color",
        "fk_i_field_id",
        "b_is_filter",
        "b_enable",
        "dt_created_date",
        "i_parent_id",
        "dt_modified_date",
        "dt_deleted_date",
    ];
    public $timestamps = false;

    public function getChilds()
    {
        return $this->hasMany(FieldOptionsModel::class, "i_parent_id", "pk_i_id")->where(["b_enable" => 1]);
    }

    public function getChildsb_is_filter()
    {
        return $this->hasMany(FieldOptionsModel::class, "i_parent_id", "pk_i_id")->where(["b_enable" => 1, "b_is_filter" => 1]);
    }

    public function getParent()
    {
        return $this->belongsTo(FieldOptionsModel::class, "i_parent_id", "pk_i_id");
    }
}

                            