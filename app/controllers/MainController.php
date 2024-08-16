<?php

namespace app\controllers;

use app\models\Main;
use RedBeanPHP\R;
use core\App;

/** @property Main $model */
class MainController extends AppController
{
    public function indexAction()
    {
        $lang = App::$app->getProperty('language');
        $sliders = R::findAll('sliders');
        $products = $this->model->getHits($lang['id'], 6);
        $this->setMeta(___('main_index_meta_title'), ___('main_index_meta_description'), ___('main_index_meta_keywords'));
        $this->set(compact('sliders', 'products'));
    }
}