<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('title')->unique();
            $table->string('subtitle')->nullable();
            $table->string('excerpt');
            $table->string('slug')->unique();
            $table->text('body');
            $table->boolean('statusenable')->default(1);

            // Foreign Key
            $table->foreignId('category_id')->constrained();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
