<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Ernesto',
            'email' => 'jesh40@hotmail.es',
            'password' => bcrypt('123456'),
        ]);
    }
}
