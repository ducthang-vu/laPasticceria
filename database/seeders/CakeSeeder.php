<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cake;


class CakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cake::factory()->count(50)->create();
    }
}
