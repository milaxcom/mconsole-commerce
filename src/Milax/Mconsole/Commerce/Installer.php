<?php

namespace Milax\Mconsole\Commerce;

use Milax\Mconsole\Contracts\Modules\ModuleInstaller;
use Milax\Mconsole\Models\MconsoleOption;
use Milax\Mconsole\Models\MconsoleUploadPreset;
use Schema;

class Installer implements ModuleInstaller
{
    public static $options = [
        [
            'group' => 'mconsole::commerce.settings.group.name',
            'label' => 'mconsole::commerce.settings.category.cover',
            'key' => 'category_has_cover',
            'value' => 0,
            'type' => 'select',
            'options' => ['1' => 'mconsole::settings.options.on', '0' => 'mconsole::settings.options.off'],
        ],
        [
            'group' => 'mconsole::commerce.settings.group.name',
            'label' => 'mconsole::commerce.settings.product.cover',
            'key' => 'product_has_cover',
            'value' => 1,
            'type' => 'select',
            'options' => ['1' => 'mconsole::settings.options.on', '0' => 'mconsole::settings.options.off'],
        ],
        [
            'group' => 'mconsole::commerce.settings.group.name',
            'label' => 'mconsole::commerce.settings.product.gallery',
            'key' => 'product_has_gallery',
            'value' => 1,
            'type' => 'select',
            'options' => ['1' => 'mconsole::settings.options.on', '0' => 'mconsole::settings.options.off'],
        ],
    ];
    
    public static $presets = [
        [
            'key' => 'commerce_category',
            'type' => MX_UPLOAD_TYPE_IMAGE,
            'name' => 'Commerce category',
            'path' => 'commerce',
            'extensions' => ['jpg', 'jpeg', 'png'],
            'min_width' => 90,
            'min_height' => 90,
            'operations' => [
                [
                    'operation' => 'resize',
                    'type' => 'center',
                    'width' => '90',
                    'height' => '90',
                ],
                [
                    'operation' => 'save',
                    'path' => 'category',
                    'quality' => '',
                ],
            ],
        ],
        [
            'key' => 'commerce_product_cover',
            'type' => MX_UPLOAD_TYPE_IMAGE,
            'name' => 'Product cover',
            'path' => 'commerce/product',
            'extensions' => ['jpg', 'jpeg', 'png'],
            'min_width' => 90,
            'min_height' => 90,
            'operations' => [
                [
                    'operation' => 'resize',
                    'type' => 'center',
                    'width' => '90',
                    'height' => '90',
                ],
                [
                    'operation' => 'save',
                    'path' => 'cover',
                    'quality' => '',
                ],
            ],
        ],
        [
            'key' => 'commerce_product_gallery',
            'type' => MX_UPLOAD_TYPE_IMAGE,
            'name' => 'Product gallery',
            'path' => 'commerce/product',
            'extensions' => ['jpg', 'jpeg', 'png'],
            'min_width' => 800,
            'min_height' => 600,
            'operations' => [
                [
                    'operation' => 'resize',
                    'type' => 'ratio',
                    'width' => '800',
                    'height' => '600',
                ],
                [
                    'operation' => 'save',
                    'path' => 'gallery',
                    'quality' => '',
                ],
                [
                    'operation' => 'resize',
                    'type' => 'center',
                    'width' => '90',
                    'height' => '90',
                ],
                [
                    'operation' => 'save',
                    'path' => 'preview',
                    'quality' => '',
                ],
            ],
        ],
    ];
    
    public static function install()
    {
        app('API')->options->install(self::$options);
        app('API')->presets->install(self::$presets);
    }
    
    public static function uninstall()
    {
        app('API')->options->uninstall(self::$options);
        app('API')->presets->uninstall(self::$presets);
        
        if (Schema::hasTable('commerce_categories')) {
            $repository = app('\Milax\Mconsole\Commerce\Contracts\Repositories\CategoriesRepository');
            foreach ($repository->get() as $instance) {
                $instance->delete();
            }
        }
        
        if (Schema::hasTable('commerce_products')) {
            $repository = app('\Milax\Mconsole\Commerce\Contracts\Repositories\ProductsRepository');
            foreach ($repository->get() as $instance) {
                $instance->delete();
            }
        }
    }
}
