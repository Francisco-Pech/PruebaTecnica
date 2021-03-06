<?php

namespace Database\Seeders;

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
        $this->call([
            UserSeeder::class,
            CompanySeeder::class,
            BranchofficeSeeder::class,
            AppointmentSeeder::class,
            RegisterbranchofficesSeeder::class,
            RegistercompanySeeder::class,
            RegisterappointmentSeeder::class
        ]);
    }
}
