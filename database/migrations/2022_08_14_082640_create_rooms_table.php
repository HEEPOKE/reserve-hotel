<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id')->nullable();
            $table->string('room_name',100)->nullable();
            $table->text('room_detail')->nullable();
            $table->text('room_facilities')->nullable();
            $table->integer('room_capacity')->nullable();
            $table->integer('room_quantity')->nullable();
            $table->string('room_type',100)->nullable();
            $table->integer('price')->nullable();
            $table->text('more_detail')->nullable();
            $table->text('rooms_image')->nullable();
            $table->text('other')->nullable();
            $table->text('other_quantity')->nullable();
            $table->integer('other_price')->nullable();
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
        Schema::dropIfExists('rooms');
    }
}
