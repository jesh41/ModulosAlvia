<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCatcolores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catcolores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion');
            $table->timestamps(4);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('catcolores', function (Blueprint $table) {
            Schema::dropIfExists('catcolores');
        });
    }
}
