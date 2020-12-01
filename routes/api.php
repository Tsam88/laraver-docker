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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/posts', 'PostController@restApiGetPosts');
Route::get('/post/{id}', 'PostController@restApiGetPost');
Route::get('/projects', 'ProjectController@restApiGetProjects');
Route::get('/project/{id}', 'ProjectController@restApiGetProject');
Route::get('/developers', 'ProjectController@restApiGetDevelopers');
Route::get('/developers/{id}', 'ProjectController@restApiGetDeveloper');
Route::get('/developers_projects', 'DeveloperProjectController@restApiGetDevelopersProjects');
Route::get('/developer_projects/{developerId}', 'DeveloperProjectController@restApiGetDeveloperProjects');
Route::get('/project_developers/{projectId}', 'DeveloperProjectController@restApiGetProjectDevelopers');
Route::get('/developer_project_relationship/{developersId}/{projectId}', 'DeveloperProjectController@restApiGetDeveloperProjectRelationship');
Route::get('/developer_project_relationships', 'DeveloperProjectController@restApiGetDeveloperProjectRelationships');
Route::post('/import', 'ImportExcelController@restApiImport');
