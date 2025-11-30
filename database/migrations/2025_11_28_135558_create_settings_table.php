<?php
// database/migrations/2024_01_02_create_settings_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id('settings_id');
            $table->string('barangay_name');
            $table->text('barangay_address');
            $table->string('barangay_agtain');
            $table->string('contact_number');
            $table->time('office_hour_start');
            $table->time('office_hours_end');
            $table->json('office_days');
            $table->integer('max_daily_appointments');
            $table->integer('appointment_duration');
            $table->boolean('email_notifications')->default(true);
            $table->boolean('sms_notifications')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
