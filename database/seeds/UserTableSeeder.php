<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\User::create([
            'first_name'=>'super',
            'last_name'=>'admin',
            'email'=>'super_admin@app.com',
            'password'=>bcrypt('123456'),
        ]);
        $user->attachRole('super_admin');
    }
}

