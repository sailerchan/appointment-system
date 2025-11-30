<?php
// database/migrations/2024_01_08_create_residents_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->id('resident_id');
            $table->foreignId('user_id')->constrained('users');
            $table->string('full_name');
            $table->string('email_address');
            $table->string('phone_number');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('residents');
    }
};
