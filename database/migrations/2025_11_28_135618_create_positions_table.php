<?php
// database/migrations/2024_01_05_create_positions_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->id('position_id');
            $table->string('position_name');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('positions');
    }
};
