<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userdetails', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->boolean('enablestatus')->default(1);
            $table->string('telp')->nullable();
            $table->string('address')->nullable();
            $table->date('birth')->nullable();
            $table->string('photo')->nullable();

            // Foreign Key
            $table->foreignId('user_id')->constrained(); // Reference ke table users
            $table->foreignId('userlevel_id')->constrained(); //Reference ke table userlevels

            // Cara lain membuat Foreign Key
            // $table->unsignedBigInteger('user_id');
            // $table->unsignedBigInteger('userlevel_id');
            // $table->foreign('user_id')->references('id')->on('users'); 
            // $table->foreign('userlevel_id')->references('id')->on('userlevels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('userdetails');
    }
}
