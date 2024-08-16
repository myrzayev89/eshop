<?php

namespace app\controllers;

use core\App;
use app\models\Cart;

/** @property Cart $model */
class CartController extends AppController
{
    public function addAction()
    {
        $lang = App::$app->getProperty('language');
        $id = get('id');
        $qty = get('qty');

        if (!$id) {
            return false;
        }

        $product = $this->model->get_product($id, $lang['id']);
        if (!$product) {
            return false;
        }

        $this->model->add_to_cart($product, $qty);
        if ($this->isAjax()) {
            $this->loadModalView('cart_modal');
        }
        redirect();
    }

    public function showAction()
    {
        $this->loadModalView('cart_modal');
    }

    public function deleteAction()
    {
        $id = get('id');
        if (isset($_SESSION['cart'][$id])) {
            $this->model->delete_item($id);
        }
        if ($this->isAjax()) {
            $this->loadModalView('cart_modal');
        }
        redirect();
    }

    public function clearAction()
    {
        if (empty($_SESSION['cart'])) {
            return false;
        }
        $this->model->clear_cart();
        $this->loadModalView('cart_modal');
    }
}