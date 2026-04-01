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
        Schema::dropIfExists('expenses');
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('category'); // Travel, Events, Utilities, Staff, etc.
            $table->decimal('amount', 15, 2);
            $table->text('description')->nullable();
            $table->date('expense_date');
            $table->foreignId('project_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
