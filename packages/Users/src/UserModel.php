<?php

namespace Packages\Users;

use Illuminate\Database\Eloquent\Model;
use Packages\Adds\ConstantModel;
use Packages\Adds\FieldOptionsModel;
use Packages\Adds\SpaceAreaModel;
use Packages\Adds\UserAddsModel;
use Packages\RecentAdd\AddsComments;
use Illuminate\Foundation\Auth\User as Authenticatable;


class UserModel extends Authenticatable
{
    protected $table = "t_user";
    protected $primaryKey = "pk_i_id";
    protected $fillable = [
        "fk_i_role_id",
        "fk_i_gender_id",
        "s_username",
        "s_first_name",
        "s_last_name",
        "s_mobile_number",
        "s_email",
        "s_password",
        "i_country_id",
        "i_city_id",
        "s_address",
        "dt_birth_date",
        "d_latitude",
        "d_longitude",
        "dt_notification_seen_date",
        "s_pic",
        "dt_last_block_date",
        "dt_block_to_date",
        "i_block_count",
        "i_bad_words_count",
        "s_default_language",
        "fk_i_secret_question_id",
        "s_secret_question_answer",
        "b_enabled",
        "dt_created_date",
        "dt_modified_date",
        "dt_deleted_date",
    ];
    public $timestamps = false;

    public function getCountry()
    {
        return $this->belongsTo(FieldOptionsModel::class, "i_country_id", "pk_i_id");
    }

    public function getRole()
    {
        return $this->belongsTo(ConstantModel::class, "fk_i_role_id", "pk_i_id");
    }

    public function getCity()
    {
        return $this->belongsTo(FieldOptionsModel::class, "i_city_id", "pk_i_id");
    }

    public function getCountOfAdds()
    {
        return $this->hasMany(UserAddsModel::class, "fk_i_by_user_id", "pk_i_id");
    }

    public function getCountOfComments()
    {
        return $this->hasMany(AddsComments::class, "fk_i_user_id", "pk_i_id");
    }
}
