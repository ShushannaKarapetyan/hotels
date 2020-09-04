<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', 'LoginController@showLoginForm');
Route::post('/login', 'LoginController@login')->name('login');

Route::group(['middleware' => 'auth'], function () {

    Route::post('/logout', 'LoginController@logout')->name('logout');
    Route::get('/reset-password', 'LoginController@resetPasswordForm')->name('reset_password_form');
    Route::put('/reset-password', 'LoginController@resetPassword')->name('reset_password');

    //-----Home-------------------------------------------------------------------------------------------------------//
    Route::get('/', 'HomeController@home')->name('home');

    //-----Hotels------------------------------------------------------------------------------------------------------//
    Route::get('/hotels', 'HotelsController@index')->name('hotels');
    Route::get('/hotels/create', 'HotelsController@create')->name('hotels.create');
    Route::post('/hotels', 'HotelsController@store')->name('hotels.store');
    Route::get('/hotels/{hotel}/edit', 'HotelsController@edit')->name('hotels.edit');
    Route::put('/hotels/{hotel}', 'HotelsController@update')->name('hotels.update');
    Route::delete('/hotels/{hotel}', 'HotelsController@destroy')->name('hotels.delete');

    //-----Topics-----------------------------------------------------------------------------------------------------//
    Route::put('/hotel-types', 'HotelTypesController@sync')->name('hotel_types.sync');

    //-----Rooms-----------------------------------------------------------------------------------------------------//
    Route::get('/hotels/{hotel}/rooms', 'RoomsController@index')->name('rooms');
    Route::put('/hotels/{hotel}/rooms', 'RoomsController@sync')->name('rooms.sync');

    //-----Free Rooms-----------------------------------------------------------------------------------------------------//
    Route::get('/hotels/{hotel}/free-rooms', 'FreeRoomsController@index')->name('free_rooms');
    Route::put('/hotels/{hotel}/free-rooms', 'FreeRoomsController@update')->name('free_rooms.update');

    Route::get('/invoice', 'HotelsController@generateInvoice')->name('invoice');
});

//-----Public-----------------------------------------------------------------------------------------------------//
Route::get('/hotels/{uuid}/public-free-rooms', 'FreeRoomsController@publicFreeRooms')->name('public_free_rooms');
Route::put('/hotels/{uuid}/public-free-rooms', 'FreeRoomsController@publicFreeRoomsUpdate')->name('public_free_rooms.update');

Route::get('/all-days', 'FreeRoomsController@allDays');
Route::get('/hotel-types', 'HotelTypesController@index')->name('hotel_types');
Route::get('/filtered-hotels', 'HotelsController@getFilteredHotels');
