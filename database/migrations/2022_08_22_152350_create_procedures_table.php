<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProceduresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procedures', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('title', 190)->nullable();
            $table->string('fee', 190)->nullable();
            $table->timestamps();
            $table->string('color', 45)->nullable();
            $table->string('image', 45)->nullable();
            $table->text('description')->nullable();
            $table->text('details')->nullable();
            $table->string('top', 190)->nullable();
            $table->string('slug', 45)->nullable();
            $table->string('meta_key')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('intro_procedure')->nullable();
            $table->text('faq_procedure')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('procedures');
    }
}
