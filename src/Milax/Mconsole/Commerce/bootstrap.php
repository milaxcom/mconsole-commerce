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
        ], 'commerce/orders', 'commerce');
        
        app('API')->menu->push([
            'name' => 'mconsole::commerce.menu.products',
            'url' => 'commerce/products',
            'visible' => true,
            'enabled' => true,
        ], 'commerce/products', 'commerce');
        
        app('API')->menu->push([
            'name' => 'mconsole::commerce.menu.categories',
            'url' => 'commerce/categories',
            'visible' => true,
            'enabled' => true,
        ], 'commerce/categories', 'commerce');
        
        app('API')->menu->push([
            'name' => 'mconsole::commerce.menu.delivery',
            'url' => 'commerce/delivery',
            'visible' => true,
            'enabled' => true,
        ], 'commerce/delivery', 'commerce');
        
        app('API')->menu->push([
            'name' => 'mconsole::commerce.menu.discounts',
            'url' => 'commerce/discounts',
            'visible' => true,
            'enabled' => true,
        ], 'commerce/discounts', 'commerce');
        
        app('API')->menu->push([
            'name' => 'mconsole::commerce.menu.promocodes',
            'url' => 'commerce/promocodes',
            'visible' => true,
            'enabled' => true,
        ], 'commerce/promocodes', 'commerce');
        
        app('API')->menu->push([
            'name' => 'mconsole::commerce.menu.payment',
            'url' => 'commerce/payment',
            'visible' => true,
            'enabled' => true,
        ], 'commerce/payment', 'commerce');
        
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
        
        app('API')->acl->register([
            ['GET', 'commerce/products', 'mconsole::products.acl.index'],
            ['GET', 'commerce/products/create', 'mconsole::products.acl.create'],
            ['POST', 'commerce/products', 'mconsole::products.acl.store'],
            ['GET', 'commerce/products/{product}/edit', 'mconsole::products.acl.edit'],
            ['PUT', 'commerce/products/{product}', 'mconsole::products.acl.update'],
            ['GET', 'commerce/products/{product}', 'mconsole::products.acl.show'],
            ['DELETE', 'commerce/products/{product}', 'mconsole::products.acl.destroy'],
        ]);
        
        app('API')->acl->register([
            ['GET', 'commerce/categories', 'mconsole::categories.acl.index'],
            ['GET', 'commerce/categories/create', 'mconsole::categories.acl.create'],
            ['POST', 'commerce/categories', 'mconsole::categories.acl.store'],
            ['GET', 'commerce/categories/{category}/edit', 'mconsole::categories.acl.edit'],
            ['PUT', 'commerce/categories/{category}', 'mconsole::categories.acl.update'],
            ['GET', 'commerce/categories/{category}', 'mconsole::categories.acl.show'],
            ['DELETE', 'commerce/categories/{category}', 'mconsole::categories.acl.destroy'],
        ]);
        
        app('API')->acl->register([
            ['GET', 'commerce/delivery', 'mconsole::delivery.acl.index'],
            ['GET', 'commerce/delivery/create', 'mconsole::delivery.acl.create'],
            ['POST', 'commerce/delivery', 'mconsole::delivery.acl.store'],
            ['GET', 'commerce/delivery/{delivery}/edit', 'mconsole::delivery.acl.edit'],
            ['PUT', 'commerce/delivery/{delivery}', 'mconsole::delivery.acl.update'],
            ['GET', 'commerce/delivery/{delivery}', 'mconsole::delivery.acl.show'],
            ['DELETE', 'commerce/delivery/{delivery}', 'mconsole::delivery.acl.destroy'],
        ]);
        
        app('API')->acl->register([
            ['GET', 'commerce/discounts', 'mconsole::discounts.acl.index'],
            ['GET', 'commerce/discounts/create', 'mconsole::discounts.acl.create'],
            ['POST', 'commerce/discounts', 'mconsole::discounts.acl.store'],
            ['GET', 'commerce/discounts/{discount}/edit', 'mconsole::discounts.acl.edit'],
            ['PUT', 'commerce/discounts/{discount}', 'mconsole::discounts.acl.update'],
            ['GET', 'commerce/discounts/{discount}', 'mconsole::discounts.acl.show'],
            ['DELETE', 'commerce/discounts/{discount}', 'mconsole::discounts.acl.destroy'],
        ]);
        
        app('API')->acl->register([
            ['GET', 'commerce/payment', 'mconsole::payment.acl.index'],
            ['GET', 'commerce/payment/create', 'mconsole::payment.acl.create'],
            ['POST', 'commerce/payment', 'mconsole::payment.acl.store'],
            ['GET', 'commerce/payment/{payment}/edit', 'mconsole::payment.acl.edit'],
            ['PUT', 'commerce/payment/{payment}', 'mconsole::payment.acl.update'],
            ['GET', 'commerce/payment/{payment}', 'mconsole::payment.acl.show'],
            ['DELETE', 'commerce/payment/{payment}', 'mconsole::payment.acl.destroy'],
        ]);
        
        app('API')->acl->register([
            ['GET', 'commerce/orders', 'mconsole::orders.acl.index'],
            ['GET', 'commerce/orders/create', 'mconsole::orders.acl.create'],
            ['POST', 'commerce/orders', 'mconsole::orders.acl.store'],
            ['GET', 'commerce/orders/{order}/edit', 'mconsole::orders.acl.edit'],
            ['PUT', 'commerce/orders/{order}', 'mconsole::orders.acl.update'],
            ['GET', 'commerce/orders/{order}', 'mconsole::orders.acl.show'],
            ['DELETE', 'commerce/orders/{order}', 'mconsole::orders.acl.destroy'],
        ]);
        
        app('API')->acl->register([
            ['GET', 'commerce/promocodes', 'mconsole::promocodes.acl.index'],
            ['GET', 'commerce/promocodes/create', 'mconsole::promocodes.acl.create'],
            ['POST', 'commerce/promocodes', 'mconsole::promocodes.acl.store'],
            ['GET', 'commerce/promocodes/{promocode}/edit', 'mconsole::promocodes.acl.edit'],
            ['PUT', 'commerce/promocodes/{promocode}', 'mconsole::promocodes.acl.update'],
            ['GET', 'commerce/promocodes/{promocode}', 'mconsole::promocodes.acl.show'],
            ['DELETE', 'commerce/promocodes/{promocode}', 'mconsole::promocodes.acl.destroy'],
        ]);
    },
];
