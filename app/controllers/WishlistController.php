<?php

namespace app\controllers;

use app\models\Wishlist;
use core\App;

/** @property Wishlist $model */
class WishlistController extends AppController
{
    public function indexAction()
    {
        $lang = App::$app->getProperty('language');
        $products = $this->model->get_products($lang['id']);
        $this->setMeta('Sevimliler');
        $this->set(compact('products'));
    }

    public function addAction()
    {
        $id = get('id');
        if (!$id) {
            $result = ['type' => 'error', 'text' => ___('tpl_wishlist_add_error')];
            exit(json_encode($result));
        }
        $product = $this->model->get_product($id);
        if ($product) {
            $this->model->add_to_wishlist($id);
            $result = ['type' => 'success', 'text' => ___('tpl_wishlist_add_success')];
        } else {
            $result = ['type' => 'error', 'text' => ___('tpl_wishlist_add_error')];
        }
        exit(json_encode($result));
    }

    public function deleteAction()
    {
        $id = get('id');
        ($this->model->delete_from_wishlist($id))
            ? $result = ['type' => 'success', 'text' => ___('tpl_wishlist_delete_success')]
            : $result = ['type' => 'error', 'text' => ___('tpl_wishlist_delete_error')];
        exit(json_encode($result));
    }
}