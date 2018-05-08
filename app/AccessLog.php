<?php

namespace App;

use App\Libs\UrlParser;
use App\Libs\UserAgentAnalyser;
use Illuminate\Database\Eloquent\Model;

class AccessLog extends Model
{
    protected $fillable = [
        'site_id',
        'host_id',
        'action_id',
        'access_client_id',
        'request_time',
        'referrer',
        'session_id',
        'href',
        'keywords',
        'ip',
        'title',
        'useragent',
        'width',
        'height',
        'color_depth'
    ];
    private $userAgent;
    private $urlParser;

    /**
     * 用于获取UserAgentAnalyser类的示例对象，用于解析agent使用
     * @return UserAgentAnalyser
     */
    private function userAgent()
    {
        if (!$this->userAgent) {
            $this->userAgent = new UserAgentAnalyser($this->useragent);
        }
        return $this->userAgent;
    }

    private function urlParser()
    {
        if (!$this->urlParser) {
            try {
                $this->urlParser = new UrlParser($this->href);
            } catch (\Exception $e) {
                dd($e);
            }
        }
        return $this->urlParser;
    }

    /**
     * 获取当次访问的path
     * @return mixed
     * @throws \Exception
     */
    public function getPage()
    {
        return $this->urlParser()->get('path');
    }

    /**
     * 获取访问用户的浏览器信息
     */
    public function getBrowser()
    {
        return $this->userAgent()->getBrowser();
    }

    /**
     * 获取访问客户端的操作系统信息
     * @return string
     */
    public function getOS()
    {
        return $this->userAgent()->getOS();
    }

    /**
     * 获取当次访问设备的品牌
     * @return string 品牌名称
     */
    public function getBrand()
    {
        return $this->userAgent()->getBrand();
    }

    /**
     * 判断当次访问设备是否是移动设备
     * @return bool
     */
    public function isMobile()
    {
        return $this->userAgent()->isMobile();
    }

    /**
     * 判断当次访问是否是桌面软件
     * @return bool
     */
    public function isDesktop()
    {
        return $this->userAgent()->isDesktop();
    }

    /**
     * 判断当次访问是否是平板电脑
     * @return bool
     */
    public function isTablet()
    {
        return $this->userAgent()->isTablet();
    }

    /**
     * 获取当前时间
     *
     * @return int
     */
    public function freshTimestamp() {
        return time();
    }

    /**
     * 避免转换时间戳为时间字符串
     *
     * @param int $value
     * @return int
     */
    public function fromDateTime($value) {
        return $value;
    }

    /**
     * 从数据库获取的为获取时间戳格式
     *
     * @return string
     */
    public function getDateFormat() {
        return 'U';
    }

    /**
     * 获取访问地点
     */
    public function addr()
    {
        $ip = Ip::where('ip_start_num', '<=', $this->ip)->where('ip_end_num', '>=', $this->ip)->first();
        if (!$ip) {
            return '未知';
        }
        return $ip->country . ',' . $ip->province . ',' . $ip->city;
    }

    /**
     * 获取关键词数量
     */
    public static function keywordsCount()
    {
        $logs = AccessLog::select('keywords')->where('keywords', '!=', '')->get();
        $result = [];
        foreach ($logs as $log) {
            if (!in_array($log->keywords, $result)) {
                array_push($result, $log->keywords);
            }
        }
        return count($result);
    }

    /**
     * 获取查询次数
     * @return
     */
    public static function queryCount()
    {
        $logs = AccessLog::select('keywords')->where('keywords', '!=', '')->get();
        return count($logs);
    }

    /**
     * 页面跳出率
     * @param int $startTime
     * @param int $endTime
     * @param int $site_id
     * @return string 页面跳出率
     */
    public static function bounceRate(int $startTime=0, int $endTime=0, int $site_id=0)
    {
        $bounceTimes = AccessLog::OnePageCount($startTime, $endTime, $site_id);
        $visitCount = AccessLog::visitCount($startTime, $endTime, $site_id);
        if ($visitCount == 0) {
            return 0 . '%';
        }
        return $bounceTimes / $visitCount * 100 . '%';
    }

    /**
     * 跳出次数(只访问一个页面就跳走的次数)
     * @param int $startTime
     * @param int $endTime
     * @param int $site_id
     * @return int 跳出次数
     */
    private static function OnePageCount(int $startTime=0, int $endTime=0, int $site_id=0)
    {
        $result = AccessLog::select('session_id');
        $result = $result->where('created_at', '>=', $startTime);
        if ($endTime !== 0) {
            $result = $result->where('created_at', '<=', $endTime);
        }
        if ($site_id !== 0) {
            $result = $result->where('site_id', $site_id);
        }
        $logs = $result->get();
        $result = [];
        foreach ($logs as $log) {
            if (!in_array($log->session_id, $result)) {
                array_push($result, [$log->session_id=>1]);
            } else {
                $result[$log->session_id] += 1;
            }
        }
        $count = 0;
        foreach ($result as $session=>$times) {
            if ($times === 1) {
                $count += 1;
            }
        }
        return $count;
    }

