<?php

namespace App\Http\Controllers;

use App\AccessLog;
use Illuminate\Http\Request;

class PageAnalyseController extends Controller
{
    public function index(Request $request)
    {

        $logs = AccessLog::select('*');
        if ($site_id = $request->get('site_id')) {
            $logs->where('site_id', $site_id);
        }
        if ($start_time = $request->get('start_time')) {
            $logs->where('created_at', '>=', strtotime($start_time));
        }
        if ($end_time = $request->get('end_time')) {
            $logs->where('created_at', '<=', strtotime($end_time . ' 24:00:00'));
        }
        $logs = $logs->get();

        $pages = [];
        foreach ($logs as $log) {
            $pages[$log->getPage()][] = $log;
        }
        return view('admin.pageanalyse.index', [
            'pages' => $pages
        ]);
    }

    public function enterPage(Request $request)
    {
        $logs = AccessLog::orderBy('created_at', 'esc');
        if ($site_id = $request->get('site_id')) {
            $logs->where('site_id', $site_id);
        }
        if ($start_time = $request->get('start_time')) {
            $logs->where('created_at', '>=', strtotime($start_time));
        }
        if ($end_time = $request->get('end_time')) {
            $logs->where('created_at', '<=', strtotime($end_time . ' 24:00:00'));
        }
        $logs = $logs->get();

        $visits = [];
        foreach ($logs as $log) {
            $visits[$log->session_id][] = $log;
        }
//        dd($visitsCount);
        $enterPages = [];
        foreach ($visits as $visit=>$logs) {
            $enterPages[$logs[0]->href]['sessions'][] = $visit;
            if (count($logs) === 1) {
                $enterPages[$logs[0]->href]['only'][] = $visit;
            }
        }
        return view('admin.pageanalyse.enterpage', [
            'enterPages' => $enterPages
        ]);
    }

    public function quitPage(Request $request)
    {
        $logs = AccessLog::orderBy('created_at', 'esc');if ($site_id = $request->get('site_id')) {
        $logs->where('site_id', $site_id);
    }
        if ($start_time = $request->get('start_time')) {
            $logs->where('created_at', '>=', strtotime($start_time));
        }
        if ($end_time = $request->get('end_time')) {
            $logs->where('created_at', '<=', strtotime($end_time . ' 24:00:00'));
        }
        $logs = $logs->get();

        $sessions = [];
        foreach ($logs as $log) {
            $sessions[$log->session_id][] = $log;
        }
        $quitPages = [];
        foreach ($sessions as $session=>$logs) {
            $quitPages[$logs[count($logs)-1]->href]['sessions'][] = $session;
            foreach ($logs as $log) {
                if ($log->href === $logs[count($logs)-1]->href) {
                    $quitPages[$logs[count($logs)-1]->href]['uv'][] = $session;
                    break;
                }
            }
        }
        return view('admin.pageanalyse.quitpage', [
            'quitPages'=>$quitPages
        ]);
    }

    /**
     * 页面标题统计
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function pageTitle(Request $request)
    {
        $logs = AccessLog::select('*');
        if ($site_id = $request->get('site_id')) {
            $logs->where('site_id', $site_id);
        }
        if ($start_time = $request->get('start_time')) {
            $logs->where('created_at', '>=', strtotime($start_time));
        }
        if ($end_time = $request->get('end_time')) {
            $logs->where('created_at', '<=', strtotime($end_time . ' 24:00:00'));
        }
        $logs = $logs->get();

        $titles = [];
        foreach ($logs as $log) {
            $titles[$log->title][] = $log;
        }
        return view('admin.pageanalyse.pagetitle', [
            'titles'=>$titles
        ]);
    }

    public function search(Request $request)
    {
        $logs = AccessLog::select('*');
        if ($site_id = $request->get('site_id')) {
            $logs->where('site_id', $site_id);
        }
        if ($start_time = $request->get('start_time')) {
            $logs->where('created_at', '>=', strtotime($start_time));
        }
        if ($end_time = $request->get('end_time')) {
            $logs->where('created_at', '<=', strtotime($end_time . ' 24:00:00'));
        }
        $logs = $logs->get();

        $keywords = [];
        foreach($logs as $log){
            $keywords[$log->keywords][] = $log;
        }
        return view('admin.pageanalyse.search', [
            'keywords' => $keywords
        ]);
    }

    public function leaveLink()
    {
        return view('admin.pageanalyse.leavelink');
    }
}
