<?php

namespace App\Http\Controllers;

use App\AccessLog;
use Illuminate\Http\Request;

class PageAnalyseController extends Controller
{
    public function index()
    {
        $logs = AccessLog::all();
        $pages = [];
        foreach ($logs as $log) {
            $pages[$log->getPage()][] = $log;
        }
        return view('admin.pageanalyse.index', [
            'pages' => $pages
        ]);
    }

    public function enterPage()
    {
        $logs = AccessLog::orderBy('created_at', 'esc')->get();
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

    public function quitPage()
    {
        $logs = AccessLog::orderBy('created_at', 'esc')->get();

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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function pageTitle()
    {
        $logs = AccessLog::all();
        $titles = [];
        foreach ($logs as $log) {
            $titles[$log->title][] = $log;
        }
        return view('admin.pageanalyse.pagetitle', [
            'titles'=>$titles
        ]);
    }

    public function search()
    {
        return view('admin.pageanalyse.search');
    }

    public function leaveLink()
    {
        return view('admin.pageanalyse.leavelink');
    }
}
