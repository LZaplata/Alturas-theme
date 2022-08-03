<?php namespace Lzaplata\Repeaterextensions;

use Backend;
use System\Classes\PluginBase;
use System\Models\File;
use Tailor\Models\RepeaterItem;

/**
 * Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'repeaterextensions',
            'description' => 'No description provided yet...',
            'author'      => 'lzaplata',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return void
     */
    public function boot()
    {
        RepeaterItem::extend(function ($model) {
            $model->attachOne = [
                "photo" => File::class,
            ];
        });
    }
}
