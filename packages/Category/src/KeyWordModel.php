<?php

namespace Packages\Category;

use Illuminate\Database\Eloquent\Model;


class KeyWordModel extends Model
{
    protected $table = "t_categories_key_words";
    protected $primaryKey = "pk_i_id";
    protected $fillable = [
        "fk_i_ads_user_id",
        "key_word",
    ];
    public $timestamps = false;

}
