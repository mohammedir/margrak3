<?php

namespace Packages\RecentAdd;

use Illuminate\Database\Eloquent\Model;


class UserReactModel extends Model
{
    protected $table = "t_user_react_ads";
    protected $primaryKey = "pk_i_id";
    protected $fillable = [
        "fk_i_ads_user_id",
        "fk_i_user_id",
        "i_type",
    ];
    public $timestamps = false;

}
