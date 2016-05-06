<?php

return [
    'menu' => [
        'index' => 'Commerce',
        'categories' => 'Categories',
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
        'tabs' => [
            'main' => 'Main',
            'additional' => 'Additional',
        ],
        'table' => [
            'updated' => 'Updated',
            'slug' => 'Slug',
            'name' => 'Name',
        ],
        'form' => [
            'slug' => 'Slug',
            'name' => 'Name',
            'description' => 'Description',
        ],
    ],
    'products' => [
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
        'form' => [
            'accumulative' => 'Accumulative',
            'name' => 'Name',
            'description' => 'Description',
            'discounts' => 'Discounts table',
            'sum' => 'Total',
            'discount' => 'Discount value',
            'remove' => 'Remove',
            'append' => 'Add discount item',
        ],
    ],
];
