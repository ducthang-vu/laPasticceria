<?php

namespace Database\Seeders;

use App\Models\CakeType;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class CakeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        foreach (array_keys(config('seeding_data')) as $type) {
            $newCakeType = new CakeType();
            $newCakeType->name = $type;
            $newCakeType->price = $faker->numberBetween($min = 50, $max = 200) * 10;
            $newCakeType->slug = str_replace(' ', '-', $type);
            $newCakeType->image = sprintf('imagesSeeding/%s.jpg', $newCakeType->slug);
            $newCakeType->save();
        }
    }
}
