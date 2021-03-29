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
        // $this->call(UsersTableSeeder::class);
        $this->call(Users::class);
        $this->call(Books::class);
        $this->call(Categories::class);
        $this->call(cities::class);
        $this->call(provinces::class);
    }
}
