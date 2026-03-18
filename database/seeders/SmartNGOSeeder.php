<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SmartNGOSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // News
        \App\Models\News::create([
            'title' => 'Healthy Hearts Campaign 2026',
            'slug' => 'healthy-hearts-2026',
            'content' => 'Our latest initiative provides free heart checkups for 500+ elderly citizens in the rural areas. We are committed to better healthcare for all.',
            'created_at' => now()->subDays(2),
        ]);

        \App\Models\News::create([
            'title' => 'Women Empowerment Workshop',
            'slug' => 'women-empowerment-workshop',
            'content' => 'Successful completion of our 3-month vocational training for 50 women in tailoring and digital literacy.',
            'created_at' => now()->subDays(5),
        ]);

        // Campaigns
        \App\Models\Campaign::create([
            'title' => 'Child Education Fund',
            'slug' => 'child-education-fund',
            'description' => 'Help us provide books, uniforms, and school fees for children who cannot afford basic education.',
            'goal_amount' => 1000000,
            'current_amount' => 450000,
            'start_date' => now(),
            'end_date' => now()->addMonths(3),
        ]);

        \App\Models\Campaign::create([
            'title' => 'Clean Water Initiative',
            'slug' => 'clean-water-initiative',
            'description' => 'Installing solar-powered water pumps in dry regions to ensure 24/7 access to clean drinking water.',
            'goal_amount' => 500000,
            'current_amount' => 120000,
            'start_date' => now(),
            'end_date' => now()->addMonths(2),
        ]);

        // Events
        \App\Models\Event::create([
            'title' => 'Annual NGO Meet 2026',
            'slug' => 'annual-meet-2026',
            'description' => 'A gathering of all members and volunteers to discuss our impact and future goals.',
            'event_date' => now()->addDays(15),
            'location' => 'Community Hall, Sector 4',
            'fees' => 0,
        ]);

        // Projects
        \App\Models\Project::create([
            'title' => 'Solar Rural Lights',
            'description' => 'Lighting up 10 villages with sustainable solar energy.',
            'budget' => 2000000,
            'spent' => 1500000,
            'status' => 'ongoing',
        ]);

        // Members
        $admin = \App\Models\User::where('role', 'admin')->first();
        if ($admin) {
            \App\Models\Activity::create([
                'user_id' => $admin->id,
                'caption' => 'Excited to announce our new partnership with local schools!',
                'created_at' => now()->subHours(5),
            ]);
            
            \App\Models\Activity::create([
                'user_id' => $admin->id,
                'caption' => 'The Health Camp was a huge success. Thanks to all volunteers.',
                'created_at' => now()->subDay(),
            ]);
        }

        // Dummy Donations
        if ($admin) {
            \App\Models\Donation::create([
                'user_id' => $admin->id,
                'donor_name' => 'John Doe',
                'donor_email' => 'john@example.com',
                'amount' => 5000,
                'payment_method' => 'online',
                'receipt_number' => 'REC-DUMMY-1',
                'status' => 'completed',
                'campaign_id' => 1,
            ]);
        }
    }
}
