<?php

namespace Packages\RecentAdd;

use Illuminate\Database\Eloquent\Model;
use Packages\Users\UserModel;
use Packages\Adds\UserAddsModel;


class AddsComments extends Model
{
    protected $table = "t_ads_comments";
    protected $primaryKey = "pk_i_id";
    protected $fillable = [
        "fk_i_user_id",
        "fk_i_ads_user_id",
        "s_comment",
        "i_status",
        "b_enabled",
        "dt_created_date",
        "dt_modified_date",
        "dt_deleted_date",
    ];
    public $timestamps = false;

    public function getCommentsUser()
    {
        return $this->belongsTo(UserModel::class, "fk_i_user_id", "pk_i_id");
    }

    public function getAddsDetails()
    {
        return $this->belongsTo(UserAddsModel::class, "fk_i_ads_user_id", "pk_i_id");
    }
}
