<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Estados extends Model
{
    public $table = 'estados';
    protected $fillable = ['id','nombreEstado'];
    public $timestamps = false;
}
