<?php

namespace Packages\Block;

use Illuminate\Database\Eloquent\Model;


class BlockModel extends Model
{
    protected $table = "t_blocks";
    protected $primaryKey = "pk_i_id";
    protected $fillable = [
        "s_title",
        "s_desc",
        "i_type",
        "b_enabled",
        "dt_created_date",
        "dt_modified_date",
        "dt_deleted_date",
    ];
    public $timestamps = false;

}