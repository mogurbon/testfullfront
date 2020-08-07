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
Route::get('/', 'EmployeeController@index');
Route::get('/employees', 'EmployeeController@getEmployees');
Route::get('/newemployee', 'EmployeeController@newEmployee');
Route::post('/employee', 'EmployeeController@store');
Route::get('/employees/{id}', 'EmployeeController@editEmployee');
Route::get('/employee/{id}', 'EmployeeController@getEmployee');
Route::put('/employee/{id}', 'EmployeeController@updateEmployee');



Route::get('/skills', 'SkillController@index');

Route::get('/listskills', 'SkillController@getSkills');
Route::get('/newskill', 'SkillController@newSkill');
Route::post('/skill', 'SkillController@store');
Route::get('/skills/{id}', 'SkillController@editSkill');
Route::get('/skill/{id}', 'SkillController@getSkill');
Route::put('/skill/{id}', 'SkillController@updateSkill');
Route::delete('/skill/{id}', 'SkillController@deleteSkill');

/*Route::get('/welcome', function () {
    return view('welcome');
});*/


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
