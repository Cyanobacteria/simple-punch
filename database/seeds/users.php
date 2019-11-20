<?php

use Illuminate\Database\Seeder;

class users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $value = 12345678;
        //一個管理者 兩個工作者
        DB::table('users')->insert(
            [
                [
                    'id' => 1,
                    'name' => "admin",
                    'isAdmin' => "1",
                    'email' => 'admin@admin.com',
                    'password' => Hash::make($value),
                ],
                [
                    'id' => 2,
                    'name' => "user1",
                    'isAdmin' => "0",
                    'email' => 'user1@user1.com',
                    'password' => Hash::make($value),
                ], [
                    'id' => 3,
                    'name' => "user2",
                    'isAdmin' => "0",
                    'email' => 'user2@user2.com',
                    'password' => Hash::make($value),
                ],
            ]
        );
    }
}
