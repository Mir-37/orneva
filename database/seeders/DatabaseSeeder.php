<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Test User',
            'phone' => '01234567891',
            'email' => 'test@example.com',
            'role' => 'admin',
        ]);

        User::factory(10)->create();

        $this->call([
            CategorySeeder::class,
            BrandSeeder::class,
            // ProductSeeder::class,
        ]);

        Product::factory()->count(50)->create();
    }
}
