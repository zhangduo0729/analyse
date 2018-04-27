<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Site extends Model
{
    protected $fillable = [
        'name',
        'user_id'
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

    /**
     * 获取站点的埋点脚本
     * @return string
     */
    public function script()
    {
        $script = '';
        $script .= '<script type="text/javascript">' . "\r\n";
        $script .= '    var _maq = _maq || [];' . "\r\n";
        $script .= '    _maq.push(["site_id", '. $this->id .']);' . "\r\n";
        $script .= '    (function() {' . "\r\n";
        $script .= '        var ma = document.createElement("script"); ma.type = "text/javascript"; ma.async = true;' . "\r\n";
        $script .= '        ma.src = "'. config('app.url') .'/analyse.js";' . "\r\n";
        $script .= '        var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ma, s);' . "\r\n";
        $script .= '    })();' . "\r\n";
        $script .= '</script>' . "\r\n";
        return $script;
    }
}
