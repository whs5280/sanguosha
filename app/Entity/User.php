<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';

    protected $fillable = [
        'nickname', 'email', 'password', 'phone'
    ];

    protected $primaryKey = 'id';

    //public $timestamps = false;
}
