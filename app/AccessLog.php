<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccessLog extends Model
{
    protected $fillable = [
        'site_id',
        'host_id',
        'action_id',
        'access_client_id',
        'request_time',
        'referrer'
    ];
}
