<?php

namespace App\Http\Controllers;

use App\AccessClient;
use App\AccessLog;
use App\Action;
use App\Host;
use App\Libs\ip\Ip;
use App\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Input;

class CollectController extends Controller
{
    /**
     * 用于收集站点的访问信息并记录进数据库
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $param = Input::get();

        // 过滤掉不包含siteId或者没有添加的站点的请求
        if (!isset($param['site_id']) || !Site::find($param['site_id'])) {
            return response()->json('failed');
        }

        $url_arr = parse_url($param['href']);
        // host_id
        $host = $url_arr['scheme'] . '://'. $url_arr['host'];
        $host = Host::where('host', '=', $host)->first();
        if (!$host) {
            return response()->json('failed');
        }
        $host_id = $host->id;

        // action_id 如果已经存在了就直接查询数据库，如果不存在，创建action并获取id
        $action_path = $url_arr['path'];
        if ($action = Action::where('path', '=', $action_path)->first()) {
            $action_id = $action->id;
        } else {
            $action_arr = [
                'path'=> $action_path,
                'title'=> $param['title']
            ];
            $action = Action::create($action_arr);
            $action_id = $action->id;
        }

        // session_id用于统计会话次数，即访问次数，默认生存期三十分钟,超过三十分钟后的再次访问作为新的一次访问
        $session_id = Cookie::get('session_id');
        if (!$session_id) {
            $session_id = uniqid();
        }

        // 通过cookie确定client_id是否是第一次访问，如果是就添加客户端，如果不是，直接获取用户id
        $access_client_id = Cookie::get('access_client_id');
        if (!$access_client_id || !AccessClient::find($access_client_id)) {
            $access_client = [
                'ip'=> $request->getClientIp(),
                'proxy'=>$request->server->get('REMOTE_ADDR'),
                'agent'=>$request->headers->get('user-agent'),
                'lang'=>$param['lang']
            ];
            $access_client = AccessClient::create($access_client);
            $access_client_id = $access_client->id;
        }

        // 根据ip获取地理位置
        $ip = $request->getClientIp();
        $ipInstance = new Ip('ali');
        $addr = $ipInstance->ip2addr($ip);

        // 最后准备加入日志文件的内容
        $access_log = [
            'country'=> $addr['country'],
            'province'=> $addr['province'],
            'city'=> $addr['city'],
            'site_id'=> $param['site_id'],
            'host_id'=> $host_id,
            'action_id'=> $action_id,
            'access_client_id'=> $access_client_id,
            'request_time'=> $request->server->get('REQUEST_TIME'),
            'referrer'=> $param['referrer'] || '',
            'session_id'=> $session_id
        ];
        AccessLog::create($access_log);
        $client_id_cookie = Cookie('access_client_id', $access_client_id, 365 * 2 * 24 * 60);
        $session_id_cookie = Cookie('session_id', $session_id, 30);

        // 返回并写入cookie
        return response()
            ->json('success')
            ->cookie($session_id_cookie)
            ->cookie($client_id_cookie);
    }
}
