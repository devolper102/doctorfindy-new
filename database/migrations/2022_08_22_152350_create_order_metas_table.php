<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_metas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('meta_key');
            $table->text('meta_value');
            $table->string('metable_type');
            $table->unsignedBigInteger('metable_id');
            $table->timestamps();
            $table->integer('votes')->nullable()->default(0);

            $table->index(['metable_type', 'metable_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_metas');
    }
}
