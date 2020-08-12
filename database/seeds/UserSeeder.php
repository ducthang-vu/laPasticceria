<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (['Luana', 'Maria'] as $name) {
            $newUser = new User();
            $newUser->name = $name;
            $newUser->email = strtolower($name) . '@mail.com';
            $newUser->password = bcrypt('prova');
            $newUser->save();
        }
    }
}
