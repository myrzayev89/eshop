<?php

namespace app\controllers;

use core\App;
use core\Pagination;
use app\models\Search;

/** @property Search $model */
class SearchController extends AppController
{
    public function indexAction()
    {
        $query = get('q', 's');
        $lang = App::$app->getProperty('language');
        $page = get('page');
        $perpage = App::$app->getProperty('pagination');
        $total = $this->model->get_find_count_products($query, $lang['id']);
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();

        $products = $this->model->get_find_products($query, $lang['id'], $start, $perpage);
        $this->setMeta(___('tpl_search_title'));
        $this->set(compact('query', 'pagination', 'products'));
    }
}