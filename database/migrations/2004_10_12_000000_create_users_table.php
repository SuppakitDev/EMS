<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Username')->unique();
            $table->string('Fname',45);
            $table->string('Lname',45);
            $table->string('Tel',10);
            $table->string('image',100)->default('nopic.jpg');
            $table->integer('CreateBy');
            $table->integer('C_ID')->unsigned();
            $table->foreign('C_ID')->references('id')->on('client_company');
            $table->integer('B_ID')->unsigned();
            $table->foreign('B_ID')->references('id')->on('building');
            $table->integer('D_ID')->unsigned();
            $table->foreign('D_ID')->references('id')->on('department');
            $table->string('email')->unique();
            $table->enum('Status', array('ADMIN','MANAGER','USER'));
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
// test pull request of vs code
