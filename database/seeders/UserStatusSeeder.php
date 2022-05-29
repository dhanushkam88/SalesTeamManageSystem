<?php

namespace Database\Seeders;

use App\Models\UserStatus;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UserStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserStatus::create([
            'status' => 'inactive'
        ]);
        UserStatus::create([
            'status' => 'active'
        ]);
    }
}
