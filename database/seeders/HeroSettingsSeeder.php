<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class HeroSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $heroSettings = [
            'hero_badge' => 'REGISTERED NGO',
            'hero_title' => 'Change lives with SAMRAT FOUNDATION TRUST',
            'hero_subtitle' => 'Join our mission to create sustainable change. We bridge the gap between resources and those who need them most.',
            'cta_title' => 'Ready to spark a change?',
            'cta_description' => 'Join thousands of members who are making a real difference in the lives of those who need it most.',
            'cta_primary_button' => 'Join Us Today',
            'cta_secondary_button' => 'Contact Us',
        ];

        foreach ($heroSettings as $key => $value) {
            Setting::updateOrCreate(
                ['setting_key' => $key],
                ['value' => $value]
            );
        }
    }
}
