<?php

namespace App\Console\Commands;

use App\Role;
use App\User;
use App\UserRole;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InstallApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '安装此应用';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /**
         * 步骤
         * 1. 获取env的配置
         * 2. 写入配置
         * 3. 生成key
         * 4. 运行迁移
         * 5. 生成用户
         */
        // env配置
        $env = [
            'app_key' => '',
            'app_debug' => 'true',
            'app_env'=> 'local',
            'app_name' => $this->ask(mb_convert_encoding('请输入应用名称(默认为Analyse)', 'gb2312', 'utf-8')) ?: 'Analyse',
            'app_url' => $this->ask(mb_convert_encoding('请输入应用域名(默认为http://localhost)', 'gb2312', 'utf-8')) ?: 'http://localhost',
            'db_connection' => $this->ask(mb_convert_encoding('请输入数据库类型(默认为mysql)', 'gb2312', 'utf-8')) ?: 'mysql',
            'db_host' => $this->ask(mb_convert_encoding('请输入数据库主机地址(默认为localhost)', 'gb2312', 'utf-8')) ?: '127.0.0.1',
            'db_port' => $this->ask(mb_convert_encoding('请输入数据库主机端口(默认为3306)', 'gb2312', 'utf-8')) ?: '3306',
            'db_database' => $this->ask(mb_convert_encoding('请输入数据库名称(必填，请确认数据库已存在)', 'gb2312', 'utf-8')),
            'db_username' => $this->ask(mb_convert_encoding('请输入用户名(默认为root)', 'gb2312', 'utf-8')) ?: 'root',
            'db_password' => $this->secret(mb_convert_encoding('请输入密码(默认为root)', 'gb2312', 'utf-8')) ?: 'root'
        ];

        // 写入配置
        $this->editEnv($env);

        // 生成key
        Artisan::call('key:generate');

        // 运行迁移
        Artisan::call('migrate');

        // 添加登录用户
        $user = new User();
        $user->name = 'aaaaaa';
        $user->email = 'aaaaaa@aaa.aaa';
        $user->password = bcrypt('aaaaaa');
        $user->save();

        // 创建管理员角色
        $role = new Role();
        $role->name = '管理员';
        $role->save();

        // 添加用户为管理员
        $userRole = new UserRole();
        $userRole->user_id = $user->id;
        $userRole->role_id = 1;
        $userRole->save();
    }

    /**
     * 将给定的数组信息写进env文件
     * @param array $env
     */
    private function editEnv(array $env)
    {
        file_put_contents(base_path('.env'), '');
        $fp = fopen(base_path('.env'), 'a');
        foreach ($env as $k=>$v) {
            fwrite($fp, strtoupper($k) . '=' . $v . "\r\n");
        }
        fclose($fp);
    }
}
