<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    //访问模型
    protected $table = 'access';

    public $timestamps = true;

    const CREATED_AT = 'access_addtime';
    const UPDATED_AT = 'access_updatetime';

    protected $fillable = [];
}
