<?php

namespace Packages\Announcement;

use Illuminate\Database\Eloquent\Model;


class AnnouncementModel extends Model
{
    protected $table = "t_announcements";
    protected $primaryKey = "pk_i_id";
    protected $fillable = [
        "s_title",
        "s_desc",
        "s_pic",
        "i_fk_category_id",
        "i_clicks_count",
        "b_enabled",
        "dt_created_date",
        "dt_modified_date",
        "dt_deleted_date",
    ];
    public $timestamps = false;
}
