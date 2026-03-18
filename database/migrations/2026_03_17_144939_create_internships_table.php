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
        Schema::create('internships', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->date('start_date');
            $table->integer('duration_weeks');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('internship_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('internship_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('resume_path')->nullable();
            $table->string('status')->default('pending'); // pending, approved, completed, rejected
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internships');
    }
};
