<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Dhanushka',
            'email' => 'dhanushka@test.com',
            'contact' => '0773518123',
            'manager_id' => '0',
            'status' => '2',
            'joined_date' => '2022-05-22',
            'current_route' => 'Cinnamon gardens, colombo 7',
            'password' => Hash::make('Dhanushka@1234'),
            'comment' => 'jfosdfhdsifhsdfdshfidhfhsd'
        ])->assignRole('admin');

        $user = User::create([
            'name' => 'Mahela Jayawardana',
            'email' => 'duminda.kt@gmail.com',
            'contact' => '0773518123',
            'manager_id' => '1',
            'status' => '2',
            'joined_date' => '2022-05-22',
            'current_route' => 'Rosmead place',
            'password' => Hash::make('Dhanushka@1234'),
            'comment' => 'jfosdfhdsifhsdfdshfidhfhsd'
        ])->assignRole('manager');

        $user = User::create([
            'name' => 'Sanath.Jayesuriya',
            'email' => 'sanath@gmail.com',
            'contact' => '0773518123',
            'manager_id' => '1',
            'status' => '2',
            'joined_date' => '2022-05-22',
            'current_route' => 'Cinnamon gardens, colombo 7',
            'password' => Hash::make('Dhanushka@1234'),
            'comment' => 'jfosdfhdsifhsdfdshfidhfhsd'
        ])->assignRole('employee');
    }
}
