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
        'referrer',
        'session_id',
        'country',
        'province',
        'city'
    ];

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

    /**
     * 访问次数
     * @param int $startTime
     * @param int $endTime
     * @param int $site_id
     * @return int 访问次数的统计
     */
    public static function visitCount(int $startTime=0, int $endTime=0, int $site_id=0)
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
                array_push($result, $log->session_id);
            }
        }
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
}
