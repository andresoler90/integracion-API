<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Payment Routes
|--------------------------------------------------------------------------
|
| Rutas definidas para el proceso de pago en el proceso de integracion.
|
*/
Route::group(['prefix' => 'payment'], function()
{
    Route::get('/', 'PaymentController@index')->name('payment.index');
    Route::get('/config', 'PaymentController@config')->name('payment.config');
    Route::get('/create', 'PaymentController@create')->name('payment.create');
    Route::post('/store', 'PaymentController@store')->name('payment.store');
    Route::get('/edit/{paym5_id}', 'PaymentController@edit')->name('payment.edit');
    Route::post('/update', 'PaymentController@update')->name('payment.update');
    Route::post('/destroy', 'PaymentController@destroy')->name('payment.destroy');

    Route::get('/firstStep', 'PaymentController@firstStep')->name('payment.firstStep');
    Route::get('/secondStep/{product}', 'PaymentController@secondStep')->name('payment.secondStep');
    Route::get('/thirdStep', 'PaymentController@thirdStep')->name('payment.thirdStep');
    Route::post('/storeClient', 'PaymentController@storeClient')->name('payment.ajax.storeClient');

    //testeo
    Route::get('/test', 'PaymentController@test')->name('payment.test');

    //Epayco
    Route::group(['prefix' => 'epayco'], function()
    {
        Route::get('/response', 'PaymentController@response')->name('payment.epayco.response');
        Route::post('/confirmation', 'PaymentController@confirmation')->name('payment.epayco.confirmation');
    });

    Route::group(['prefix' => 'ajax'], function()
    {
        Route::post('/country', 'PaymentController@getCountry')->name('payment.ajax.country');
        Route::post('/subProducts', 'PaymentController@getSubProducts')->name('payment.ajax.subProduct');
        Route::post('/value', 'PaymentController@getValue')->name('payment.ajax.value');
        Route::post('/signature', 'PaymentController@signature')->name('payment.ajax.signature');
        Route::get('/madePayment', 'PaymentController@madePayment')->name('payment.ajax.madePayment');
    });
});
