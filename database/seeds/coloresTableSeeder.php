<?php

use Illuminate\Database\Seeder;
use App\Colores;

class coloresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $colores = [

            'Ninguno',

            'Mill Finish',

            'Natural',

            'Champagne',

            'Bronce',

            'Blanco',

            'Beige',

            'Ivory'

        ];


        foreach ($colores as $color) {

            Colores::create(['descripcion' => $color]);

        }
    }
}
