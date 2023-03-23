<?php namespace LZaplata\BlogExtensions;

use Backend;
use October\Rain\Support\Facades\Event;
use RainLab\Blog\Controllers\Posts;
use RainLab\Blog\Models\Post;
use System\Classes\PluginBase;
use System\Models\File;

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
            'name'        => 'BlogExtensions',
            'description' => 'No description provided yet...',
            'author'      => 'LZaplata',
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
        /**
         * Extend Post model
         */
        Post::extend(function ($model) {
            $model->addJsonable("content_misc");
            $model->rules["content"] = "";
        });

        /**
         * Add video textarea to Rainlab.Blog post
         */
        Event::listen("backend.form.extendFields", function ($widget) {
            if (!$widget->getController() instanceof Posts) {
                return;
            }

            if (!$widget->model instanceof Post) {
                return;
            }

            if ($widget->isNested) {
                return;
            }

            $widget->addSecondaryTabFields([
                "content" => [
                    "tab"       => "rainlab.blog::lang.post.tab_edit",
                    "type"      => "richeditor",
                    "stretch"   => true,
                    "required"  => false,
                ],
                "content_misc" => [
                    "tab"           => "Obsah",
                    "type"          => "repeater",
                    "prompt"        => "Přidat obsah",
                    "itemsExpanded" => false,
                    "form" => [
                        "fields" => [
                            "type" => [
                                "type"  => "dropdown",
                                "label" => "Typ",
                                "options" => [
                                    "text"      => "Text",
                                    "gallery"   => "Galerie"
                                ],
                            ],
                            "text" => [
                                "type"  => "richeditor",
                                "size"  => "huge",
                                "label" => "Text",
                                "trigger" => [
                                    "action"    => "show",
                                    "field"     => "type",
                                    "condition" => "value[type][text]",
                                ]
                            ],
                            "images" => [
                                "type"      => "mediafinder",
                                "label"     => "Obrázky",
                                "maxItems"  => 100,
                                "mode"      => "image",
                                "trigger" => [
                                    "action"    => "show",
                                    "field"     => "type",
                                    "condition" => "value[type][gallery]",
                                ]
                            ],
                        ],
                    ]
                ],
                "video" => [
                    "label"     => "Video",
                    "tab"       => "rainlab.blog::lang.post.tab_manage",
                    "type"      => "textarea",
                ]
            ]);
        });
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'LZaplata\BlogExtensions\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * Registers any backend permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'lzaplata.blogextensions.some_permission' => [
                'tab' => 'BlogExtensions',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers backend navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'blogextensions' => [
                'label'       => 'BlogExtensions',
                'url'         => Backend::url('lzaplata/blogextensions/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['lzaplata.blogextensions.*'],
                'order'       => 500,
            ],
        ];
    }
}
