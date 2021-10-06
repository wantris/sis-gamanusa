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

Route::get('/', 'authController@index')->name('auth.login');
Route::post('/login', 'authController@postLogin')->name('auth.login.post');
Route::get('/logout', 'authController@logout')->name('auth.logout');

// admin
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'admin\homeController@index')->name('admin.home.index');

    Route::group(['prefix' => 'position'], function () {
        Route::get('/', 'admin\positionController@index')->name('admin.position.index');
        Route::get('/create', 'admin\positionController@create')->name('admin.position.create');
        Route::post('/create', 'admin\positionController@save')->name('admin.position.save');
        Route::get('/edit/{code}', 'admin\positionController@edit')->name('admin.position.edit');
        Route::put('/update', 'admin\positionController@update')->name('admin.position.update');
        Route::delete('/delete', 'admin\positionController@delete')->name('admin.position.delete');
    });

    Route::group(['prefix' => 'employee'], function () {
        Route::get('/', 'admin\employeeController@index')->name('admin.employee.index');
        Route::get('/create', 'admin\employeeController@create')->name('admin.employee.create');
        Route::post('/create', 'admin\employeeController@save')->name('admin.employee.save');
        Route::get('/edit/{id}', 'admin\employeeController@edit')->name('admin.employee.edit');
        Route::put('/update', 'admin\employeeController@update')->name('admin.employee.update');
        Route::delete('/delete', 'admin\employeeController@delete')->name('admin.employee.delete');
        Route::get('/list', 'admin\employeeController@getEmployeeJson')->name('admin.employee.list');
    });

    Route::group(['prefix' => 'account'], function () {
        Route::get('/', 'admin\accountController@index')->name('admin.account.index');
        Route::get('/create', 'admin\accountController@create')->name('admin.account.create');
        Route::post('/create', 'admin\accountController@save')->name('admin.account.save');
        Route::get('/edit/{id}', 'admin\accountController@edit')->name('admin.account.edit');
        // Route::put('/update', 'admin\accountController@update')->name('admin.account.update');
        // Route::delete('/delete', 'admin\accountController@delete')->name('admin.account.delete');
        // Route::get('/list', 'admin\accountController@getaccountJson')->name('admin.account.list');
    });

    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', 'admin\adminController@index')->name('admin.admin.index');
        Route::get('/create', 'admin\adminController@create')->name('admin.admin.create');
        Route::post('/create', 'admin\adminController@save')->name('admin.admin.save');
        Route::get('/edit/{id}', 'admin\adminController@edit')->name('admin.admin.edit');
        Route::put('/update', 'admin\adminController@update')->name('admin.admin.update');
        Route::delete('/delete', 'admin\adminController@delete')->name('admin.admin.delete');
    });

    Route::group(['prefix' => 'salarybonus'], function () {
        Route::get('/', 'admin\salaryBonusController@index')->name('admin.salaryBonus.index');
        Route::get('/create', 'admin\salaryBonusController@create')->name('admin.salaryBonus.create');
        Route::post('/create', 'admin\salaryBonusController@save')->name('admin.salaryBonus.save');
        Route::get('/edit/{id}', 'admin\salaryBonusController@edit')->name('admin.salaryBonus.edit');
        Route::put('/update', 'admin\salaryBonusController@update')->name('admin.salaryBonus.update');
        Route::get('/detail/{id}', 'admin\salaryBonusController@detail')->name('admin.salaryBonus.detail');
        Route::delete('/delete', 'admin\salaryBonusController@delete')->name('admin.salaryBonus.delete');
        Route::delete('/delete/detail', 'admin\salaryBonusController@deleteDetail')->name('admin.salaryBonus.delete.detail');
    });
});

// admin
Route::group(['prefix' => 'employee'], function () {
    Route::get('/', 'employee\homeController@index')->name('employee.home.index');

    Route::group(['prefix' => 'salarybonus'], function () {
        Route::get('/', 'employee\salaryBonusController@index')->name('employee.salaryBonus.index');
        Route::get('/detail/{id}', 'employee\salaryBonusController@detail')->name('employee.salaryBonus.detail');
    });
});
