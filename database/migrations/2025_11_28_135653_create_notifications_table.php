<?php
// database/migrations/2024_01_10_create_notifications_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id('notification_id');

            // First: Define the columns
            $table->unsignedBigInteger('resident_id');
            $table->unsignedBigInteger('appointment_id');

            $table->text('message');
            $table->timestamp('sent_at');
            $table->boolean('is_read')->default(false);
            $table->timestamps();

            // Then: Add foreign key constraints
            $table->foreign('resident_id')->references('resident_id')->on('residents')->onDelete('cascade');
            $table->foreign('appointment_id')->references('appointment_id')->on('appointments')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
