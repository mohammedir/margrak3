<?php

namespace Packages\Template;

use Illuminate\Database\Eloquent\Model;


class TemplateFieldsModel extends Model
{
    protected $table = "t_ads_template_fields";
    protected $primaryKey = "pk_i_id";
    protected $fillable = [
        "fk_i_field_id",
        "fk_i_ads_template_id",
    ];
    public $timestamps = false;

    public function getFieldData()
    {
        return $this->belongsTo(FieldsModel::class, "fk_i_field_id", "pk_i_id")->where([
            "b_is_field" => 1,
        ]);
    }
}
                            