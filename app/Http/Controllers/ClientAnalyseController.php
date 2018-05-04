<?php
namespace App\Http\Controllers;
use App\AccessLog;
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
}