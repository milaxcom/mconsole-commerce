<?php

Route::group([
    'prefix' => 'mconsole/commerce',
    'middleware' => ['web', 'mconsole'],
    'namespace' => 'Milax\Mconsole\Commerce\Http\Controllers',
], function () {
    
    Route::get('/', 'CommerceController@index');
    Route::resource('categories', 'CategoriesController');
    Route::resource('delivery', 'DeliveryTypesController');

});
