<?php
// database/migrations/2024_01_11_create_service_demands_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('service_demands', function (Blueprint $table) {
            $table->id('demand_id');
            $table->foreignId('service_id')->constrained('services');
            $table->integer('request_count');
            $table->decimal('percentage', 5, 2);
            $table->integer('ranking');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_demands');
    }
};
