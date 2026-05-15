<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScrappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scrappings', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('url', 255)->nullable();
            $table->string('category', 50)->nullable()->default('');
            $table->string('type', 50)->default('');
            $table->string('city', 50)->nullable()->default('');
            $table->string('uniqueid', 50)->nullable()->default('');
            $table->tinyInteger('disable')->nullable()->default(0);
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
        Schema::dropIfExists('scrappings');
    }
}
