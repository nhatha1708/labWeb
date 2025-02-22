<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public $categories = [
        [
            'id' => 1,
            'name' => 'Cafe',
            'description' => '',
        ],
        [
            'id' => 2,
            'name' => 'Chicken',
            'description' => '',
        ],
    ];

    private function getCategories()
    {
        return
         $this->categories;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo 1000 bản ghi ngẫu nhiên
        Category::factory(1000)->create();
        // foreach ($this->getCategories() as $category) {
        //     Category::create($category);
        // }
        // Chèn các danh mục tĩnh
        foreach ($this->getCategories() as $category) {
            Category::firstOrCreate(['name' => $category['name']], $category);
        }
    }

}
