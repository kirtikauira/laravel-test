<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TeacherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Teacher::factory()->count(10)->create(); 
    }
}
