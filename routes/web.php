<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::middleware('auth')->group(function(){
    Route::get('/', 'TableController@index')->name('home');
    


    // this route contain which is prevent by user only access by admin @Protect by admin
    Route::middleware('preventUser')->group(function(){
        Route::get('/user', 'UserController@index')->name("user");
        Route::post('/user', 'UserController@store')->name("user_post");

        Route::post('/table', 'TableController@store')->name('add_table');
    });
    
});


