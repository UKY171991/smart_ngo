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
        // Check if the settings table exists and has 'key' column
        if (Schema::hasTable('settings') && Schema::hasColumn('settings', 'key')) {
            // Rename the 'key' column to 'setting_key' to avoid MySQL reserved word issues
            Schema::table('settings', function (Blueprint $table) {
                $table->renameColumn('key', 'setting_key');
            });
        }
        
        // If settings table doesn't exist, create it
        if (!Schema::hasTable('settings')) {
            Schema::create('settings', function (Blueprint $table) {
                $table->id();
                $table->string('setting_key')->unique();
                $table->text('value')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('settings') && Schema::hasColumn('settings', 'setting_key')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->renameColumn('setting_key', 'key');
            });
        }
    }
};
