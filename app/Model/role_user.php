<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class role_user extends Model
{
    public $table = 'role_user';

    protected $fillable = ['role_id','user_id'];
}
