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
            'name' => 'mconsole::commerce.menu.promocodes',
            'url' => 'commerce/promocodes',
            'visible' => true,
            'enabled' => true,
        ], 'commerce_promocodes', 'commerce');
        
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
        
        app('API')->acl->register([
            ['GET', 'commerce/{id}/products', 'mconsole::products.acl.index'],
            ['GET', 'commerce/{id}/products/create', 'mconsole::products.acl.create'],
            ['POST', 'commerce/{id}/products', 'mconsole::products.acl.store'],
            ['GET', 'commerce/{id}/products/{products}/edit', 'mconsole::products.acl.edit'],
            ['PUT', 'commerce/{id}/products/{products}', 'mconsole::products.acl.update'],
            ['GET', 'commerce/{id}/products/{products}', 'mconsole::products.acl.show'],
            ['DELETE', 'commerce/{id}/products/{products}', 'mconsole::products.acl.destroy'],
        ]);
        
        app('API')->acl->register([
            ['GET', 'commerce/{id}/categories', 'mconsole::categories.acl.index'],
            ['GET', 'commerce/{id}/categories/create', 'mconsole::categories.acl.create'],
            ['POST', 'commerce/{id}/categories', 'mconsole::categories.acl.store'],
            ['GET', 'commerce/{id}/categories/{categories}/edit', 'mconsole::categories.acl.edit'],
            ['PUT', 'commerce/{id}/categories/{categories}', 'mconsole::categories.acl.update'],
            ['GET', 'commerce/{id}/categories/{categories}', 'mconsole::categories.acl.show'],
            ['DELETE', 'commerce/{id}/categories/{categories}', 'mconsole::categories.acl.destroy'],
        ]);
        
        app('API')->acl->register([
            ['GET', 'commerce/{id}/delivery', 'mconsole::delivery.acl.index'],
            ['GET', 'commerce/{id}/delivery/create', 'mconsole::delivery.acl.create'],
            ['POST', 'commerce/{id}/delivery', 'mconsole::delivery.acl.store'],
            ['GET', 'commerce/{id}/delivery/{delivery}/edit', 'mconsole::delivery.acl.edit'],
            ['PUT', 'commerce/{id}/delivery/{delivery}', 'mconsole::delivery.acl.update'],
            ['GET', 'commerce/{id}/delivery/{delivery}', 'mconsole::delivery.acl.show'],
            ['DELETE', 'commerce/{id}/delivery/{delivery}', 'mconsole::delivery.acl.destroy'],
        ]);
        
        app('API')->acl->register([
            ['GET', 'commerce/{id}/discounts', 'mconsole::discounts.acl.index'],
            ['GET', 'commerce/{id}/discounts/create', 'mconsole::discounts.acl.create'],
            ['POST', 'commerce/{id}/discounts', 'mconsole::discounts.acl.store'],
            ['GET', 'commerce/{id}/discounts/{discounts}/edit', 'mconsole::discounts.acl.edit'],
            ['PUT', 'commerce/{id}/discounts/{discounts}', 'mconsole::discounts.acl.update'],
            ['GET', 'commerce/{id}/discounts/{discounts}', 'mconsole::discounts.acl.show'],
            ['DELETE', 'commerce/{id}/discounts/{discounts}', 'mconsole::discounts.acl.destroy'],
        ]);
        
        app('API')->acl->register([
            ['GET', 'commerce/{id}/payment', 'mconsole::payment.acl.index'],
            ['GET', 'commerce/{id}/payment/create', 'mconsole::payment.acl.create'],
            ['POST', 'commerce/{id}/payment', 'mconsole::payment.acl.store'],
            ['GET', 'commerce/{id}/payment/{payment}/edit', 'mconsole::payment.acl.edit'],
            ['PUT', 'commerce/{id}/payment/{payment}', 'mconsole::payment.acl.update'],
            ['GET', 'commerce/{id}/payment/{payment}', 'mconsole::payment.acl.show'],
            ['DELETE', 'commerce/{id}/payment/{payment}', 'mconsole::payment.acl.destroy'],
        ]);
        
        app('API')->acl->register([
            ['GET', 'commerce/{id}/orders', 'mconsole::orders.acl.index'],
            ['GET', 'commerce/{id}/orders/create', 'mconsole::orders.acl.create'],
            ['POST', 'commerce/{id}/orders', 'mconsole::orders.acl.store'],
            ['GET', 'commerce/{id}/orders/{orders}/edit', 'mconsole::orders.acl.edit'],
            ['PUT', 'commerce/{id}/orders/{orders}', 'mconsole::orders.acl.update'],
            ['GET', 'commerce/{id}/orders/{orders}', 'mconsole::orders.acl.show'],
            ['DELETE', 'commerce/{id}/orders/{orders}', 'mconsole::orders.acl.destroy'],
        ]);
        
        app('API')->acl->register([
            ['GET', 'commerce/{id}/promocodes', 'mconsole::promocodes.acl.index'],
            ['GET', 'commerce/{id}/promocodes/create', 'mconsole::promocodes.acl.create'],
            ['POST', 'commerce/{id}/promocodes', 'mconsole::promocodes.acl.store'],
            ['GET', 'commerce/{id}/promocodes/{promocodes}/edit', 'mconsole::promocodes.acl.edit'],
            ['PUT', 'commerce/{id}/promocodes/{promocodes}', 'mconsole::promocodes.acl.update'],
            ['GET', 'commerce/{id}/promocodes/{promocodes}', 'mconsole::promocodes.acl.show'],
            ['DELETE', 'commerce/{id}/promocodes/{promocodes}', 'mconsole::promocodes.acl.destroy'],
        ]);
    },
];
