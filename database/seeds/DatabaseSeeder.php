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

         $this->call(status::class);
        $this->call(puncheType::class);
        $this->call(shiftType::class);
    }
}
