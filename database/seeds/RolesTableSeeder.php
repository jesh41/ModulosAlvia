<?php

use Illuminate\Database\Seeder;
 use \Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'Administrador',
            'Informatica'
        ];


        foreach ($roles as $rol) {
            Role::create(['name' => $rol]);
        }
    }
}
