<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmsInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ems_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('C_ID')->unsigned();
            $table->foreign('C_ID')->references('id')->on('client_company');
            $table->integer('B_ID')->unsigned();
            $table->foreign('B_ID')->references('id')->on('building');
            $table->integer('D_ID')->unsigned();
            $table->foreign('D_ID')->references('id')->on('department');
            $table->string('Dis_Number',10);
            $table->datetime('Dis_Date');            
            $table->string('ID1',5);            
            $table->string('Ln1',10);            
            $table->string('Cs1',10);            
            $table->string('Ec1',10);            
            $table->string('Fm1',15);            
            $table->string('Vrms1',15);            
            $table->string('Irms1',15);            
            $table->string('S1',15);            
            $table->string('Q1',15);            
            $table->string('PF1',15);            
            $table->string('Apf1',20);            
            $table->string('Apr1',20);            
            $table->string('Pof1',20);            
            $table->string('Por1',20);

            $table->string('ID2',5);            
            $table->string('Ln2',10);            
            $table->string('Cs2',10);            
            $table->string('Ec2',10);            
            $table->string('Fm2',15);            
            $table->string('Vrms2',15);            
            $table->string('Irms2',15);            
            $table->string('S2',15);            
            $table->string('Q2',15);            
            $table->string('PF2',15);            
            $table->string('Apf2',20);            
            $table->string('Apr2',20);            
            $table->string('Pof2',20);            
            $table->string('Por2',20);
            
            $table->string('ID3',5);            
            $table->string('Ln3',10);            
            $table->string('Cs3',10);            
            $table->string('Ec3',10);            
            $table->string('Fm3',15);            
            $table->string('Vrms3',15);            
            $table->string('Irms3',15);            
            $table->string('S3',15);            
            $table->string('Q3',15);            
            $table->string('PF3',15);            
            $table->string('Apf3',20);            
            $table->string('Apr3',20);            
            $table->string('Pof3',20);            
            $table->string('Por3',20);

            $table->string('ID4',5);            
            $table->string('Ln4',10);            
            $table->string('Cs4',10);            
            $table->string('Ec4',10);            
            $table->string('Fm4',15);            
            $table->string('Vrms4',15);            
            $table->string('Irms4',15);            
            $table->string('S4',15);            
            $table->string('Q4',15);            
            $table->string('PF4',15);            
            $table->string('Apf4',20);            
            $table->string('Apr4',20);            
            $table->string('Pof4',20);            
            $table->string('Por4',20);
            
            $table->string('ID5',5);            
            $table->string('Ln5',10);            
            $table->string('Cs5',10);            
            $table->string('Ec5',10);            
            $table->string('Fm5',15);            
            $table->string('Vrms5',15);            
            $table->string('Irms5',15);            
            $table->string('S5',15);            
            $table->string('Q5',15);            
            $table->string('PF5',15);            
            $table->string('Apf5',20);            
            $table->string('Apr5',20);            
            $table->string('Pof5',20);            
            $table->string('Por5',20);

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
        Schema::dropIfExists('ems_info');
    }
}
