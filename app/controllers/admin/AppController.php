<?php

namespace app\controllers\admin;

use app\models\admin\User;
use app\models\AppModel;
use app\widgets\language\LanguageWidget;
use core\Controller;
use core\App;

class AppController extends Controller
{
    public false|string $layout = 'admin/app';

    public function __construct($route)
    {
        parent::__construct($route);
        if (!User::isAdmin() && $route['action'] != 'login-admin') {
            redirect(ADMIN . '/user/login-admin');
        }
        new AppModel();
        App::$app->setProperty('languages', LanguageWidget::getLanguages());
        App::$app->setProperty('language', LanguageWidget::getLanguage(App::$app->getProperty('languages')));
    }
}