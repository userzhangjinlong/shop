<?php

use Illuminate\Database\Seeder;

class ManagersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //添加admin用户
        $faker = \Faker\Factory::create('zh_cn');

        //生成admin用户
        $data = [
            'username'  =>  'admin',
            'nickname'  =>  '超级管理员',
            'role'      =>  0,
            'phone'     =>  18000000000,
            'password'  =>  bcrypt('111111'),
            'created_at'=>  \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at'=>  \Carbon\Carbon::now()->toDateTimeString(),
        ];

        //写入数据表
        DB::table('managers') -> insert($data);
    }
}
