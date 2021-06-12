<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePilotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pilots', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('height')->nullable();
            $table->string('mass')->nullable();
            $table->integer('hair_color')->nullable();
            $table->integer('skin_color')->nullable();
            $table->double('eye_color')->nullable();
            $table->string('birth_year')->nullable();
            $table->integer('gender')->nullable();
            $table->integer('homeworld')->nullable();
            $table->string('created')->nullable();
            $table->double('edited')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pilots');
    }
}
