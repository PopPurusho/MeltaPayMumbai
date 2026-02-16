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

Route::prefix('superadmin')->middleware(['auth', 'SetSessionData', 'language', 'timezone', 'AdminSidebarMenu', 'superadmin'])->name('superadmin.')->group(function() {
    Route::get('/', 'SuperadminController@index');
    Route::get('/business', 'BusinessController@index')->name('business.index');
    Route::get('/business/create', 'BusinessController@create')->name('business.create');
    Route::post('/business', 'BusinessController@store')->name('business.store');
    Route::get('/business/{id}', 'BusinessController@show')->name('business.show');
    Route::delete('/business/{id}', 'BusinessController@destroy')->name('business.destroy');
    Route::get('/business/{id}/toggle-active', 'BusinessController@toggleActive')->name('business.toggle-active');
});
