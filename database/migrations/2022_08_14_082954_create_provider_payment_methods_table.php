<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderPaymentMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_payment_methods', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->string('payment_type',100)->nullable();
            $table->integer('bank_id')->default('1');
            $table->string('bank_account_no',100);
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
        Schema::dropIfExists('provider_payment_methods');
    }
}
