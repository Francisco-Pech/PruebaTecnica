<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Auth;

// Home
Route::redirect('/', '/home');
Route::get('/home','HomeController@index')->name('home.index');

// Authentication
Route::get('/login','Auth\LoginController@showLoginForm')->name('login.form');
Route::post('/login','Auth\LoginController@login')->name('login');
Route::post('/logout','Auth\LoginController@logout')->name('logout');

// Register
Route::get('/register','Auth\RegisterController@showRegisterForm')->name('registers.form');
Route::post('/register','Auth\RegisterController@store')->name('registers.store');

// Companies
Route::get('/company/index','CompanyController@index')->name('companies.index');
Route::get('/company','CompanyController@create')->name('companies.create');
Route::post('/company','CompanyController@store')->name('companies.store');
Route::delete('/company/{id}','CompanyController@destroy')->name('companies.destroy');
Route::get('/company/edit/{id}', 'CompanyController@edit')->name('companies.edit');
Route::put('/company/{id}', 'CompanyController@update')->name('companies.update');

// Branch Offices
Route::get('/branchoffice/index','BranchofficeController@index')->name('branchoffices.index');
Route::get('/branchoffice','BranchofficeController@create')->name('branchoffices.create');
Route::post('/branchoffice','BranchofficeController@store')->name('branchoffices.store');
Route::get('/branchoffice/{id}', 'BranchofficeController@edit')->name('branchoffices.edit');
Route::put('/branchoffice/{id}', 'BranchofficeController@update')->name('branchoffices.update');

// Appointments
Route::get('/appointment/index','AppointmentController@index')->name('appointments.index');
Route::get('/appointment','AppointmentController@create')->name('appointments.create');
Route::post('/appointment','AppointmentController@store')->name('appointments.store');
Route::get('/appointment/branchoffice', 'AppointmentController@showByBranchoffice')->name('appointments.branchoffice');
Route::get('/appointment/date/time', 'AppointmentController@showByBranchofficeDateTime')->name('appointments.branchoffice.dateTime');
Route::get('/appointment/time', 'AppointmentController@showByBranchofficeTime')->name('appointments.branchoffice.Time');
Route::get('/appointment/{id}', 'AppointmentController@edit')->name('appointments.edit');
Route::put('/appointment/{id}', 'AppointmentController@update')->name('appointments.update');


// Users
Route::get('/user/index','UserController@index')->name('users.index');
Route::get('/user/branchoffices','UserController@branchofficesindex')->name('users.branchoffices');
Route::get('/user','UserController@create')->name('users.create');
Route::post('/user','UserController@store')->name('users.store');
Route::get('/user/username', 'UserController@showByUsername');
Route::get('/user/search/','UserController@search')->name('users.search');
Route::get('/user/branchoffices/search/','UserController@branchofficessearch')->name('users.branchoffices.search');



