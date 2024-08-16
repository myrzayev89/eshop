<?php

namespace app\controllers;

use core\App;
use app\models\Page;

/** @property Page $model*/
class PageController extends AppController
{
    public function viewAction()
    {
        $lang = App::$app->getProperty('language');
        $page = $this->model->get_page($this->route['slug'], $lang['id']);
        
        if (!$page) {
            $this->error_404();
            return;
        }

        $this->setMeta($page['title'], $page['keywords'], $page['description']);
        $this->set(compact('page'));
    }
}