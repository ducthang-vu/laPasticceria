<?php

namespace Database\Factories;

use App\Models\Cake;
use App\Models\CakeType;
use Illuminate\Database\Eloquent\Factories\Factory;

class CakeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cake::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $days = $this->faker->boolean(85) ? '1' : '4';
        return [
            'cake_type_id' => CakeType::all()->random()->id,
            'created_at' => $this->faker->dateTimeInInterval($startDate = '-' . $days . ' days', $interval = '+' . $days . ' days')
        ];
    }
}
