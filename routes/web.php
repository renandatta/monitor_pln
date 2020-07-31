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

Route::get('grup_slo', 'GrupSloController@index')->name('grup_slo');
Route::post('grup_slo/search', 'GrupSloController@search')->name('grup_slo.search');
Route::get('grup_slo/info', 'GrupSloController@info')->name('grup_slo.info');
Route::post('grup_slo/save', 'GrupSloController@save')->name('grup_slo.save');
Route::post('grup_slo/delete', 'GrupSloController@delete')->name('grup_slo.delete');

Route::get('item_kelengkapan', 'ItemKelengkapanController@index')->name('item_kelengkapan');
Route::post('item_kelengkapan/search', 'ItemKelengkapanController@search')->name('item_kelengkapan.search');
Route::get('item_kelengkapan/info', 'ItemKelengkapanController@info')->name('item_kelengkapan.info');
Route::post('item_kelengkapan/save', 'ItemKelengkapanController@save')->name('item_kelengkapan.save');
Route::post('item_kelengkapan/delete', 'ItemKelengkapanController@delete')->name('item_kelengkapan.delete');

Route::get('item_progres', 'ItemProgresController@index')->name('item_progres');
Route::post('item_progres/search', 'ItemProgresController@search')->name('item_progres.search');
Route::get('item_progres/info', 'ItemProgresController@info')->name('item_progres.info');
Route::post('item_progres/save', 'ItemProgresController@save')->name('item_progres.save');
Route::post('item_progres/delete', 'ItemProgresController@delete')->name('item_progres.delete');
