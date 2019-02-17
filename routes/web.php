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
use App\Post;
use App\Role;

use App\Staff;
use App\Photo;
use App\Product;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/about', 'PagesController@index');
// insert Data
// Route::get('/insert', function () {
//     $user = User::find(1);
//     $address = new Address(['name'=>'1403 D PuranikHomeTown Oval,Thane']);
//     $user->address()->save($address);
// });

// Route::get('/update', function () {
//     // find user
//     $address = Address::where('user_id', 1)->first();
//     $address->name = "Update New address 1403 D PuranikHomeTown Oval,Thane";
//     $address->save();
// });

// Route::get('/read', function () {
//     $user = User::find(1);
//     dd($user->address->name);
// });


/*
|--------------------------------------------------------------------------
| Web Routes Has Many
|--------------------------------------------------------------------------
|
*/

Route::get('/create', function () {
    $user = User::find(1);
    $post = new Post(['title'=>'this is title','body'=> "this is body"]);
    $user->posts()->save($post);
    return "done";
});

// read all user
Route::get('/read_post', function () {
    $user = User::find(1);
    return response()->json([$user->posts, $user->name]);
});

//update
Route::get('/post_update', function () {
    $user = User::find(1);
    // whereUserId update All the row with user_id = 1
    // ex whereName
    $user->posts()->where('user_id', 1)->update(['title'=> "new update title",'body'=>'update Body']);
    return 'done';
});
//delete
Route::get('/delete_post', function () {
    $user = User::find(1);
    $user->posts()->where('user_id', 1)->delete();
    return 'done';
});

/*
|--------------------------------------------------------------------------
| Web Routes Belongs Many
|--------------------------------------------------------------------------
|
*/

Route::get('/belongs_to_many_create', function () {
    $user = User::find(1);
    $role = new Role(['name' => 'Administrator']);
    $user->roles()->save($role);
    return 'done';
});


/*
|--------------------------------------------------------------------------
| Web Routes PolyMorphic ReletionShip 
|--------------------------------------------------------------------------
|
*/
Route::get('/poly_morphic_create', function () {
    $staff = Staff::find(1);
    //dd($staff->photos);
    $staff->photos()->create(['path'=>'example.jpg']);
    return 'done';
});
Route::get('/poly_morphic_read', function () {
    $staff = Staff::find(1);
    //dd($staff->photos);
    
    return response()->json($staff->photos, 200);
});


Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', 'Auth\AdminLoginController@showForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@showForm')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
});
