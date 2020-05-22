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

use App\Http\Controllers\AdminHigherController;

Route::get('/', 'MicropostsController@index');

//ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup','Auth\RegisterController@register')->name('signup.post');

//ログイン認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

// ユーザ機能　全権限で利用可
Route::group(['middleware' => ['auth','can:user-higher']], function() {
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

        Route::resource('microposts', 'MicropostsController', ['only' => ['destroy', 'update']]);

        //凍結されていない場合のみ、POSTを投稿できる
        Route::group(['middleware' => ['auth', 'can:not-freeze']], function() {
            Route::resource('microposts', 'MicropostsController', ['only' =>['store']]);
        });
    });
});

//管理者以上の権限を持つ場合のみ利用可能
Route::group(['middleware' => ['auth', 'can:admin-higher']], function() {
    Route::resource('admin', 'AdminHigherController');
    Route::group(['prefix' => 'users/{id}'], function () {
        Route::post('freeze', 'AdminHigherController@freeze')->name('admin.freeze');
        Route::post('unzip', 'AdminHigherController@unzip')->name('admin.unzip');
    });
});