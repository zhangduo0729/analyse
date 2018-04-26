<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccessClient extends Model
{
    protected $fillable = [
        'ip',
        'proxy',
        'agent',
        'lang'
    ];
}
