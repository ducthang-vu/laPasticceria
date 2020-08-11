<?php

use Illuminate\Database\Seeder;
use App\Ingredient;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ingredients = [];
        foreach(config('seeding_data') as $recipe) {
            foreach($recipe as $ingredient) {
                $ingredients[] = $ingredient[0];
            }
        }
        $ingredients = array_unique($ingredients);
        sort($ingredients);

        foreach ($ingredients as $ingredient) {
            $newUser = new Ingredient();
            $newUser->name = $ingredient;
            $newUser->save();
        }
    }
}
