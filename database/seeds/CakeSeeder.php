<?php

use Illuminate\Database\Seeder;

class CakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Cake::class, 75)->create();
    }
}
