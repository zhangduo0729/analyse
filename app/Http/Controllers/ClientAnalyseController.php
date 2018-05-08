<?php
namespace App\Http\Controllers;
use App\AccessLog;
use App\Libs\UserAgentAnalyser;
use Illuminate\Http\Request;

class ClientAnalyseController extends Controller
{
    /**
     * 访客分析-概览
     * get:/clientanalyse/index
     */
    public function index()
    {
        return view('admin.clientanalyse.index', [
            'keywordsCount'=>AccessLog::keywordsCount(),
            'queryCount'=>AccessLog::queryCount(),
            'avgResidenceTime'=>AccessLog::avgResidenceTime(),
            'visitCount'=> AccessLog::visitCount(),
            'pvCount'=> AccessLog::pvCount(),
            'uniquePageClicksCount'=> AccessLog::uniquePageClicksCount(),
            'bounceRate'=> AccessLog::bounceRate()
        ]);
    }

    /**
     * 访客日志
     * get:/clientanalyse/log
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function log(Request $request)
    {
        /**
         * 访问时间， ip, 来源, 国家，ua，页面
         */
        $site_id = $request->get('site_id');
        $start_time = $request->get('start_time');
        $end_time = $request->get('end_time');
        $logs = AccessLog::orderBy('created_at', 'desc');
        if ($site_id) {
            $logs = $logs->where('site_id', $site_id);
        }
        if ($start_time) {
            $logs = $logs->where('created_at', '>=', strtotime($start_time));
        }
        if ($end_time) {
            $logs = $logs->where('created_at', '<=', strtotime($end_time));
        }

        $logs = $logs
            ->paginate(10);
        return view('admin.clientanalyse.log', [
            'visitsLogs'=> $logs
        ]);
    }

    /**
     * 按照设备来对访客进行统计
     */
    public function device()
    {
        $logs = AccessLog::all();
        $count = [
            'mobileCount'=>0,
            'tabletCount'=>0,
            'desktopCount'=>0,
            'otherCount'=>0,
        ];

        // 屏幕分辨率
        $screens = $brands = [];

        foreach($logs as $log) {
            // 区分客户端类型
            if ($log->isMobile()) {
                $count['mobileCount'] += 1;
            } else if ($log->isTablet()) {
                $count['tabletCount'] += 1;
            } else if ($log->isDesktop()) {
                $count['desktopCount'] += 1;
            } else {
                $count['otherCount'] += 1;
            }
            $screens[$log->width . '*' . $log->height][] = $log;
            $brands[$log->getBrand()][] = $log;
        }

        return view('admin.clientanalyse.device', [
            'brands'=> $brands,
            'count'=> $count,
            'screens'=> $screens
        ]);
    }

    /**
     * 按照软件区别统计
     */
    public function software()
    {
        $oses = $browsers = [];
        $logs = AccessLog::all();
        foreach ($logs as $log) {
            $oses[$log->getOS()][] = $log;
            $browsers[$log->getBrowser()][] = $log;
        }
        return view('admin.clientanalyse.software', [
            'oses'=> $oses,
            'browsers'=> $browsers
        ]);
    }
}