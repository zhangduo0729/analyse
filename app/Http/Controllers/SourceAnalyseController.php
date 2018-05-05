<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SourceAnalyseController extends Controller
{
    public function index()
    {
        return view('admin.sourceanalyse.index');
    }

    public function allSources()
    {
        return view('admin.sourceanalyse.allsources');
    }

    public function searchEngine()
    {
        return view('admin.sourceanalyse.searchengine');
    }
}
