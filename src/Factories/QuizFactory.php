<?php

namespace NadzorServera\Skijasi\Module\LMSModule\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use NadzorServera\Skijasi\Module\LMSModule\Models\Course;
use NadzorServera\Skijasi\Module\LMSModule\Models\Quiz;
use NadzorServera\Skijasi\Module\LMSModule\Models\User;

class QuizFactory extends Factory
{
    protected $model = Quiz::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'course_id' => Course::factory(),
            'title' => $this->faker->text(),
            'link_url' => $this->faker->text(),
            'created_by' => User::factory(),
        ];
    }
}
