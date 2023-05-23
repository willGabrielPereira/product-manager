<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'William Gabriel Pereira',
            'email' => 'will.gabriel.pereira@gmail.com',
            'password' => '123456789',
        ]);

        $category = \App\Models\Category::create([
            'description' => 'Placas de Vídel (GPU)',
        ]);

        \App\Models\Category::create([
            'description' => 'RTX 2060',
            'parent_id' => $category->id,
        ]);
    }
}
