<?php

namespace Database\Seeders;

use App\Models\Link;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        $links = [
            'https://laravel.com',
            'https://github.com',
            'https://tailwindui.com',
            'https://livewire.laravel.com',
            'https://php.net',
        ];

        foreach ($links as $url) {
            Link::create([
                'user_id' => $user->id,
                'code' => Link::generateCode(),
                'original_url' => $url,
                'clicks' => rand(10, 500),
                'last_click' => now()->subDays(rand(0, 10)),
            ]);
        }

        // Also create some anonymous links
        Link::create([
            'user_id' => null,
            'code' => Link::generateCode(),
            'original_url' => 'https://example.com',
            'clicks' => 5,
        ]);
    }
}
