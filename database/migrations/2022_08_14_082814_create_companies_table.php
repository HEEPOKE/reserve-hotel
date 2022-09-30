<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name',100);
            $table->string('company_logo',100)->nullable();
            $table->string('tel', 100);
            $table->string('email')->unique();
            $table->string('address',100)->nullable();
            $table->string('location',100)->nullable();
            $table->date('license_expire')->nullable();
            $table->string('license_status',200)->nullable();
            $table->integer('renew_contract')->nullable();
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
        Schema::dropIfExists('companies');
    }
}
