<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

         \App\Models\Category::create([
             'name'=>'Earring',
         ]);
         \App\Models\Category::create([
             'name'=>'Necklace',
         ]);
         \App\Models\Category::create([
             'name'=>'Bracelet',
         ]);
         \App\Models\Category::create([
             'name'=>'Ring',
         ]);

        User::factory()->create([
            'name' => 'morty',
            'email' => 'admin@morty.net',
            'password' =>Hash::make('00225588'),
        ]);

        User::factory()->create([
            'name' => 'omar',
            'email' => 'admin@omar.net',
            'password' =>Hash::make('12345678'),
        ]);


        \App\Models\Product::factory(20)->create();
    }
}
