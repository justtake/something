<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(1)->create([
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123')
        ]);

        User::factory(1)->create([
            'email' => 'admin2@example.com',
            'password' => Hash::make('admin123')
        ]);
    }
}
