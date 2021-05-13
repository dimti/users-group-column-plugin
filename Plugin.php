<?php namespace Dimti\UserGroup;

use Backend;
use RainLab\User\Controllers\Users;
use RainLab\User\Models\User;
use System\Classes\PluginBase;

/**
 * user-group Plugin Information File
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
            'name'        => 'usergroup',
            'description' => 'No description provided yet...',
            'author'      => 'dimti',
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
     * @return array
     */
    public function boot()
    {
        Users::extendListColumns(function ($list, $model) {
            if (!$model instanceof User) {
                return;
            }

            $list->addColumns([
                'groups' => [
                    'label' => 'rainlab.user::lang.user.groups',
                    'relation' => 'groups',
                    'select' => 'name',
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
            'Dimti\UserGroup\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'dimti.usergroup.some_permission' => [
                'tab' => 'usergroup',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'user-group' => [
                'label'       => 'user-group',
                'url'         => Backend::url('dimti/usergroup/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['dimti.usergroup.*'],
                'order'       => 500,
            ],
        ];
    }
}
