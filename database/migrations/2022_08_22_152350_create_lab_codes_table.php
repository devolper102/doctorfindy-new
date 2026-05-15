<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('Sr_No')->nullable();
            $table->string('CouponNumber', 200)->nullable();
            $table->string('Id_no', 200)->nullable();
            $table->string('ReferenceID', 200)->nullable();
            $table->unsignedInteger('CouponStatus')->nullable();
            $table->string('CreatedBy', 200)->nullable();
            $table->string('ModifiedBy', 200)->nullable();
            $table->string('Status', 200)->nullable();
            $table->string('CaseID', 200)->nullable();
            $table->string('expiry_date', 50)->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_codes');
    }
}
