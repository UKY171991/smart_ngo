<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Program;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programs = [
            [
                'title' => 'Education Support',
                'description' => 'Empowering underprivileged children with quality education and necessary supplies.',
                'icon' => 'fas fa-graduation-cap',
                'statistic_number' => '500+',
                'statistic_label' => 'Students Supported',
                'sort_order' => 1,
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'title' => 'Healthcare Needs',
                'description' => 'Providing accessible healthcare, medical camps, and emergency funds for the needy.',
                'icon' => 'fas fa-heartbeat',
                'statistic_number' => '2.5k+',
                'statistic_label' => 'Lives Touched',
                'sort_order' => 2,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'title' => 'Skill Development',
                'description' => 'Training youth and women with industry-relevant skills to secure a livelihood.',
                'icon' => 'fas fa-laptop-code',
                'statistic_number' => '12+',
                'statistic_label' => 'Active Programs',
                'sort_order' => 3,
                'is_featured' => false,
                'is_active' => true,
            ],
        ];

        foreach ($programs as $program) {
            Program::create($program);
        }
    }
}
