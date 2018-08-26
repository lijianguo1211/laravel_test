<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $table = 'test';
    public $timestamps = false;
    protected $fillable = ['username','sex','age','class','hobby','email','mobile','createtime','updatetime'];
}
