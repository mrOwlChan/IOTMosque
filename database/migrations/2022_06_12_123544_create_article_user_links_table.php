<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleUserLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_user_links', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            // Foreign Key
            $table->foreignId('article_id')->constrained();
            $table->foreignId('user_id')->constrained(); // mengacu pada $user->userlevel->level = editor

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_user_links');
    }
}
