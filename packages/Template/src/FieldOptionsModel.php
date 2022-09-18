<?php

namespace Packages\Template;

use Illuminate\Database\Eloquent\Model;


class FieldOptionsModel extends Model
{

    protected $table = "t_field_options";
    protected $primaryKey = "pk_i_id";
    protected $fillable = [
        "s_name_ar",
        "fk_i_field_id",
        "b_is_filter",
        "i_parent_id",
        "b_enable",
        "dt_created_date",
        "dt_modified_date",
        "dt_deleted_date",
    ];
    public $timestamps = false;
    public function getChilds()
    {
        return $this->hasMany(FieldOptionsModel::class, "i_parent_id", "pk_i_id");
    }

    public function getParent()
    {
        return $this->belongsTo(FieldOptionsModel::class, "i_parent_id", "pk_i_id");
    }
}

                            