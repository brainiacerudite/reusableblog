<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('meta_keywords')->nullable();
            $table->string('meta_description')->nullable();
            $table->text('body');
            $table->text('image')->default('defaultpostimage.png');
            $table->string('downloadable')->nullable();
            $table->enum('status', ['DRAFT', 'PUBLISHED', 'PENDING'])->default('DRAFT');
            $table->timestamp('publish_on')->nullable();
            $table->bigInteger('reads')->unsigned()->default(0)->index();
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
        Schema::dropIfExists('posts');
    }
}
