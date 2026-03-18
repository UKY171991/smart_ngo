<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('recipient_name');
            $table->string('recipient_email');
            $table->string('type'); // membership, achievement, internship, visitor
            $table->string('certificate_number')->unique();
            $table->string('qr_code_path')->nullable();
            $table->string('template_id')->default('default');
            $table->json('metadata')->nullable(); // extra data like achievement title etc.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
