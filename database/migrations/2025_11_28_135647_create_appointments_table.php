<?php
// database/migrations/2024_01_09_create_appointments_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id('appointment_id');
            $table->foreignId('resident_id')->constrained('residents');
            $table->foreignId('service_id')->constrained('services');
            $table->foreignId('administrator_id')->constrained('users');
            $table->foreignId('timestop_id')->constrained('time_slots');
            $table->foreignId('status_id')->constrained('status');
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->integer('duration_minutes');
            $table->text('purpose_notes');
            $table->string('reference_no')->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
