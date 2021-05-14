<?php namespace Dimti\UserGroup;

use Backend;
use Block;
use Dimti\Usergroup\FormWidgets\UserLogin;
use Dimti\Usergroup\Widgets\ImpersonateUser;
use Event;
use RainLab\User\Controllers\Users;
use RainLab\User\Models\User;
use System\Classes\PluginBase;
use System\Traits\AssetMaker;
use System\Traits\EventEmitter;

/**
 * user-group Plugin Information File
 */
class Plugin extends PluginBase
{
    use AssetMaker;
    use EventEmitter;

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

            $list->addColumns([
                'impersonate' => [
                    'label' => 'rainlab.user::lang.users.impersonate_user',
                    'type' => 'partial',
                    'path' => '$/dimti/usergroup/views/columns/_impersonate_user_button.phtml',
                ]
            ]);
        });

        Event::listen('backend.page.beforeDisplay', function ($controller, $action, $params) {
            if (is_a($controller, Users::class)) {
                $widget = $controller->makeWidget(ImpersonateUser::class);

                $widget->bindToController();
            }

            $this->addCss('/plugins/dimti/usergroup/assets/css/columns-button.css');
            $this->addJs('/plugins/dimti/usergroup/assets/js/impersonate-user.js');

            Block::append('head', $this->makeAssets('css'));
            Block::append('body', $this->makeAssets('js'));
        });
    }

    public function registerFormWidgets()
    {
        return [
            UserLogin::class => 'userlogin',
        ];
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
