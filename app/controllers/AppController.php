<?php

namespace app\controllers;

use app\models\AppModel;
use app\widgets\language\LanguageWidget;
use core\Controller;
use core\App;
use core\Language;
use core\Cache;
use RedBeanPHP\R;

class AppController extends Controller
{
    public function __construct($route)
    {
        parent::__construct($route);
        new AppModel;
        App::$app->setProperty('languages', LanguageWidget::getLanguages());
        App::$app->setProperty('language', LanguageWidget::getLanguage(App::$app->getProperty('languages')));

        $lang = App::$app->getProperty('language');
        Language::load($lang['code'], $this->route);

        $categories = R::getAssoc("SELECT c.*, cd.* FROM categories c
                JOIN category_description cd ON c.id = cd.category_id
            WHERE cd.lang_id = ?", [$lang['id']]);

        // Add container
        App::$app->setProperty("categories_{$lang['code']}", $categories);
    }
}