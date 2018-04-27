<?php
/**
 * Class Ip
 * 用于根据ip获取地理位置
 * 目前支持的方式阿里ip库开发接口，本地ip库
 */
namespace App\Libs\ip;

 class Ip
 {
     private $instance;

     /**
      * Ip constructor.
      * 根据传入的参数自动选择驱动
      * @param string $type 可选参数[文件地址，ali]
      */
     public function __construct(string $type)
     {
        if ($type === 'ali') {
            $this->instance = new Ali();
        } else {
            $this->instance = new LocalIp($type);
        }
     }

     /**
      * 根据ip地址获取地址
      * @param string $ip
      * @return mixed
      */
     public function ip2addr(string $ip)
     {
        return $this->instance->ip2addr($ip);
     }
 }