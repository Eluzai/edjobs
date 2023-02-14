<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
Use \App\Models\User;
Use \App\Models\Listing;
Use \App\Models\Company;
Use \App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(3)->create();
        // \App\Models\Company::factory(3)->create();
        // \App\Models\Listing::factory(3)->create();
        $user = User::factory()->create([
            'firstname' => 'Ebuka',
            'lastname' => 'Eluzai',
            'email' => 'eebukas9@gmail.com',
        ]);
        $company = Company::factory()->create([
            'city' => 'Jabi',
            'state' => 'Abuja',
            'user_id' => $user->id,
        ]);
        $category = Category::factory()->create([
            'title' => 'High School',
            'description' => 'Higher primary education'
        ]);
        Listing::factory()->create([
            'user_id' => $user->id,
            'company_id' => $company->id,
            'category_id' => $category->id
        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
