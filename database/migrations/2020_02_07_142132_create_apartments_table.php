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
            $table->string('img')->nullable();
            $table->integer('roomNum')->default('0');
            $table->integer('bedNum')->default('0');
            $table->integer('mQ')->default('0');
            $table->integer('wcNum')->default('0');
            $table->integer('view')->default('0');
            $table->boolean('sponsored')->default('0');
            $table->boolean('visible')->default('1');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);

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
