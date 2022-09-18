<?php

namespace Packages\System;

use Illuminate\Database\Eloquent\Model;


class NotificationUser extends Model
{

    protected $table = "t_notification_user";
    protected $primaryKey = "pk_i_id";
    protected $fillable = [
        "fk_i_notification_id",
        "fk_i_user_id",
        "i_title_type",
        "dt_seen_date",
        "dt_read_date",
        "dt_created_date",
        "is_deleted",
    ];
    public $timestamps = false;

}
