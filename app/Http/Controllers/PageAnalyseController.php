<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageAnalyseController extends Controller
{
    public function index()
    {
        return view('admin.pageanalyse.index');
    }

    public function enterPage()
    {
        return view('admin.pageanalyse.enterpage');
    }

    public function quitPage()
    {
        return view('admin.pageanalyse.quitpage');
    }

    public function pageTitle()
    {
        return view('admin.pageanalyse.pagetitle');
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
