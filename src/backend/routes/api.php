<?php

use App\Http\Controllers\ApiArticleController;
use App\Http\Controllers\ApiTodoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//http://backend.demo:8081/api/ping
Route::get('/ping', function () {
    return 'OK';
});
Route::resource('crawl', ApiTodoController::class, [
    'only' => ['store', 'show']
]);
Route::resource('articles', ApiArticleController::class, [
    'only' => ['index','store']
]);
