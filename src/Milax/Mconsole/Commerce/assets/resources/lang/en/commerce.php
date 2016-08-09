<?php

return [
    'menu' => [
        'index' => 'Commerce',
        'categories' => 'Categories',
        'products' => 'Products',
        'delivery' => 'Delivery types',
        'discounts' => 'Discounts',
        'payment' => 'Payment',
    ],
    'module' => [
        'description' => 'E-shop solutions',
    ],
    'delivery' => [
        'tabs' => [
            'main' => 'Main',
        ],
        'form' => [
            'name' => 'Name',
            'description' => 'Description',
            'cost' => 'Cost',
        ],
    ],
    'categories' => [
        'caption' => 'Categories',
        'table' => [
            'updated' => 'Updated',
            'slug' => 'Slug',
            'name' => 'Name',
        ],
        'tabs' => [
            'main' => 'Main',
            'additional' => 'Additional',
            'relationships' => 'Relationships',
        ],
        'form' => [
            'slug' => 'Slug',
            'name' => 'Name',
            'description' => 'Description',
            'cover' => 'Cover',
            'category_id' => 'Parent category',
            'parent' => 'Parent',
            'children' => 'Children',
        ],
    ],
    'products' => [
        'caption' => 'Products',
        'table' => [
            'updated' => 'Updated',
            'article' => 'Article',
            'slug' => 'Slug',
            'name' => 'Name',
        ],
        'tabs' => [
            'main' => 'Main',
            'additional' => 'Additional',
        ],
        'form' => [
            'slug' => 'Slug',
            'name' => 'Name',
            'article' => 'Article',
            'price' => 'Price',
            'inventory' => 'Inventory',
            'quantity' => 'Aviablable quantity',
            'discount_price' => 'Discount price',
            'increase_price' => 'Increase price (%)',
            'decrease_price' => 'Decrease price (%)',
            'description' => 'Description',
            'cover' => 'Cover',
            'categories' => 'Categories',
            'gallery' => 'Gallery',
            'in_stock' => 'In stock',
            'of_stock' => 'Of stock',
            'on_request' => 'On request',
        ],
        'categories' => [
            'placeholder' => 'Product must belong to at least one category',
        ],
        'info' => [
            'category' => 'Available categories not found. Please create new category.',
        ],
        'config' => [
            'tables' => [
                'specifications' => 'Specifications',
            ],
            'lists' => [
                'composition' => 'Composition (each on a new line)',
                'advantages' => 'Advantages (each on a new line)',
            ],
        ],
    ],
    'discounts' => [
        'tabs' => [
            'main' => 'Main',
            'discounts' => 'Discounts table',
        ],
        'table' => [
            'nodiscounts' => 'No discounts',
        ],
        'form' => [
            'accumulative' => 'Accumulative',
            'name' => 'Name',
            'description' => 'Description',
            'discounts' => 'Discounts table',
            'discount' => 'Discount',
            'sum' => 'Total',
            'discount' => 'Discount value',
            'remove' => 'Remove',
            'append' => 'Add discount item',
        ],
    ],
    'payment' => [
        'tabs' => [
            'main' => 'Main',
            'settings' => 'Settings',
        ],
        'table' => [
            //
        ],
        'form' => [
            'type' => 'Payment provider',
            'name' => 'Name',
            'description' => 'Description',
            'commission' => 'Commission',
            'commission_type' => 'Type',
        ],
        'robokassa' => [
            'login' => 'Shop login',
            'password' => 'Password #1',
        ],
    ],
    'settings' => [
        'group' => [
            'name' => 'Commerce',
        ],
        'category' => [
            'cover' => 'Category has cover',
        ],
    ],
];
