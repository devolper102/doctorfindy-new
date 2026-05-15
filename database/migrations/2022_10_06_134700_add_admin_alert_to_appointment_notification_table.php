<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdminAlertToAppointmentNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appointment_notification', function (Blueprint $table) {
            $table->string('admin_alert')->default('unread');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appointment_notification', function (Blueprint $table) {
            Schema::dropIfExists('appointment_notification');
        });
    }
}
