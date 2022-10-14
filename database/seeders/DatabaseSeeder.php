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
        \App\Models\Company::factory(100)->create()->each(fn ($company) => $company->users()
            ->createMany(\App\Models\User::factory(50)->make()->map->getAttributes()));
    }
}
