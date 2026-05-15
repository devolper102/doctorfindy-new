<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddSlugToPharmacyMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Check if column already exists
        if (!Schema::hasColumn('pharmacy_medicines', 'slug')) {
            Schema::table('pharmacy_medicines', function (Blueprint $table) {
                $table->string('slug')->unique()->nullable()->after('name');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Check if column exists before dropping
        if (Schema::hasColumn('pharmacy_medicines', 'slug')) {
            Schema::table('pharmacy_medicines', function (Blueprint $table) {
                $table->dropColumn('slug');
            });
        }
    }
}
