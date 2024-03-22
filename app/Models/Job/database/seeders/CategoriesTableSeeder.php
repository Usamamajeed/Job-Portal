<?php

namespace App\Models\Job\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Programming', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Design', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}
