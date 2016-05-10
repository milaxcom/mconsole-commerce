<?php

use Milax\Mconsole\Commerce\Installer;

return [
    'name' => 'Commerce',
    'identifier' => 'mconsole-commerce',
    'description' => 'mconsole::commerce.module.description',
    'register' => [
        'middleware' => [],
        'providers' => [
            \Milax\Mconsole\Commerce\Provider::class,
        ],
        'aliases' => [],
        'bindings' => [],
        'dependencies' => [],
    ],
    'install' => function () {
        Installer::install();
    },
    'uninstall' => function () {
        Installer::uninstall();
    },
    'init' => function () {
        app('API')->menu->push([
            'name' => 'mconsole::commerce.menu.index',
            'url' => 'commerce',
            'visible' => true,
            'enabled' => true,
        ], 'commerce');
        
        app('API')->menu->push([
            'name' => 'mconsole::commerce.menu.products',
            'url' => 'commerce/products',
            'visible' => true,
            'enabled' => true,
        ], 'commerce_products', 'commerce');
        
        app('API')->menu->push([
            'name' => 'mconsole::commerce.menu.categories',
            'url' => 'commerce/categories',
            'visible' => true,
            'enabled' => true,
        ], 'commerce_categories', 'commerce');
        
        app('API')->menu->push([
            'name' => 'mconsole::commerce.menu.delivery',
            'url' => 'commerce/delivery',
            'visible' => true,
            'enabled' => true,
        ], 'commerce_delivery', 'commerce');
        
        app('API')->menu->push([
            'name' => 'mconsole::commerce.menu.discounts',
            'url' => 'commerce/discounts',
            'visible' => true,
            'enabled' => true,
        ], 'commerce_discounts', 'commerce');
    },
];
