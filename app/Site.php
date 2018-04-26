<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Site extends Model
{
    protected $fillable = [
        'name'
    ];

    /**
     * 获取站点的浏览量
     * @return int 浏览量
     */
    public function access_count()
    {
        return AccessLog::where('site_id', $this->id)->count();
    }

    /**
     * 获取站点的访问人数
     */
    public function access_client_count()
    {
        return DB::select('select count(1) from (select count(1) from access_logs group by site_id,access_client_id)aa')[0]->{'count(1)'};
    }
}
