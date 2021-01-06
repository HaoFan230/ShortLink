<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * 添加Admin用户
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=> 'root',
            'email'=> 'root@shortlink.com',
            'password'=> bcrypt('rootpass...123'),
            'access_token'=> base64_encode(bcrypt('root@shortlink.com')),
            'role'=> 'root',
            'status'=> 'normal',
            'created_at'=> date('Y-m-d H:i:s'),
            'updated_at'=> date('Y-m-d H:i:s')
        ]);

        echo "==============管理用户信息================".PHP_EOL;
        echo "邮箱: root@shortlink.com".PHP_EOL;
        echo "密码: rootpass...123".PHP_EOL;
        echo "========================================".PHP_EOL;
    }
}
