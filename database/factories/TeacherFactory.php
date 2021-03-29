<?php

namespace Database\Factories;
use App\Models\Teacher;
use App\Models\Student;

use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Teacher::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'tech_image' => $this->faker->image(public_path('storage\techimages'),400,300, null, false),
            ];
    }
}
