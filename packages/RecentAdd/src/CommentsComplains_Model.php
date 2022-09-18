<?php

namespace Packages\RecentAdd;

use Illuminate\Database\Eloquent\Model;
use Packages\Users\UserModel;
use Packages\RecentAdd\AddsComments;

class CommentsComplains_Model extends Model
{
    protected $table = "t_ads_comments_complains";
    protected $primaryKey = "pk_i_id";
    protected $fillable = [
        "fk_i_ads_comments_id",
        "fk_by_user_id",
    ];
    public $timestamps = false;

    public function getCommentsUser()
    {
        return $this->belongsTo(UserModel::class, "fk_by_user_id", "pk_i_id");
    }

    public function getCommentsDetails()
    {
        return $this->belongsTo(AddsComments::class, "fk_i_ads_comments_id", "pk_i_id");
    }

}
