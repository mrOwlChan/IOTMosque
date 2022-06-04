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
            
            $table->boolean('enablestatus')->default(true);
            $table->string('photo')->nullable();
            $table->string('telp')->nullable();
            $table->date('birth')->nullable();
            $table->string('address')->nullable();
    
            // Foreign Key yag mengaku ke table 
            $table->foreignId('user_id');
            $table->foreignId('userlevel_id');
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
