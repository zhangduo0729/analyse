<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Host extends Model
{
    protected $fillable = ['host', 'site_id'];

    public static function createHosts(string $host,int $site_id)
    {
        // 替换换行
        $replace = ["\r\n", "\n", "\r"];
        $host = explode(',', str_replace($replace, ',', $host));
        foreach ($host as $value) {
            Host::create(['host'=>$value, 'site_id'=>$site_id]);
        }
    }
}
