<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Site extends Model
{
    protected $fillable = [
        'name',
        'user_id',
        'query'
    ];

    /**
     * 新建站点方法，单独写由于添加站点涉及两个表
     * @param $site
     */
    public static function createSite($site)
    {
        $host = $site['host'];
        unset($site['host']);

        // 存入数据库
        if (isset($site['name']) && $site['name']) {
            $site = Site::create($site);
            Host::createHosts($host, $site->id);
        }
    }

    /**
     * 更新站点信息
     * @param $site
     * @param $site_id
     */
    public static function updateSite($site, $site_id)
    {
        $host = $site['host'];
        Host::where('site_id', $site_id)->delete();
        unset($site['host']);
        Host::createHosts($host, $site_id);
        Site::where('id', $site_id)->update($site);
    }

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
