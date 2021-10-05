<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Equipment;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class EquipmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Equipment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'created_at' => now(),
            'updated_at' => now(),
            'name' => $this->faker->words(3, true),
            'device_code' => Str::random(7),
            'description' => $this->faker->paragraphs(3, true),
            'price' =>$this->faker->numberBetween($min = 90000, $max = 500000),
            'quantity' => $this->faker->numberBetween($min = 50, $max = 200),
            'supplier_id'=> Supplier::inRandomOrder()->first()->id,
            'category_id'=> Category::inRandomOrder()->first()->id,
        ];
    }
}
