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
            $table->foreignId('resident_id')->constrained('residents');
            $table->foreignId('appointment_id')->constrained('appointments');
            $table->text('message');
            $table->timestamp('sent_at');
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
