<?php

Route::group([
    'prefix' => 'mconsole',
    'middleware' => ['web', 'mconsole'],
    'namespace' => 'Milax\Mconsole\Commerce\Http\Controllers',
], function () {
    
    Route::resource('commerce/categories', 'CategoriesController@index');
    Route::get('commerce', 'CommerceController@index');

});
