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
            'name' => 'Commerce',
            'translation' => 'commerce.menu.index',
            'url' => 'commerce',
            'visible' => true,
            'enabled' => true,
        ], 'commerce');
        
        app('API')->menu->push([
            'name' => 'Delivery',
            'translation' => 'commerce.menu.delivery',
            'url' => 'commerce/delivery',
            'visible' => true,
            'enabled' => true,
        ], 'commerce_delivery', 'commerce');
    },
];
