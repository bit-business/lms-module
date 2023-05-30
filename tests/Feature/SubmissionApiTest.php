<?php

namespace NadzorServera\Skijasi\Module\LMSModule\Tests\Feature;

use Tests\TestCase;
use NadzorServera\Skijasi\Module\LMSModule\Enums\CourseUserRole;
use NadzorServera\Skijasi\Module\LMSModule\Models\Assignment;
use NadzorServera\Skijasi\Module\LMSModule\Models\Course;
use NadzorServera\Skijasi\Module\LMSModule\Models\Submission;
use NadzorServera\Skijasi\Module\LMSModule\Models\User;
use NadzorServera\Skijasi\Module\LMSModule\Tests\Helpers\AuthHelper;

class SubmissionApiTest extends TestCase
{
    public function testSubmissionWithoutLogin()
    {
        $url = route('skijasi.submission.add');
        $response = $this->json('POST', $url);
        $response->assertStatus(401);
    }

    public function testSubmissionWithoutAsssignment()
    {
        $url = route('skijasi.submission.add');
        $user = User::factory()->create();
        $user->rawPassword = 'password';

        $response = AuthHelper::asUser($this, $user)->json('POST', $url, [
            'assignment_id' => 1,
        ]);

        $response->assertStatus(400);
    }

    public function testSubmissionWithoutUserInCourse()
    {
        $url = route('skijasi.submission.add');

        $user = User::factory()->create();
        $user->rawPassword = 'password';

        $assignment = Assignment::factory()
            ->create();

        $response = AuthHelper::asUser($this, $user)->json('POST', $url, [
            'assignment_id' => $assignment->id,
        ]);

        $response->assertStatus(400);
    }

    public function testSubmissionPassDueDate()
    {
        $url = route('skijasi.submission.add');

        $user = User::factory()->create();
        $user->rawPassword = 'password';

        $course = Course::factory()
            ->hasAttached($user, ['role' => CourseUserRole::STUDENT])
            ->create();

        $assignment = Assignment::factory()
            ->for($course)
            ->create([
                'due_date' => '2022-05-10 23:55:00+07:00',
            ]);

        $response = AuthHelper::asUser($this, $user)->json('POST', $url, [
            'assignment_id' => $assignment->id,
        ]);

        $response->assertStatus(400);
    }

    public function testSubmissionWithExistingSubmission()
    {
        $url = route('skijasi.submission.add');

        $user = User::factory()->create();
        $user->rawPassword = 'password';

        $course = Course::factory()
            ->hasAttached($user, ['role' => CourseUserRole::STUDENT])
            ->create();

        $assignment = Assignment::factory()
            ->for($course)
            ->create();

        Submission::factory()
            ->for($user)
            ->create();

        $response = AuthHelper::asUser($this, $user)->json('POST', $url, [
            'assignment_id' => $assignment->id,
        ]);

        $response->assertStatus(400);
    }

    public function testSubmissionSuccess()
    {
        $url = route('skijasi.submission.add');

        $user = User::factory()->create();
        $user->rawPassword = 'password';

        $course = Course::factory()
            ->hasAttached($user, ['role' => CourseUserRole::STUDENT])
            ->create();

        $assignment = Assignment::factory()
            ->for($course)
            ->create([
                'due_date' => '2122-05-10 23:55:00+07:00',
            ]);

        $response = AuthHelper::asUser($this, $user)->json('POST', $url, [
            'assignment_id' => $assignment->id,
        ]);

        $submissionData = $response->json('data');

        $this->assertEquals(1, Submission::count());
        $this->assertArrayHasKey('id', $submissionData);
        $this->assertEquals($submissionData['assignmentId'], $assignment->id);
        $this->assertEquals($submissionData['userId'], $user->id);
    }

    public function testReadSubmissionWithoutLogin()
    {
        $url = route('skijasi.submission.read', ['id' => 1]);
        $response = $this->json('GET', $url);
        $response->assertStatus(401);
    }

    public function testReadSubmissionButNotExisted()
    {
        $url = route('skijasi.submission.read', ['id' => 1]);
        $user = User::factory()->create();
        $user->rawPassword = 'password';

        $response = AuthHelper::asUser($this, $user)->json('GET', $url);

        $data = $response->json('data');

        $response->assertStatus(200);
        $this->assertEquals($data['status'], 'no submission');
    }

    public function testReadSubmissionSuccess()
    {
        $user = User::factory()->create();
        $user->rawPassword = 'password';

        $course = Course::factory()
            ->hasAttached($user, ['role' => CourseUserRole::STUDENT])
            ->create();

        $assignment = Assignment::factory()
            ->for($course)
            ->create();

        $submission = Submission::factory()
            ->for($assignment)
            ->for($user)
            ->create();

        $url = route('skijasi.submission.read', ['id' => $assignment->id]);

        $response = AuthHelper::asUser($this, $user)->json('GET', $url);

        $data = $response->json('data');
        $response->assertStatus(200);
        $this->assertEquals($data['status'], 'submitted');
    }

    public function testEditSubmissionWithoutLogin()
    {
        $url = route('skijasi.submission.edit', ['id' => 1]);
        $response = $this->json('GET', $url);
        $response->assertStatus(401);
    }

    public function testEditSubmissionWithoutExisting()
    {
        $url = route('skijasi.submission.edit', ['id' => 1]);
        $user = User::factory()->create();
        $user->rawPassword = 'password';

        $response = AuthHelper::asUser($this, $user)->json('PUT', $url);
        $response->assertStatus(400);
    }

    public function testEditSubmissionWithoutUserInCourse()
    {
        $user = User::factory()->create();
        $user->rawPassword = 'password';

        $submission = Submission::factory()
            ->for($user)
            ->create();

        $url = route('skijasi.submission.edit', ['id' => $submission->id]);

        $response = AuthHelper::asUser($this, $user)->json('PUT', $url);

        $response->assertStatus(400);
    }

    public function testEditSubmissionPassDueDate()
    {
        $user = User::factory()->create();
        $user->rawPassword = 'password';

        $course = Course::factory()
            ->hasAttached($user, ['role' => CourseUserRole::STUDENT])
            ->create();

        $assignment = Assignment::factory()
            ->for($course)
            ->create([
                'due_date' => '2020-05-10 23:55:00+07:00',
            ]);

        $submission = Submission::factory()
            ->for($assignment)
            ->for($user)
            ->create();

        $url = route('skijasi.submission.edit', ['id' => $submission->id]);

        $response = AuthHelper::asUser($this, $user)->json('PUT', $url, [
            'file_url' => 'www.google.com',
        ]);

        $response->assertStatus(400);
    }

    public function testEditSubmissionSuccess()
    {
        $user = User::factory()->create();
        $user->rawPassword = 'password';

        $course = Course::factory()
            ->hasAttached($user, ['role' => CourseUserRole::STUDENT])
            ->create();

        $assignment = Assignment::factory()
            ->for($course)
            ->create([
                'due_date' => '2122-05-10 23:55:00+07:00',
            ]);

        $submission = Submission::factory()
            ->for($assignment)
            ->for($user)
            ->create();

        $url = route('skijasi.submission.edit', ['id' => $submission->id]);

        $response = AuthHelper::asUser($this, $user)->json('PUT', $url, [
            'file_url' => 'www.google.com',
        ]);

        $data = $response->json('data');

        $response->assertStatus(200);
        $this->assertEquals($data['fileUrl'], 'www.google.com');
    }
}
