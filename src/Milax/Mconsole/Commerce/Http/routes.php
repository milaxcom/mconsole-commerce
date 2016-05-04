<?php

Route::group([
    'prefix' => 'mconsole',
    'middleware' => ['web', 'mconsole'],
    'namespace' => 'Milax\Mconsole\Commerce\Http\Controllers',
], function () {
    
    Route::get('commerce', 'CommerceController@index');

});
