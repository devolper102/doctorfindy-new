<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payouts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('amount');
            $table->string('payment_method');
            $table->string('currency');
            $table->string('status');
            $table->text('payout_detail')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('user_id')->index('payouts_user_id_foreign');
            $table->unsignedBigInteger('order_id')->index('payouts_order_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payouts');
    }
}
