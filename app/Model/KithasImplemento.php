<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class KithasImplemento extends Model
{
    public $table = 'implementostrabajo_has_kit';
    protected $fillable = ['implemento_id','kit_id'];
    public $timestamps = false;
}
