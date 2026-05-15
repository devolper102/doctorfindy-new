<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('hospital_id');
            $table->integer('patient_id');
            $table->string('payment_gateway')->nullable();
            $table->string('appointment_time', 190);
            $table->string('charges', 190);
            $table->string('appointment_date')->nullable();
            $table->string('status', 190)->nullable();
            $table->string('first_name', 190)->nullable();
            $table->string('last_name', 190)->nullable();
            $table->string('patient_name', 190)->nullable();
            $table->string('relation_you', 190)->nullable();
            $table->text('commants')->nullable();
            $table->timestamps();
            $table->integer('appointment_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
