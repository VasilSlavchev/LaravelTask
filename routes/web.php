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

// home route.
Route::get('/', function () {
    return view('welcome');
});

// Route::get('/insert', function () {
//     return view('insert');
// });

// insert route
Route::get('/insert', 'InsertsController@insert');
Route::post('insert/uploadFile', 'InsertsController@uploadFile');

// register route
Route::get('/register', 'Auth\AuthController@register')->name('register');
Route::post('/register', 'Auth\AuthController@storeUser');

// login route
Route::get('/login', function () {
    return view('login');
});

// login route
Route::get('/login', 'Auth\AuthController@login')->name('login');

// login route
Route::post('/login', 'Auth\AuthController@authenticate');

// log out route
Route::get('logout', 'Auth\AuthController@logout')->name('logout');

// home route
Route::get('/home', 'Auth\AuthController@home')->name('home');

// Route::post('login', [ 'as' => 'login', 'uses' => 'LoginController@login']);
Route::post('login', [ 'as' => 'login', 'uses' => 'LoginController@authenticate']);

// Route::get('/insert', function () { return view('insert'); });

// dashboard route // Only authenticated users may enter...
// Route::get('dashboard', 'DashboardController@userDashboard')->name('user_dashboard')->middleware('auth');

// dashboard route
Route::get('/dashboard', 'DashboardController@userDashboard')->name('user_dashboard');
// Route::get('/dashboard', 'DashboardController@userDashboard')->name('user_dashboard');

// test route
Route::get('/flights', function () {
    // Only authenticated users may access this route...
})->middleware('auth');