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
        //<!------  lesson-01-measuring-your-database-performance ----->

        \App\Models\Company::factory(100)->create()->each(fn ($company) => $company->users()
            ->createMany(\App\Models\User::factory(50)->make()->map->getAttributes()));

        // <!---------- lesson-02-minimizing-memory-usage ---->

        // \App\Models\User::factory(20)->create()
        //     ->each(function ($user) {
        //         if (!\App\Models\User::find($user->email))
        //             $user->posts()->createMany(\App\Models\Post::factory(5)->make()->toArray());
        //     });

        \App\Models\User::all()
            ->each(function ($user) {
                // if (!\App\Models\User::find($user->email))
                $user->logins()->createMany(\App\Models\Login::factory(5)->make()->toArray());
                $user->posts()->createMany(\App\Models\Post::factory(5)->make()->toArray());
            });
    }
}
