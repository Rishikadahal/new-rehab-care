<?php

use App\Admin\Controllers\Bill\BillController;
use App\Admin\Controllers\HomeController;
use App\Admin\Controllers\MeetController;
use App\Admin\Controllers\Patient\PatientActivityController;
use App\Admin\Controllers\Patient\PatientController;
use App\Admin\Controllers\Review\ReviewController;
use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('/patients', PatientController::class);
    $router->resource('/patient-activities', PatientActivityController::class);
    $router->get('/appointment', [HomeController::class, 'appointment']);
    $router->resource('meets', MeetController::class);
    $router->resource('reviews', ReviewController::class);
    $router->resource('bills', BillController::class);
});
