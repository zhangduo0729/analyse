<?php

namespace App\Http\Controllers;

use App\AccessLog;
use App\Site;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * 报表面板
     * get:/reports
     */
    public function index(Request $request)
    {
        // 获取所有的站点列表
        $sites = Site::select('id', 'name')->get();

        $site_id = empty($request->get('site_id')) ? 1 : $request->get('site_id');
        $startTime = empty($request->get('start_time')) ? 0 : strtotime($request->get('start_time'));
        $endTime = empty($request->get('end_time')) ? 0 : strtotime($request->get('end_time'));
//var_dump($startTime.','.$endTime);exit;
        // 访问次数
        return view('admin.report.index', [
            'sites'=> $sites,
            // 查询参数
            'site_id'=> $site_id,
            'start_time'=> date('Y-m-d', $startTime),
            'end_time'=> date('Y-m-d', $endTime),
            // 访客概览
            'clicksCount'=>AccessLog::pvCount($startTime, $endTime, $site_id),
            'uniqueVisitorsCount'=>AccessLog::uniqueVisitorsCount($startTime, $endTime, $site_id),
            'uniquePageClicksCount'=>AccessLog::uniquePageClicksCount($startTime, $endTime, $site_id),
            'visitCount'=>AccessLog::visitCount($startTime, $endTime, $site_id),
            'bounceRate'=>AccessLog::bounceRate($startTime, $endTime, $site_id),
            // 实时数据
            'logs'=>AccessLog::realTimeData(10, $site_id, $startTime, $endTime)
        ]);
    }
}
