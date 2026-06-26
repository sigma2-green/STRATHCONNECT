<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Club;

class ClubSeeder extends Seeder
{
    public function run(): void
    {
        $clubs = [

            [
                'name' => 'Christian Union',
                'category' => 'Religious',
                'status' => 'approved',
            ],

            [
                'name' => 'Catholic Action',
                'category' => 'Religious',
                'status' => 'approved',
            ],

            [
                'name' => 'Debate Society',
                'category' => 'Academic',
                'status' => 'approved',
            ],

            [
                'name' => 'Rotaract Club',
                'category' => 'Community Service',
                'status' => 'approved',
            ],

            [
                'name' => 'Robotics Club',
                'category' => 'Technology',
                'status' => 'approved',
            ],

            [
                'name' => 'AIESEC',
                'category' => 'Leadership',
                'status' => 'approved',
            ],

            [
                'name' => 'Music Club',
                'category' => 'Arts',
                'status' => 'approved',
            ],

            [
                'name' => 'Drama Club',
                'category' => 'Arts',
                'status' => 'approved',
            ],

            [
                'name' => 'Photography Club',
                'category' => 'Media',
                'status' => 'approved',
            ],

            [
                'name' => 'Environmental Club',
                'category' => 'Environment',
                'status' => 'approved',
            ],

            [
                'name'=> 'Dance Club',
                'category' => 'Arts',
                'status' => 'approved',
    
            ],

            [
                'name'=> 'Sports Club',
                'category' => 'Sports',
                'status' => 'approved',
    
            ],

            [
                'name'=> 'Entrepreneurship Club',
                'category' => 'Business',
                'status' => 'approved',
    
            ],

            [
                'name'=> 'Coding Club',
                'category' => 'Technology',
                'status' => 'approved',
    
            ],
        ];

        foreach ($clubs as $club) {
            Club::firstOrCreate(
                ['name' => $club['name']],
                $club
            );
        }
    }
}
