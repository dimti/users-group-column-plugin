<?php namespace Dimti\Usergroup\Widgets;

use Backend\Classes\WidgetBase;
use Backend\Facades\BackendAuth;
use BackendMenu;
use Auth;
use Flash;
use Lang;
use Response;

/**
 * Impersonate User Back-end Controller
 */
class ImpersonateUser extends WidgetBase
{
    protected $defaultAlias = 'impersonateuser';

    public function onLogin()
    {
        if (!BackendAuth::getUser()->hasAccess('rainlab.users.impersonate_user')) {
            return Response::make(Lang::get('backend::lang.page.access_denied.label'), 403);
        }

        $model = $this->controller->formFindModelObject(post('id'));

        Auth::impersonate($model);

        Flash::success(Lang::get('rainlab.user::lang.users.impersonate_success'));
    }
}
