<?php
// database/migrations/2024_01_09_create_appointments_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id('appointment_id'); // Remove ->primary(), id() already sets it as primary

            // Foreign keys
            $table->unsignedBigInteger('resident_id');
            $table->foreignId('service_id')->references('service_id')->on('services')->onDelete('cascade');
            $table->foreignId('timeslot_id')->references('timestop_id')->on('time_slots')->onDelete('cascade');
            $table->foreignId('status_id')->references('status_id')->on('status')->onDelete('cascade');

            // Appointment details
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->integer('duration_minutes');
            $table->text('purpose_notes');
            $table->string('reference_no')->unique();

            $table->timestamps();

            // Optional: Add indexes
            $table->index('appointment_date');
            $table->index('reference_no');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
