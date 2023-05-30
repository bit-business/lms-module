<?php

namespace NadzorServera\Skijasi\Module\LMSModule\Helpers;

use NadzorServera\Skijasi\Module\LMSModule\Models\CourseUser;

class CourseUserHelper
{
    public static function isUserInCourse($userId, $courseId, $role = null)
    {
        if (! $userId || ! $courseId) {
            return false;
        }

        $courseUser = CourseUser::where('user_id', $userId)
            ->where('course_id', $courseId)
            ->first();

        if (! $courseUser) {
            return false;
        }

        if ($role !== null) {
            return $courseUser->role == $role;
        }

        return true;
    }
}
