<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CakeType;
use App\Models\Ingredient;


class CakeTypeIngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (CakeType::all() as $cakeType) {
            $recipeList = config('seeding_data')[$cakeType->name];
            foreach($recipeList as $ingredient) {   // Each $ingredient is [name, quantity]
                $ingredientId = Ingredient::where('name', $ingredient[0])->first()->id;
                $cakeType->ingredients()->attach($ingredientId , ['quantity' => $ingredient[1]]);
            }
        }
    }
}
