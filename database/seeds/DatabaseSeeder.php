<?php

use App\Cake_type;
use App\Ingredient;
use Illuminate\Database\Seeder;

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
            UserSeeder::class,
            IngredientSeeder::class,
            Cake_typeSeeder::class,
            Cake_typeIngredientSeeder::class,
            CakeSeeder::class,
        ]);
    }
}
