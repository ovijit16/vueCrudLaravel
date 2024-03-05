<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Api\ClassController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResources(['class' => 'App\Http\Controllers\Api\ClassController']);
Route::apiResources(['subject' => 'App\Http\Controllers\Api\SubjectController']);
Route::apiResources(['section' => 'App\Http\Controllers\Api\SectionController']);
Route::apiResources(['student' => 'App\Http\Controllers\Api\StudentController']);


Route::group(
    [


        'prefix' => 'auth'

    ],
    function () {

        Route::post('login', 'App\Http\Controllers\AuthController@login');
        Route::post('logout', 'App\Http\Controllers\AuthController@logout');
        Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
        Route::post('me', 'App\Http\Controllers\AuthController@me');
        Route::post('payload', 'App\Http\Controllers\AuthController@payload');
        Route::post('register', 'App\Http\Controllers\AuthController@register');
    }
);
