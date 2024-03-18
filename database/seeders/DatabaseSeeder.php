<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategoriesTableSeeder::class,
            addCategoryValueInJobSeeder::class,
            addAnotherRowInJobsTable::class,
            // Add other seeders here if needed
        ]);
    }
}
