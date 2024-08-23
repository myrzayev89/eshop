<?php

namespace app\controllers\admin;

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
        new AppModel();
        App::$app->setProperty('languages', LanguageWidget::getLanguages());
        App::$app->setProperty('language', LanguageWidget::getLanguage(App::$app->getProperty('languages')));
    }
}