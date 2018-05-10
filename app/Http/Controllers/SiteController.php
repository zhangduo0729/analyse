<?php

namespace App\Http\Controllers;

use App\AccessLog;
use App\Host;
use App\Site;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $sites = Site::paginate(15);
        return view('admin.site.index', [
            'sites'=> $sites
        ]);
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
        $post['user_id'] = Auth::user()->id;
        Site::createSite($post);
        return redirect()->route('adminSiteIndex');
    }

    /**
     * Display the specified resource.
     * 获取详细信息 get:/sites/{id}
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *  更新表单 get:/sites/{id}/edit
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->can('update', Site::find($id))) {
            $site = Site::find($id);
            $site->host = '';
            $hosts = Host::where('site_id', $site->id)->get();
            foreach ($hosts as $host) {
                $site->host .= $host->host . "\r\n";
            }
            return view('admin.site.edit', [
                'site' => $site
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     * 更新信息 put:/sites/{id}/update
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->can('update', Site::find($id))) {
            $post = $request->except('_token', '_method');
            Site::updateSite($post, $id);
            return redirect()->route('adminSiteIndex');
        }
    }

    /**
     * Remove the specified resource from storage.
     * delete:/sites/{id}
     * @param int $site_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $site_id)
    {
        if (Auth::user()->can('delete', Site::find($site_id))) {
            DB::beginTransaction();
            try {
                // 获取与站点有关的host并删除
                Host::where('site_id', $site_id)->delete();
                // 获取site相关的访问记录
                AccessLog::where('site_id', $site_id)->delete();
                Site::destroy($site_id);
            } catch (Exception $exception) {
                DB::rollBack();
            }
            DB::commit();
            return redirect()->route('adminSiteIndex');
        }
    }

    /**
     * 查看跟踪脚本
     */
    public function script($id)
    {
        $site = Site::find($id);
        return view('admin.site.script', [
            'site'=> $site
        ]);
    }
}
