<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            ['name' => 'E-Commerce'],
            ['name' => 'Payment Gateway'],
            ['name' => 'CRM'],
            ['name' => 'ERP'],
            ['name' => 'Finance'],
            ['name' => 'Blog'],
            ['name' => 'OTA'],
        ];

        foreach ($projects as $project) {
            Project::updateOrCreate($project);
        }
    }
}
