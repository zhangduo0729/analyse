<?php

namespace App\Http\Controllers;

use App\AccessLog;
use App\SearchEngine;
use Illuminate\Http\Request;

class SourceAnalyseController extends Controller
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

        $directViewCount = $fromEngine = $fromSite = 0;
        $searchEngines = $sites = [];
        foreach($logs as $log) {
            if ($engine = $log->fromEngine()) {
                $searchEngines[$engine][] = $log;
            }
            if ($site = $log->fromSite()) {
                $sites[$site][] = $log;
            }
            if ($log->isDirectView()) {
                $directViewCount += 1;
            } else if ($log->isFromSearchEngine()) {
                $fromEngine += 1;
            } else {
                $fromSite += 1;
            }
        }
        return view('admin.sourceanalyse.index', [
            'directViewCount' => $directViewCount,
            'fromEngine' => $fromEngine,
            'fromSite' => $fromSite,
            'searchEngines' => $searchEngines,
            'sites' => $sites
        ]);
    }

    /**
     * 所有来源统计
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function allSources(Request $request)
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

        $engines = [];
        $sites = [];
        $directViewCount = $fromEngine = $fromSite = 0;
        foreach ($logs as $log) {
            if ($log->isFromSearchEngine()) {
                $engines[$log->fromEngine()][$log->session_id] = $log;
            }
            if ($site = $log->fromSite()) {
                $sites[$site][$log->session_id] = $log;
            }
            if ($log->isDirectView()) {
                $directViewCount += 1;
            } else if ($log->isFromSearchEngine()) {
                $fromEngine += 1;
            } else {
                $fromSite += 1;
            }
        }
        return view('admin.sourceanalyse.allsources', [
            'engines' => $engines,
            'sites' => $sites,
            'directViewCount'=>$directViewCount,
            'fromEngine'=>$fromEngine,
            'fromSite'=> $fromSite
        ]);
    }

    public function searchEngine()
    {
        $engines = SearchEngine::all();
        return view('admin.sourceanalyse.searchengine', [
            'engines' => $engines
        ]);
    }
}
