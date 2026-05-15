<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_tests', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('lab_id');
            $table->integer('branch_id');
            $table->string('test_id', 190)->nullable();
            $table->string('full_name', 190)->nullable();
            $table->string('email', 190)->nullable();
            $table->string('city', 190)->nullable();
            $table->string('age', 190)->nullable();
            $table->string('gender', 190)->nullable();
            $table->string('phone_number', 190)->nullable();
            $table->string('date_preferred', 190)->nullable();
            $table->string('address', 190)->nullable();
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
        Schema::dropIfExists('book_tests');
    }
}
