<?php

namespace Packages\Users;

use Illuminate\Database\Eloquent\Model;


class Contact extends Model
{


    protected $table = "t_contact_us";
    protected $primaryKey = "pk_i_id";
    protected $fillable = [
        "s_name_ar",
        "i_type",
        "s_title",
        "s_desc",
        "s_email",
        "s_mobile",
        "dt_seen_date",
        "b_enabled",
        "dt_created_date",
        "dt_modified_date",
        "dt_deleted_date",
    ];
    public $timestamps = false;

}
