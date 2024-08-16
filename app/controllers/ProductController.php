<?php

namespace app\controllers;

use app\models\Breadcrumbs;
use core\App;
use app\models\Product;

/** @property Product $model */
class ProductController extends AppController
{
    public function viewAction()
    {
        $lang = App::$app->getProperty('language');
        $product = $this->model->get_product($this->route['slug'], $lang['id']);
        if (!$product) {
            $this->error_404();
            return;
        }
        $galleries = $this->model->get_galery($product['id']);
        $breadcrumbs = Breadcrumbs::getBreadcrumbs($product['category_id'], $product['title']);
        $this->setMeta($product['title'], $product['description'], $product['keywords']);
        $this->set(compact('product', 'galleries', 'breadcrumbs'));
    }
}