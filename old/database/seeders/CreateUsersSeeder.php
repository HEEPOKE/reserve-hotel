<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = [
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'role' => '1',
                'password' => bcrypt('1234'),
                'company_id' => NULL
            ],
            [
                'name' => 'User',
                'email' => 'user@user.com',
                'role' => '0',
                'password' => bcrypt('1234'),
                'company_id' => NULL
            ]
        
            ];
        foreach($user as $key => $value) {
            User::create($value);
        }
       
    }
}
