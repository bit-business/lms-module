<?php

use Illuminate\Support\Facades\Route;
use NadzorServera\Skijasi\Middleware\ApiRequest;
use NadzorServera\Skijasi\Middleware\SkijasiAuthenticate;
use NadzorServera\Skijasi\Module\LMSModule\Helpers\Route as HelpersRoute;

$api_route_prefix = config('Skijasi.api_route_prefix', 'skijasi-api');

Route::group(['prefix' => $api_route_prefix, 'as' => 'skijasi.', 'middleware' => [ApiRequest::class]], function () {
    Route::group(['prefix' => 'module/lms/v1'], function () {
        Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
            Route::post('/login', HelpersRoute::getController('AuthController@login'))
                ->name('login');

            Route::post('/register', HelpersRoute::getController('AuthController@register'))
                ->name('register');
        });

        Route::group(['prefix' => 'course', 'as' => 'course.'], function () {
            Route::post('/', HelpersRoute::getController('CourseController@add'))
                ->middleware(SkijasiAuthenticate::class)
                ->name('add');

            Route::post('/join', HelpersRoute::getController('CourseController@join'))
                ->middleware(SkijasiAuthenticate::class)
                ->name('join');

            Route::get('/{id}', HelpersRoute::getController('CourseController@detail'))
                ->middleware(SkijasiAuthenticate::class)
                ->name('detail');

            Route::get('/{id}/people', HelpersRoute::getController('CourseController@people'))
                ->middleware(SkijasiAuthenticate::class)
                ->name('people');

            Route::get('/', HelpersRoute::getController('CourseController@view'))
                ->middleware(SkijasiAuthenticate::class)
                ->name('view');
        });

        Route::group(['prefix' => 'announcement', 'as' => 'announcement.'], function () {
            Route::post('/', HelpersRoute::getController('AnnouncementController@add'))
                ->middleware(SkijasiAuthenticate::class)
                ->name('add');

            Route::get('/', HelpersRoute::getController('AnnouncementController@browse'))
                ->middleware(SkijasiAuthenticate::class)
                ->name('browse');

            Route::put('/{id}', HelpersRoute::getController('AnnouncementController@edit'))
                ->middleware(SkijasiAuthenticate::class)
                ->name('edit');

            Route::delete('/{id}', HelpersRoute::getController('AnnouncementController@delete'))
                ->middleware(SkijasiAuthenticate::class)
                ->name('delete');
        });

        Route::group(['prefix' => 'comment', 'as' => 'comment.'], function () {
            Route::post('/', HelpersRoute::getController('CommentController@add'))
                ->middleware(SkijasiAuthenticate::class)
                ->name('add');

            Route::put('/{id}', HelpersRoute::getController('CommentController@edit'))
                ->middleware(SkijasiAuthenticate::class)
                ->name('edit');

            Route::delete('/{id}', HelpersRoute::getController('CommentController@delete'))
                ->middleware(SkijasiAuthenticate::class)
                ->name('delete');
        });

        Route::group(['prefix' => 'topic', 'as' => 'topic.'], function () {
            Route::post('/', HelpersRoute::getController('TopicController@add'))
                ->middleware(SkijasiAuthenticate::class)
                ->name('add');

            Route::get('/', HelpersRoute::getController('TopicController@browse'))
                ->middleware(SkijasiAuthenticate::class)
                ->name('browse');

            Route::put('/{id}', HelpersRoute::getController('TopicController@edit'))
                ->middleware(SkijasiAuthenticate::class)
                ->name('edit');

            Route::delete('/{id}', HelpersRoute::getController('TopicController@delete'))
                ->middleware(SkijasiAuthenticate::class)
                ->name('delete');
        });

        Route::group(['prefix' => 'lesson-material', 'as' => 'lesson_material.'], function () {
            Route::post('/', HelpersRoute::getController('LessonMaterialController@add'))
                ->middleware(SkijasiAuthenticate::class)
                ->name('add');

            Route::get('/{id}', HelpersRoute::getController('LessonMaterialController@read'))
                ->middleware(SkijasiAuthenticate::class)
                ->name('read');

            Route::put('/{id}', HelpersRoute::getController('LessonMaterialController@edit'))
                ->middleware(SkijasiAuthenticate::class)
                ->name('edit');

            Route::delete('/{id}', HelpersRoute::getController('LessonMaterialController@delete'))
                ->middleware(SkijasiAuthenticate::class)
                ->name('delete');
        });

        Route::group(['prefix' => 'material-comment', 'as' => 'material_comment.'], function () {
            Route::post('/', HelpersRoute::getController('MaterialCommentController@add'))
                ->middleware(SkijasiAuthenticate::class)
                ->name('add');

            Route::put('/{id}', HelpersRoute::getController('MaterialCommentController@edit'))
                ->middleware(SkijasiAuthenticate::class)
                ->name('edit');

            Route::delete('/{id}', HelpersRoute::getController('MaterialCommentController@delete'))
                ->middleware(SkijasiAuthenticate::class)
                ->name('delete');
        });

        Route::group(['prefix' => 'file', 'as' => 'file.'], function () {
            Route::post('/upload', HelpersRoute::getController('FileController@upload'))
                ->middleware(SkijasiAuthenticate::class)
                ->name('upload');

            Route::delete('/{fileName}', HelpersRoute::getController('FileController@delete'))
                ->middleware(SkijasiAuthenticate::class)
                ->name('delete');
        });

        Route::group(['prefix' => 'quiz', 'as' => 'quiz.'], function () {
            Route::post('/', HelpersRoute::getController('QuizController@add'))
                ->middleware(SkijasiAuthenticate::class)
                ->name('add');

            Route::get('/{id}', HelpersRoute::getController('QuizController@read'))
                ->middleware(SkijasiAuthenticate::class)
                ->name('read');

            Route::put('/{id}', HelpersRoute::getController('QuizController@edit'))
                ->middleware(SkijasiAuthenticate::class)
                ->name('edit');

            Route::delete('/{id}', HelpersRoute::getController('QuizController@delete'))
                ->middleware(SkijasiAuthenticate::class)
                ->name('delete');
        });

        Route::group(['prefix' => 'assignment', 'as' => 'assignment.'], function () {
            Route::post('/', HelpersRoute::getController('AssignmentController@add'))
                ->middleware(SkijasiAuthenticate::class)
                ->name('add');

            Route::get('/{id}', HelpersRoute::getController('AssignmentController@read'))
                ->middleware(SkijasiAuthenticate::class)
                ->name('read');

            Route::put('/{id}', HelpersRoute::getController('AssignmentController@edit'))
                ->middleware(SkijasiAuthenticate::class)
                ->name('edit');

            Route::delete('/{id}', HelpersRoute::getController('AssignmentController@delete'))
                ->middleware(SkijasiAuthenticate::class)
                ->name('delete');
        });

        Route::group(['prefix' => 'submission', 'as' => 'submission.'], function () {
            Route::post('/', HelpersRoute::getController('SubmissionController@add'))
                ->middleware(SkijasiAuthenticate::class)
                ->name('add');

            Route::get('/{id}', HelpersRoute::getController('SubmissionController@read'))
                ->middleware(SkijasiAuthenticate::class)
                ->name('read');

            Route::put('/{id}', HelpersRoute::getController('SubmissionController@edit'))
                ->middleware(SkijasiAuthenticate::class)
                ->name('edit');
        });
    });
});
