<?php

/*
|--------------------------------------------------------------------------
| Views Routes
|--------------------------------------------------------------------------
|
| Here is where you can register views routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'welcome')->name('welcome');
Route::view('/info', 'info')->name('info');

Route::middleware(['auth', 'user.status'])->group(function () {
    Route::view('system/users', 'system.users.index')->name('users.index');
});
