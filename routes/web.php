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

Route::get('/', 'MicropostsController@index'); //上書き

//ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup','Auth\RegisterController@register')->name('signup.post');

//ログイン認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

// ユーザ機能
Route::group(['middleware' => ['auth','can:user-higher']],function() {
    Route::group(['middleware' => 'auth'], function () {
        Route::resource('users', 'UsersController', ['only' => ['index', 'show', 'update', 'edit', 'destroy']]);


        Route::group(['prefix' => 'users/{id}'], function () {
            Route::post('follow', 'UserFollowController@store')->name('user.follow');
            Route::delete('unfollow', 'UserFollowController@destroy')->name('user.unfollow');
            Route::get('followings', 'UsersController@followings')->name('users.followings');
            Route::get('followers', 'UsersController@followers')->name('users.followers');
            Route::post('favorite', 'UserFavoriteController@store')->name('user.favorite');
            Route::delete('unfavorite', 'UserFavoriteController@destroy')->name('user.unfavorite');
            Route::get('favoritings', 'UsersController@favoritings')->name('user.favoritings');
            Route::get('withdrawal', 'UsersController@withdrawal')->name('users.withdrawal');
        });

        Route::resource('microposts', 'MicropostsController', ['only' => ['store', 'destroy', 'update']]);
    });
});