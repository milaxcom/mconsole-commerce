<?php

Route::group([
    'prefix' => sprintf('%s/commerce', config('mconsole.url')),
    'middleware' => ['web', 'mconsole'],
    'namespace' => 'Milax\Mconsole\Commerce\Http\Controllers',
], function () {
    
    Route::get('/', 'CommerceController@index');
    Route::resource('orders', 'OrdersController');
    Route::resource('categories', 'CategoriesController');
    Route::resource('products', 'ProductsController');
    Route::resource('delivery', 'DeliveryTypesController');
    Route::resource('discounts', 'DiscountsController');
    Route::resource('promocodes', 'PromocodesController');
    Route::resource('payment', 'PaymentMethodsController');

});
