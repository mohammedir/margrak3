<?php

namespace Packages\RecentAdd;

use Illuminate\Database\Eloquent\Model;


class TempImgModel extends Model
{
    protected $table = "t_images_temp";
    protected $primaryKey = "pk_i_id";
    protected $fillable = [
        "fk_i_user_id",
        "s_img",
        "i_order",
    ];
    public $timestamps = false;
}
