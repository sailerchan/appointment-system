<?php
// database/migrations/2024_01_03_create_status_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('status', function (Blueprint $table) {
            $table->id('status_id');
            $table->string('status_name');
            $table->enum('status_type', ['appointment', 'user', 'system']);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('status');
    }
};
