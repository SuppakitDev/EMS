<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisplayInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('display_info', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Dis_SerialNo',24);
            $table->integer('C_ID')->unsigned();
            $table->foreign('C_ID')->references('id')->on('client_company');
            $table->integer('B_ID')->unsigned();
            $table->foreign('B_ID')->references('id')->on('building');
            $table->string('Dis_Number',10);            
            $table->string('DisModel',24);            
            $table->string('DisManufacturing_Date',24);            
            $table->string('DisFirmware_Version',24);
            $table->string('Ct_SerialNo',24);
            $table->string('CtModel',24);            
            $table->string('CtManufacturing_Date',24);            
            $table->string('CtFirmware_Version',24);      
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
        Schema::dropIfExists('display_info');
    }
}
