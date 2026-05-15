<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_teams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('full_name');
            $table->string('slug');
            $table->text('designation')->nullable();
            $table->integer('details')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_teams');
    }
}
