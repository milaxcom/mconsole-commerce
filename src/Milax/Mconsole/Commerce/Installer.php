<?php

namespace Milax\Mconsole\Commerce;

use Milax\Mconsole\Contracts\Modules\ModuleInstaller;
use Milax\Mconsole\Models\MconsoleOption;
use Milax\Mconsole\Models\MconsoleUploadPreset;

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
        
        $repository = new \Milax\Mconsole\Commerce\Repositories\CategoriesRepository(\Milax\Mconsole\Commerce\Models\Category::class);
        foreach ($repository->get() as $instance) {
            $instance->delete();
        }
    }
}
