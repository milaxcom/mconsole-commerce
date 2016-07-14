<?php

/**
 * Mconsole commerce products configuration file
 */
return [
    'tables' => [
        'specifications' => [
            'name' => 'mconsole::commerce.products.config.tables.specifications',
            'fields' => [
                'taste' => 'mconsole::commerce.products.specifications.taste',
                'proteins' => 'mconsole::commerce.products.specifications.proteins',
                'carbohydrates' => 'mconsole::commerce.products.specifications.carbohydrates',
                'fats' => 'mconsole::commerce.products.specifications.fats',
                'calorific' => 'mconsole::commerce.products.specifications.calorific',
                'weight' => 'mconsole::commerce.products.specifications.weight',
            ],
        ],
    ],
    'lists' => [
        'composition' => 'mconsole::commerce.products.config.tables.composition',
        'advantages' => 'mconsole::commerce.products.config.tables.advantages',
    ],
];
