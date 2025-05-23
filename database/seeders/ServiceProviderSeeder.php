<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\ServiceProvider;
use Illuminate\Database\Seeder;

class ServiceProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory(5)->create()->each(function ($category) {
            ServiceProvider::factory(40)->create([
                'category_id' => $category->id,
            ]);
        });
    }
}
