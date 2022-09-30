<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->integer('company_id');
            $table->string('rooms_name',100);
            $table->text('room_detail');
            $table->text('room_facilities');
            $table->integer('room_capacity');
            $table->integer('room_quantity');
            $table->string('room_type',100);
            $table->integer('price');
            $table->string('rooms_image');
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
};