    public static function visitsLog(int $startTime=0, int $endTime=0, int $site_id=0, $limit=0)
    {
        $result = AccessLog::select('session_id');
        $result = $result->where('created_at', '>=', $startTime);
        if ($endTime !== 0) {
            $result = $result->where('created_at', '<=', $endTime);
        }
        if ($site_id !== 0) {
            $result = $result->where('site_id', $site_id);
        }
        $logs = $result->get();
        $result = [];
        foreach ($logs as $log) {
            if (!in_array($log->session_id, $result)) {
                $result[$log->session_id][] = $log;
            }
        }
        return $result;
    }

    /**
     * 访问次数
     * @param int $startTime
     * @param int $endTime
     * @param int $site_id
     * @return int 访问次数的统计
     */
    public static function visitCount(int $startTime=0, int $endTime=0, int $site_id=0)
    {
        $result = AccessLog::visitsLog($startTime, $endTime, $site_id);
        return count($result);
    }

    /**
     * pv浏览量
     * @param int $startTime
     * @param int $endTime
     * @param int $site_id
     * @return int
     */
    public static function pvCount(int $startTime=0, int $endTime=0, int $site_id=0)
    {
        $result = AccessLog::select('id');
        $result = $result->where('created_at', '>=', $startTime);
        if ($endTime !== 0) {
            $result = $result->where('created_at', '<=', $endTime);
        }
        if ($site_id !== 0) {
            $result = $result->where('site_id', $site_id);
        }
        $result = $result->get();
        return count($result);
    }

    /**
     * 获取站点独立访客数量
     * @param int $startTime 开始时间
     * @param int $endTime 结束时间
     * @param int $site_id 站点id
     * @return int 返回地理访客数量
     */
    public static function uniqueVisitorsCount($startTime=0, $endTime=0, int $site_id = 0)
    {
        /*
         * 1. 获取时间段内的所有访问记录的客户端id
         * 2. 统计不同的客户端的数量
         */
        $result = AccessLog::select('access_client_id');
        $result = $result->where('created_at', '>=', $startTime);
        if ($endTime !== 0) {
            $result = $result->where('created_at', '<=', $endTime);
        }
        if ($site_id !== 0) {
            $result = $result->where('site_id', $site_id);
        }
        $logs = $result->get();
        $result = [];
        foreach ($logs as $log) {
            if (!in_array($log->access_client_id, $result)) {
                array_push($result, $log->access_client_id);
            }
        }
        return count($result);
    }

    /**
     * 获取唯一页面访问量
     * @param int $startTime
     * @param int $endTime
     * @param int $site_id
     * @return int 唯一页面访问量
     */
    public static function uniquePageClicksCount(int $startTime=0, int $endTime=0, int $site_id=0)
    {
        /*
         * 1. 获取所有的action_id
         * 2. 根据条件筛选并返回次数
         */
        $result = AccessLog::select('action_id');
        $result = $result->where('created_at', '>=', $startTime);
        if ($endTime !== 0) {
            $result = $result->where('created_at', '<=', $endTime);
        }
        if ($site_id !== 0) {
            $result = $result->where('site_id', $site_id);
        }
        $logs = $result->get();
        $result = [];
        foreach ($logs as $log) {
            if (!in_array($log->action_id, $result)) {
                array_push($result, $log->action_id);
            }
        }
        return count($result);
    }

    /**
     * 实时数据
     * @param int $count
     * @param int $site_id
     * @return mixed
     */
    public static function realTimeData(int $count=10, int $site_id=0, $startTime=0, $endTime=0)
    {
        $instance = AccessLog::join('access_clients', 'access_logs.access_client_id', '=', 'access_clients.id')
                        ->select('access_logs.href', 'access_logs.title', 'access_logs.created_at', 'access_logs.referrer', 'access_clients.agent', 'access_logs.ip')
                        ->orderBy('created_at', 'desc');
        if ($site_id !== 0) {
            $instance = $instance->where('access_logs.site_id', $site_id);
        }
        if ($startTime !== 0) {
            $instance = $instance->where('access_logs.created_at', '>=', $startTime);
        }
        if ($endTime !== 0) {
            $instance = $instance->where('access_logs.created_at', '<=', $endTime);
        }
        $instance = $instance->limit($count);
        $result = $instance->get();
        return $result;
    }

    /**
     * 站点平均停留时间
     */
    public static function avgResidenceTime()
    {
        $logs = AccessLog::select('session_id', 'created_at')
            ->orderBy('created_at', 'desc')
            ->get();

        $result = [];
        // 获取每一次会话的所有时间
        foreach($logs as $access_log) {
            if (!key_exists($access_log->session_id, $result)) {
                $result[$access_log->session_id] = [];
            }
            array_push($result[$access_log->session_id], $access_log->created_at);
        }
        // 获取每一次会话的停留时间，并销毁记录的时间
        foreach ($result as $session_id=>$time) {
            $result[$session_id]['residence_time'] = $time[0]->timestamp-$time[count($time)-1]->timestamp;
            foreach ($result[$session_id] as $k=>$v) {
                if ($k !== 'residence_time') {
                    unset($result[$session_id][$k]);
                }
            }
        }
        // 遍历，获取停留时间的和
        $totalTime = 0;
        foreach ($result as $k=>$v) {
            $totalTime += $v['residence_time'];
        }
        if (count($result) == 0) {
            return 0;
        } else {
            return $totalTime / count($result);
        }
    }
}
