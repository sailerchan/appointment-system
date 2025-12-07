<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('residents', function (Blueprint $table) {
            // DON'T use: $table->id('resident_id');
            // INSTEAD use:
            $table->bigIncrements('resident_id'); // This creates resident_id as auto-increment PK

            $table->unsignedBigInteger('user_id');
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
