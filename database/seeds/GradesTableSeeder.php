<?php

use Illuminate\Database\Seeder;

use App\Grade;

class GradesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($year = 5; $year <= 12; $year ++) {
          for($class_name = 1; $class_name <= 3; $class_name ++) {
            Grade::create([
              'year' => $year,
              'class_name' => $class_name,
            ]);
          }
        }
    }
}
