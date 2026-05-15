<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ChangeShortDescToLongtextInUserMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Check if column exists before modifying
        if (Schema::hasColumn('user_metas', 'short_desc')) {
            // Use raw SQL to avoid Carbon date parsing issues
            DB::statement('ALTER TABLE user_metas MODIFY short_desc LONGTEXT NULL');
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Check if column exists before modifying
        if (Schema::hasColumn('user_metas', 'short_desc')) {
            // Use raw SQL to avoid Carbon date parsing issues
            DB::statement('ALTER TABLE user_metas MODIFY short_desc VARCHAR(255) NULL');
        }
    }
}
