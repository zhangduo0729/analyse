<?php

namespace App\Http\Controllers;

use App\AccessLog;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * 报表面板
     * get:/reports
     */
    public function index()
    {
        // 访问次数
        return view('admin.report.index', [
            'clicksCount'=>AccessLog::pvCount(),
            'uniqueVisitorsCount'=>AccessLog::uniqueVisitorsCount(),
            'uniquePageClicksCount'=>AccessLog::uniquePageClicksCount(),
            'visitCount'=>AccessLog::visitCount(),
            'bounceRate'=>AccessLog::bounceRate()
        ]);
    }
}
