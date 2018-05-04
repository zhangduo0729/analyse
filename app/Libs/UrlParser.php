<?php
namespace App\Libs;

class UrlParser
{
    private $url;
    private $params = [
        'scheme'=> '',
        'host'=> '',
        'port'=> '',
        'user'=> '',
        'pass'=> '',
        'path'=> '',
        'query'=> '',
        'fragment'=> ''
    ];

    /**
     * 构造方法，穿入需要解析的url
     * UrlParser constructor.
     * @param $url string url字符串
     */
    public function __construct(string $url)
    {
        $this->url = $url;
        // 解析url
        $this->parse();
    }

    /**
     * 解析url，并将查询字符串格式化成键值对存进query
     * @throws \Exception 如果要解析的url无法解析，那么抛出异常
     */
    private function parse()
    {
        $this->params = parse_url($this->url);
        if ($this->params === false) {
            throw new \Exception('url有误，请确认需要解析的url是正确的url地址！');
        }
        if (isset($this->params['query'])) {
//            $this->params['query'] = substr($this->params['query'], 1);
            $param_arr = explode('&', $this->params['query']);
            $this->params['query'] = [];
            foreach($param_arr as $v) {
                $one_arr = explode('=', $v);
                $this->params['query'][$one_arr[0]] = $one_arr[1];
            }
        }
    }

    /**
     * get方法
     * @param $key
     * @return mixed
     * @throws \Exception 如果要获取的键不存在，抛出异常
     */
    public function get($key)
    {
        if (key_exists($key, $this->params)) {
            return $this->params[$key];
        } else {
            return '';
//            $key = '';
//            foreach ($this->params as $k=>$v) {
//                $key .= $k . ',';
//            }
//            $key = substr($key, 0, -1);
//            throw new \Exception('输入的键无效，可用的键包括' . $key);
        }
    }
}