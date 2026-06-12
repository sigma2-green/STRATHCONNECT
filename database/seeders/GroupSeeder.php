<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Group;

class GroupSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'SCES' => ['ICS', 'BBIT', 'CNA'],
            'SBS'  => ['BCOM'],
            'SLS'  => ['LAW'],
            'SHS'  => ['Philosophy'],
        ];

        $years = ['1st Year', '2nd Year', '3rd Year', '4th Year'];
        $letters = ['A', 'B', 'C', 'D', 'E', 'F'];

        foreach ($data as $school => $courses) {
            foreach ($courses as $course) {
                foreach ($years as $year) {
                    foreach ($letters as $letter) {

                        Group::create([
                            'name' => "{$school}-{$course}-{$year}-{$letter}",
                            'type' => 'class',
                            'school' => $school,
                            'course' => $course,
                            'year_level' => $year,
                            'student_group' => $letter,
                        ]);

                    }
                }
            }
        }
    }
}
