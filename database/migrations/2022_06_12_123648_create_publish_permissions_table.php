<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublishPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publish_permissions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->timestamp('publish_at')->nullable();
            $table->enum('status_permission', ['publish', 'rejected', 'idle'])->default('idle');
            $table->text('desc')->nullable();

            // Foreign Key
            $table->foreignId('article_id')->constrained();
            $table->foreignId('user_id')->constrained(); // mengacu pada $user->userlevel->level = admin

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('publish_permissions');
    }
}
