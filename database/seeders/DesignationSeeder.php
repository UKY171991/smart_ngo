<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $designations = [
            [
                'title' => 'President',
                'fees' => 10000,
                'benefits' => 'Voting rights, priority access to events, annual recognition',
                'is_active' => true,
            ],
            [
                'title' => 'Vice President',
                'fees' => 7500,
                'benefits' => 'Voting rights, event participation, monthly newsletter',
                'is_active' => true,
            ],
            [
                'title' => 'Secretary',
                'fees' => 5000,
                'benefits' => 'Meeting participation, event coordination access',
                'is_active' => true,
            ],
            [
                'title' => 'Treasurer',
                'fees' => 5000,
                'benefits' => 'Financial oversight, budget review access',
                'is_active' => true,
            ],
            [
                'title' => 'Executive Member',
                'fees' => 3000,
                'benefits' => 'Committee participation, event discounts',
                'is_active' => true,
            ],
            [
                'title' => 'Life Member',
                'fees' => 25000,
                'benefits' => 'Lifetime voting rights, all event access, special recognition',
                'is_active' => true,
            ],
            [
                'title' => 'Annual Member',
                'fees' => 2000,
                'benefits' => 'Annual event access, newsletter subscription',
                'is_active' => true,
            ],
            [
                'title' => 'Student Member',
                'fees' => 500,
                'benefits' => 'Educational workshops, mentorship program',
                'is_active' => true,
            ],
            [
                'title' => 'Volunteer',
                'fees' => 0,
                'benefits' => 'Certificate of appreciation, training programs',
                'is_active' => true,
            ],
        ];

        foreach ($designations as $designation) {
            \App\Models\Designation::create($designation);
        }
    }
}
