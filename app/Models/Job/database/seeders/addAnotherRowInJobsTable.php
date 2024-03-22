<?php

namespace App\Models\Job\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class addAnotherRowInJobsTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert data into the 'jobs' table
        DB::table('jobs')->insert([
            'job_title' => 'Front End Developer',
            'job_region' => 'Cairo, Cairo',
            'company' => 'Amazon',
            'job_type' => 'part time',
            'vacancy' => 2,
            'experience' => '2 to 3 year(s)',
            'salary' => '$60k - $100k',
            'gender' => 'Any',
            'application_deadline' => 'April 28, 2019',
            'jobdescription' => 'Lorem ipsum dolor sit amet. Ut natus dolorem quo ipsa dolorum est ullam dolore a quis repellat qui accusamus odit! Est nulla obcaecati et aliquam veniam et reiciendis harum sed Quis fuga',
            'responsibilities' => 'Est nulla obcaecati et aliquam veniam et reiciendis harum sed Quis fuga',
            'education_experience' => 'Est nulla obcaecati et aliquam veniam et reiciendis harum sed Quis fuga',
            'otherbenifits' => 'Est nulla obcaecati et aliquam veniam et reiciendis harum sed Quis fuga',
            'image' => 'job_logo_3.jpg',
            'category' => 'Programming',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
