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
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Auth::routes(["register" => false]);

Route::middleware('auth')->group(function () {

    Route::get('/', 'HomeController@index')->name('home');

    Route::prefix('admin')->group(function () {

        Route::prefix('user')->group(function () {

            Route::match(['get', 'post'], '/', 'Admin\UserController@index')->name('admin.user');

            Route::get('/create', function () {
                return view('admin.user.create');
            })->name('admin.user.create');
            Route::post('/save', 'Admin\UserController@save')->name('admin.user.save');

            Route::get('/edit/{user}', 'Admin\UserController@edit')->name('admin.user.edit');
            Route::post('/update', 'Admin\UserController@update')->name('admin.user.update');

            Route::get('/delete/{user}', 'Admin\UserController@delete')->name('admin.user.delete');

        });
    });

    Route::get('locale/{locale}', function ($locale)
    {
        \Illuminate\Support\Facades\Session::put('_locale', $locale);
        return redirect()->back();
    })->name('locale.change');

});
