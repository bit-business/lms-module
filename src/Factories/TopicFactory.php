<?php

namespace NadzorServera\Skijasi\Module\LMSModule\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use NadzorServera\Skijasi\Module\LMSModule\Models\Course;
use NadzorServera\Skijasi\Module\LMSModule\Models\Topic;
use NadzorServera\Skijasi\Module\LMSModule\Models\User;

class TopicFactory extends Factory
{
    protected $model = Topic::class;

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
            'created_by' => User::factory(),
        ];
    }
}
