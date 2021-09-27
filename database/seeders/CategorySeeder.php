<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Đồ điện tử', 'Nội thất', 'Trang trí','Đồ ngoại thất'];
        for($i=0 ; $i < count($categories); $i++){
            Category::create([
                'name' => $categories[$i],
                'description' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                Inventore rerum illo quisquam dicta cupiditate maiores. Placeat adipisci officia rerum facilis.',
            ]);
        }
    }
}
