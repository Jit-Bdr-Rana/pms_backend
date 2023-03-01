<?php

namespace Database\Seeders;

use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Super Admin', 'created_at' => Carbon::now()->toDateTimeString()],
            ['name' => 'Normal', 'created_at' => Carbon::now()->toDateTimeString()],
            ['name' => 'Data Entry', 'created_at' => Carbon::now()->toDateTimeString()],
        ];
        Role::insert($data);
    }
}