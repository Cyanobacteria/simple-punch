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
        $this->call(punchRecords::class);
        $this->call(users::class);
        $this->call(status::class);
        $this->call(punchType::class);
        $this->call(shiftType::class);
        $this->call(punchResult::class);
    }
}
