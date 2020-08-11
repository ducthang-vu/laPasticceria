<?php

use Illuminate\Database\Seeder;
use App\Cake_type;
use App\Ingredient;


class Cake_typeIngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Cake_type::all() as $cakeType) {
            $recipeList = config('seeding_data')[$cakeType->name];
            foreach($recipeList as $ingredient) {   // Each $ingredient is [name, quantity]
                $ingredientId = Ingredient::where('name', $ingredient[0])->first()->id;
                $cakeType->ingredients()->attach($ingredientId , ['quantity' => $ingredient[1]]);
            }
        }
    }
}
