<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'category 1',
            'parent_id' => null,
        ]);

        Category::create([
            'name' => 'category 2',
            'parent_id' => '1',
        ]);
        Category::create([
            'name' => 'category 3',
            'parent_id' => null,
        ]);

        
    }
}
