<?php

namespace NadzorServera\Skijasi\Module\LMSModule\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use NadzorServera\Skijasi\Module\LMSModule\Models\LessonMaterial;
use NadzorServera\Skijasi\Module\LMSModule\Models\MaterialComment;
use NadzorServera\Skijasi\Module\LMSModule\Models\User;

class MaterialCommentFactory extends Factory
{
    protected $model = MaterialComment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'material_id' => LessonMaterial::factory(),
            'content' => $this->faker->text(),
            'created_by' => User::factory(),
        ];
    }
}
