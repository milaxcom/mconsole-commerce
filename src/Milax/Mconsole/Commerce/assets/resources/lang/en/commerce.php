<?php

return [
    'menu' => [
        'index' => 'Commerce',
        'categories' => 'Categories',
        'products' => 'Products',
        'delivery' => 'Delivery types',
        'discounts' => 'Discounts',
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
        ],
        'form' => [
            'slug' => 'Slug',
            'name' => 'Name',
            'description' => 'Description',
            'cover' => 'Cover',
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
            'discount_price' => 'Discount price',
            'increase_price' => 'Increase price (%)',
            'decrease_price' => 'Decrease price (%)',
            'description' => 'Description',
            'cover' => 'Cover',
            'gallery' => 'Gallery',
        ],
        'config' => [
            'tables' => [
                'specifications' => 'Specifications',
            ],
            'lists' => [
                'composition' => 'Composition',
                'advantages' => 'Advantages',
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
    'settings' => [
        'group' => [
            'name' => 'Commerce',
        ],
        'category' => [
            'cover' => 'Category has cover',
        ],
    ],
];
