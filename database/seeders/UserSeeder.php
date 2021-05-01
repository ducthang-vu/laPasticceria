<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

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
            $newUser->password = bcrypt('test');
            $newUser->save();
        }
    }
}
