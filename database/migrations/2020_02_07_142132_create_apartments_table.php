<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('address');
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->integer('roomNum')->default('0');
            $table->integer('bedNum')->default('0');
            $table->integer('mQ')->default('0');
            $table->integer('wcNum')->default('0');
            $table->integer('view')->default('0');
            $table->integer('sponsored')->default('0')->nullable();
            $table->dateTimeTz('startDaySponsor')->nullable();
            $table->boolean('visible')->default('1')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartments');
    }
}
