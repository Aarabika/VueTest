<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('v1')->group(function () {

    Route::prefix('task')->group(function () {

        Route::get('', '\App\Http\Controllers\Task\TaskController@taskList');

        Route::get('{id}', '\App\Http\Controllers\Task\TaskController@task')
            ->where(['id' => '[0-9]+']);
    });

});

