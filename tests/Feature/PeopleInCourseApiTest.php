<?php

namespace NadzorServera\Skijasi\Module\LMSModule\Tests\Feature;

use Tests\TestCase;
use NadzorServera\Skijasi\Module\LMSModule\Models\User;
use NadzorServera\Skijasi\Module\LMSModule\Tests\Helpers\AuthHelper;

class PeopleInCourseApiTest extends TestCase
{
    public function testPeopleInCourseWithoutLoginExpectResponse401()
    {
        $url = route('skijasi.course.people', ['id' => 1]);
        $response = $this->json('GET', $url);
        $response->assertStatus(401);
    }

    public function testPeopleInCourseAsLoggedInUserWithValidDataExpectResponse200()
    {
        $user = User::factory()->create();
        $user->rawPassword = 'password';

        $url = route('skijasi.course.people', ['id' => 1]);
        $response = AuthHelper::asUser($this, $user)->json('GET', $url);
        $response->assertStatus(200);
    }
}
