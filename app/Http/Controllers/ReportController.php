<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * 报表面板
     * get:/reports
     */
    public function index()
    {
        return view('admin.report.index');
    }
}
