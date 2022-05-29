<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionsRoleSeeder::class);
        $this->call(UserStatusSeeder::class);
        $this->call(CreateUserSeeder::class);
    }
}
