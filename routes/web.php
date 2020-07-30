<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

Route::get('image/{folder}/{filename}', function ($folder,$filename){
    $path = storage_path('app/' . $folder . '/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
});

/// =============== auth
Route::get('login', 'AuthController@login')->name('login');
Route::post('login', 'AuthController@login_process')->name('login.process');
Route::get('logout', 'AuthController@logout')->name('logout');

Route::get('/', 'HomeController@index')->name('/');
Route::get('home', 'HomeController@index')->name('home');

Route::get('user', 'UserController@index')->name('user');
Route::post('user/search', 'UserController@search')->name('user.search');
Route::get('user/info', 'UserController@info')->name('user.info');
Route::post('user/save', 'UserController@save')->name('user.save');
Route::post('user/delete', 'UserController@delete')->name('user.delete');

Route::get('kontraktor', 'KontraktorController@index')->name('kontraktor');
Route::post('kontraktor/search', 'KontraktorController@search')->name('kontraktor.search');
Route::get('kontraktor/info', 'KontraktorController@info')->name('kontraktor.info');
Route::post('kontraktor/save', 'KontraktorController@save')->name('kontraktor.save');
Route::post('kontraktor/delete', 'KontraktorController@delete')->name('kontraktor.delete');

Route::get('petugas', 'PetugasController@index')->name('petugas');
Route::post('petugas/search', 'PetugasController@search')->name('petugas.search');
Route::get('petugas/info', 'PetugasController@info')->name('petugas.info');
Route::post('petugas/save', 'PetugasController@save')->name('petugas.save');
Route::post('petugas/delete', 'PetugasController@delete')->name('petugas.delete');
