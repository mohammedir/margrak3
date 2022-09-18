<?php

namespace Packages\Template;

use Illuminate\Database\Eloquent\Model;


class FieldsModel extends Model
{

    protected $table = "t_fields";
    protected $primaryKey = "pk_i_id";
    protected $fillable = [
        "s_name_ar",
        "s_name_en",
        "i_type",
        "b_is_filter",
        "b_is_field",
        "b_enable",
        "not_deleted",
        "dt_created_date",
        "dt_modified_date",
        "dt_deleted_date",
    ];
    public $timestamps = false;

    public function getOptionField()
    {
        return $this->hasMany(FieldOptionsModel::class, "fk_i_field_id", "pk_i_id");
    }
}
                            