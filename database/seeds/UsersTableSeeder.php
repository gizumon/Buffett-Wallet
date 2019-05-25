<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\Model\User::create([
            'name' => 'develop_user',
            'email' => 'develop@example.com',
            'password' => Hash::make('1234567890'),
            'remember_token' => str_random(10),  
        ]);
    }
}
