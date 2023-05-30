<?php

namespace NadzorServera\Skijasi\Module\LMSModule\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use NadzorServera\Skijasi\Module\LMSModule\Models\Assignment;
use NadzorServera\Skijasi\Module\LMSModule\Models\Submission;
use NadzorServera\Skijasi\Module\LMSModule\Models\User;

class SubmissionFactory extends Factory
{
    protected $model = Submission::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'assignment_id' => Assignment::factory(),
            'user_id' => User::factory(),
        ];
    }
}
