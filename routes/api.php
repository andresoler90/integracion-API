<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'Api\UserController@login')->name('api.login');

Route::prefix('users')->middleware(['auth:api'])->group(function () {
    Route::post('create', 'Api\UserController@create')->name('api.create.user');
    Route::post('validate', 'Api\UserController@validateUser')->name('api.validate.user');
});

Route::prefix('invoway')->middleware(['auth:api'])->group(function () {
    Route::post('user/token', 'Api\InvoWayController@getDataUser')->name('invoway.api.data.user.token');
});

Route::prefix('risk')->middleware(['auth:api'])->group(function () {
    Route::post('save/company', 'Api\RiskController@addCompany')->name('risk.api.data.save.company');
    Route::post('list/company', 'Api\RiskController@getListCompany')->name('risk.api.data.list.company');
    Route::post('get/alert/people', 'Api\RiskController@getPeopleAlert')->name('risk.api.data.alert.people');
    Route::post('get/alert/company', 'Api\RiskController@getCompaniesAlert')->name('risk.api.data.alert.company');
    Route::post('get/alerts/all', 'Api\RiskController@getAllAlerts')->name('risk.api.data.alert.all');
    Route::get('get/differences', 'Api\RiskController@getDifferences')->name('risk.api.data.differences');

});
