<?php

use Illuminate\Database\Seeder;
use Illuminate\Contracts\Hashing\Hasher;
use App\User;

class UserSeeder extends Seeder
{

    const ADMIN_MAIL = 'admin@example.com';
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $faker = Faker\Factory::create();
        $hasher = app(Hasher::class);

        $user = new User();
        $user->name = $faker->firstName. ' '. $faker->lastName ;
        $user->email = self::ADMIN_MAIL;
        $user->password = $hasher->make('admin');
        $user->save();
    }
}
