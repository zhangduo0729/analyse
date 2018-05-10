<?php

namespace App\Http\Controllers;

use App\SearchEngine;
use Illuminate\Http\Request;

class SearchEngineController extends Controller
{
    /**
     * 搜索引擎列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $engines = SearchEngine::all();
        return view('admin.setting.searchengine.index', [
            'engines' => $engines
        ]);
    }

    /**
     * 添加站点表单页面
     */
    public function create()
    {
        return view('admin.setting.searchengine.create');
    }

    /**
     * 添加站点
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $post = $request->except('_token');
        SearchEngine::create($post);
        return redirect()->route('adminSearchEngineIndex');
    }

    /**
     * 删除搜索引擎
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        SearchEngine::destroy($id);
        return redirect()->route('adminSearchEngineIndex');
    }

    /**
     * 修改信息表单
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $engine = SearchEngine::find($id);
        return view('admin.setting.searchengine.edit', [
            'engine' => $engine
        ]);
    }

    public function update(Request $request, $id)
    {
        $engine = SearchEngine::find($id);
        $post = $request->except('_token', '_method');
        foreach ($post as $k=>$v) {
            $engine->$k = $v;
        }
        $engine->save();
//        SearchEngine::where('id', $id)->update($post);
        return redirect()->route('adminSearchEngineIndex');
    }
}
