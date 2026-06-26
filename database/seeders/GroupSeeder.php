<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Group;

class GroupSeeder extends Seeder
{
    public function run(): void
    {
        $schools = [

            'SCES' => ['ICS', 'BBIT', 'CNA'],

            'SBS' => ['BCOM'],

            'SLS' => ['LAW'],

            'SHS' => ['Philosophy']

        ];

        $years = [
            '1st Year',
            '2nd Year',
            '3rd Year',
            '4th Year'
        ];

        $classes = [
            'A','B','C','D','E','F'
        ];

        foreach ($schools as $school => $courses) {

            /*
             |---------------------------------------
             | SCHOOL GROUP
             |---------------------------------------
             */

            Group::firstOrCreate([
                'type' => 'school',
                'school' => $school,
            ], [
                'name' => $school,
            ]);

            foreach ($courses as $course) {

                /*
                 |---------------------------------------
                 | COURSE GROUP
                 |---------------------------------------
                 */

                Group::firstOrCreate([
                    'type' => 'course',
                    'school' => $school,
                    'course' => $course,
                ], [
                    'name' => "$school-$course",
                ]);

                foreach ($years as $year) {

                    /*
                     |---------------------------------------
                     | YEAR GROUP
                     |---------------------------------------
                     */

                    Group::firstOrCreate([
                        'type' => 'year',
                        'school' => $school,
                        'course' => $course,
                        'year_level' => $year,
                    ], [
                        'name' => "$school-$course-$year",
                    ]);

                    foreach ($classes as $class) {

                        /*
                         |---------------------------------------
                         | CLASS GROUP
                         |---------------------------------------
                         */

                        Group::firstOrCreate([
                            'type' => 'class',
                            'school' => $school,
                            'course' => $course,
                            'year_level' => $year,
                            'class_group' => $class,
                        ], [
                            'name' => "$school-$course-$year-$class",
                        ]);
                    }
                }
            }
        }
    }
}