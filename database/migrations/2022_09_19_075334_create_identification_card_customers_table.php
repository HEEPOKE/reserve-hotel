<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdentificationCardCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identification_card_customers', function (Blueprint $table) {
            $table->id();
            $table->integer('reserve_id')->nullable();
            $table->string('name_prefixth',50)->nullable();
            $table->string('name_prefixen',50)->nullable();
            $table->string('first_nameth',100)->nullable();
            $table->string('first_nameen',100)->nullable();
            $table->string('last_nameth',100)->nullable();
            $table->string('last_nameen',100)->nullable();
            $table->string('tel',100)->nullable();
            $table->string('email',100)->unique()->nullable();
            $table->string('identity_card',100)->nullable();
            $table->string('birthdate',100)->nullable();
            $table->text('inhabited')->nullable();
            $table->string('soi',100)->nullable();
            $table->string('tumbol',100)->nullable();
            $table->string('street',100)->nullable();
            $table->string('amphur',100)->nullable();
            $table->string('province',100)->nullable();
            $table->text('image_customer')->nullable();
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
        Schema::dropIfExists('identification_card_customers');
    }
}
