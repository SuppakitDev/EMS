<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCtInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ct_info', function (Blueprint $table) {
            $table->increments('id');
            $table->foreign('id')->references('id')->on('display_info');
            $table->string('Dis_SerialNo',24);
            $table->string('Ct_SerialNo',24);
            $table->string('Model',24);
            $table->string('Manufacturing_Date',24);            
            $table->string('Firmware_Version',24);  
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
        Schema::dropIfExists('ct_info');
    }
}
