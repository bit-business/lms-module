<?php

namespace NadzorServera\Skijasi\Module\LMSModule\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use NadzorServera\Skijasi\Module\LMSModule\Models\Course;
use NadzorServera\Skijasi\Module\LMSModule\Models\User;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'subject' => $this->faker->name(),
            'room' => $this->faker->buildingNumber(),
            'join_code' => $this->faker->unique()->randomAscii(),
            'created_by' => User::factory(),
        ];
    }
}
