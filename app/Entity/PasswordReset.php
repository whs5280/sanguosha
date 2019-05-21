<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    protected $table = 'password_reset';
    protected $primaryKey = 'id';
}