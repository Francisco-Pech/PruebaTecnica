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
Route::get('/company/index','CompanyController@index')->name('companies.index')->middleware('auth');
Route::get('/company','CompanyController@create')->name('companies.create')->middleware('auth');
Route::post('/company','CompanyController@store')->name('companies.store')->middleware('auth');
Route::delete('/company/{id}','CompanyController@destroy')->name('companies.destroy')->middleware('auth');
Route::get('/company/edit/{id}', 'CompanyController@edit')->name('companies.edit')->middleware('auth');
Route::put('/company/{id}', 'CompanyController@update')->name('companies.update')->middleware('auth');

// Branch Offices
Route::get('/branchoffice/index','BranchofficeController@index')->name('branchoffices.index')->middleware('auth');
Route::get('/branchoffice','BranchofficeController@create')->name('branchoffices.create')->middleware('auth');
Route::post('/branchoffice','BranchofficeController@store')->name('branchoffices.store')->middleware('auth');
Route::get('/branchoffice/{id}', 'BranchofficeController@edit')->name('branchoffices.edit')->middleware('auth');
Route::put('/branchoffice/{id}', 'BranchofficeController@update')->name('branchoffices.update')->middleware('auth');
Route::get('/branchoffice/supervisor/edit','BranchofficeController@showEditBySupervisor')->name('branchoffices.supervisor')->middleware('auth');


// Appointments
Route::get('/appointment','AppointmentController@create')->name('appointments.create');
Route::get('/appointment/company/branchoffices', 'AppointmentController@showBranchOffices')->name('appointments.branchoffice');
Route::post('/appointment','AppointmentController@store')->name('appointments.store');
Route::get('/appointment/branchoffices/date', 'AppointmentController@showDate')->name('appointments.date');
Route::get('/appointment/branchoffices/time', 'AppointmentController@showTime')->name('appointments.time');
Route::get('/appointment/company', 'AppointmentController@showCompany')->name('appointments.company');

Route::get('/appointment/assign/{id}','AppointmentController@assignUser')->name('appointments.assign')->middleware('auth');
Route::get('/appointment/branchoffices/data', 'AppointmentController@appointment')->name('appointments.information')->middleware('auth');
Route::get('/appointment/employee','AppointmentController@showAppointmentEmployee')->name('appointments.employee')->middleware('auth');
Route::get('/appointment/information','AppointmentController@showByInformationBranchOffices')->name('appointments.branchoffice.index')->middleware('auth');
Route::get('/appointment/search', 'AppointmentController@showBySearchBranchOffices')->name('appointments.search')->middleware('auth');
Route::get('/appointment/index','AppointmentController@index')->name('appointments.index')->middleware('auth');

// Users
Route::get('/user/index','UserController@index')->name('users.index')->middleware('auth');
Route::get('/user/branchoffices','UserController@branchofficesindex')->name('users.index.branchoffices')->middleware('auth');
Route::get('/user','UserController@create')->name('users.create')->middleware('auth');
Route::get('/user/supervisor','UserController@createSup')->name('users.create.supervisor')->middleware('auth');
Route::post('/user/supervisor','UserController@storeSup')->name('users.supervisor.store')->middleware('auth');
Route::post('/user','UserController@store')->name('users.store')->middleware('auth');
Route::get('/user/username', 'UserController@showByUsername')->middleware('auth');
Route::get('/user/search/','UserController@search')->name('users.search')->middleware('auth');
Route::get('/user/branchoffices/search/','UserController@branchofficessearch')->name('users.branchoffices.search')->middleware('auth');



