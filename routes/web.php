<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'ImportExcelController@index')->name('import.index');
Route::get('/post', 'PostController@index')->name('post.index');
Route::get('/project', 'ProjectController@index')->name('project.index');
Route::get('/developer', 'DeveloperController@index')->name('developer.index');
Route::get('/developer_project', 'DeveloperProjectController@index')->name('developer.project.index');
Route::post('/import', 'ImportExcelController@import')->name('import');
