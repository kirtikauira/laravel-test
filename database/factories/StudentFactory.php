<?php

namespace Database\Factories;
use App\Models\Teacher;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'teacher_id' => Teacher::factory(),
            'stu_image' => $this->faker->image(public_path('storage\stuimages'),400,300, null, false),
            
        ];
    }
}
