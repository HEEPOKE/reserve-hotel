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
        Schema::create('reserve', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->integer('room_id');
            $table->integer('guest_adult');
            $table->integer('guest_child');
            $table->integer('reserve_quantity');
            $table->date('start_in_room');
            $table->date('end_in_room');
            $table->integer('payment_status');
            $table->text('payment_slip');
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
        Schema::dropIfExists('reserve');
    }
};
