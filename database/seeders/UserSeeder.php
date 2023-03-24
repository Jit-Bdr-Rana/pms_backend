<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            // [
            //     'full_name' => 'Super Admin',
            //     'address' => 'gaushala',
            //     'password' => bcrypt('admin@123'),
            //     'username' => 'superadmin',
            //     'email' => 'superadmin@gmail.com',
            //     'phone' => '9807590188',
            //     'role_id' => 1,
            //     "shareholder_type" => 'type',
            //     'created_at' => Carbon::now()->toDateTimeString()
            // ],
            [
                'full_name' => 'sudip pandey',
                'address' => 'gaushala',
                'password' => bcrypt('admin@123'),
                'username' => 'sudip-pandey',
                'email' => 'pandeysudip02@gmail.com',
                'phone' => '9807590188',
                'role_id' => 1,
                "shareholder_type" => 'type',
                'created_at' => Carbon::now()->toDateTimeString()
            ]
        ];
        User::insert($data);
    }
}