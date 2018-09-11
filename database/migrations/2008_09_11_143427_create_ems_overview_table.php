<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmsOverviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ems_overview', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('C_ID')->unsigned();
            $table->foreign('C_ID')->references('id')->on('client_company');
            $table->integer('B_ID')->unsigned();
            $table->foreign('B_ID')->references('id')->on('building');
            $table->integer('D_ID')->unsigned();
            $table->foreign('D_ID')->references('id')->on('department');
            $table->string('Dis_Number',10);            
            $table->datetime('Dis_Date');
            $table->string('Vrms',15);   
            $table->string('Irms',15);   
            $table->string('S',15);   
            $table->string('Q',15);   
            $table->string('PF',15);   
            $table->string('Apf',20);   
            $table->string('Apr',20);   
            $table->string('Pof',20);   
            $table->string('Por',20);   
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
        Schema::dropIfExists('ems_overview');
    }
}
