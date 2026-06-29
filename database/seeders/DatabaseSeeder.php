<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Database\Seeders\GroupSeeder;
use Database\Seeders\ClubSeeder;

class DatabaseSeeder extends Seeder
{
    
    public function run(): void
    {
        $this->call([
            GroupSeeder::class,
            ClubSeeder::class,
        ]);
    }
}