<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_company', function (Blueprint $table) {
            $table->increments('id');
            $table->string('C_name',100);
            $table->float('lat');
            $table->float('lon');
            $table->string('Display_list');
            $table->string('Address');
            $table->string('Email');
            $table->string('Tel',10);
            $table->integer('Money_rate');
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
        Schema::dropIfExists('client_company');
    }
}
