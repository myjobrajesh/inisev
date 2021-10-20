<?php

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
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/


Route::post('website/create', 'App\Http\Controllers\WebsiteController@createWebsite')->name('website.create');
//Route::get('website/{id}', 'App\Http\Controllers\WebsiteController@getWebsite')->name('website.get');
//Route::get('website', 'App\Http\Controllers\WebsiteController@getWebsite')->name('website.all');
//TODO:: add more routes for delete and edit

//Route::get('website/{id}/posts', 'App\Http\Controllers\PostController@getPosts')->name('post.all');
//Route::get('post/{id}', 'App\Http\Controllers\PostController@getPost')->name('post.get');

//required one
Route::post('website/{id}/post', 'App\Http\Controllers\PostController@createPost')->name('post.create');

Route::post('website/{id}/subscribe', 'App\Http\Controllers\WebsiteSubscriberController@createSubscription')->name('website.subscribe');


