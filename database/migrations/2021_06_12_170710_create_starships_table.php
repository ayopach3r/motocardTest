<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStarshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('starships', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('model')->nullable();
            $table->string('manufacturer')->nullable();
            $table->integer('cost_in_credits')->nullable();
            $table->integer('length')->nullable();
            $table->double('max_atmosphering_speed')->nullable();
            $table->string('crew')->nullable();
            $table->integer('passengers')->nullable();
            $table->integer('cargo_capacity')->nullable();
            $table->string('consumables')->nullable();
            $table->double('hyperdrive_rating')->nullable();
            $table->integer('mglt')->nullable();
            $table->string('starship_class')->nullable();
            $table->dateTime('created')->nullable();
            $table->dateTime('edited')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('starships');
    }
}
