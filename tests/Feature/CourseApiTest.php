<?php

namespace NadzorServera\Skijasi\Module\LMSModule\Tests\Feature;

use Tests\TestCase;
use NadzorServera\Skijasi\Module\LMSModule\Enums\CourseUserRole;
use NadzorServera\Skijasi\Module\LMSModule\Models\Course;
use NadzorServera\Skijasi\Module\LMSModule\Models\CourseUser;
use NadzorServera\Skijasi\Module\LMSModule\Models\User;
use NadzorServera\Skijasi\Module\LMSModule\Tests\Helpers\AuthHelper;

class CourseApiTest extends TestCase
{
    public function testCreateCourseWithoutLoginExpectResponse401()
    {
        $url = route('skijasi.course.add');
        $response = $this->json('POST', $url);
        $response->assertStatus(401);
    }

    public function testCreateCourseAsLoggedInUserWithValidDataExpectResponse200()
    {
        $user = User::factory()->create();
        $user->rawPassword = 'password';

        $url = route('skijasi.course.add');

        $response = AuthHelper::asUser($this, $user)->json('POST', $url, [
            'name' => 'Test course',
            'subject' => 'Test subject',
            'room' => 'Test room',
        ]);
        $response->assertStatus(200);
    }

    public function testCreateCourseAsLoggedInUserWithValidDataExpectResponseCreatedCourseWithId()
    {
        $user = User::factory()->create();
        $user->rawPassword = 'password';

        $url = route('skijasi.course.add');
        $response = AuthHelper::asUser($this, $user)->json('POST', $url, [
            'name' => 'Test course',
            'subject' => 'Test subject',
            'room' => 'Test room',
        ]);

        $courseData = $response->json('data');
        $this->assertArrayHasKey('id', $courseData);
        $this->assertNotNull($courseData['id']);
        $this->assertEquals('Test course', $courseData['name']);
        $this->assertEquals('Test subject', $courseData['subject']);
        $this->assertEquals('Test room', $courseData['room']);
    }

    public function testCreateCourseAsLoggedInUserWithValidDataExpectCourseCreated()
    {
        $user = User::factory()->create();
        $user->rawPassword = 'password';

        $courseCountBefore = Course::count();

        $url = route('skijasi.course.add');
        AuthHelper::asUser($this, $user)->json('POST', $url, [
            'name' => 'Test course',
            'subject' => 'Test subject',
            'room' => 'Test room',
        ]);

        $courseCountAfter = Course::count();
        $course = Course::first();

        $this->assertEquals(0, $courseCountBefore);
        $this->assertEquals(1, $courseCountAfter);
        $this->assertEquals('Test course', $course->name);
        $this->assertEquals('Test subject', $course->subject);
        $this->assertEquals('Test room', $course->room);
    }

    public function testCreateCourseAsLoggedInUsertWithValidDataExpectUserHasTheRoleTeacherForTheCreatedCourse()
    {
        $user = User::factory()->create();
        $user->rawPassword = 'password';

        $url = route('skijasi.course.add');
        AuthHelper::asUser($this, $user)->json('POST', $url, [
            'name' => 'Test course',
            'subject' => 'Test subject',
            'room' => 'Test room',
        ]);

        $user->fresh();
        $this->assertEquals(1, CourseUser::count());
        $this->assertEquals(1, $user->courses->count());
        $this->assertEquals(CourseUserRole::TEACHER, $user->courses->first()->pivot->role);
    }

    public function testCreateCourseAsLoggedInUserWithoutEitherNameSubjectOrRoomExpectResponse400()
    {
        $user = User::factory()->create();
        $user->rawPassword = 'password';

        $url = route('skijasi.course.add');
        $response1 = AuthHelper::asUser($this, $user)->json('POST', $url, [
            'subject' => 'Test subject',
            'room' => 'Test room',
        ]);
        $response2 = AuthHelper::asUser($this, $user)->json('POST', $url, [
            'name' => 'Test course',
            'room' => 'Test room',
        ]);
        $response3 = AuthHelper::asUser($this, $user)->json('POST', $url, [
            'name' => 'Test course',
            'subject' => 'Test subject',
        ]);

        $response1->assertStatus(400);
        $response2->assertStatus(400);
        $response3->assertStatus(400);
    }

    public function testCreateCourseAsLoggedInUserWithoutEitherNameSubjectOrRoomExpectNoCourseAndCourseUserCreated()
    {
        $user = User::factory()->create();
        $user->rawPassword = 'password';

        $url = route('skijasi.course.add');
        AuthHelper::asUser($this, $user)->json('POST', $url, [
            'subject' => 'Test subject',
            'room' => 'Test room',
        ]);
        AuthHelper::asUser($this, $user)->json('POST', $url, [
            'name' => 'Test course',
            'room' => 'Test room',
        ]);
        AuthHelper::asUser($this, $user)->json('POST', $url, [
            'name' => 'Test course',
            'subject' => 'Test subject',
        ]);

        $this->assertEquals(0, Course::count());
        $this->assertEquals(0, CourseUser::count());
    }

    public function testCourseDetailWithoutLoginExpectResponseStatus401()
    {
        $url = route('skijasi.course.detail', ['id' => '200']);
        $response = $this->json('GET', $url);
        $response->assertStatus(401);
    }

    public function testCourseDetailAsAuthorizedUserWithUnknownIdExpectResponseStatus500()
    {
        $user = User::factory()->create();
        $user->rawPassword = 'password';

        $url = route('skijasi.course.detail', ['id' => 200]);

        $response = AuthHelper::asUser($this, $user)->json('GET', $url);
        $response->assertStatus(500);
    }

    public function testCourseDetailAsAuthorizedUserWithValidIdAsInputExpectResponseStatus200()
    {
        $user = User::factory()->create();
        $user->rawPassword = 'password';

        $course = Course::factory()
            ->hasAttached($user, ['role' => CourseUserRole::TEACHER])
            ->create();

        $url = route('skijasi.course.detail', ['id' => 1]);

        $response = AuthHelper::asUser($this, $user)->json('GET', $url);
        $response->assertStatus(200);
    }
}
