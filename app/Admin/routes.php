<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('students', StudentController::class);
    $router->resource('users', UserController::class);
    $router->resource('courses', CourseController::class);
    $router->resource('course_-users', CourseUserController::class);
   

});
