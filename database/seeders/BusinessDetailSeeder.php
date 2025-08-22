<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BusinessDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('business_details')->insert([
            [
                'key' => 'address',
                'value' => '122 Kushar Khas, Mahua, Vaishali',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'phone',
                'value' => '+91 7481092465',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'hours',
                'value' => '10:00 - 18:00, Mon - Sat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'facebook',
                'value' => 'https://facebook.com/yourpage',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'twitter',
                'value' => 'https://twitter.com/yourhandle',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'instagram',
                'value' => 'https://instagram.com/yourprofile',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'youtube',
                'value' => 'https://youtube.com/yourchannel',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'copyright',
                'value' => '© copyright reserved, 2021, Ecommerce',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
