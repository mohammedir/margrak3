<?php

namespace Packages\System;

use Illuminate\Database\Eloquent\Model;
use Packages\Users\UserModel;


class Notification extends Model
{


    protected $table = "t_notification";
    protected $primaryKey = "pk_i_id";
    protected $fillable = [
        "fk_i_actor_user_id",
        "i_target_users_id",
        "s_url_msg",
        "s_url",
        "i_title_type",
        "s_msg",
        "i_action",
        "record_id",
        "b_enabled",
        "dt_created_date",
        "dt_modified_date",
        "dt_deleted_date",
        "is_deleted",
    ];
    public $timestamps = false;

    public function getSenderDetails()
    {
        return $this->belongsTo(UserModel::class, "fk_i_actor_user_id", "pk_i_id");
    }
}
