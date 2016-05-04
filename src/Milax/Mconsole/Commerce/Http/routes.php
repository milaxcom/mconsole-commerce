<?php

Route::group([
    'prefix' => 'mconsole',
    'middleware' => ['web', 'mconsole'],
    'namespace' => 'Milax\Mconsole\Commerce\Http\Controllers',
], function () {
    
    Route::resource('commerce/categories', 'CategoriesController');
    Route::get('commerce', 'CommerceController@index');
    Route::resource('commerce/delivery', 'DeliveryTypesController');

});
