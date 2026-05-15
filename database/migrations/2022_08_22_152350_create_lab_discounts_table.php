<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_discounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 200)->nullable();
            $table->string('phone_number', 50)->nullable();
            $table->string('code', 50)->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->string('address', 200)->nullable();
            $table->string('home_sampling', 45)->nullable();
            $table->integer('age')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_discounts');
    }
}
