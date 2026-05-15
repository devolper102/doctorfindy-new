<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToArticleCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('article_category', function (Blueprint $table) {
        // Convert article_id and category_id to BIGINT
        $table->unsignedBigInteger('article_id')->change();
        $table->unsignedBigInteger('category_id')->change();

        // Add foreign key for article_id referencing articles table
        $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');

        // Add foreign key for category_id referencing categories table
        $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('article_category', function (Blueprint $table) {
            //
        });
    }
}
