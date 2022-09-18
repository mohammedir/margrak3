<?php

namespace Packages\Adds;

use Illuminate\Database\Eloquent\Model;
use Packages\RecentAdd\AddsComments;


class UserAddsMeta extends Model
{
    protected $table = "t_ads_user_meta";
    protected $primaryKey = "pk_i_id";
    protected $fillable = [
        "fk_i_ads_user_id",
        "s_key",
        "s_value",
        "i_order",
    ];
    public $timestamps = false;

}