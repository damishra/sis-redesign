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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('faculty', [
    'uses' => 'FacultyController@index'
]);

Route::get('auth/login', function () {
    return view('auth.login');
});

Route::post('auth/login', [
    'uses' => 'LoginsController@verify'
]);

Route::get('logout', [
    'uses' => 'LoginsController@logout'
]);

Route::get('student', 'StudentController@index');
Route::post('student/password', 'StudentController@password');
Route::post('student/personal', 'StudentController@personal');
Route::post('student/enroll', 'StudentController@enroll');
Route::post('student/drop', 'StudentController@drop');
Route::get('faculty', 'FacultyController@index');
Route::post('faculty/password', 'FacultyController@password');
Route::post('faculty/personal', 'FacultyController@personal');
Route::post('faculty/grade', 'FacultyController@updateGrade');
Route::get('admin', 'AdminController@index');
Route::post('admin/user', 'AdminController@makeUser');
Route::post('admin/newUser', 'AdminController@updateUser');
Route::post('admin/newClass', 'AdminController@makeSection');
Route::post('admin/upClass', 'AdminController@updateSection');
Route::post('admin/delClass', 'AdminController@deleteSection');
Route::post('admin/password', 'AdminController@password');
Route::post('admin/personal', 'AdminController@personal');
