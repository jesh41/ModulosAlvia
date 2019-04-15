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
       /* $roles = [
            'Administrador',
            'Coordinador',
            'Cajero',
            'Vendedor'
        ];


        foreach ($roles as $rol) {
            Role::create(['name' => $rol]);
        }*/
//DBCC CHECKIDENT('dbo.users', RESEED, 0) en sql ejecutarlo reinicia el autoincremento
    /*  DB::table('roles')->truncate();*/

        DB::table('roles')->insert(array(
            array(
                'nombre' => 'Administrador',
                'descripcion' => 'Administrador del sistema',
            ),
            array(
                'nombre' => 'Coordinador',
                'descripcion' => 'Rol coordinador del sistema',
            ),
            array(
                'nombre' => 'Vendedor',
                'descripcion' => 'Rol vendedor del sistema',
            ),
            array(
                'nombre' => 'Cajero',
                'descripcion' => 'Rol cajero del sistema',
            ),
        ));

    }
}
