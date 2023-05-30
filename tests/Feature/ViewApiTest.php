<?php

namespace NadzorServera\Skijasi\Module\LMSModule\Tests\Feature;

use Tests\TestCase;
use NadzorServera\Skijasi\Module\LMSModule\Models\User;
use NadzorServera\Skijasi\Module\LMSModule\Tests\Helpers\AuthHelper;

class ViewApiTest extends TestCase
{
    public function testViewCourseWithoutLoginExpectResponse401()
    {
        $url = route('skijasi.course.view');
        $response = $this->json('GET', $url);
        $response->assertStatus(401);
    }

    public function testViewCourseAsLoggedInUserWithValidDataExpectResponse200()
    {
        $user = User::factory()->create();
        $user->rawPassword = 'password';

        $url = route('skijasi.course.view');
        $response = AuthHelper::asUser($this, $user)->json('GET', $url);
        $response->assertStatus(200);
    }
}
