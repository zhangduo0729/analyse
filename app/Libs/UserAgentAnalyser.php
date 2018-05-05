<?php
namespace App\Libs;

class UserAgentAnalyser
{
    private $user_agent;
    private $params = [
        'system' => '',
        'render_engine' => '',
        'browser'=> ''
    ];

    public function __construct(string $user_agent)
    {
        $this->user_agent = $user_agent;
        $this->parser();
    }

    /**
     * 解析user_agent
     */
    private function parser()
    {
        // 系统信息
        $system_info_pat = "/\({1}([^()]+)\){1} ([^\/ ]+\/[^\/ ]+( \({1}[^()]+\){1})?( Version\/[^ ]+)?) (.+)/";
        preg_match($system_info_pat, $this->user_agent, $result);
        $this->params['system'] = $result[1];
        $this->params['render_engine'] = $result[2];
        $this->params['browser'] = $result[count($result)-1];
//        echo $this->user_agent;
//        print_r($result);
//        print_r($this->params);
    }

    /**
     * 获取访问设备的品牌
     * @return string
     */
    public function getBrand()
    {
        if (stripos($this->params['system'], 'huawei')) {
            return 'HUAWEI';
        } else if (stripos($this->params['system'], 'iphone')) {
            return 'iPhone';
        } else if (stripos($this->params['system'], 'oppo')) {
            return 'OPPO';
        } else {
            return 'Others';
        }
    }

    /**
     * 判断当前ua是否是手机ua
     * @return bool
     */
    public function isMobile()
    {
        if (stripos($this->params['system'], 'android') !== false ||
            stripos($this->params['system'], 'iphone') !== false
        ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 判断当前是否是tablet平板电脑
     */
    public function isTablet()
    {
        if (stripos($this->params['system'], 'ipad') !== false ||
            stripos($this->params['system'], 'nexus') !== false
        ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 判断是否是电脑ua
     */
    public function isDesktop()
    {
        if (stripos($this->params['system'], 'windows') !== false
        ) {
            return true;
        } else {
            return false;
        }
    }
}