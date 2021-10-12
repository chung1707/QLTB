<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Supplier;
use App\Models\Equipment;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\CategorySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
        ]);
        Supplier::factory()->count(10)->create();
        Equipment::factory()->count(30)->create();
        Area::factory()->count(10)->create();

        // \App\Models\User::factory(10)->create();
    }
}
