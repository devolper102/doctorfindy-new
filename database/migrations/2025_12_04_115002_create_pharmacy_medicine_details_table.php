<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePharmacyMedicineDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pharmacy_medicine_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pharmacy_medicine_id');
            $table->text('description')->nullable();
            $table->text('ingredients')->nullable();
            $table->string('drug_class')->nullable();
            $table->string('dosage_form')->nullable();
            $table->text('uses')->nullable();
            $table->text('in_case_of_overdose')->nullable();
            $table->text('missed_dose')->nullable();
            $table->text('how_to_use')->nullable();
            $table->text('when_not_to_use')->nullable();
            $table->text('side_effects')->nullable();
            $table->text('precautions_and_warnings')->nullable();
            $table->text('drug_interactions')->nullable();
            $table->text('food_interactions')->nullable();
            $table->text('storage_or_disposal')->nullable();
            $table->text('quick_tips')->nullable();
            $table->timestamps();
            
            $table->foreign('pharmacy_medicine_id')->references('id')->on('pharmacy_medicines')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pharmacy_medicine_details');
    }
}
