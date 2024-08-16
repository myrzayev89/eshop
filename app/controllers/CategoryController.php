<?php

namespace app\controllers;

use app\models\Breadcrumbs;
use core\App;
use app\models\Category;
use core\Pagination;

/** @property Category $model */
class CategoryController extends AppController
{
    public function viewAction()
    {
        $lang = App::$app->getProperty('language');
        $category = $this->model->get_category($this->route['slug'], $lang['id']);

        if (!$category) {
            $this->error_404();
            return;
        }

        $breadcrumbs = Breadcrumbs::getBreadcrumbs($category['id']);
        $categoryIds = $this->model->getCategoryIds($category['id']);
        $categoryIds = !$categoryIds ? $category['id'] : $categoryIds . $category['id'];

        // Pagination
        $page = get('page');
        $perpage = App::$app->getProperty('pagination');
        $total = $this->model->get_count_products($categoryIds);
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();

        $products = $this->model->get_products($categoryIds, $lang['id'], $start, $perpage);
        $this->setMeta($category['title'], $category['description'], $category['keywords']);
        $this->set(compact('category', 'breadcrumbs', 'products', 'pagination'));
    }
}