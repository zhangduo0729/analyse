<?php

namespace App\Http\Controllers;

use App\Host;
use App\Site;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     * 列表 /site
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     * 添加表单 get /
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.site.create');
    }

    /**
     * Store a newly created resource in storage.
     * 添加站点动作 post:/sites
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = $request->except('_token');

        // 替换换行
        $replace = ["\r\n", "\n", "\r"];
        $host = explode(',', str_replace($replace, ',', $post['host']));
        unset($post['host']);

        // 存入数据库
        if (isset($post['name']) && $post['name']) {
            DB::beginTransaction();
            try {
                Site::create($post);
                foreach ($host as $value) {
                    Host::create(['host'=>$value]);
                }
            } catch (Exception $exception) {
                DB::rollBack();
                return redirect()->route('home');
            }
            DB::commit();
        }
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
