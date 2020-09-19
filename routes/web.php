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

Auth::routes(['register' => false, 'verify' => false]);

Route::middleware('auth')->group(function(){
    Route::get('/', 'TableController@index')->name('home');
    Route::get('/table/{table:table_id}/order', "TableController@show")->name('in_table');
    Route::get('/start/{table}/{boyid}', 'TableController@start')->name('startTable');
    


    // this route contain which is prevent by user only access by admin @Protect by admin
    Route::middleware('preventUser')->group(function(){

        // User management routes
        Route::get('/user', 'UserController@index')->name("user");        
        Route::post('/user', 'UserController@store')->name("user_post");
        Route::put('/user/{user:user_id}/user/{us:user_id}', 'UserController@update')->name('update_user');
        Route::delete('/user/{user:user_id}/delete/{us:user_id}', 'UserController@destroy')->name('delete_user');


        // table management routes
        Route::post('/table/{user:user_id}/edit/{table:id}', 'TableController@update')->name('update_table');
        Route::get('/table', 'AdminController@index')->name('tableShow');
        Route::post('/table', 'TableController@store')->name('add_table');
        Route::delete('/table/{user:user_id}/delete/{table:id}', 'TableController@destroy')->name('deleteTable');
        Route::get('/table/reset/{table:table_id}', 'TableController@reset')->name('reset_table');

        

        // category managemane routes
        Route::post('/category/{user:user_id}/update/{category:id}', "FoodController@updateCategory")->name("EditCategory");
        Route::delete('/category/{user:user_id}/delete/{category:id}', "FoodController@deleteCategory")->name("deleteCategory");
        Route::post('/category', 'FoodController@storeCategory')->name('storeCategory');


        // food management routes
        Route::post('/food/add', 'FoodController@store')->name('AddFood');
        Route::post('/food/{user:user_id}/edit/{food:id}', 'FoodController@update')->name('editFood');
        Route::delete('/food/{user:user_id}/delete/{food:id}', 'FoodController@delete')->name('deleteFood');
        Route::get('/food', 'AdminController@foodShow')->name('foodShow');

        // report management
        Route::get('/report', 'AdminController@report')->name("report");
        Route::get('/report/today', 'AdminController@today')->name('today_report');
        Route::post('/report/pick', 'AdminController@pick')->name('pick_report');
    });
    
});


