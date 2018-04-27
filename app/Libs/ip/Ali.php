<?php
namespace App\Libs\ip;

class Ali
{
    private $host = 'http://ip.taobao.com';
    private $path = '/service/getIpInfo.php';

    public function ip2addr(string $ip)
    {
        $result = file_get_contents($this->host.$this->path.'?ip='.$ip);
        $result = json_decode($result, JSON_UNESCAPED_UNICODE);
        return [
            'country'=>isset($result['data']['country']) ?: '',
            'region'=>isset($result['data']['province']) ?: '',
            'city'=>isset($result['data']['city']) ?: ''
        ];
    }
}