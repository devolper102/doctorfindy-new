<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePharmacyMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pharmacy_medicines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('medicine_category_id')->nullable();
            $table->unsignedBigInteger('medicine_subcategory_id')->nullable();
            $table->string('name');
            $table->string('manufacturer')->nullable();
            $table->string('generic_name')->nullable();
            $table->decimal('rating', 3, 2)->default(0)->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('sale_price', 10, 2)->nullable();
            $table->string('pack_size')->nullable();
            $table->decimal('pack_price', 10, 2)->nullable();
            $table->decimal('pack_sale_price', 10, 2)->nullable();
            $table->string('status', 50)->default('active');
            $table->timestamps();
            
            $table->foreign('medicine_category_id')->references('id')->on('medicine_categories')->onDelete('set null');
            $table->foreign('medicine_subcategory_id')->references('id')->on('medicine_subcategories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pharmacy_medicines');
    }
}
