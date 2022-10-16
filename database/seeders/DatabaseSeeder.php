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

        \App\Models\User::factory()->create(['name' => 'Ted Bossman', 'is_owner' => true]);
        \App\Models\User::factory()->create(['name' => 'Sarah Seller']);
        \App\Models\User::factory()->create(['name' => 'Chase Indeals']);

        \App\Models\Company::factory(50)->create()->each(fn ($company) => $company->users()
            ->createMany(\App\Models\User::factory(25)->make()->map->getAttributes()));

        // // <! -- -- -- -- -- lesson-02-minimizing-memory-usage ---->

        \App\Models\User::all()
            ->each(function ($user) {
                // if (!\App\Models\User::find($user->email))
                $user->logins()->createMany(\App\Models\Login::factory(5)->make()->toArray());
                $user->posts()->createMany(\App\Models\Post::factory(5)->make()->toArray());
                $user->customer()->createMany(\App\Models\Customer::factory(25)->make()->toArray());
            });

        //// 05
        $users = \App\Models\User::get();

        \App\Models\Feature::factory(60)->create()->each(
            function ($feature) use ($users) {
                $feature->comments()->createMany(
                    \App\Models\Comment::factory(50)->make()->each(
                        function ($comment) use ($users) {
                            $comment->user_id = $users->random()->id;
                        }
                    )->toArray()
                );
            }
        );
    }
}
