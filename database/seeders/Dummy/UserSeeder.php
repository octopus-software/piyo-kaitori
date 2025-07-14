<?php

namespace Database\Seeders\Dummy;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->create([
            'id' => 1,
            'name' => 'ぴよぴよカンパニー',
            'email' => 'hickcompany20190905@gmail.com',
            'password' => bcrypt('password'),
            'role' => User::USER_ROLE['admin'],
        ]);

        User::query()->create([
            'name' => 'テスト用ユーザー',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'role' => User::USER_ROLE['client'],
        ]);

        Company::query()->create([
            'user_id' => 1,
            'name' => 'ぴよぴよカンパニー',
            'email' => 'info@hiyoco-kaitori.com',
            'address' => '千葉県松戸市松戸１２２８−１ー５F',
            'representative_name' => '橋本達也',
            'tel' => '07083857096',
            'secondhand_dealer_license_number' => '第401300000065号',
            'send_address' => '千葉県松戸市松戸１２２８−１ー５F'
        ]);
    }
}
