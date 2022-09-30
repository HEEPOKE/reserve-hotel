<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserves', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->nullable();
            $table->integer('company_id')->nullable();
            $table->string('type_room',100)->nullable();
            $table->integer('room_id')->nullable();
            $table->string('room_name',100)->nullable();
            $table->integer('guest_adult')->nullable();
            $table->integer('guest_child')->nullable();
            $table->integer('reserve_quantity')->nullable();
            $table->date('start_in_room');
            $table->date('end_in_room');
            $table->integer('payment_status')->nullable();
            $table->text('payment_slip')->nullable();
            $table->integer('total_price')->nullable();
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
        Schema::dropIfExists('reserves');
    }
}
