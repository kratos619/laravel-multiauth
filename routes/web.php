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

use App\User;
use App\Address;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/about', 'PagesController@index');
// insert Data
Route::get('/insert', function () {
    $user = User::find(1);
    $address = new Address(['name'=>'1403 D PuranikHomeTown Oval,Thane']);
    $user->address()->save($address);
});

Route::get('/update', function () {
    // find user
    $address = Address::where('user_id', 1)->first();
    $address->name = "Update New address 1403 D PuranikHomeTown Oval,Thane";
    $address->save();
});

Route::get('/read', function () {
    $user = User::find(1);
    dd($user->address->name);
});


Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', 'Auth\AdminLoginController@showForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@showForm')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
});
