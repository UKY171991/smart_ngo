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
        // Settings - only insert if not exists
        $settings = [
            'site_name' => 'Smart NGO',
            'site_email' => 'info@smartngo.org',
            'site_phone' => '+91-9876543210',
            'site_address' => '123 NGO Street, City - 123456',
            'donation_receipt_prefix' => 'DON-',
            'tax_exemption_number' => '80G-123456789',
            'social_facebook' => 'https://facebook.com/smartngo',
            'social_twitter' => 'https://twitter.com/smartngo',
            'social_instagram' => 'https://instagram.com/smartngo',
            'about_us' => 'Smart NGO is dedicated to making a positive impact in communities through education, healthcare, and social welfare initiatives.',
            'contact_email' => 'contact@smartngo.org',
            'donation_email' => 'donate@smartngo.org',
            'volunteer_email' => 'volunteer@smartngo.org'
        ];

        foreach ($settings as $key => $value) {
            \App\Models\Setting::setValue($key, $value);
        }

        // News - only insert if not exists
        if (!\App\Models\News::where('slug', 'healthy-hearts-2026')->exists()) {
            \App\Models\News::create([
                'title' => 'Healthy Hearts Campaign 2026',
                'slug' => 'healthy-hearts-2026',
                'content' => 'Our latest initiative provides free heart checkups for 500+ elderly citizens in the rural areas. We are committed to better healthcare for all.',
                'created_at' => now()->subDays(2),
            ]);
        }

        if (!\App\Models\News::where('slug', 'women-empowerment-workshop')->exists()) {
            \App\Models\News::create([
                'title' => 'Women Empowerment Workshop',
                'slug' => 'women-empowerment-workshop',
                'content' => 'Successful completion of our 3-month vocational training for 50 women in tailoring and digital literacy.',
                'created_at' => now()->subDays(5),
            ]);
        }

        // Campaigns - only insert if not exists
        if (!\App\Models\Campaign::where('slug', 'child-education-fund')->exists()) {
            \App\Models\Campaign::create([
                'title' => 'Child Education Fund',
                'slug' => 'child-education-fund',
                'description' => 'Help us provide books, uniforms, and school fees for children who cannot afford basic education.',
                'goal_amount' => 1000000,
                'current_amount' => 450000,
                'start_date' => now(),
                'end_date' => now()->addMonths(3),
            ]);
        }

        if (!\App\Models\Campaign::where('slug', 'clean-water-initiative')->exists()) {
            \App\Models\Campaign::create([
                'title' => 'Clean Water Initiative',
                'slug' => 'clean-water-initiative',
                'description' => 'Installing solar-powered water pumps in dry regions to ensure 24/7 access to clean drinking water.',
                'goal_amount' => 500000,
                'current_amount' => 120000,
                'start_date' => now(),
                'end_date' => now()->addMonths(2),
            ]);
        }

        // Events - only insert if not exists
        if (!\App\Models\Event::where('slug', 'annual-meet-2026')->exists()) {
            \App\Models\Event::create([
                'title' => 'Annual NGO Meet 2026',
                'slug' => 'annual-meet-2026',
                'description' => 'A gathering of all members and volunteers to discuss our impact and future goals.',
                'event_date' => now()->addDays(15),
                'location' => 'Community Hall, Sector 4',
                'fees' => 0,
            ]);
        }

        // Projects - only insert if not exists
        if (!\App\Models\Project::where('title', 'Solar Rural Lights')->exists()) {
            \App\Models\Project::create([
                'title' => 'Solar Rural Lights',
                'description' => 'Lighting up 10 villages with sustainable solar energy.',
                'budget' => 2000000,
                'spent' => 1500000,
                'status' => 'ongoing',
            ]);
        }

        // Members
        $admin = \App\Models\User::where('role', 'admin')->first();
        if ($admin) {
            // Activities - only insert if not exists
            if (!\App\Models\Activity::where('caption', 'Excited to announce our new partnership with local schools!')->exists()) {
                \App\Models\Activity::create([
                    'user_id' => $admin->id,
                    'caption' => 'Excited to announce our new partnership with local schools!',
                    'created_at' => now()->subHours(5),
                ]);
            }
            
            if (!\App\Models\Activity::where('caption', 'The Health Camp was a huge success. Thanks to all volunteers.')->exists()) {
                \App\Models\Activity::create([
                    'user_id' => $admin->id,
                    'caption' => 'The Health Camp was a huge success. Thanks to all volunteers.',
                    'created_at' => now()->subDay(),
                ]);
            }

            // Dummy Donations - only insert if not exists
            if (!\App\Models\Donation::where('receipt_number', 'REC-DUMMY-1')->exists()) {
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
}
