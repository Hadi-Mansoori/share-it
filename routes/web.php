<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Controllers\Admin;
use App\Http\Controllers\User;
use App\Http\Controllers\Files;

Route::group(['middleware' => ['web'],'prefix' => 'user'], function()
{
    Route::any('/login', [User::class, 'login']);
    Route::get('/logout', [User::class, 'logout']);
    Route::post('/register', [User::class, 'register']);
});

Route::group(['middleware' => ['web','auth'],'prefix' => 'admin'], function()
{
    Route::get('/panel', [Admin::class,'panel']);
});

Route::group(['middleware' => ['auth'],'prefix' => 'file'], function()
{
    Route::get('/uploader', [Files::class,'uploader']);
    Route::post('/uploader', [Files::class,'uploader']);
    Route::get('/my-files', [Files::class,'myFiles']);
    Route::post('/delete', [Files::class,'deleteFile']);
});

Route::get('/{shortLink}', [Files::class, 'downloadPage']);

//Route::get('/login', [User::class, 'login','as'=>'login']);

Route::get('/file/download/{shortLink}', [Files::class, 'download']);

Route::get('/', ['as'=>'login',User::class, 'login']);
Route::get('/login', ['as'=>'login',User::class, 'login']);

Route::post('login', [ 'as' => 'login', 'uses' => 'User@login']);
