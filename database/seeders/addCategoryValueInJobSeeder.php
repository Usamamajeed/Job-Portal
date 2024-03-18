<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class addCategoryValueInJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert 'Programming' into the 'category' column for existing rows in the 'jobs' table
        DB::table('jobs')->update(['category' => 'Programming']);
    }
}
