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

Route::get('/', function () {
    if (Auth::check()) {
        $user = App\User::find(auth()->user()->id);
        $profileId = ($user->load('profile')?->profile?->id) ?? 1; //default user profile
        return view('welcome', compact('profileId'));
    } else {
        $profileId = null;
        return view('welcome', compact('profileId'));
    }
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('posts', 'PostController')->shallow();
Route::resource('profiles', 'ProfileController')->shallow();

Route::get('/feed', 'HomeController@feed')->name('feed');
