<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;

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
