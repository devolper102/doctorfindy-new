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
            $table->bigIncrements('id');
            $table->string('slug');
            $table->integer('author_id');
            $table->text('tags')->nullable();
            $table->integer('views')->nullable();
            $table->integer('likes')->nullable();
            $table->string('title');
            $table->text('description');
            $table->string('image')->nullable();
            $table->string('excerpt');
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
            $table->text('short_description')->nullable();
            $table->string('reading_time')->nullable();
            $table->string('status', 45)->nullable();
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
