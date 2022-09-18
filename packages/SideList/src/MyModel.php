<?php

                            namespace Packages\pluginclone\src;
use Illuminate\Database\Eloquent\Model;



                            class MyModel extends Model
                            {

                                /**
                                 * The attributes that are mass assignable.
                                 *
                                 * @var array
                                 */
                                protected $fillable = [
                                    "name", "email", "password",
                                ];

                                /**
                                 * The attributes that should be hidden for arrays.
                                 *
                                 * @var array
                                 */
                                protected $hidden = [
                                    "password", "remember_token",
                                ];
                            }
                            