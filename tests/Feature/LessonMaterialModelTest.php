<?php

namespace NadzorServera\Skijasi\Module\LMSModule\Tests\Feature;

use Tests\TestCase;
use NadzorServera\Skijasi\Module\LMSModule\Models\LessonMaterial;
use NadzorServera\Skijasi\Module\LMSModule\Models\Topic;

class LessonMaterialModelTest extends TestCase
{
    public function testDeleteTopicGivenMaterialAttachedToTheTopicExpectTopicIdSetToNull()
    {
        $topic = Topic::factory()->create();
        $lessonMaterial = LessonMaterial::factory()->create([
            'topic_id' => $topic->id,
        ]);

        $topic->delete();
        $lessonMaterial = $lessonMaterial->fresh();

        $this->assertNull($lessonMaterial->topic_id);
    }
}
