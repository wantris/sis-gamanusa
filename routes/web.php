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

Route::get('/admin', 'authController@index')->name('auth.login');

Route::post('/login', 'authController@postLogin')->name('auth.login.post');

Route::get('/logout', 'authController@logout')->name('admin.auth.logout');

//admin
Route::group(['prefix' => 'admin', 'middleware' => 'adminstatus'], function () {
    Route::get('/dashboard', 'admin\homeController@index')->name('admin.home.index');
    Route::get('/profile', 'authController@profile')->name('admin.auth.profile');
    Route::post('/profile', 'authController@postProfile')->name('admin.auth.profile.post');
    Route::get('/changepassword', 'authController@changePassword')->name('admin.auth.changepassword');
    Route::post('/changepassword', 'authController@postChangePassword')->name('admin.auth.changepassword.post');

    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', 'admin\adminController@index')->name('admin.admin.index');
        Route::get('/create', 'admin\adminController@create')->name('admin.admin.create');
        Route::post('/create', 'admin\adminController@save')->name('admin.admin.save');
        Route::get('/edit/{id}', 'admin\adminController@edit')->name('admin.admin.edit');
        Route::put('/update', 'admin\adminController@update')->name('admin.admin.update');
        Route::delete('/delete', 'admin\adminController@delete')->name('admin.admin.delete');
    });

    Route::group(['prefix' => 'class'], function () {
        Route::get('/', 'admin\classController@index')->name('admin.class.index');
        Route::get('/create', 'admin\classController@create')->name('admin.class.create');
        Route::post('/create', 'admin\classController@save')->name('admin.class.save');
        Route::get('/edit/{id}', 'admin\classController@edit')->name('admin.class.edit');
        Route::put('/update', 'admin\classController@update')->name('admin.class.update');
        Route::delete('/delete', 'admin\classController@delete')->name('admin.class.delete');
    });

    Route::group(['prefix' => 'student'], function () {
        Route::get('/', 'admin\studentController@index')->name('admin.student.index');
        Route::get('/create', 'admin\studentController@create')->name('admin.student.create');
        Route::post('/create', 'admin\studentController@save')->name('admin.student.save');
        Route::get('/edit/{id}', 'admin\studentController@edit')->name('admin.student.edit');
        Route::put('/update', 'admin\studentController@update')->name('admin.student.update');
        Route::delete('/delete', 'admin\studentController@delete')->name('admin.student.delete');
        Route::get('/detail/{id}', 'admin\studentController@detail')->name('admin.student.detail');

        Route::post('/class/create', 'admin\studentController@createClass')->name('admin.student.class.save');
    });

    Route::group(['prefix' => 'npsn'], function () {
        Route::get('/', 'admin\npsnController@index')->name('admin.npsn.index');
        Route::get('/create', 'admin\npsnController@create')->name('admin.npsn.create');
        Route::post('/create', 'admin\npsnController@save')->name('admin.npsn.save');
        Route::get('/edit/{id}', 'admin\npsnController@edit')->name('admin.npsn.edit');
        Route::put('/update', 'admin\npsnController@update')->name('admin.npsn.update');
        Route::delete('/delete', 'admin\npsnController@delete')->name('admin.npsn.delete');
    });
});

//siswa
Route::group(['prefix' => 'siswa'], function () {
    Route::get('/', 'student\authController@index')->name('siswa.auth.login');
    Route::post('/', 'student\authController@postLogin')->name('siswa.auth.login.post');
    Route::get('/register', 'student\authController@register')->name('siswa.auth.register');
    Route::get('/logout', 'student\authController@logout')->name('siswa.auth.logout');
    Route::post('/register', 'student\authController@postRegister')->name('siswa.auth.register.post');
    Route::get('/register/success', 'student\authController@registerSuccess')->name('siswa.auth.register.success');

    Route::get('/dashboard', 'student\homeController@index')->name('siswa.home.index');
    Route::get('/profile', 'student\authController@profile')->name('siswa.auth.profile');
    Route::post('/profile', 'student\authController@postProfile')->name('siswa.auth.profile.post');

    Route::get('/changepassword', 'student\authController@changePassword')->name('siswa.auth.changepassword');
    Route::post('/changepassword', 'student\authController@postChangePassword')->name('siswa.auth.changepassword.post');

    Route::group(['prefix' => 'class', 'middleware' => 'siswastatus'], function () {
        Route::get('/', 'student\classController@index')->name('siswa.class.index');
    });
});
