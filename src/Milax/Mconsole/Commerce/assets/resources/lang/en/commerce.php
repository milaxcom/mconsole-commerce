<?php

return [
    'menu' => [
        'index' => 'Commerce',
        'brands' => 'Brands',
        'orders' => 'Orders',
        'categories' => 'Categories',
        'products' => 'Products',
        'delivery' => 'Delivery types',
        'discounts' => 'Discounts',
        'promocodes' => 'Promocodes',
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
    'orders' => [
        'caption' => 'Orders',
        'order' => 'Order #:identifier',
        'cart' => [
            'product' => 'Product',
            'quantity' => 'Quantity',
            'price' => 'Price',
            'total' => 'Total',
        ],
        'tabs' => [
            'status' => 'Status',
            'delivery' => 'Delivery information',
            'cart' => 'Cart',
            'total' => 'Total',
        ],
        'form' => [
            'status' => 'Status',
            'email' => 'Email',
            'change_status' => 'Change order status',
            'comment' => 'Operator comment (not visible to customer)',
        ],
        'table' => [
            'identifier' => 'Order N',
            'total' => 'Total',
            'status' => 'Status',
            'delivery' => 'Delivery',
            'payment' => 'Payment',
        ],
    ],
    'brands' => [
        'caption' => 'Brands',
        'table' => [
            'updated' => 'Updated',
            'slug' => 'Slug',
            'name' => 'Name',
            'products' => 'Products',
        ],
        'tabs' => [
            'main' => 'Main',
        ],
        'form' => [
            'slug' => 'Slug',
            'name' => 'Name',
            'description' => 'Description',
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
            'brand' => 'Brand',
            'quantity' => 'Quantity',
        ],
        'tabs' => [
            'main' => 'Main',
            'additional' => 'Additional',
        ],
        'form' => [
            'brand' => 'Brand',
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
            'new' => 'Mark as new',
            'brand' => 'Brand',
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
    'promocodes' => [
        'tabs' => [
            'main' => 'Main',
            'additional' => 'Additional',
        ],
        'form' => [
            'code' => 'Code',
            'type' => 'Type',
            'discount' => 'Discount',
            'amount' => 'Amount (percents or basic currency)',
            'one_off' => 'One-off',
            'started_at' => 'Promocode start date',
            'expired_at' => 'Promocode end date',
        ],
        'type' => [
            'percent' => 'Percents',
            'amount' => 'Amount',
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
            'password1' => 'Password #1',
            'password2' => 'Password #2',
            'robochecks' => 'Robochecks support',
            'sno' => 'Tax system',
        ],
    ],
    'settings' => [
        'group' => [
            'name' => 'Commerce',
        ],
        'shop' => [
            'url' => 'Shop url prefix',
            'enabled' => 'Shop is enabled',
            'decrease_price' => 'Global price decrease (%)',
            'increase_price' => 'Global price increase (%)',
            'guests' => 'Allow guests to use shop',
            'message' => 'Message of the day',
            'show_empty_categories' => 'Show empty categories',
            'notifications_email' => 'Email for shop notifications',
        ],
        'category' => [
            'cover' => 'Category has cover',
        ],
        'product' => [
            'cover' => 'Product has cover',
            'gallery' => 'Product has gallery',
        ],
    ],
];
