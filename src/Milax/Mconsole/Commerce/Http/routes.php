<?php

Route::group([
    'prefix' => sprintf('%s/commerce', config('mconsole.url')),
    'middleware' => ['web', 'mconsole'],
    'namespace' => 'Milax\Mconsole\Commerce\Http\Controllers',
], function () {
    
    Route::get('/', 'CommerceController@index');
    Route::resource('categories', 'CategoriesController');
    Route::resource('delivery', 'DeliveryTypesController');
    Route::resource('discounts', 'DiscountsController');

});
