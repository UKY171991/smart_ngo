<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Create admin user only if not exists
        if (!User::where('email', 'admin@smartngo.org')->exists()) {
            User::factory()->create([
                'name' => 'Admin User',
                'email' => 'admin@smartngo.org',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'status' => 'active',
                'phone' => '9876543210'
            ]);
        }

        // Call SmartNGOSeeder for additional data
        $this->call(SmartNGOSeeder::class);
        $this->call(DesignationSeeder::class);
    }
}
