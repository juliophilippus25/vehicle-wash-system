<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // jalankan dengan php artisan db:seed maka seeder dari tiap kelas dibawah akan dieksekusi
        $this->call(UsersTableSeeder::class);
        $this->call(VehicleTypeSeeder::class);
    }
}
