<?php
// database/migrations/2024_01_07_create_users_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('email')->unique();
            $table->string('password_hash');
            $table->string('full_name');
            $table->string('phone_number');
            $table->foreignId('role_id')->constrained('roles');
            $table->foreignId('position_id')->nullable()->constrained('positions');
            $table->foreignId('status_id')->constrained('status');
            $table->timestamp('last_login_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
