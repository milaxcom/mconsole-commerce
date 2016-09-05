<?php

require 'helpers.php';

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
            'name' => 'mconsole::commerce.menu.orders',
            'url' => 'commerce/orders',
            'visible' => true,
            'enabled' => true,
        ], 'commerce_orders', 'commerce');
        
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
        
        app('API')->menu->push([
            'name' => 'mconsole::commerce.menu.payment',
            'url' => 'commerce/payment',
            'visible' => true,
            'enabled' => true,
        ], 'commerce_payment', 'commerce');
        
        app('API')->search->register(function ($text) {
            return app('Milax\Mconsole\Commerce\Contracts\Repositories\CategoriesRepository')->query()->select('id', 'name', 'slug')->where('slug', 'like', sprintf('%%%s%%', $text))->orWhere('name', 'like', sprintf('%%%s%%', $text))->orWhere('description', 'like', sprintf('%%%s%%', $text))->get()->transform(function ($result) {
                return [
                    'title' => $result->name,
                    'description' => $result->slug,
                    'link' => mconsole_url(sprintf('commerce/categories/%s/edit', $result->id)),
                    'tags' => ['commerce', 'categories', sprintf('#%s', $result->id)],
                ];
            });
        });
        
        app('API')->search->register(function ($text) {
            return app('Milax\Mconsole\Commerce\Contracts\Repositories\ProductsRepository')->query()->select('id', 'name', 'slug', 'article')->where('article', 'like', sprintf('%%%s%%', $text))->orWhere('name', 'like', sprintf('%%%s%%', $text))->orWhere('slug', 'like', sprintf('%%%s%%', $text))->orWhere('description', 'like', sprintf('%%%s%%', $text))->get()->transform(function ($result) {
                return [
                    'title' => $result->name,
                    'description' => $result->slug,
                    'link' => mconsole_url(sprintf('commerce/products/%s/edit', $result->id)),
                    'tags' => ['commerce', 'products', sprintf('#%s', $result->id)],
                ];
            });
        });
    },
];
