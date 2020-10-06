<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        factory(App\IndependentCollector::class,1)->create();
        factory(App\Resident::class,1)->create();
        factory(App\User::class,2)->create();
        factory(App\LocationAddress::class,2)->create();
    }
}
